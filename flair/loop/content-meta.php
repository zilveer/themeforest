<?php if( is_single() ) : ?>
<h6><?php the_time( get_option('date_format') ); ?> - <?php the_category(', '); ?> - <?php the_tags('',', ',''); ?></h6>
<?php else : ?>
<h6><?php the_time( get_option('date_format') ); ?> - <?php the_category(', '); ?></h6>
<?php endif;