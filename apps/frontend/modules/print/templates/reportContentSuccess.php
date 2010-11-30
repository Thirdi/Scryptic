<?php $count = count($pager->getResults()) ?>

<a href="#" class="basebtn btn-viewmembers-sm" onclick="toggleMembers()"><span>View Members</span></a>

<table border="0" cellspacing="0" cellpadding="0" class="report">
<tr>
  <th class="actionCol">&nbsp;</th>
  <th class="dateCol">Date</th>
  <th class="userCol">User</th>
  <th class="pagesCol">#Docs</th>
  <th class="timeCol">Time</th>
  <th class="fileCol">File</th>
  <th class="wmCol">Watermarks</th>
</tr>

<?php if ($count == 0) : ?>
<tr>
  <td colspan="5">No Results</td>
</tr>

<?php else : ?>

    <?php $altRowCount = 0 ?>
    <?php foreach ($pager->getResults() as $ph) : ?>
    <?php 
      $altRowCount++;
      $wm_groups = $ph->getPrintHistoryGroups();
    ?>
    <tr<?php if ($altRowCount % 2) : ?> class="altrow-bg"<?php endif ?>>
      <td>
	    <?php echo link_to('<span>Print</span>', 'print/printReport?id='.$ph->getId(), array('target'=>'_blank', 'class'=>'ico-print', 'title'=>'Print')) ?>
	    <?php echo link_to('<span>Save as PDF</span>', 'print/printReport?flavour=pdf&id='.$ph->getId(), array('class'=>'ico-pdf', 'title'=>'Save as PDF')) ?>
      </td>
      <td><?php echo $ph->getCreatedAt() ?></td>
      <td><?php echo $ph->getSfGuardUserProfile()->getFirstName().' '.$ph->getSfGuardUserProfile()->getLastName() ?></td>
      <td><?php echo $ph->getNumDocuments() ?></td>
      <td><?php echo number_format($ph->getTotalTime() / 1000, 2) ?>s</td>
      <td><?php echo $ph->getFile()->getName() ?></td>
      <td>
        <div class="group_items">
        <?php foreach ($wm_groups as $wm_group) : ?>
        <a href="javascript:" onclick="javascript:showHideItems(<?php echo $wm_group->getId() ?>)"><?php echo $wm_group->getName() ?></a>
        <div class="group_item_values" id="group_item_values-<?php echo $wm_group->getId() ?>" style="display:none">
        <?php echo $wm_group->getGroupItemsAsString(', ') ?>
        </div>
        <?php endforeach ?>
        </div>
      </td>
    </tr>
    <?php endforeach ?>
    
<?php endif ?>

<?php if ($pager->haveToPaginate(ESC_RAW)): ?>
<tr>
  <td colspan="7">
  <div class="pagination">
    <?php if ($pager->getPage(ESC_RAW) != 1): ?>
      <span class="prevlink"><?php echo link_to('&laquo; Previous Page', '#', array('absolute'=>'true', 'onclick'=>'getReport('.$pager->getPreviousPage().')')) ?></span>
    <?php endif; ?>
 
    <span class="pagenum"><?php echo 'Page '.$pager->getPage().' of '.$pager->getLastPage() ?></span>

    <?php if ($pager->getPage() != $pager->getLastPage()): ?>
      <span class="nextlink"><?php echo link_to('Next Page &raquo;', '#', array('absolute'=>'true', 'onclick'=>'getReport('.$pager->getNextPage().')')) ?></span>
    <?php endif; ?>
  </div>
  </td>
</tr>
<?php endif ?>

</table>

<script language="javascript">
function showHideItems(id) {
  jQuery('#group_item_values-'+id).toggle();
}

function toggleMembers() {
  jQuery('.group_item_values').toggle();
}
</script>