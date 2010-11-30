<?php echo stylesheet_tag('iframe') ?>
<?php echo javascript_include_tag('jquery-1.3.min.js') ?>

<?php use_helper('Validation') ?>

<!-- the following div gets probed by iframe parent to determine result of upload -->
<div id="upload_result" style="display:none"><?php echo isset($upload_result) ? $upload_result : '' ?></div>

<?php if (isset($upload_result) && $upload_result == false) : ?>
  An error has occurred. Please try again later.
<?php endif ?>

<?php echo form_tag('file/upload', 'multipart=true name=upload') ?>
  <?php echo form_error('file'), input_file_tag('file') ?>
  <?php echo submit_tag('Upload') ?><span id="upload_indicator" style="display:none"><img src="/images/indicator.gif" /></span>
</form>

<script language="javascript">
jQuery('form[name="upload"]').bind("submit", function() {
  jQuery('#upload_indicator').show();
});
</script>
