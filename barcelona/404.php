<?php

get_header();

?>
<div class="container">

	<div class="nf-wrapper">
		<span class="nf-404"><?php esc_html_e( '404', 'barcelona' ); ?></span>
		<span class="nf-title"><?php esc_html_e( 'Nothing Found', 'barcelona' ); ?></span>
		<span class="nf-desc"><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'barcelona' ); ?></span>
		<?php get_search_form(); ?>
	</div>

</div>
<?php

get_footer();