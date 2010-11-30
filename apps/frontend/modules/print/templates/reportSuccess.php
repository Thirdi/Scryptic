<div class="onecolpage">

  <h2>Print History</h2>
  <div id="report-content"></div>

</div>


<script language="javascript">
jQuery(document).ready(function() {
  getReport(1);
}); // ready

function getReport(page) {
  var postdata = {page: page};
  jQuery.post('/print/report', postdata, function(data, status) {
    jQuery('#report-content').html(data);
  }, 'html'); // ajax post callback
}
</script>


