<?php
if (!defined('ABSPATH')) die('No direct access allowed');

if(isset($GLOBALS['current_page']) && $GLOBALS['current_page'] === 'user-cars'){
	
$user_id = get_current_user_id();

$all_cars = TMM_Helper::get_filtered_user_cars($user_id, 'all', false);
$featured_cars = TMM_Helper::get_filtered_user_cars($user_id, 'featured', false);
$sold_cars = TMM_Helper::get_filtered_user_cars($user_id, 'sold', false);
$draft_cars = TMM_Helper::get_filtered_user_cars($user_id, 'draft', false);
$damaged_cars = TMM_Helper::get_filtered_user_cars($user_id, 'damaged', false);
$new_cars = TMM_Helper::get_filtered_user_cars($user_id, 'new', false);
$used_cars = TMM_Helper::get_filtered_user_cars($user_id, 'used', false);
?>

<div class="widget widget_statistic">

	<div class="boxed-widget">
		<?php if ($instance['title'] != '') { ?>
			<h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
		<?php } ?>

		<section class="boxed-entry clearfix">
			<input type="hidden" id="current_user_id" data-id="<?php echo $user_id ?>" data-posts-per-page="10" data-template="<?php if (!empty($_POST['template_user_cars']) && ($_POST['template_user_cars'] == true)) { echo 'template_user_cars'; } ?>">
			<ul>
				<li>
					<input class="js_filt_cars" id="filt_all_cars" type="checkbox" value="1" checked="" >
					<label for="filt_all_cars">
						<?php _e('All cars', 'cardealer'); ?> <span>(<?php echo $all_cars; ?>)</span>
					</label>
				</li>
				<li>
					<input class="js_filt_cars" id="filt_featured_cars" type="checkbox" >
					<label for="filt_featured_cars">
						<?php _e('Featured cars', 'cardealer'); ?> <span>(<?php echo $featured_cars; ?>)</span>
					</label>
				</li>
				<li>
					<input class="js_filt_cars" id="filt_sold_cars" type="checkbox" >
					<label for="filt_sold_cars">
						<?php _e('Sold cars', 'cardealer'); ?> <span>(<?php echo $sold_cars; ?>)</span>
					</label>
				</li>
				<li>
					<input class="js_filt_cars" id="filt_draft_cars" type="checkbox" >
					<label for="filt_draft_cars">
						<?php _e('Draft cars', 'cardealer'); ?> <span>(<?php echo $draft_cars; ?>)</span>
					</label>
				</li>
				<li>
					<input class="js_filt_cars" id="filt_damaged_cars" type="checkbox" >
					<label for="filt_damaged_cars">
						<?php _e('Damaged cars', 'cardealer'); ?> <span>(<?php echo $damaged_cars; ?>)</span>
					</label>
				</li>
				<li>
					<input class="js_filt_cars" id="filt_new_cars" type="checkbox" >
					<label for="filt_new_cars">
						<?php _e('New cars', 'cardealer'); ?> <span>(<?php echo $new_cars; ?>)</span>
					</label>
				</li>
				<li>
					<input class="js_filt_cars" id="filt_used_cars" type="checkbox" >
					<label for="filt_used_cars">
						<?php _e('Used cars', 'cardealer'); ?> <span>(<?php echo $used_cars; ?>)</span>
					</label>
				</li>
			</ul>
		</section><!--/ .filter-items-->

	</div><!--/ .boxed-widget-->

</div><!--/ .widget-->

<?php } ?>