<?php
/*
 * The template for displaying "Page 404"
*/

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_404_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_404_theme_setup', 1 );
	function morning_records_template_404_theme_setup() {
		morning_records_add_template(array(
			'layout' => '404',
			'mode'   => 'internal',
			'title'  => 'Page 404',
			'theme_options' => array(
				'article_style' => 'stretch'
			)
		));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_404_output' ) ) {
	function morning_records_template_404_output() {
		?>
		<article class="post_item post_item_404">
			<div class="post_content">
                <img class="image_404" src="<?php echo( get_stylesheet_directory_uri()); ?>/images/404.png" alt="404">
                <h3 class="page_title"><?php echo esc_html_e( 'Error 404!', 'morning-records' ); ?><br><?php echo esc_html_e( 'Can\'t Find That Page!', 'morning-records' ); ?></h3>
				<p class="page_description"><?php echo sprintf( esc_html__('Can\'t find what you need? Take a moment and', 'morning-records') ) . '<br>'; echo wp_kses_data( sprintf( __('do a search below or start from <a href="%s">our homepage</a>.', 'morning-records'), esc_url(home_url('/')) ) ); ?></p>
				<div class="page_search"><?php echo trim(morning_records_sc_search(array('state'=>'fixed', 'title'=>__('Enter keyword', 'morning-records')))); ?></div>
			</div>
		</article>
		<?php
	}
}
?>