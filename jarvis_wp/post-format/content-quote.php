<?php 
global $blog_post_type;	
$quote =  get_post_meta($post->ID, 'rnr_blogquote', true);
$quote = htmlspecialchars_decode($quote);	
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>
	
            <div class="post-quote">
              <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><i class="fa fa-quote-left"></i><?php echo $quote; ?><i class="fa fa-quote-right"></i></a><br /><p class="quote-source"><a href="<?php the_permalink(); ?>" target="_blank">- <?php echo get_post_meta($post->ID, 'rnr_blogquotesource', true); ?></a></p></h2>
	        </div> 
    


	<div class="post-meta">
		<?php _e('<i class="fa fa-tasks"></i> ', 'rocknrolla'); the_category(', '); ?>,  <i class="fa fa-time"></i> <?php the_time('d'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?> <span><?php if ( comments_open() ) { comments_popup_link(__('<i class="fa fa-comments-o"></i> 0', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> 1', 'rocknrolla'), __('<i class="fa fa-comments-o"></i> %', 'rocknrolla'), 'comments-link', ''); } ?></span> 
	</div><!-- End of Meta Date -->

	<div class="post-content">
		<?php the_excerpt(); ?>
        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?> 
	</div><!-- End of Content -->

    <div class="post-tags styled-list">
        <ul>
            <?php the_tags( '<ul> <li><i class="fa fa-tags"></i> ', ',&nbsp; </li><li><i class="fa fa-tags"></i> ', ' </li> </ul>'); ?>
        </ul>
    </div><!-- End of Tags -->

</div>

