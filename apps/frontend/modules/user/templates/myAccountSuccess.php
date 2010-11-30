<?php use_helper('Object', 'Validation') ?>
<?php use_helper('Validation', 'I18N') ?>


<?php echo form_tag('@myaccount', 'name=myaccount') ?>
<?php echo input_hidden_tag('old_email', $sf_params->get('old_email')) ?>

  <div class="onecolpage">
    <h2>Manage Your Account</h2>

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
      <?php echo submit_tag('Save', array('value'=>'save', 'class'=>'basebtn btn-save')) ?>
      <?php echo link_to('<span>Cancel</span>', '@printpage', 'class=basebtn btn-cancel') ?>
    </div>

  </div>

</form>
