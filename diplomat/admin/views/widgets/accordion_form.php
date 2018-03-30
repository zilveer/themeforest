<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<p>
    <label for="<?php echo esc_attr($widget->get_field_id('title')); ?>"><?php esc_html_e('Title', 'diplomat') ?>:</label>
    <input class="widefat" type="text" id="<?php echo esc_attr($widget->get_field_id('title')); ?>" name="<?php echo esc_attr($widget->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
</p>

<?php
 	$titles = explode('^', $instance['acc_titles']);
	$bodies = explode('^', $instance['acc_bodies']);
 	$layers = array();
	foreach($titles as $key => $title){
		$uniqid = uniqid();
		$layers[$key]['title'] = $title;
		$layers[$key]['body'] = $bodies[$key];
		$layers[$key]['uniqid'] = $uniqid;
	}
	$id = uniqid();
?>
<div class="accordion_layout_<?php echo esc_attr($id); ?> accordion_layout">

	<input type="hidden" class='acc_titles' value="<?php echo esc_attr($instance['acc_titles']); ?>" name="<?php echo esc_attr($widget->get_field_name('acc_titles')); ?>">
	<input type="hidden" class='acc_bodies' value="<?php echo esc_attr($instance['acc_bodies']); ?>" name="<?php echo esc_attr($widget->get_field_name('acc_bodies')); ?>">

	<a href="" class="button secondary add_new_section"><?php esc_html_e('Add New Section', 'diplomat') ?></a>

	<ul class="tabs-nav">
		<?php foreach ($layers as $key => $layer){ ?>
			<li>
				<a class="" href=".item_<?php echo $layer['uniqid'] ?>">#<?php echo $key+1 ?></a>
			</li>
		<?php } ?>
	</ul>

	<ul class="layers_items clear">
		<?php foreach ($layers as $key => $layer){ ?>
			<li class="item_<?php echo esc_attr($layer['uniqid']);  ?> layer_item">
				<a class="remove_section" href="#"><?php esc_html_e('Remove', 'diplomat') ?></a>
				<p>
					<label for=""><?php esc_html_e('Accordion Title', 'diplomat') ?>:</label>
					<input class="widefat item_title acc_changer" type="text" id="" name="" value="<?php echo esc_attr($layer['title']); ?>" />
				</p>
				<p>
					<label for=""><?php esc_html_e('Accordion Body', 'diplomat') ?>:</label>
					<textarea class="widefat item_body acc_changer" id="" name="" style="height: auto !important;"><?php echo esc_attr($layer['body']); ?></textarea>
				</p>
			</li>
		<?php } ?>
	</ul>
</div>