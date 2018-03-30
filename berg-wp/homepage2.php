<?php
/*
Template Name: Home 2
*/

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package berg-wp
 */

wp_enqueue_script('jquery-ui-datepicker');


get_header(); 
$dateFormat = YSettings::g('home_left_reservation_date_format');
$post_meta = get_post_meta(get_the_ID());
$section_home_opacity = '';
$opacity = '';

if(isset($post_meta['home_slider_opacity'][0])) {
	$section_home_opacity = $post_meta['home_slider_opacity'][0];
	$opacity = $section_home_opacity; 
} else {
	$opacity = 30;
}

?>

<div class="home-2 no-intro-padding <?php if(YSettings::g('home_left_mobile_homepage') != 0 && YSettings::g('home_left_mobile_version') == 'different') : ?> hidden-xs hidden-sm <?php endif;?>">
	<div class="home-content hidden-xs hidden-sm">
		<?php if(YSettings::g('home_background_type') == 'video'): 
			$videoUrl = YSettings::g('home_background_video');
			$videoMute = get_post_meta(get_the_id(), 'home_background_video_mute', true);
			if($videoMute == '1') {
				$videoMute = 'true';
			} else {
				$videoMute = 'false';
			}
		?>
		<div class="video-home-wrapper" style="position: fixed; left: 0; right: 0; top: 0; bottom: 0; z-index:1;">
			<div class="video-wrapper" style="position:absolute; left: 0; top: 0; right: 0; bottom: 0; "></div>
			<div id="P1" class="player" style="display:block; margin: auto; background: rgba(0,0,0,0.5);" data-property="{videoURL:'<?php echo $videoUrl; ?>',containment:'.video-wrapper',startAt:0,mute:<?php echo $videoMute; ?>,autoPlay:true,loop:true,opacity:1,showControls: false}"></div>
			<?php if(YSettings::g('section_video_overlay') == 'mask') : ?>
				<div class="video-mask hidden-xs" style="background: <?php echo YSettings::g('section_video_color_overlay', get_the_id()) ;?> url('<?php echo THEME_DIR_URI .'/img/overlay.png';?>') repeat 0 0;"></div>
			<?php endif ;?>
			<?php if(YSettings::g('section_video_overlay') == 'color_overlay') : ?>
				<div class="video-overlay hidden-xs" style="background: <?php echo YSettings::g('section_video_color_overlay', get_the_id()) ;?>"></div>
			<?php endif ;?>
		</div>
		<?php elseif(YSettings::g('home_background_type') == 'revslider'): 
			$revslider = YSettings::g('home_background_revslider');
			putRevSlider($revslider);
		?>

		<?php endif; ?>
		<?php if(YSettings::g('home_background_type') !== 'revslider') :?>
		<ul id="scene" class="<?php //echo 'opacity-'.$opacity;?>">		
			<li class="layer" data-depth="0.30">
				<div class="parallax-slides">

					<?php
					if(YSettings::g('home_background_type' ) == 'static' || YSettings::g('home_background_type') == '') {

						$img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large_bg');
						echo '<div class="slide" style="background-image: url('.$img[0].');"></div>';

					} elseif(YSettings::g('home_background_type') == 'slider') {
						// echo '<div class="slider-bg opacity-'.$opacity.'" style="">';
						$slides = YSettings::g('home_background_images');
						if($slides != false && $slides != '') {
							$slides = explode(',', $slides);
							foreach($slides as $s) {
								$img = wp_get_attachment_image_src( $s, 'large_bg');
								echo '<div class="slide" style="background-image: url('.$img[0].');"></div>';
							}
						}
						// echo '</div>';

					} ?>

				</div>
				<script>slidesDuration = <?php echo (isset($post_meta['home_slides_duration'][0]) && $post_meta['home_slides_duration'][0] > 100 ) ? $post_meta['home_slides_duration'][0] : 5000; ?></script>
				<?php if(YSettings::g('home_background_type') !== 'video') :?>
				<div class="parallax-overlay <?php echo 'opacity-'.$opacity;?>"></div>
				<?php endif; ?>
			</li>

			<li class="layer" data-depth="0.40">
				<div class="button-header-wrapper">
					<div class="button-table-bottom"><div class="button-table-bottom-cell">
						<h1><span class="first-line" data-replace="<?php echo __('Date', 'BERG');?>" data-base="<?php echo YSettings::g('home_header_text');?>"><?php echo YSettings::g('home_header_text');?></span></h1>
					</div></div>
				</div>
			</li>
			<li class="layer" data-depth="0.60">
				<div class="button-wrapper">
					<span class="second-border button-content button-frame" style="position: relative; ">
						<span class="button-frame-inner">
							<span class="second-line"><?php echo YSettings::g('home_button_text');?></span>
							<span class="button-frame-hover" style="position: absolute; left: -2px; top: -2px; right: -2px; bottom: -2px; display: block; border: 2px solid #fff; "></span>
						</span>
					</span>
				</div>
			</li>
			<li class="layer" data-depth="0.80">
				<div class="button-wrapper">
					<div class="button-content button-arrow">
						<span class="second-line"><?php echo YSettings::g('home_button_text');?></span>
						<svg xmlns="http://www.w3.org/2000/svg" class="second-border" xmlns:xlink="http://www.w3.org/1999/xlink" width="100px" height="100%" viewBox="0 0 100 50" preserveAspectRatio="xMidYMid meet" zoomAndPan="disable" ><line id="e4_line" x1="0" y1="25" x2="98" y2="25" stroke="#fff" style="stroke-width: 2px; vector-effect: non-scaling-stroke; fill: none;"/><polygon points="100,25 85,34 85,16" style="stroke-width: 2px; vector-effect: non-scaling-stroke; fill: #fff;" ></polygon></svg>
					</div>
				</div>
			</li>
			<li class="layer" data-depth="0.70">
				<div class="button-wrapper">
					<span class="button-content button-text">
						<?php
							
							$largeDate = str_replace('-', ' | ', $dateFormat);
						?>
						<a href="<?php echo YSettings::g('home_button_link');?>" class="second-line" data-replace="<?php echo date($largeDate);?>" data-base="<?php echo YSettings::g('home_button_text');?>"><?php echo YSettings::g('home_button_text');?></a>
						<div id="reservation-trigger"></div>
					</span>
				</div>
			</li>
		</ul>
		<?php endif ;?>

	</div>

	<div class="home-info">
	

		<?php
		$logo = YSettings::g('logo_image_home');
		if(isset($logo['url']) && $logo != '') : ?>						
		<div class="hidden-sm hidden-xs home-logo text-<?php echo YSettings::g('logo_image_home_align'); ?>">
			<a href="<?php echo get_home_url();?>"><img src="<?php echo $logo['url']; ?>" class="" alt="<?php bloginfo('name'); ?>" /></a>
		</div>
		<?php endif; ?>
		<div class="home-info-inner">

			<?php 
			the_post();
			the_content();

			?>

			<a href="<?php echo YSettings::g('home_button_link');?>" class="hidden-md hidden-lg booking-switch home-left-button" style="font-family: lato; font-weight: 900; font-size: 12px; letter-spacing: 2px; padding: 15px; border: 2px solid #333; text-align: center; cursor: pointer; margin-bottom: 15px; "><span><?php echo YSettings::g('home_button_text');?></span></a>
			<?php if(YSettings::g('home_left_reservation') == 1) :
				$reservationUrl = '#';
				if(YSettings::g('home_left_reservation_type') == 'custom') {
					$reservationUrl = YSettings::g('home_left_reservation_custom_link');
				}
			?>

			<a href="<?php echo $reservationUrl; ?>" class="booking-switch hidden-xs hidden-sm home-left-button"><span><?php echo YSettings::g('home_left_reservation_text'); ?></span></a>
			<a href="<?php echo $reservationUrl; ?>" class="mobile-booking-switch visible-xs visible-sm home-left-button"><span><?php echo YSettings::g('home_left_reservation_text'); ?></span></a>
			<?php endif; ?>
		
			<?php if(YSettings::g('home_left_reservation') == 1 && YSettings::g('home_left_reservation_type') == 'opentable') : ?>
			<div class="mobile-booking" style="display: none;">
				<div>
					<i class="fa fa-calendar"></i>
					<?php if($dateFormat != 'Y-m-d') : ?>
					<select id="mobile-booking-day">
						<option value="<?php echo date('d'); ?>"><?php echo date('d'); ?></option>
					</select>
					<?php endif; ?>
					<select id="mobile-booking-month">
						<?php 
							$smallFormat = 'F Y';
							if($dateFormat == 'Y-m-d') {
								$smallFormat = 'Y F';
							}
							$now = strtotime(date('Y-m'));
							for ($i=0; $i < 4 ; $i++) { 
								$time = strtotime('+'.$i.' month', $now);
								echo '<option value="'.date("m/Y", $time).'">'.date($smallFormat, $time).'</option>';
							}
						?>
					</select>
					<?php if($dateFormat == 'Y-m-d') : ?>
					<select id="mobile-booking-day">
						<option value="<?php echo date('d'); ?>"><?php echo date('d'); ?></option>
					</select>
					<?php endif; ?>					
				</div>
				<div>
					<i class="fa fa-clock-o"></i>
					<select id="mobile-booking-hour">
						<?php
						if(YSettings::g('home_left_reservation_time_format') == '24') {
							for ($i=0; $i <= 23; $i++) { 
								if(strlen($i) == 1) {
									$i = '0'.$i;
								}
								if($i == 12) {
									echo '<option selected value="'.$i.'">'.$i.'</option>';
								} else {
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
							} 
						} else {
							for ($i=1; $i <= 12; $i++) { 
								if(strlen($i) == 1) {
									$i = '0'.$i;
								}
								if($i == 12) {
									echo '<option selected value="'.$i.'">'.$i.'</option>';
								} else {
									echo '<option value="'.$i.'">'.$i.'</option>';
								}
							}
						}
						?>
					</select>
					<select id="mobile-booking-minutes">
						<option selected>00</option>
						<option>30</option>
					</select>
					<?php if(YSettings::g('home_left_reservation_time_format') == '12') : ?>
					<select id="mobile-booking-time">
						<option><?php echo __('AM', 'BERG'); ?></option>
						<option selected><?php echo __('PM', 'BERG'); ?></option>
					</select>
					<?php endif; ?>

				</div>
				<div style="margin-bottom: 30px; ">
					<i class="fa fa-users"></i>
					<select id="mobile-booking-party">
						<?php for ($i=1; $i <= 10; $i++) { 
							if(strlen($i) == 1) {
								$i = '0'.$i;
							}
							if($i == '02') {
								echo '<option selected value="'.$i.'">'.$i.'</option>';
							} else {
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						} ?>
					</select>
				</div>
				<div style="margin-bottom: 30px; font-family: lato; font-weight: 900; font-size: 12px; letter-spacing: 2px; padding: 15px; border: 2px solid #333; text-align: center; cursor: pointer;" class="mobile-booking-submit"><?php echo __('SUBMIT', 'BERG'); ?></div>					
		
			</div>
			<?php endif; ?>
		</div>
		<div class="home-info-footer">
		<?php echo berg_get_social_profiles(); ?>
		<p><?php echo YSettings::g('home_left_footer_text');?></p>
		</div>
	
	</div>
	<?php if(YSettings::g('home_left_reservation') == 1) : ?>
	<div class="reservation-form">
		<div class="reservation-form-1">
			<div id="reservation-datepicker"></div>
			<div class="datepicker-submit form-submit">
				<div class="form-close"><?php echo __('CLOSE', 'BERG'); ?></div>
				<div class="form-next-step"><?php echo __('NEXT STEP', 'BERG'); ?> <span><span class="sup">1</span>/<span class="sub">3</span></span></div>
			</div>
		</div>
		<div class="reservation-form-2">
			<div class="form-inner-wrapper">
				<h1><?php echo __('Time', 'BERG'); ?></h1>
				<span class="spinner-frame">
					<span class="spinner-wrapper">
						<span class="value spinner-hour">12</span> <i class="fa fa-angle-up spinner-up"></i><i class="fa fa-angle-down spinner-down"></i>
					</span>
					:
					<span class="spinner-wrapper">
						<span class="value spinner-minutes">00</span> <i class="fa fa-angle-up spinner-up-minutes"></i><i class="fa fa-angle-down spinner-down-minutes"></i>
					</span>
					<?php if(YSettings::g('home_left_reservation_time_format') == '12') : ?>
						<span class="time-range time-am">AM</span>/<span class="time-range time-pm time-range-active">PM</span>
					<?php endif; ?>
				</span>
			</div>
			<div class="timepicker-submit form-submit">
				<div class="form-close"><?php echo __('CLOSE', 'BERG'); ?></div>
				<div class="form-next-step"><?php echo __('NEXT STEP', 'BERG');?> <span><span class="sup">2</span>/<span class="sub">3</span></span></div>
			</div>
		</div>
		<div class="reservation-form-3">
			<div class="form-inner-wrapper">
				<h1><?php echo __('Party', 'BERG'); ?></h1>
				<span class="spinner-frame">
					<span class="spinner-wrapper">
						<span class="value spinner-party">02</span><i class="fa fa-angle-up spinner-up-party"></i><i class="fa fa-angle-down spinner-down-party"></i>
					</span>
				</span>
			</div>
			<div class="reservation-submit form-submit">
				<div class="form-close"><?php echo __('CLOSE','BERG');?></div>
				<div class="form-next-step"><?php echo __('FINISH', 'BERG');?> <span><span class="sup">3</span>/<span class="sub">3</span></span></div>
			</div>
		</div>
	</div>
	<div class="home-reservation-back" style="display:none ">
		<div class="form-close"><?php echo __('CLOSE','BERG');?></div>
	</div>
<?php endif; ?>
</div>

<?php if(YSettings::g('home_left_reservation') == 1) : ?>
<form method="get" class="otw-widget-form" action="http://www.opentable.com/restaurant-search.aspx" style="z-index: 9999; background: red; position: fixed;" target="_blank">
	<div class="otw-wrapper">
		<div class="otw-date-li otw-input-wrap">
			<label for="date-otreservations"><i class="icon-calendar"></i></label>
			<input id="date-otreservations" name="startDate" class="otw-reservation-date" type="text" value="<?php echo date('d/m/Y');?>" autocomplete="off">
		</div>
		<div class="otw-time-wrap otw-input-wrap"> <label for="time-otreservations"><i class="icon-clock-o"></i></label>
			<input type="text" id="time-otreservations" name="ResTime" class="otw-reservation-time selectpicker" value="12:00"/>

		</div>
		<div class="otw-party-size-wrap otw-input-wrap"> <label for="party-otreservations"><i class="icon-user"></i></label>
			<input type="text" id="party-otreservations" name="partySize" value="2" class="otw-party-size-select selectpicker"/>
		</div>
		<div class="otw-button-wrap">
			<input type="submit" class="otreservations-submit" value="Find a Table">
			<input type="hidden" name="RestaurantID" class="RestaurantID" value="<?php echo YSettings::g('home_left_reservation_opentable_id');?>">
			<input type="hidden" name="rid" class="rid" value="<?php echo YSettings::g('home_left_reservation_opentable_id');?>">
			<input type="hidden" name="GeoID" class="GeoID" value="15">
			<input type="hidden" name="txtDateFormat" class="txtDateFormat" value="DD/MM/YYYY">
			<input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="<?php echo YSettings::g('home_left_reservation_opentable_id');?>">
		</div>
	</div>
</form>
<?php endif; ?>

<?php
if(YSettings::g('home_left_mobile_version') == 'different') { 
	if(YSettings::g('home_left_mobile_homepage') != 0) {

		$pageId = YSettings::g('home_left_mobile_homepage');

		if (function_exists('icl_object_id')) {
			$icl = (int)icl_object_id($pageId, 'page', true);
			$pageMobile = get_post($icl);
		} else {
			$pageMobile = get_post($pageId);
		}

		$img = wp_get_attachment_image_src( get_post_thumbnail_id($pageMobile->ID), 'large_bg');
		$img = $img[0];

		if ($img != '')
?>
<div class="visible-xs visible-sm mobile-homepage" style="position: relative; background-image: url(<?php echo $img;?>); background-size: cover; background-position: center center; ">
	<div class="container-fluid homepage" style="position: static; ">
		<div class="mobile-overlay" style="position: absolute; height: 100%; width: 100%; left: 0; top: 0; background: #000; <?php if(get_post_meta($pageMobile->ID, 'mobile_home_opacity', true) != '') { echo 'opacity: '.get_post_meta($pageMobile->ID, 'mobile_home_opacity', true) / 100; } else { echo 'opacity: 0'; } ;?>;"></div>
		<div class="basic-info">
		<?php echo apply_filters('the_content', $pageMobile->post_content); ?>
		</div>
	</div>
</div>

<?php } else { ?>
<div class="visible-xs visible-sm mobile-homepage" style="position: relative; background-image: url('http://placehold.it/1440x900'); background-size: cover; background-position: center center; ">
	<div class="container-fluid homepage" style="position: static; ">
		<div class="mobile-overlay" style="position: absolute; height: 100%; width: 100%; left: 0; top: 0; background: #000; opacity: 0.3;"></div>
		<div class="basic-info text-center">
		<h2><?php echo __('Please select mobile homepage in YoPress settings', 'BERG'); ?></h2>
		</div>
	</div>
</div>
<?php } }; ?>


<?php

get_footer();

?>