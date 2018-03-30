<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php while (have_posts()) : the_post(); ?>
<?php
	$row_class = '';
	$mvb_content = get_post_meta(get_the_ID(), '_bshaper_artist_content', true );
	$mvb_enable = get_post_meta( get_the_ID(), '_bshaper_activate_metro_builder', true );
	
	$page_content = get_the_content();
	
	if (!empty($mvb_content) && strcmp($mvb_enable, '1') === 0):
	?>
		<div class="row-portfolio-template-mvb-content">
			<?php the_content(); ?>
			<?php dfd_link_pages(); ?>
		</div>
	<?php
	elseif (!empty($page_content)):
	?>
		<div class="dfd-vc-content">
			<?php the_content(); ?>
			<?php dfd_link_pages(); ?>
		</div>
	<?php
	endif;
?>
<?php endwhile; ?>
