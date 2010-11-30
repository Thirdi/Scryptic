<?php use_helper('Validation') ?>

  <tbody id="group_<?php echo $group->getId() ?>">
    <tr>
      <td class="grp-checkbox"><input type="checkbox" name="wm_groups[]" value="<?php echo $group->getId() ?>"></td>
      <td class="grp-name"><span id="group_value_<?php echo $group->getId() ?>" onclick="javascript:selectGroup(<?php echo $group->getId() ?>)"><?php echo $group->getName() ?></span></td>
      <td class="grp-edit"><a href="javascript:" onclick="toggleGroupEdit(<?php echo $group->getId() ?>)">Edit</a></td>
      <td class="grp-delete"><a href="javascript:" class="button-delete" onclick="deleteGroup(<?php echo $group->getId() ?>, '<?php echo $group->getName() ?>')">Delete</a></td>
    </tr>  

    <tr>
      <td>&nbsp;</td>
      <td colspan="3" class="grp-members-info">
          <!-- group edit form -->
          <div style="display:none" id="group_edit_<?php echo $group->getId() ?>">
            <form action="javascript:" method="post" class="group_edit_form">
              <?php echo form_error('edit_wm_group_name_'.$group->getId()) ?>
              <input type="text" name="wm_group_name" value="<?php echo $group->getName() ?>" maxlength="64" />
              <input type="hidden" name="id" value="<?php echo $group->getId() ?>" />
              <input type="submit" value="Save" class="submit-button group_edit_form_submit" />
              <input type="button" value="Cancel" onclick="toggleGroupEdit(<?php echo $group->getId() ?>)" />
            </form>
          </div>
          <!-- end group edit form -->
          
          <a href="javascript:" onclick="toggleGroupItems(<?php echo $group->getId() ?>)" class="toggleShow" title="Click to show/hide members">
            <b id="toggleGroupButton_<?php echo $group->getId() ?>">&nbsp;</b>
            (<span id="group_item_count_<?php echo $group->getId() ?>"><?php echo count($group->getWMGroupItems()) ?></span>) Members 
          </a>
          <a href="javascript:" onclick="toggleAddGroupItem(<?php echo $group->getId() ?>)">Add</a>

          <?php echo form_error('add_group_item_'.$group->getId()) ?>
          <?php echo form_error('add_group_item_alt_'.$group->getId()) ?>

          <!-- add group item -->
          <div id="group_item_add_<?php echo $group->getId() ?>" style="display:none">
            <form action="javascript:" method="post" class="group_item_add_form">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <label for="add_group_item_<?php echo $group->getId() ?>">Name</label><br />
                    <input type="text" name="wm_group_item_value" value="" id="add_group_item_<?php echo $group->getId() ?>" maxlength="128" class="narrow" />
                  </td>
                  <td>
                    <label for="add_group_item_alt_<?php echo $group->getId() ?>">Alternate Value</label><br />
                    <input type="text" name="wm_group_item_alt_value" value="" id="add_group_item_alt_<?php echo $group->getId() ?>" maxlength="128" class="narrow" />
                  </td>
                  <td>
                    <br />
                    <input type="hidden" name="wm_group_id" value="<?php echo $group->getId() ?>" />
                    <input type="submit" value="Save" class="submit-button group_item_add_form_submit" />
                    <input type="button" value="Cancel" onclick="toggleAddGroupItem(<?php echo $group->getId() ?>)" />
                  </td>
                </tr>
              </table>
            </form>
          </div>
          
          <!-- group items -->
          <div id="group_items_<?php echo $group->getId() ?>" style="display:none" class="grp-members-list">
            <?php foreach ($group->getWMGroupItems() as $item) : ?>
            <?php include_partial('watermark/displayGroupItem', array('item'=>$item, 'group'=>$group)) ?>
            <?php endforeach ?>
            <!-- end group items -->
          </div>

      </td>
    </tr>
  </tbody>

<script language="javascript">
function selectGroup(groupid) {
  var chkbox = jQuery('input[type="checkbox"][name^="wm_groups"][value="'+groupid+'"]');
  var before = chkbox.attr('checked');
  chkbox.attr('checked', !before); // toggle
}
</script> 