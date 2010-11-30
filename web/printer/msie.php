<html>
<body> 
<script src="/js/jquery-1.3.min.js" type="text/javascript"></script>
<script src="/js/app.js" type="text/javascript"></script>

<?php $token = $_GET['token'] ?>
<?php $download_url = "/print/download?token=".$token."&delete=false" ?>

<embed id="embedded_pdf" src="<?php echo $download_url ?>" type="application/pdf"></embed>

<script language="javascript">
  jQuery(document).ready(function() {
    // ajax request to get a file
    var data = {};
    jQuery.get('<?php echo $download_url ?>', data, function(data, textStatus) {
      setTimeout('updateEmbed()', 500);
    });
  });
  
  function updateEmbed() {
      jQuery('#embedded_pdf').attr('src', '<?php echo $download_url ?>');
      var embed = document.getElementById('embedded_pdf');
      embed.print();
  }
</script>

</body>
</html>
