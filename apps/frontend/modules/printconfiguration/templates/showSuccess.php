<table>
<tbody>
<tr>
<tr>
<th>Layout: </th>
<td><?php echo $print_configuration->getLayout()->getName() ?></td>
</tr>
<tr>
<th>Font: </th>
<td><?php echo $print_configuration->getFont()->getName() ?></td>
</tr>
<tr>
<th>Size: </th>
<td><?php echo $print_configuration->getSize() ?></td>
</tr>
<tr>
<th>Colour: </th>
<td><?php echo $print_configuration->getColour() ?></td>
</tr>
<tr>
<th>Opacity: </th>
<td><?php echo $print_configuration->getOpacity() ?></td>
</tr>
<tr>
<th>Created at: </th>
<td><?php echo $print_configuration->getCreatedAt() ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo link_to('edit', 'printconfiguration/edit?id='.$print_configuration->getId()) ?>
&nbsp;<?php echo link_to('list', 'printconfiguration/list') ?>
