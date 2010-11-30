<?php use_helper('Validation') ?>

            <div id="group_item_<?php echo $item->getId() ?>">
              <?php echo checkbox_tag('print_item['.$group->getId().'][]', $item->getId()) ?>&nbsp;
              <label for="print_item_<?php echo $group->getId() ?>_<?php echo $item->getId() ?>" class="grp-item-label">
                <span id="group_item_value_<?php echo $item->getId() ?>"><?php echo $item->getValue() ?></span>&nbsp;
                <span id="group_item_alt_value_<?php echo $item->getId() ?>"><?php echo ($item->getAltValue() != '' ? '('.$item->getAltValue().')' : '') ?></span>&nbsp;
              </label>
              <a href="javascript:" onclick="toggleEditGroupItem(<?php echo $item->getId() ?>)">Edit</a> | <a href="javascript:" onclick="deleteGroupItem(<?php echo $group->getId() ?>, <?php echo $item->getId() ?>, '<?php echo $item->getValue() ?>')">Delete</a><br/>
            </div>
            
            <div id="group_item_edit_<?php echo $item->getId() ?>" style="display:none">
              
              <!-- group item edit result goes here -->
              <span id="group_item_edit_result_<?php echo $item->getId() ?>"></span>
              
              <?php echo form_error('edit_group_item_value_'.$item->getId()) ?>
              <?php echo form_error('edit_group_item_alt_value_'.$item->getId()) ?>

              <!-- group item edit form -->
              <form class="group_item_edit_form" method="post" action="javascript:">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>
                    <label for="edit_group_item_name_<?php echo $item->getId() ?>">Name</label><br />
                    <input type="text" name="value" value="<?php echo $item->getValue() ?>" id="edit_group_item_name_<?php echo $item->getId() ?>" maxlength="128" class="narrow" />
                  </td>
                  <td>
                    <label for="edit_group_item_altname_<?php echo $item->getId() ?>">Alternate Value</label><br />
                    <input type="text" name="alt_value" value="<?php echo $item->getAltValue() ?>" id="edit_group_item_altname_<?php echo $item->getId() ?>" maxlength="128" class="narrow" />
                  </td>
                  <td>
                    <br />
                    <input type="hidden" name="id" value="<?php echo $item->getId() ?>" />
                    <input type="submit" value="Save" class="group_item_edit_form_submit" />
                    <input type="button" value="Cancel" onclick="toggleEditGroupItem(<?php echo $item->getId() ?>)" />
                  </td>
                </tr>
              </table>
              </form>
              <!-- end group item edit form -->
              
            </div>
