<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
if (!have_posts()) :

    get_template_part('templates/post-nothins', 'found');
    
    endif; ?>

<?php while (have_posts()) : the_post();

    get_template_part('templates/loop-content');

 endwhile; ?>

<?php if ($wp_query->max_num_pages > 1) : ?>

<nav class="page-nav">

    <?php echo dfd_kadabra_pagination(); ?>

</nav>

<?php endif; ?>
