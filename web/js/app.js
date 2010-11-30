/* GLOBAL VARIABLES */
var IFRAME_POLL_INTERVAL_ID = 0; // global variable. used for iframe polling

/* PLUGIN DETECTION */
function isPdfPluginAvailable() {

  var len = navigator.plugins.length;
  var name;
  var result = false;
  for (var i=0; i<len; i++) {
    name = navigator.plugins[i].name;
    if (name.indexOf('PDF') >= 0 || name.indexOf('Acrobat') >= 0) {
      result = true;
      break;
    }
  }
  if (getBrowserFamily() == 'msie') {
    result = pluginDetectionForIe();
  }
  return result;
}

// adapted from: http://www.builtfromsource.com/tag/internet-explorer/
function pluginDetectionForIe() {
  var isInstalled = false;
  var version = null;
  if (window.ActiveXObject) {
      var control = null;
      try {
          // AcroPDF.PDF is used by version 7 and later
          control = new ActiveXObject('AcroPDF.PDF');
      } catch (e) {
          // Do nothing
      }
      if (!control) {
          try {
              // PDF.PdfCtrl is used by version 6 and earlier
              control = new ActiveXObject('PDF.PdfCtrl');
          } catch (e) {
              return;
          }
      }
      if (control) {
          isInstalled = true;
          version = control.GetVersions().split(',');
          version = version[0].split('=');
          version = parseFloat(version[1]);
      }
  } else {
      // Check navigator.plugins for "Adobe Acrobat" or "Adobe PDF Plug-in"*
  }
  return isInstalled;
}

/* END PLUGIN DETECTION */

/* FILE MANAGEMENT */

function deleteFile(fileId, fname) {
  if (confirm('Delete file "'+fname+'"?')) {
    jQuery.post('/file/delete', { id: fileId }, function(data) {
      // post callback
      jQuery('#file_list').html(data);
    }, "html");
  }
}

function deleteWatermarkImage(id) {
  if (confirm('Delete watermark image?')) {
    jQuery.post('/printconfiguration/deleteWatermarkImage', { id: id }, function(data) {
      // post callback
      jQuery('#file_list').html(data);
    }, "html");
  }
}
/* END FILE MANAGEMENT */

/* Error messages */
function displayErrorMessage(inputId, message) {
  var selector = "div[class='form_error'][id='error_for_" + inputId + "']";
  jQuery(selector).text(message).show();
}

function clearFormErrors() {
  jQuery('.form_error').each(function() {
    jQuery(this).hide();
  });
}
/* End error messages*/

/* USER MANAGEMENT */
function deleteUser(userId, fullName) {
  if (confirm('Delete ' + fullName + '?')) {
    jQuery.post('/user/delete', {id: userId}, function(data) {
      // post callback //
      if (data.success) {
        jQuery.post('/user/list', {}, function(data) {
          // post callback //
          jQuery('#userList').html(data);
        }, "html");
      } else {
        alert('Error deleting user. Please try again later.');
      }
    }, "json");
  }
}
/* END USER MANAGEMENT */

/* BROWSER DETECTION */
function getBrowserFamily() {
  var data = 'unknown';
  jQuery.each(jQuery.browser, function(i, val) {
    if (val == true) {
      data = i;
    }
  });
  return data;
}
/* END BROWSER DETECTION */

/* PRINTING */
function sendToPrinter(data) {

  iframe = jQuery('#pdf_iframe');
  iframe.each(function() {
    // iframe each callback
    var browser = getBrowserFamily();
    if (browser == 'msie') {
      printIE(this, data);
    } else if (browser == 'safari') {
      printSafari(this, data);
    } else if (browser == 'mozilla') {
      printFirefox(this, data);
    } else {
      printDefault(this, data);
    }
  });
}

function downloadFile(data) {
  
  var browser = getBrowserFamily();
  if (browser == 'msie') {
    downloadIE(data);
  } else {
    iframe = jQuery('#pdf_iframe');
    iframe.each(function(){
      this.contentWindow.location.href = '/print/download?token='+data.token;
    });
  }
}

function downloadIE(data) {
  window.open('/downloader/msie.php?token='+data.token, 'downloadWindow', "height=200,width=400,status=no,toolbar=no,menubar=no,location=no");
}

function cleanup(token) {
  jQuery.post('/print/cleanup', { token: token }, function(){});
}

function printSafari(iframe, data) {
  printWindow = window.open("/print/download?token="+data.token+"&delete=false");
}

function printDefault(iframe, data) {
  iframe.contentWindow.location.href = '/print/download?token='+data.token;
  jQuery(iframe).load(function() {
    // TODO check error code. print IFF status code is 200
    iframe.contentWindow.print();
  });
}

function printFirefox(iframe, data) {
  pollIframe(iframe, data);
}

/* 
 * IE is awesome. 
 */
function printIE(iframe, data) {
  iframe.contentWindow.location.href = '/printer/msie.php?token='+data.token+'&u='+Math.random();
}

function pollIframe(iframe, data) {
  // start location polling (workaround): http://www.vanpuffelen.net/pufprinciple/iframe_onload/page.html
  iframe.contentWindow.location.href = '/print/download?token='+data.token;
  IFRAME_POLL_INTERVAL_ID = setInterval("inspectIFrame()", 1000);
}

function inspectIFrame() {
  var iframe = jQuery('#pdf_iframe').get(0);
  var loc = iframe.contentWindow.location;
  if (loc.pathname.indexOf('/print/download') >= 0) {
    clearInterval(IFRAME_POLL_INTERVAL_ID);
    iframe.contentWindow.print();
  }
}
/* END PRINTING */