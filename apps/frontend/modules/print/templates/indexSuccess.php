<?php use_helper('Object', 'Validation', 'I18N') ?>


<div class="twocolpage">

  <div class="leftcol">

    <!-- FILE COMPONENT -->
    <div id="upload-doc">
      <?php include_component('file', 'selector') ?>
    </div>

    <!-- WATERMARK COMPONENT -->
    <div id="watermarks">
      <?php include_component('watermark', 'watermarkGroups') ?>
    </div>
  
  </div>


  <div class="rightcol" id="preview-container">
    <h2>Preview</h2>
    <div id="pdf-preview" class="img-preview"></div>

    <?php echo link_to('&raquo; Configure Watermark', '@configpage') ?>
    <?php echo submit_tag('Preview', array('id'=>'preview_button', 'class'=>'basebtn btn-preview')) ?>
    
    <div class="form-submit">
      <?php echo submit_tag('Print', array('id'=>'print_button', 'class'=>'basebtn btn-print')) ?>
    </div>
  </div>

  <div class="hideiframe">
    <iframe src="" width="265" height="1" id="pdf_iframe"></iframe>
  </div>


</div>


<script langugae="javascript">
  function log(s) {
    console.log(s);
  }

  jQuery.noConflict();
  jQuery(document).ready(function(){
    autoGroupItemSelect();
    printButton();
    printPreview();

    jQuery('input[type="radio"]').live("click", function(){
      if (checkPreviewParameterFilled()) {
        updatePreview();
      }
    });
    jQuery('input[type="checkbox"]').live("click", function(){
      if (checkPreviewParameterFilled()) {
        updatePreview();
      }
    });
  });

  function printPreview() {
    jQuery('#preview_button').bind("click", function(event) {
      updatePreview();
    });      
  }

  function updatePreview() {
    // get file id and watergroups
    var post_data = gatherParameter();
    if (post_data == false) {
      return false;
    }

    // 1. send ajax request to prepare pdf (hard code file name)
    jQuery.post('/print/preview', post_data, function(data, textStatus) {

      // ajax callback function
      if (data.success) {
        jQuery('#pdf-preview').empty();
        var width;
        var height;
        var setxy;
        if (data.pdfWidth >= data.pdfHeight) {
          width = 266;
    // calculate height to vertical align center the preview image, 1/2 height is used as negative top margin combined with css to shift image up
    height = data.pdfHeight * (266/data.pdfWidth);
    marginTop = height/2;
          setwh = 'width="266" style="margin-top: -'+parseInt(marginTop)+'px; position: absolute; top: 50%; left: 0;"';
    }
        else {
          height = 346;
          setwh = 'height="346"';
        }
        jQuery('#pdf-preview').html('<img src="'+data.image_url+'" '+setwh+' />');
      } else {
        alert('Error watermarking PDF. Please try again later.');
      }
    }, "json");
  }

  function autoGroupItemSelect() {
    // bulk (un)select group items
    var groupName = 'wm_groups[]';
    jQuery("input[name='"+groupName+"']").live("click", function(event) {
  
      // "this" refers to the wm_groups[] checkbox just clicked
      var name = 'print_item['+ this.value +'][]';
      var inputs = jQuery("input[name='"+name+"']");
      is_wm_group_selected = this.checked; // global var for the each() function 
      inputs.each(function(){
        this.checked = is_wm_group_selected;
      }); 
    });
  }
  
  function checkPreviewParameterFilled() {
    var fid = jQuery("input:radio[checked=true]");
    var groups = jQuery("input:checkbox[checked=true]");
    return groups.length > 0 && fid.length > 0;
  }
  
  function gatherParameter() {

    // file
    var file_id = '';
    fid = jQuery("input:radio[checked=true]");
    if (fid.length > 0) {
      file_id = fid.get(0).value;  
    } else {
      alert('Please select a file');
      return false;
    }
    
    // groups
    groups = jQuery("input:checkbox[checked=true]");
    n = groups.length;
    if (n == 0) {
      alert('Please select a watermark');
      return false;
    }

    var group_items = new Array();
    var group_ids = new Array();
    for (i=0; i<n; i++) {
      // skip over groups
      if (groups.get(i).name=='wm_groups[]') {
        group_ids.push(groups.get(i).value);      
      } else {
        group_items.push(groups.get(i).value); 
      }
    }
    
    return { 'group_item_ids[]': group_items, 'group_ids[]': group_ids, file_id: file_id }
  }
  
  function printButton() {
    jQuery("#print_button").live("click", function(){

      var post_data = gatherParameter();
      if (post_data == false) {
        return false;
      }

      var pluginInstalled = isPdfPluginAvailable();
      if (!pluginInstalled) {
        alert('Adobe Acrobat browser plugin is required to use this application. Please see the FAQ on installing the missing plugin.');
        return false;
      }
  
      // 1. send ajax request to prepare pdf (hard code file name)
      jQuery.post('/print/print', post_data, function(data, textStatus) {
  
        // ajax callback function
        if (data.success) {
    
          // 2. on success, load iframe with pdf from 1 and print or download right away
          if (data.contentType == 'application/zip') {
            downloadFile(data);          
          } else {
            sendToPrinter(data); 
          }

        } else {
          alert('Error watermarking PDF. Please try again later.');
        }
      }, "json");
    });
  }


</script>
