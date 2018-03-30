<?php
	$orig_post = $post;  
    global $post,$smof_data;  
    $tags = wp_get_post_tags($post->ID);  

    if ($tags) {  
        $tag_ids = array();  
        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;  
        $args=array(  
        'tag__in' => $tag_ids,  
        'post__not_in' => array($post->ID),  
        'posts_per_page'=>5, // Number of related posts to display.  
        'ignore_sticky_posts'=>1  
        );  

        $my_query = new wp_query( $args );  
        $count = 0;
        $class='col-xs-12 col-sm-12 col-md-6 col-lg-6';
        if($my_query->post_count==1){
        	$class='col-xs-12 col-sm-12 col-md-12 col-lg-12';
        }
        if(isset($smof_data['related_posts']) && $smof_data['related_posts'] && $my_query->have_posts()){ ?>
        <div class="cshero-single-related">
            <h3><?php echo __('Related posts',THEMENAME);?></h3>   
	        <div class="row">    
	        <?php while( $my_query->have_posts() ) { 
	        	$my_query->the_post();   
	        	if($count==0){
	        		?>
	        		<article id="post-<?php the_ID(); ?>" <?php post_class($class.' special-related-post'); ?>>
						<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
							<div class="single-post-thumbnail related-post-thumbnail">
								<?php the_post_thumbnail('recent-posts'); ?>
							</div><!-- .entry-thumbnail -->
						<?php else:?>
							<div class="single-post-thumbnail related-post-thumbnail">
								<img alt="<?php the_title();?>" title="<?php echo the_title();?>" src="<?php echo get_template_directory_uri(); ?>/assets/images/no-image.jpg" />
							</div><!-- .entry-thumbnail -->
						<?php endif; ?>
						<header>
							<?php echo cshero_title_render(); ?>
						</header>
						<div class="related-post-content">
							<?php
								cshero_content_render();
							?>
						</div>
					</article><!-- #post-## -->
	        		<?php
	        	}
	        	else{
	        		?>
		            <article id="post-<?php the_ID(); ?>" <?php post_class($class .' normal-related-post'); ?>>
		            	<div>
		            	<div class="row">
							<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
								<div class="related-post-thumbnail col-xs-4 col-sm-4 col-md-4 col-lg-4">
									<?php the_post_thumbnail('thumbnail'); ?>
								</div><!-- .entry-thumbnail -->
							<?php endif; ?>
							<div class="related-post <?php echo ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() )?'col-xs-8 col-sm-8 col-md-8 col-lg-8':'col-xs-12 col-sm-12 col-md-12 col-lg-12';?>">
								<?php
									echo cshero_title_render();
									echo cshero_infobar_style2();
								?>
							</div>
						</div>
						</div>
					</article> 
			        <?php
	        	}
	        $count++;
	    	} ?>
	    	</div>
    	</div>
        <?php } ?>  
    <?php }  
    $post = $orig_post;  
    wp_reset_query();  
?>
