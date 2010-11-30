<html>
<body style="margin:0px;padding:0px">
<?php echo form_tag("ajaxUploader/submit", array("id"=>"iform", "enctype"=>"multipart/form-data")) ?>
<?php echo input_file_tag("upload"); ?>
<?php echo input_hidden_tag($name, "__fieldname"); ?>
</form>
</body>
</html>