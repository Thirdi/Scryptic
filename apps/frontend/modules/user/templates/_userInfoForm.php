<?php use_helper('Validation') ?>

<?php $addOrEdit = 'Edit' ?>
<?php if ($sf_params->get('user_id') == '') : ?>
  <?php $addOrEdit = 'Add' ?>
<?php endif; ?>

<?php echo form_tag('user/update', 'name=updateForm') ?>
<?php echo input_hidden_tag('user_id', $sf_params->get('user_id')) ?>
<?php echo input_hidden_tag('old_email', $sf_params->get('old_email')) ?>

  <h2><?php echo $addOrEdit; ?> User</h2>

    <div class="form-input">
      <?php echo form_error('first_name') ?>
      <label for="first_name">First Name</label>
      <?php echo input_tag('first_name', $sf_params->get('first_name'), array('maxlength'=>64)) ?>
    </div>

    <div class="form-input">
      <?php echo form_error('last_name') ?>
      <label for="last_name">Last Name</label>
      <?php echo input_tag('last_name', $sf_params->get('last_name'), array('maxlength'=>64)) ?>
    </div>
      
    <div class="form-input">
      <?php echo form_error('email') ?>
      <label for="email">Email</label>
      <?php echo input_tag('email', $sf_params->get('email'), array('maxlength'=>128)) ?>
      <span class="infotext">a confirmation e-mail will be sent to this address</span>
    </div>  

    <?php if ($sf_user->hasCredential('administrator')) : ?>
    <div class="form-input">
      <label for="is_admin">Administrator</label>
      <?php echo select_tag('is_admin', options_for_select(array('no'=>'no', 'yes'=>'yes'), $sf_params->get('is_admin')))?>
    </div>
    <?php endif ?>

  <div class="form-submit">
    <?php echo submit_tag('Submit', array('value'=>'save', 'class'=>'basebtn btn-save')) ?>
    <?php if ($sf_params->get('user_id') != '') : ?>
      <?php echo link_to('<span>Cancel</span>', 'user/index', 'class=basebtn btn-cancel') ?>
    <?php endif ?>
  </div>
</form>