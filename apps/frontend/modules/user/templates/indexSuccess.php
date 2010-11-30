<!-- add user form -->
  <div class="onecolpage">

    <div id="addUserForm">
      <?php include_partial('user/userInfoForm') ?>
    </div>

    <!-- user list -->
    <div id="userList">
      <?php include_partial('user/list', array('users'=>$users)) ?>
    </div>


  </div>

<script language="javascript">
jQuery.noConflict();

jQuery(document).ready(function() {

  jQuery('form[name="updateForm"]').live("submit", function(event) {
    // submit event handler //
    
    // ajax post the form
    var postData = jQuery('form[name="updateForm"]').serialize();
    jQuery.post('/user/update', postData, function(data) {

      // post callback //
      if (data != '') {
        // add user validation error
        jQuery('#addUserForm').html(data);
      } else {
        // add user success. clear form, form errors and reload user list
        jQuery('form[name="updateForm"] input').each(function(){
          if (this.type=='text' || this.type=='hidden') {
            this.value = '';
          }
        });
        
        jQuery('.form_error').each(function() {
          jQuery(this).hide();
        });
        
        jQuery.post('/user/list', {}, function(data) {

          // user list update callback //
          jQuery('#userList').html(data);
        }, "html");
      }
    }, "html");
    
    return false; // stop regular form post
  });
});
</script>