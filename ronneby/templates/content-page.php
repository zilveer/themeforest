<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	<?php dfd_link_pages(); ?>
<?php endwhile; ?>