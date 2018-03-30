<?php
/**
 * News Content
 *
 * @subpackage newidea
 * @since newidea 1.0
 */
global $page_id, $object_id, $default_background;

$post = get_page($object_id);
$bg = $default_background;

if( newidea_get_post_meta_key('default-image', $post->ID) != ""){
	$bg = newidea_get_post_meta_key('default-image', $post->ID);
}
?>
<!--News-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg content-news'); ?> data-bg="<?php echo $bg;?>"  >
	<span></span>
	<div class="news-container">
    	 <?php
			$args=array(
					  'post_type' => 'post',
					  'post_status' => 'publish',
					  'posts_per_page' => get_option('posts_per_page'),
					  );
			global $the_query;
			$the_query = new WP_Query($args);
			if($the_query->have_posts()) {
		?>
        
        <div class="jcarousel-news">
        	<?php
			// The Loop
			while ( $the_query->have_posts() ) : $the_query->the_post();
			?>
            <div <?php post_class('jcarousel-item newsList');?> >
            	<div class="item-image">
                	<?php if(has_post_thumbnail(get_the_ID()) ) {?>
                		<?php echo get_the_post_thumbnail(get_the_ID(), 'post-thumbnail' ,array('alt' => get_the_title(),'title' => get_the_title())); ?>
					<?php } ?>
                </div>
                <div class="rhtCol">
                	<div class="news-information">
                    <span class="newsDate"><?php echo get_the_date('d M Y'); ?></span><?php if(newidea_get_options_key('news-show-category') == "on") : ?>-<span class="newsCategory"><?php 	$categories = get_the_category();
							$seperator = ' , ';
							$output = '';
							if($categories){
								foreach($categories as $category) {
									$output .= $category->cat_name.$seperator;
								}
							echo trim($output, $seperator);
							}
				 ?><?php endif; ?></span>
                 	</div>
                    <h6 class="title link" data-id="<?php echo get_the_ID(); ?>"><?php echo get_the_title(); ?></h6>
                    <div class="scroll-pane">
                       <div>
                       <?php					
						global $more;    // Declare global $more (before the loop).
						$more = 0;       // Set (inside the loop) to display content above the more
						the_content(__('Read More &raquo;','newidea'),true); 
						?>
                       </div>
                    </div>
                 </div>
          	</div>
			<?php endwhile; ?>
         </div>
        <?php }else{
			echo __('Please open admin backend\'s <strong><em>Posts -&gt; Add New</em></strong> add your posts/news items.','newidea');
		?>
        <?php } ?>
      </div>

</section>