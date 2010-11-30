<?php use_helper('Validation') ?>

<h2 class="num2">Add Watermarks</h2>

<div id="create_group">
  <form class="group_create_form" method="post" action="javascript:">
    <?php echo form_error('wm_group_name') ?>
    <input type="text" id="wm_group_name" name="wm_group_name" maxlength="64"/><span id="wm_group_message"></span><input type="submit" value="Create" />
  </form>
</div>

<div id="group_list">
<table border="0" cellspacing="0" cellpadding="0" class="watermark-groups" id="watermark-groups-table">
  <?php foreach ($wmGroups as $group) : ?>
    <?php include_partial('watermark/displayGroup', array('group'=>$group)) ?>
  <?php endforeach ?>
  <!-- end group -->
</table>
</div>

<script language="javascript">
jQuery.noConflict();

jQuery(document).ready(function() {

  // wm create form
  jQuery('.group_create_form').bind("submit", function() {

    // submit event callback
    var postdata = jQuery(this).serialize();
    clearFormErrors();
    jQuery.post('/watermark/createGroup', postdata, function(data){
      
      // post callback function
      if (data.success) {

        // create UI for new wm... 
        jQuery.post('/watermark/renderGroup?id='+data.id, {}, function(data) {
          // render group post callback
          jQuery('#watermark-groups-table').prepend(data);
          jQuery('#wm_group_name').val('');
        }, 'html');
        
      } else {

        displayErrorMessage('wm_group_name', data.errors.wm_group_name);  
        jQuery('#wm_group_message').html(data.message);
      }
    }, 'json');
  });

  // group edit form
  jQuery('.group_edit_form_submit').live("click", function() {

    // submit event callback
    var form = jQuery(this).parent();
    var postdata = form.serialize();
    clearFormErrors();
    jQuery.post('/watermark/group/update/'+postdata.id, postdata, function(data) {

      // post callback function
      if (data.success) {
        jQuery('#group_edit_'+data.id).hide();
        jQuery('#group_value_'+data.id).html(data.value);
      } else if (!data.valid) {
        var groupId = data.id;
        displayErrorMessage('edit_wm_group_name_'+groupId, data.errors.wm_group_name);
      } else {
        jQuery('#group_edit_result_'+data.id).html(data.message);
      }
      
    }, 'json');
  });

  // group item add form
  jQuery('.group_item_add_form_submit').live("click", function() {
    // submit event callback
    var form = jQuery(this).closest('form');
    var postdata = form.serialize();
    clearFormErrors();
    jQuery.post('/watermark/createGroupItem', postdata, function(data) {

      // post callback function
      if (data.success) {

        // create UI for new wm... 
        jQuery.post('/watermark/renderGroupItem', data, function(data) {

          var postdata = this.data;
          var pieces = postdata.split("&");
          var groupId = '';
          var tmp = '';
          for (var i=0; i < pieces.length; i++) {
            tmp = pieces[i];
            if (tmp.indexOf("groupId") >= 0) {
              groupId = pieces[i].substring(8);
              break;
            }
          }

          // render group post callback
          jQuery('#group_items_'+groupId).append(data);
          jQuery('#add_group_item_'+groupId).val('');
          jQuery('#add_group_item_alt_'+groupId).val('');
          jQuery('#group_items_'+groupId).show();
        }, 'html');
        
        // update item count...
        updateItemCount(data.groupId, 1);

      } else if (!data.valid) {
        var groupId = data.wm_group_id;
        displayErrorMessage('add_group_item_'+groupId, data.errors.wm_group_item_value);
      } else {
        jQuery('#group_item_add_result_'+data.id).html(data.message);
      }
      
    }, 'json');
  });

  // group item edit form
  jQuery('.group_item_edit_form_submit').live("click", function() {

    // submit event callback
    var form = jQuery(this).closest('form');
    var postdata = form.serialize();
    clearFormErrors();
    jQuery.post('/watermark/group/item/update/'+postdata.id, postdata, function(data) {

      // post callback function
      if (data.success) {
        jQuery('#group_item_edit_'+data.id).hide();
        jQuery('#group_item_value_'+data.id).html(data.value);
        var s = data.alt_value;
        if (s != '') {
          s = '(' + s + ')';
        }
        jQuery('#group_item_alt_value_'+data.id).html(s);
      } else if (!data.valid) {
        displayErrorMessage('edit_group_item_value_'+data.id, data.errors.value);
      } else {
        jQuery('#group_item_edit_result_'+data.id).html(data.message);
      }
      
    }, 'json');
  });

});

function deleteGroup(groupId, value) {
  if (confirm('Delete '+value+'?')) {
    jQuery.post('/watermark/group/delete/'+groupId, {}, function(data) {
      
      // post callback
      if (data.success) {
        jQuery('#group_'+data.id).empty();        
      }
      
    }, 'json');
  }
}

function toggleAddGroupItem(groupId) {
  jQuery('#group_item_add_'+groupId).toggle();
}

function toggleGroupEdit(groupId) {
  jQuery('#group_edit_'+groupId).toggle();
}

function toggleGroupItems(groupId) {
  jQuery('#group_items_'+groupId).toggle();
  jQuery('#toggleGroupButton_'+groupId).toggleClass('show');
}

function toggleEditGroupItem(groupItemId) {
  jQuery('#group_item_edit_'+groupItemId).toggle();
}

function deleteGroupItem(groupId, groupItemId, value) {
  if (confirm('Delete '+value+'?')) {
    jQuery.post('/watermark/group/item/delete/'+groupItemId, {groupId: groupId}, function(data) {
      
      // post callback
      if (data.success) {
        jQuery('#group_item_'+data.id).empty();
        updateItemCount(data.groupId, -1);        
      }
      
    }, 'json');
  }
}

function updateItemCount(groupId, sign) {
  var itemCountObj = jQuery('#group_item_count_'+groupId);
  var newCount = parseInt(itemCountObj.html()) + 1 * sign;
  itemCountObj.html(newCount);
}
</script>