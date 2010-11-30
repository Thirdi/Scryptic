<h2 class="num1">Upload Documents</h2>
<iframe id="upload_iframe" src="/file/upload" width="400" height="35" frameBorder="0" scrolling="no">file upload iframe</iframe>

<div id="file_list">
  <?php include_partial('file/list', array('pager' => $pager, 'page' => $page)) ?>
</div>

<script language="javascript">
var iframe_original_height = jQuery('#upload_iframe').attr('height');

jQuery(document).ready(function() {
  
  jQuery('#upload_iframe').bind("load", function(event) {

    // event handler
    var v = jQuery('#upload_iframe').contents().find('#upload_result').text();
    if (v == 'success') {
      this.height = iframe_original_height;
      loadFiles(1);
    } else {
      this.height = this.contentWindow.document.body.scrollHeight;
    }
  });
});

function loadFiles(page) {
  var postdata = {page: page};
  jQuery.post('/file/list', postdata, function(data, status) {
    jQuery('#file_list').html(data);
  }, 'html'); // ajax post callback
}
</script>