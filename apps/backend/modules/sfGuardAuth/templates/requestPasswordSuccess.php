<?php use_helper('Validation', 'I18N') ?>

<?php echo form_tag('@sf_guard_password') ?>


<div class="register_form resetpass" id="sf_guard_auth_username">

  <div class="form_input">
    <?php
      echo form_error('username'), 
      label_for('username', __('Email')),
      input_tag('username', $sf_data->get('sf_params')->get('username'));
    ?>
  </div>
</div>

<div id="footer">
  <div id="footercontainer"> 

    <?php echo submit_tag('reset password') ?>
    <div class="submit-text">This will reset the current password and send a new password to the specified email address</div>

  </div>
</div>

