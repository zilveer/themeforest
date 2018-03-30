<?php 
	global $smof_data;
	global $blog_post_type;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
	<div class="post-audio">
		<?php echo get_post_meta($post->ID, 'rnr_blogaudiourl', true); ?>
	</div>


    <div class="post-title">
        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><h2><?php the_title(); ?></h2></a>
    </div><!-- End of Title -->

	<div class="post-meta">
		<?php _e('<i class="fa fa-tasks"></i> ', 'rocknrolla'); the_category(', '); ?>,  <i class="fa fa-time"></i> <?php the_time('d'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?> <span><?php if ( comments_open() ) { comments_popup_link(__('<i class="fa fa-comments-o"></i> 0', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> 1', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> %', 'rocknrolla'), 'comments-link', ''); } ?></span> 
	</div><!-- End of Meta Date -->

    <div class="post-content">
        <?php the_excerpt(); ?>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?> 
    </div><!-- End of Content -->

    <div class="post-tags styled-list">
        <ul>
            <?php the_tags( '<ul><li><i class="fa fa-tags"></i>', '</li><li><i class="fa fa-tags"></i>', '</li></ul>'); ?>
        </ul>
    </div><!-- End of Tags -->

</div><!-- End of Post -->

