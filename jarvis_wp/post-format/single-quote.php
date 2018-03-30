<?php 
$quote =  get_post_meta($post->ID, 'rnr_blogquote', true);
$quote = htmlspecialchars_decode($quote);
?>
<div class="post clearfix">
	
	<div class="post-single-content">
		
		<div class="post-quote">
              <h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__('Permalink to %s', 'rocknrolla'), the_title_attribute('echo=0') ); ?>" rel="bookmark"><i class="fa fa-quote-left"></i><?php echo $quote; ?><i class="fa fa-quote-right"></i></a><br /><p class="quote-source"><a href="<?php the_permalink(); ?>" target="_blank">- <?php echo get_post_meta($post->ID, 'rnr_blogquotesource', true); ?></a></p></h2>
		</div>   
		
		<div class="post-single-meta"><?php get_template_part( 'includes/meta-single' ); ?></div>
		
        
        <div class="post-tags styled-list">
            <ul>
                <?php the_tags( '<ul> <li><i class="fa fa-tags"></i> ', ',&nbsp; </li><li><i class="fa fa-tags"></i> ', ' </li> </ul>'); ?>
            </ul>
        </div><!-- End of Tags -->
	</div>

</div>
