<?php
// auto-generated by sfPropelCrud
// date: 2009/06/11 20:31:45
?>
<table class="formtable">
<tbody>
<tr>
<th>Id: </th>
<td><?php echo $account->getId() ?></td>
</tr>
<tr>
<th>Created at: </th>
<td><?php echo $account->getCreatedAt() ?></td>
</tr>
<tr>
<th>Deleted at: </th>
<td><?php echo $account->getDeletedAt() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'account/edit?id='.$account->getId()) ?>
&nbsp;<?php echo link_to('list', 'account/list') ?>
