<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!have_posts()): ?>

	<?php get_template_part('templates/notresult','content'); ?>

<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>

	<?php get_template_part('templates/loop-search'); ?>

<?php endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>

<nav class="page-nav">

    <?php echo dfd_kadabra_pagination(); ?>

</nav>

<?php endif;
