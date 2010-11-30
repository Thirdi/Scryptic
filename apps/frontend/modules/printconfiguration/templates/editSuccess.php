<?php use_helper('Object', 'Validation') ?>

<?php echo form_tag('printconfiguration/update', array('name'=>'edit', 'id'=>'print_config_form')) ?>
<?php echo object_input_hidden_tag($print_configuration, 'getId') ?>

<div class="twocolpage">

    <div class="leftcol">

        <div id="layout-position">
          <h2>Layout Position</h2>
          <table width="460" border="0" cellspacing="0" cellpadding="0">
            <tbody>
              <tr>
                <td class="layout-img">
                  <img onclick="selectLayout(1)" src="/images/top-bottom-layout.gif" width="100" height="121" align="Top Bottom Layout" />
                  <?php echo radiobutton_tag('layout_id', 1, 1 == $print_configuration->getLayoutId(), array('onclick'=>'layoutRadioButtonClicked(this)')) ?>
                  <label for="layout_id_1">Top Bottom</label>
                </td>
                <td class="layout-img">
                  <img onclick="selectLayout(2)" src="/images/left-right-layout.gif" width="100" height="121" />
                  <?php echo radiobutton_tag('layout_id', 2, 2 == $print_configuration->getLayoutId(), array('onclick'=>'layoutRadioButtonClicked(this)')) ?>
                  <label for="layout_id_2">Left Right</label>
                </td>
                <td class="layout-img">
                  <img onclick="selectLayout(3)" src="/images/diagonal-layout.gif" width="100" height="121" />
                  <?php echo radiobutton_tag('layout_id', 3, 3 == $print_configuration->getLayoutId(), array('onclick'=>'layoutRadioButtonClicked(this)')) ?>
                  <label for="layout_id_3">L-R Diagonal</label>
                </td>
                <td class="layout-img">
                  <img onclick="selectLayout(4)" src="/images/diagonal-layout2.gif" width="100" height="121" />
                  <?php echo radiobutton_tag('layout_id', 4, 4 == $print_configuration->getLayoutId(), array('onclick'=>'layoutRadioButtonClicked(this)')) ?>
                  <label for="layout_id_4">R-L Diagonal</label>
                </td>
              </tr>
            </tbody>
          </table>
        </div><!--end of layout-position -->



        <div class="upload-wm" id="watermark-image">
          <h2>Watermark Image</h2>
          <iframe id="upload_iframe" src="/printconfiguration/upload" width="450" height="35" frameBorder="0" scrolling="no">file upload iframe</iframe>
          <div id="file_list" class="clearfix">
		    <?php include_partial('printconfiguration/listWatermarkImage', array('watermark_images'=>$watermark_images, 'print_configuration'=>$print_configuration)) ?>
          </div>

        </div><!-- end of watermark-image -->



        <div id="font-options">
          <h2>Font Options</h2>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <?php $fonts = array(); ?>
              <td>
                <?php echo form_error('font_id') ?>
                <?php echo object_select_tag($print_configuration, 'getFontId', array ('related_class' => 'Font', 'peer_method' => 'getAllOrderByName', )) ?>
              </td>
              
			  <?php $sizes = array(''=>'sizes'); for ($i=10;$i<=30;$i++) { $sizes[''.$i] = $i; } ?>
        <?php for ($i=30;$i<=130;$i = $i + 5) { $sizes[''.$i] = $i; } ?>
              <td>
                <label for="size">Size:</label>
                <?php echo form_error('size') ?>
                <?php echo select_tag('size', options_for_select($sizes, $print_configuration->getSize())) ?>
              </td>
              <td>
                <label for="color">Color:</label>

                <div id="picker-color">
                   <div id="color-close">&nbsp;</div><!-- end of the color-close -->
                   <div id="picker"></div><!--end of the picker -->   
                   <img src="/images/picker-color-background.png" width="210" height="245" />
                </div><!-- end of the picker-color -->

                <input name="Select" type="button" id="select" value="select" />
                <input type="text" id="color" name="color" size="10" value="<?php echo $print_configuration->getColour() ?>" />

              </td>
              <td>
                <div id="color2" class="colorpicker"></div>
              </td>
            </tr>
            <tr>
              <td colspan="5">
                <div class="img-opacity-field">Image Opacity
                  <input type="text" id="amount" name="amount" value=""/>
                  <input name="hiddenamount" type="hidden" value="<?php echo $sf_params->get('amount', $print_configuration->getOpacity()) ?>" id="hiddenamount"/>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="5"><div id="slider-range-min" class="slider-container"></div></td>
            </tr>
            <tr>
              <td colspan="5"><img src="/images/scale2.gif" width="452" height="20" /></td>
            </tr>
          </table>
        </div> <!-- end of font-options -->

      </div>


      <div class="rightcol" id="preview-container">
        <h2>Preview</h2>
        <div id="pdf-preview" class="img-preview"></div>

        <?php echo submit_tag('Preview', array('id'=>'preview_button', 'class'=>'basebtn btn-preview')) ?>

        <div class="form-submit">
          <?php echo submit_tag('Save', array('class'=>'basebtn btn-save')) ?>
          <?php echo link_to('<span>Cancel</span>', '@printpage', 'class=basebtn btn-cancel') ?>
        </div>
      </div>

      <div class="hideiframe"></div>

</div>

</form>

<script language="javascript">
jQuery(document).ready(function() {

  // document ready callback ...
  
  // bind events that would change preview image
  jQuery("select").bind("change", function() {
    updatePreview();  
  });

  jQuery('#color-close').bind("click", function() {
    updatePreview();  
  });

  jQuery('.ui-slider-handle').mouseup(function() {
    updatePreview();  
  });
  
  // get preview image
  updatePreview();
  
  // register preview onclick event
  jQuery('#preview_button').bind("click", function() {
    // click event callback
    updatePreview();
    return false;
  });
}); 

function layoutRadioButtonClicked(radioButton) {
  uncheckAll();
  radioButton.checked='checked';
  updatePreview();  
}

function watermarkImageClicked(radioButton) {
  uncheckAll();
  radioButton.checked='checked';
  updatePreview();  
}

function uncheckAll() {
  jQuery('input[type="radio"]').each(function(){
    jQuery(this).attr('checked', '');
  });
}

function updatePreview() {

  var data = jQuery('#print_config_form').serialize();
  jQuery.post('/printconfiguration/generatePreview', data, function(data, textStatus) {

    // post callback ...
    if (data.success) {
      jQuery('#pdf-preview').empty();
      jQuery('#pdf-preview').html('<img src="'+data.image_url+'" width="265" height="346" />');
    } else {
      var msg = '';
      if (data.error_code == 1) {
        msg = 'Please create a configuration first';
      } else if (data.error_code == 2) {
        msg = 'Preview is unavailable. Please check again later.';
      }
      jQuery('#pdf-preview').html(msg);
    }
  }, "json");
}

function selectLayout(layout_id) {
  jQuery('input#layout_id_' + layout_id).attr("checked", "true");
}

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
  jQuery.post('/printconfiguration/listWatermarkImage', postdata, function(data, status) {
    jQuery('#file_list').html(data);
  }, 'html'); // ajax post callback
}
</script>

