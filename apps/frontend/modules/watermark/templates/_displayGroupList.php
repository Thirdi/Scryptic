
<table border="0" cellspacing="0" cellpadding="0" class="watermark-groups">
<?php foreach ($wmGroups as $wmGroup) : ?>
<tbody>
  <tr id="wm_group_<?php echo $wmGroup->getId() ?>">
     <?php include_partial('watermark/displayGroup', array('wmGroup' => $wmGroup)) ?>	   
  </tr>
  <tr id="wm_group_item_link_<?php echo $wmGroup->getId() ?>">
    <td></td>
    <td colspan="3">
    (<?php echo $wmGroup->countWMGroupItems() ?>) 
    Members <?php echo link_to_remote('Show', array('update' => 'wm_group_item_'.$wmGroup->getId(),
													'url'=>'@display_watermark_group_items?id='.$wmGroup->getId(),
													'success' => ''))  ?>
    </td>
  </tr>
  <tr id="wm_group_item_<?php echo $wmGroup->getId() ?>"></tr>
  <tr>
  	<td colspan="4" class="underline">&nbsp;</td>
  </tr>
</tbody>
<?php endforeach; ?>
</table>