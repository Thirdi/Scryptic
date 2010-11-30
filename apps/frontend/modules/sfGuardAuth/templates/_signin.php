<?php use_helper('Validation', 'I18N') ?>

<div class="login">

  <?php echo form_tag('@sf_guard_signin', 'name=signin') ?>

      <?php
	  echo form_error('si_username'),
	  label_for('si_username', __('Email ')),
	  input_tag('si_username', $sf_params->get('si_username'));
	  ?><br />

      <?php
      echo form_error('si_password'),
      label_for('si_password', __('Password ')),
      input_password_tag('si_password');
      ?><br />

    <?php echo submit_tag('Sign In', 'class=basebtn btn-signin') ?>
    <a href="/request-password">Forgot Your Password?</a>

  </form>

</div>
