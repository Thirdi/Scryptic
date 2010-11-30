<?php use_helper('Validation', 'I18N') ?>

  <div class="onecolpage">

    <?php if (isset($changed)) : ?>
      <h2>Congratulations!</h2>
      <p><strong>Registration is now complete.</strong></p>
      <p>Click <a href="/">here</a> to start using Scryptic!</p>
      
    <?php else : ?>
      <h2>Password Change</h2>
      <p>This is your first time using scryptic. Please choose a password.</p><br/>
      
      <?php echo form_tag('@force_password_change') ?>
          <div class="form-input">
            <?php
              echo form_error('password'),
              label_for('password', __('Password'))
            ?>
            <input type="password" name="password" maxlength="64" />
          </div>
      
          <div class="form-input">
            <?php
              echo form_error('password_confirm'),
              label_for('password_confirm', __('Repeat Password'))
            ?>
            <input type="password" name="password_confirm" maxlength="64" />
          </div>
        </div><!-- end of register-middle -->

        <div class="form-submit">
          <?php echo submit_tag('Save', array('value'=>'save', 'class'=>'basebtn btn-save')) ?>
        </div>

      </form>

    <?php endif ?>
    
  </div><!-- end of app-container -->
