<?php use_helper('Object', 'Validation') ?>
<?php use_helper('Validation', 'I18N') ?>

<?php echo form_tag('user/signup', 'name=signup') ?>
<div class="onecolpage">

    <h2>Register with Scryptic</h2>

    <div class="robot-input">
<?php echo form_error('validate'),
           input_tag('validate') ?>
    </div>

    <div class="form-input">
      <?php
      echo form_error('first_name'),
      label_for('first_name', __('First Name ')),
      input_tag('first_name', $sf_params->get('first_name'), array('maxlength'=>64));
      ?>
    </div>
      
    <div class="form-input">
      <?php
      echo form_error('last_name'),
      label_for('last_name', __('Last Name ')),
      input_tag('last_name', $sf_params->get('last_name'), array('maxlength'=>64));
      ?>
    </div>
      
    <div class="form-input">
      <?php
      echo form_error('email'),
      label_for('email', __('Email ')),
      input_tag('email', $sf_params->get('email'), array('maxlength'=>128));
      ?>
      <span class="infotext">a confirmation e-mail will be sent to this address</span>
    </div>  
    
    <div class="form-input">
      <?php
      echo form_error('password'),
      label_for('password', __('Password ')),
      input_password_tag('password', $sf_params->get('password'), array('maxlength'=>128));
      ?>
    </div>
    
    <div class="form-input">
      <?php
      echo form_error('password_confirm'),
      label_for('password_confirm', __('Repeat Password ')),
      input_password_tag('password_confirm', $sf_params->get('password_confirm'), array('maxlength'=>128));
      ?>
    </div>

    <div class="form-submit">
      <?php echo submit_tag('Create', 'class=basebtn btn-create') ?>  
      <p>By clicking on 'Create', you confirm that you accept the <?php echo link_to('Terms of Service', '@termspage') ?></p>
    </div>

</div><!-- end of footer -->

</form>