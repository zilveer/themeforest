<?php
/**
 * Single Content
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $page_id, $default_background;
?>
<!--Single-->
<section id="<?php echo $page_id;?>" <?php post_class('contBg content-news'); ?> data-title="<?php echo get_the_title(); ?>" data-bg="<?php echo $default_background;?>"  >
	<span></span>
	<div class="news-container">
		<?php
		if(have_posts()) {
		?>
        <div class="single-post-content">
        	<?php
			// The Loop
			while ( have_posts() ) : the_post();
			?>
            <div <?php post_class('newsList');?> >
            	<div class="item-image">
                	<?php if(has_post_thumbnail(get_the_ID()) ){?>
                		<?php echo get_the_post_thumbnail(get_the_ID(), 'post-thumbnail' ,array('alt' => get_the_title(),'title' => get_the_title())); ?>
					<?php } ?>
                </div>
                <div class="rhtCol">
                	<div class="news-information">
                    <span class="newsDate"><?php echo get_the_date('d M Y'); ?></span>-<span class="newsCategory"><?php 	$categories = get_the_category();
							$seperator = ' , ';
							$output = '';
							if($categories){
								foreach($categories as $category) {
									$output .= $category->cat_name.$seperator;
								}
							echo trim($output, $seperator);
							}
				 ?></span>
                 	</div>
                    <h6 class="title"><?php echo get_the_title(); ?></h6>
                    <div class="scroll-pane">
                       <?php 
							$content = get_the_content();
							$content = apply_filters( 'the_content', $content );
						?>
						<div><?php echo $content; ?></div>
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