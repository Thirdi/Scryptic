<?php use_helper('Validation', 'I18N') ?>

<?php echo form_tag('@sf_guard_password') ?>

<div class="onecolpage" id="sf_guard_auth_username">

    <h2>Request New Password</h2>
    
    <div class="form-input">
	<?php
      echo form_error('username'), 
      label_for('username', __('Email')),
      input_tag('username', $sf_data->get('sf_params')->get('username'));
    ?>
    </div>

    <div class="form-submit">
      <?php echo submit_tag('Submit', 'class=basebtn btn-submit') ?>
      <p>This will reset the current password and send a new password to the specified email address</p>
    </div>

</div>

</form>