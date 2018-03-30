<?php
get_header();

global $kowloonbay_redux_opts;
global $kowloonbay_allowed_html;
?>

<section>
	<?php echo wp_kses( $kowloonbay_redux_opts['misc_404_content'], $kowloonbay_allowed_html ); ?>
</section>

<?php 
get_footer();