<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'morning_records_template_no_articles_theme_setup' ) ) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_template_no_articles_theme_setup', 1 );
	function morning_records_template_no_articles_theme_setup() {
		morning_records_add_template(array(
			'layout' => 'no-articles',
			'mode'   => 'internal',
			'title'  => esc_html__('No articles found', 'morning-records')
		));
	}
}

// Template output
if ( !function_exists( 'morning_records_template_no_articles_output' ) ) {
	function morning_records_template_no_articles_output($post_options, $post_data) {
		?>
		<article class="post_item">
			<div class="post_content">
				<h2 class="post_title"><?php esc_html_e('No posts found', 'morning-records'); ?></h2>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria.', 'morning-records' ); ?></p>
				<p><?php echo wp_kses_data( sprintf(__('Go back, or return to <a href="%s">%s</a> home page to choose a new page.', 'morning-records'), esc_url(home_url('/')), get_bloginfo()) ); ?>
				<br><?php esc_html_e('Please report any broken links to our team.', 'morning-records'); ?></p>
				<?php echo trim(morning_records_sc_search(array('state'=>"fixed"))); ?>
			</div>	<!-- /.post_content -->
		</article>	<!-- /.post_item -->
		<?php
	}
}
?>