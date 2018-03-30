<?php

the_post();

$desc = rwmb_meta( 'kowloonbay_service_desc');
$desc_short = rwmb_meta( 'kowloonbay_service_desc_short');

global $kowloonbay_redux_opts;
$breadcrumb_services_display = $kowloonbay_redux_opts['breadcrumb_services_display'];
$breadcrumb_home_label = $kowloonbay_redux_opts['breadcrumb_home_label'];
$breadcrumb_services_label = $kowloonbay_redux_opts['breadcrumb_services_label'];
$breadcrumb_icon = $kowloonbay_redux_opts['breadcrumb_icon'];
$breadcrumb_services_page = $kowloonbay_redux_opts['breadcrumb_services_page'];

get_header();
?>


<section>
	<div class="section-heading">
		<?php if ($breadcrumb_services_display === '1'): ?>
		<p class="margin-v-none small-text"><a href="<?php echo esc_url(home_url()); ?>"><?php echo esc_attr( $breadcrumb_home_label ); ?></a><i class="fa <?php echo esc_attr( $breadcrumb_icon ); ?>"></i><a href="<?php echo esc_url(empty($breadcrumb_services_page) ? '#' : get_permalink($breadcrumb_services_page)); ?>"><?php echo esc_html(empty($breadcrumb_services_label) ? get_the_title($breadcrumb_services_page ) : $breadcrumb_services_label); ?></a><i class="fa <?php echo esc_attr( $breadcrumb_icon ); ?>"></i></p>
		<?php endif; ?>
		<h2><a href="#"><?php the_title(); ?></a></h2>
		<p class="section-desc"><?php echo esc_html( $desc_short ); ?></p>
	</div>

	<?php the_content(); ?>

</section>

<?php

get_footer();