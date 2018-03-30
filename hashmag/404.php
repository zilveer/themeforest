<?php

/***** Set params for posts on 404 page *****/

$params = '';

$number_of_posts = 6;
$params .= ' number_of_posts="'.$number_of_posts.'"';	

$column_number = 3;
$params .= ' column_number="'.$column_number.'"';

$display_excerpt = 'no';
$params .= ' display_excerpt="'.$display_excerpt.'"';

$title_tag = 'h2';
$params .= ' title_tag="'.$title_tag.'"';

$title_length = '55';
$params .= ' title_length="'.$title_length.'"';

$title = 'top stories';
$params .= ' title="'.$title.'"';

?>
<?php get_header(); ?>
<?php hashmag_mikado_get_title(); ?>

	<div class="mkdf-container">
	<?php do_action('hashmag_mikado_after_container_open'); ?>
		<div class="mkdf-container-inner mkdf-404-page">
			<div class="mkdf-page-not-found">
				<h1>
					<?php if(hashmag_mikado_options()->getOptionValue('404_title')){
						echo esc_html(hashmag_mikado_options()->getOptionValue('404_title'));
					} else {
						esc_html_e('Sorry... 404 Error Page', 'hashmag');
					} ?>
				</h1>
				<h3>
					<?php if(hashmag_mikado_options()->getOptionValue('404_text')){
						echo esc_html(hashmag_mikado_options()->getOptionValue('404_text'));
					} else {
						esc_html_e("Sorry, But The Page You Are Looking For Doesn't Exist", "hashmag");
					} ?>
				</h3>
				<?php
					$button_params = array();
					if (hashmag_mikado_options()->getOptionValue('404_back_to_home')){
						$button_params['text'] = hashmag_mikado_options()->getOptionValue('404_back_to_home');
					} else {
						$button_params['text'] = "Back To Home";
					}
					$button_params['type'] = 'solid';
					$button_params['size'] = 'large';
					$button_params['link'] = esc_url(home_url('/'));
					$button_params['target'] = '_self';
					$button_params['icon_pack'] = 'ion_icons';
					$button_params['ion_icon'] = 'ion-chevron-right';

				echo hashmag_mikado_execute_shortcode('mkdf_button', $button_params);?>


			</div>
			<?php echo do_shortcode("[mkdf_post_layout_one $params]"); ?>
		</div>
		<?php do_action('hashmag_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>