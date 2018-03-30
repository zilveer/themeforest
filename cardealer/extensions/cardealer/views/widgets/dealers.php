<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php
global $wpdb;
$users = array();

if ($instance['user_number'] <= 0) {
    $instance['user_number'] = 5;
}

$author__in = array();
$args = array(
	'orderby' => 'registered',
	'order' => ($instance['order'] != 'random' ? $instance['order'] : 'ASC'),
);

if($instance['specific_dealer'] !== ''){
	$args['include'] = (int) $instance['specific_dealer'];
}

if(isset($instance['dealer_type']) && $instance['dealer_type'] && $instance['dealer_type'] !== '1'){
	$args['role'] = $instance['dealer_type'];
}

$u = get_users($args);

if (!empty($u)) {
	foreach ($u as $value) {
		if ($instance['dealer_type'] === '1' && !empty($value->caps['administrator'])) {
			continue;
		}

		$users[] = $value;
	}
}

if($instance['order'] == 'random'){
	shuffle($users);
}

$users = array_slice($users, 0, $instance['user_number']);
?>

<div class="widget widget_dealers">

    <?php if ($instance['title'] != '') { ?>
        <h3 class="widget-title"><?php _e($instance['title'], 'cardealer'); ?></h3>
    <?php } ?>

    <ul class="clearfix">

        <?php if (!empty($users)): ?>
            <?php foreach ($users as $user_data) : ?>
                <?php
                if (empty($user_data)) {
                    continue;
                }
								
				$dealers_page = TMM_Helper::get_permalink_by_lang( TMM::get_option('dealers_page', TMM_APP_CARDEALER_PREFIX), array('dealer_id' => $user_data->ID), true );
		        $user_logo = TMM_Cardealer_User::get_user_logo_url($user_data->ID);
		        $ud = get_userdata($user_data->ID);
                ?>

                <li>
	                <?php
	                if(isset($instance['show_dealer_logo']) && $instance['show_dealer_logo'] && !empty($user_logo)){
		                ?>

	                    <a href="<?php echo $dealers_page; ?>" class="thumb single-image">
                            <img width="80" <?php if (empty($user_logo)): ?>style="display: none;"<?php endif; ?> src="<?php echo $user_logo ?>" alt="<?php the_author_meta('display_name'); ?>" />
	                    </a>

		                <?php
	                }
	                ?>

                    <div class="table-entry">

                        <b class="dealer-title"><a href="<?php echo $dealers_page; ?>"><?php echo $user_data->data->display_name ?></a></b>

                    </div><!--/ .table-entry-->

			        <?php if ($instance['show_dealer_bio']): ?>
				        <?php
				        $bio = $ud->description;
				        if(isset($instance['dealer_bio_symbols_count']) && $instance['dealer_bio_symbols_count'] > 0){
					        $bio_after = strlen($bio) > (int) $instance['dealer_bio_symbols_count'] ? ' ...' : '';
					        $bio = mb_substr($bio, 0, (int) $instance['dealer_bio_symbols_count']) . $bio_after;
				        }
				        ?>
				        <div class="dealer-bio"><?php echo $bio ?></div>
			        <?php endif; ?>

	                <div class="clear"></div>

                    <ul class="dealer-meta">

                        <?php if ($instance['show_phone'] AND !empty($ud->phone)): ?>
                            <li><i class="icon-phone-2"></i> <?php echo $ud->phone ?></li>
                        <?php endif; ?>
                        <?php if ($instance['show_mobile'] AND !empty($ud->mobile)): ?>
                            <li><i class="icon-mobile-alt"></i> <?php echo $ud->mobile ?></li>
                        <?php endif; ?>
                        <?php if ($instance['show_fax'] AND !empty($ud->fax)): ?>
                            <li><i class="icon-print-3"></i> <?php echo $ud->fax ?></li>
                        <?php endif; ?>
                        <?php if ($instance['show_email'] AND !empty($ud->user_email)): ?>
                            <li><i class="icon-mail"></i> <a href="mailto:<?php echo $ud->user_email ?>" rel="nofollow"><?php echo $ud->user_email ?></a></li>
                        <?php endif; ?>
                        <?php if ($instance['show_skype'] AND !empty($ud->skype)): ?>
                            <li><i class="icon-skype"></i> <?php echo $ud->skype ?></li>
                        <?php endif; ?>
                        <?php if ($instance['show_site'] AND !empty($ud->user_url)): ?>
                            <li><i class="icon-link-1"></i> <a href="<?php echo $ud->user_url ?>" rel="nofollow" target="_blank"><?php echo $ud->user_url ?></a></li>
                        <?php endif; ?>
                        <?php if ($instance['show_address'] AND !empty($ud->address)): ?>
                            <li><i class="icon-address"></i> <?php echo $ud->address ?></li>
                        <?php endif; ?>

                    </ul>

	                <?php if ($instance['show_map'] AND !empty($ud->address)): ?>
		                <?php $map_data = TMM_Cardealer_User::get_user_map_data($user_data->ID);?>
		                <?php if (!empty($map_data['map_latitude']) AND $map_data['show_map_to_visitors']): ?>
			                <p class="dealer-map">
				                <?php
				                if (shortcode_exists('google_map')) {
					                echo do_shortcode('[google_map height="200" width="300" mode="image" location_mode="coordinates" latitude="' . $map_data['map_latitude'] . '" longitude="' . $map_data['map_longitude'] . '" address="" zoom="15" enable_scrollwheel="0" maptype="ROADMAP" enable_marker="1" enable_popup="0" marker_is_draggable="0"]');
				                }
				                ?>
			                </p>
		                <?php endif; ?>
	                <?php endif; ?>
                </li>

            <?php endforeach; ?>
        <?php endif; ?>

    </ul>

    <div class="clear"></div>

	<?php if (isset($instance['show_see_all_button']) && $instance['show_see_all_button'] == "true"): ?>
		<?php
		$searching_page = TMM_Helper::get_permalink_by_lang( TMM::get_option('searching_page', TMM_APP_CARDEALER_PREFIX) );
		?>
		<a class="button orange" href="<?php echo $searching_page; ?>"><?php _e('All Cars', 'cardealer'); ?></a><br />
	<?php endif; ?>

</div><!--/ .widget-->

