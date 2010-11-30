<html>
<head>
<?php $token = $_GET['token'] ?>
<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />
</head>

<script src="/js/jquery-1.3.min.js"></script>
<div class="static-body">
<p>Please click <a href="/print/download?delete=false&token=<?php echo $token ?>" onclick="jQuery('#close-button').show()">here</a> to download your watermarked files.</p>

<br/>
<input id="close-button" type="submit" value="close window" onclick="window.close();" style="display:none">

</html>