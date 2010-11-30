<?php use_helper('Validation') ?>
<?php if ($sf_request->hasError('deleteError')) : ?>
<div class="error">
<?php echo $sf_request->getError('deleteError') ?>
</div>
<?php endif ?>

<?php include_partial('file/list', array('pager' => $pager, 'page' => $page)) ?>