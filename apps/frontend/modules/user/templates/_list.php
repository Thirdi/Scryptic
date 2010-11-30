<table border="0" cellspacing="0" cellpadding="0" class="report">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>&nbsp;</th>
    <th class="editCol">&nbsp;</th>
    <th class="deleteCol">&nbsp;</th>
  </tr>
<?php $curr_user_id = $sf_user->getProfile()->getId() ?>
<?php foreach ($users as $user) : ?>
  <tr>
    <td><?php echo $user->getFirstName() ?></td>
    <td><?php echo $user->getLastName() ?></td>
    <td><?php echo $user->getSfGuardUser()->getUsername() ?></td>
    <td><?php echo $user->hasRole('administrator') ? 'admin' : '' ?></td>
    <td><?php echo link_to('Edit', '/user/edit?id='.$user->getId()) ?></td>
    <td>
      <?php if ($user->getId() != $curr_user_id) : ?>
      <a href="javascript:" class="button-delete" onclick="deleteUser(<?php echo $user->getId() ?>, '<?php echo $user->getFirstName() ?> <?php echo $user->getLastName() ?>')">Delete</a>
      <?php endif ?>
    </td>
  </tr>
<?php endforeach ?>
</table>
