<table border="0" cellspacing="0" cellpadding="0">
<tbody>
  <tr>
    <th></th>
    <th>Name</th>
    <th>Uploaded By</th>
    <th>Date</th>
    <th></th>
  </tr>
<?php foreach ($pager->getResults() as $file) : ?>
  <tr onmouseover="this.className='hover'" onmouseout="this.className=''" onclick="javascript:selectFile(this)">
    <td><?php echo radiobutton_tag('print_file', $file->getId(), false) ?></td>
	<td><?php echo $file->getName() ?></td>
    <td><?php echo $file->getsfGuardUserProfile()->getFullName(); ?></td>
    <td><?php echo $file->getCreatedAt(); ?></td>
    <td><a href="javascript:" class="button-delete" onclick="deleteFile(<?php echo $file->getId() ?>, '<?php echo $file->getName() ?>')">Delete</a></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php if ($pager->haveToPaginate()): ?>
<div class="pagination">
  <?php if ($page > 1): ?>
    <span class="prevlink"><a href="javascript:" onclick="loadFiles(<?php echo $pager->getPreviousPage() ?>)">&laquo; Previous</a></span>
  <?php endif; ?>
  <?php if ($page < $pager->getLastPage()): ?>
    <span class="nextlink"><a href="javascript:" onclick="loadFiles(<?php echo $pager->getNextPage() ?>)">Next &raquo;</a></span>
  <?php endif; ?>
</div>
<?php endif; ?>

<script language="javascript">
function selectFile(row) {
  var radio = jQuery(row).find('input[type="radio"]');
  radio.attr('checked', 'true');
}
</script>