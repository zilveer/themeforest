<?php
    //post settings
    $HFI = get_post_meta(get_the_ID(), 'mom_hide_feature', true);
    $d_breacrumb = get_post_meta(get_the_ID(), 'mom_disbale_breadcrumb', true);
?>
<?php get_header(); ?>
    <div class="inner">
                <div class="category-title">
                        <?php if ($d_breacrumb != true) { mom_breadcrumb(); } ?>
                </div>
<div <?php post_class('base-box p-single'); ?>>
<h1 class="portfolio-item-title"><?php the_title(); ?></h1>

<?php if ($HFI != 1) { ?>
<div class="feature-img pt-feature"><img src="<?php echo mom_post_image('full'); ?>" alt="<?php the_title(); ?>"></div>
<?php } ?>

<div class="entry-content portfolio-item-content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>
<?php endwhile; else: ?>
<?php endif; ?>
</div> <!-- entry content -->
   <div class="main-title">
        <h4><?php _e('Most Recent Entries'); ?></h4>
    </div><!-- main title -->
                <script type="text/javascript">
                        jQuery(document).ready(function($){
                                $(".mom-portfolio a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, deeplinking: false});
                        });
                </script>    
           <div class="mom-portfolio">
           <ul class="portfolio-list">

	       		<?php
                                wp_enqueue_script('prettyPhoto');
				global $paged;
                                global $post;
				$args = array(
				'posts_per_page' => 4,
				'post_type' => 'portfolio',
				'paged' => $paged,
                                'post__not_in' => array($post->ID)
				);
			$query = new WP_Query( $args );
		?>
		<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
	       <li class="portfolio_item">
                   <div class="portfolio-image">
                   <img src="<?php echo mom_post_image('mom-portfolio-four'); ?>" data-hidpi="<?php echo mom_post_image('mom-portfolio-two'); ?>" alt="<?php the_title(); ?>">
                   <div class="pt-overlay">
                       <div class="ov-content">
                       <h3 class="ov-title"><?php the_title(); ?></h3>
                       <div class="ov-nav">
                       <a href="<?php the_permalink(); ?>" class="ov-link"><i class="brankic-icon-link"></i></a>
                       <a href="<?php echo mom_post_image('full'); ?>" rel="prettyPhoto['portfolio']" class="ov-zoom"><i class="brankic-icon-zoom-in"></i></a>
                       </div>
                       </div>
                   </div> <!-- overlay -->
                   </div> <!-- portfolio image -->
               </li> <!-- portfolio item -->
               <?php endwhile; else: ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
           </ul> <!-- porfolio list -->
       </div> <!-- mom portfolio -->    
</div> <!-- base box -->
            
            </div> <!--main inner-->
            
<?php get_footer(); ?>