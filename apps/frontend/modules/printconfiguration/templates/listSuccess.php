<h1>print configuration</h1>

<table>
<thead>
<tr>
  <th>Layout</th>
  <th>Font</th>
  <th>Size</th>
  <th>Colour</th>
  <th>Opacity</th>
  <th>Created at</th>
  <th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php foreach ($print_configurations as $print_configuration): ?>
<tr>
      <td><?php echo $print_configuration->getLayout()->getName() ?></td>
      <td><?php echo $print_configuration->getFont()->getName() ?></td>
      <td><?php echo $print_configuration->getSize() ?></td>
      <td><?php echo $print_configuration->getColour() ?></td>
      <td><?php echo $print_configuration->getOpacity() ?></td>
      <td><?php echo $print_configuration->getCreatedAt() ?></td>
      <td><?php echo link_to('edit', 'printconfiguration/edit?id='.$print_configuration->getId()) ?></td>
  </tr>
<?php endforeach; ?>
</tbody>
</table>

<?php echo link_to ('create', 'printconfiguration/create') ?>
