<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<input type="hidden" value="<?php echo $data_group_index ?>" name="data_groups[<?php echo $data_group_index ?>][]">
<a href="#" data-group-index="<?php echo $data_group_index ?>" data-group-name="<?php echo $name ?>" class="show_group_data_link"><?php echo $name ?></a>
<a class="edit show_group_data_link" data-group-index="<?php echo $data_group_index ?>" title="<?php _e("Edit", 'cardealer') ?>" href="#"></a>
<a class="remove delete_group" data-group-index="<?php echo $data_group_index ?>" title="<?php _e("Delete", 'cardealer') ?>" href="#"></a>

