<?php use_helper('sfEmail'); ?>

<?php if (isset($files)) foreach ($files as $f): ?>

<?php echo link_to_file($f) ?>

<br />

<?php endforeach ?>