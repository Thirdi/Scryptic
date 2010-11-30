<h2>account</h2>

<table class="datatable">
<thead>
<tr>
  <th>Created at</th>
  <th>Action</th>
</tr>
</thead>
<tbody>
<?php foreach ($accounts as $account): ?>
<tr>
      <td><?php echo $account->getCreatedAt() ?></td>
      <td><?php echo link_to('edit', 'account/edit?id='.$account->getId()) ?> | <?php echo link_to('delete', 'account/delete?id='.$account->getId(), array('onclick'=>'confirm("Delete account?")')) ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'account/create') ?>
