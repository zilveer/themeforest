<?php get_header();
$options_ibuki = get_option('ibuki'); 

$blog_main_url = $options_ibuki['back-to-blog-url'];
$header_type = $options_ibuki['header-type'];
$header_layout = $options_ibuki['header-container'];

$header_container = null;
$alignment = (!empty($options_ibuki['blog_post_sidebar_layout'])) ? $options_ibuki['blog_post_sidebar_layout'] : 'no_side' ;

if($header_type == 'header-normal' || $header_type == 'header-fixed' || $header_type == 'header-sticky' ) {
    $header_container = 'container';
} else {
    $header_container = 'container-fluid';
}

?>

<div id="content">
	<?php az_post_header($post->ID); ?>

    <section class="wrap_content">
	<section id="blog" class="main-content single-post">
		<div class="<?php echo $header_container; ?>">
			<div class="row default-padding">

			<?php
                        
            switch ($alignment) {
            case 'right_side' :
                $align_sidebar = 'right_side';
                $align_main = 'left_side';
            break;
            
            case 'left_side' :
                $align_sidebar = 'left_side';
                $align_main = 'right_side';
            break;
            }
            
            if($alignment == 'no_side') {
                echo '<div id="post-area" class="col-md-12">';
            }
            else if($alignment == 'left_side' || $alignment == 'right_side') {
                echo '<div id="post-area" class="col-md-9 page-content '.$align_main.'">';
            }

            ?>          
  
			<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">	
				<?php 
                    $format = get_post_format(); 
                    get_template_part( 'content', $format );
                ?>
			</article>

            <?php if( !empty($options_ibuki['blog-social']) && $options_ibuki['blog-social'] == 1 ) { 
                                   
                   echo '<div class="az-social-share single-post">
                   		<h3>Share</h3>';
                   
                    //facebook
                    if(!empty($options_ibuki['blog-facebook-sharing']) && $options_ibuki['blog-facebook-sharing'] == 1) { 
                        echo '<a href="#" id="share-facebook" class="share-btn">Facebook</a>';
                    }
                    //twitter
                    if(!empty($options_ibuki['blog-twitter-sharing']) && $options_ibuki['blog-twitter-sharing'] == 1) {
                        echo '<a href="#" id="share-twitter" class="share-btn">Twitter</a>';
                    }
                    //google plus
                    if(!empty($options_ibuki['blog-google-sharing']) && $options_ibuki['blog-google-sharing'] == 1) {
                        echo '<a href="#" id="share-google" class="share-btn">Google +</a>';
                    }
                    //Pinterest
                    if(!empty($options_ibuki['blog-pinterest-sharing']) && $options_ibuki['blog-pinterest-sharing'] == 1) {
                        $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
                        echo '<a href="#" id="share-pinterest" class="share-btn">Pinterest</a>';
                    }
                  echo '</div>';

                }
            ?>

            <?php if($alignment == 'left_side' || $alignment == 'right_side') { ?>
            <!-- Comments Template Area -->
		    <section class="comment-area with_sidebar">
		        <?php comments_template('', true); ?>
		    </section>
		    <!-- End Comments Template Area -->
			<?php } ?>

			</div>
			
			<?php
            if($alignment == 'left_side' || $alignment == 'right_side') { ?>
            <aside class="col-md-3 page-sidebar <?php echo $align_sidebar; ?>">
                <?php get_sidebar(); ?>
            </aside>
            <?php } ?>
                
			</div> 
		</div>
	</section>

	<?php if($alignment == 'no_side') { ?>

    <!-- Comments Template Area -->
    <section class="comment-area no_sidebar">
    	<div class="<?php echo $header_container; ?>">
    		<div class="row">
    			<div class="col-md-12">
        			<?php comments_template('', true); ?>
        		</div>
        	</div>
    	</div>
    </section>
    <!-- End Comments Template Area -->
    
    <?php } ?>

    <?php if(!empty($options_ibuki['enable-paginate-article']) && $options_ibuki['enable-paginate-article'] == 1) { ?>

    <?php 
    $back_class = null;
    if( $options_ibuki['back-to-blog'] == 0) { $back_class = ' no-back'; } 
    ?>
    <!-- Navigation Area -->
    <section class="post-type-navi<?php echo $back_class; ?>">
        <ul>
        	<?php if( !empty($options_ibuki['back-to-blog']) && $options_ibuki['back-to-blog'] == 1) { ?>
            <li class="back-blog"><a href="<?php echo esc_url($blog_main_url); ?>" title="<?php _e('Back to Blog', AZ_THEME_NAME);?>"><?php _e('Back to Blog', AZ_THEME_NAME);?><i class="back-blog-icon"></i></a></li>
            <?php } ?>
            <li class="prev"><?php next_post_link(('%link'), 'Prev<i class="prev-icon"></i>') ?></li>
            <li class="next"><?php previous_post_link(('%link'), 'Next<i class="next-icon"></i>') ?></li>
        </ul>
    </section>
    <!-- End Navigation Area -->

    <?php } ?>

    <?php endwhile; endif; ?>

    </section>
</div>

<?php get_footer(); ?>