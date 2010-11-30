<?php use_helper('Validation', 'I18N') ?>

<?php echo form_tag('@sf_guard_signin', 'name=signin') ?>

  <div class="onecolpage">
  
    <h2>Sign in to your Scryptic Account</h2>

    <div class="form-input">
	  <?php
        echo form_error('si_username'), 
        label_for('si_username', __('Email')),
        input_tag('si_username', $sf_data->get('sf_params')->get('si_username'), array('id'=>'email'));
      ?>
    </div>

    <div class="form-input">
      <?php
        echo form_error('si_password'), 
        label_for('si_password', __('Password')),
        input_password_tag('si_password', '', array('id'=>'password'));
      ?>
      <span class="infotext"><?php echo link_to(__('Forgot Your Password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password')) ?></span>
    </div>

    <div class="form-submit">
      <?php echo submit_tag('Sign In', 'class=basebtn btn-signin') ?>
    </div>

  </div>

</form>
