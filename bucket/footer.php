<?php
/**
 * The template for displaying the footer widget areas.
 * @package Bucket
 * @since   Bucket 1.0
**/
?>   
    </div><!-- .wrapper --> 
    
    <?php if (wpgrade::option('posts_stats') || wpgrade::option('back_to_top')):

	$months = bucket::wpgrade_count_posts();

	$max_posts_nr = $months['max_posts_nr'];
	$months = $months['months'];

	if ( !empty($months) ) { ?>
    <div class="site__stats">
        <div class="container">
        
            <?php if (wpgrade::option('posts_stats')): ?>
            <ul class="stat-group nav nav--banner">
				<?php foreach($months as $key => $month ) { ?>
					<li>
						<?php if ( isset($month['url'])) { ?>
							<a href="<?php echo $month['url'] ;?>" class="stat">
						<?php } else { ?>
							<div class="stat disable">
						<?php }
						//$max_posts_nr might be 0 when one hasn't published in a long long time, more then a year
						if ( $max_posts_nr > 0 ) {
							$percent = ( $month['count'] * 100 ) / $max_posts_nr;
						} else {
							$percent = 0;
						} ?>
							<dd class="stat__value" <?php if($percent > 0) echo 'style="height:' . $percent . '%;"'; ?>><?php echo $month['count']; ?></dd>
							<dt class="stat__title"><?php echo $month['month']; ?></dt>
						
                        <?php if ( isset($month['url'])) { ?>
                            </a>
                        <?php } else { ?>
                            </div>
                        <?php } ?>
                                          
					</li>
				<?php } ?>
            </ul>
            <?php endif; 

                  if (wpgrade::option('back_to_top')): ?>
            <div class="back-to-top"><a href="#page"><?php _e('Back to Top', 'bucket'); ?></a></div>
            <?php endif; ?>
        </div>
    </div>
    <?php }
	endif; ?>
    
    <footer class="site__footer">
        
        <h2 class="accessibility"><?php __('Footer', 'bucket') ?></h2>
		
    	<?php

    	/* The footer widget area is triggered if any of the areas
    	 * have widgets. So let's check that first.
    	 *
    	 * If none of the sidebars have widgets, then let's bail early.
    	 */
    	if (is_active_sidebar('sidebar-footer-first-1')
    	 || is_active_sidebar('sidebar-footer-first-2')
    	 || is_active_sidebar('sidebar-footer-first-3')
    	 || is_active_sidebar('sidebar-footer-second-1')
    	 || is_active_sidebar('sidebar-footer-second-2')
    	):

    	// If we get this far, we have widgets. Let do this.
    	?>

            <div class="footer__sidebar">

                <div class="container">
                    
                    <div class="footer__widget-area  grid"><!--
                        <?php if ( is_active_sidebar( 'sidebar-footer-first-1' ) ) : ?>
                         --><div class="grid__item one-third  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-first-1' ); ?>
                            </div><!--
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'sidebar-footer-first-2' ) ) : ?>
                            --><div class="grid__item one-third  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-first-2' ); ?>
                            </div><!--
                        <?php endif; ?>
                        <?php if ( is_active_sidebar( 'sidebar-footer-first-3' ) ) : ?>
                            --><div class="grid__item one-third  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-first-3' ); ?>
                            </div><!--
                        <?php endif; ?>
                 --></div>
                    
                    <div class="footer__widget-area  grid"><!--

                        <?php if ( is_active_sidebar( 'sidebar-footer-second-1' ) ) : ?>
                         --><div class="grid__item two-thirds  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-second-1' ); ?>
                            </div><!--
                        <?php endif; ?>

                        <?php if ( is_active_sidebar( 'sidebar-footer-second-2' ) ) : ?>
                            --><div class="grid__item one-third  palm-one-whole">
                                <?php dynamic_sidebar( 'sidebar-footer-second-2' ); ?>
                            </div><!--
                        <?php endif; ?>
                        
                 --></div>

                </div>

            </div>

    	<?php endif; ?>
		
        <div class="footer__copyright">
            <div class="container">
                <div class="flexbox">
                    <div class="footer-copyright flexbox__item"><?php echo wpgrade::option('copyright_text') ?></div>
                    <div class="footer-menu flexbox__item "><?php wpgrade_footer_nav() ?></div>
                </div>
            </div>
        </div>

    </footer><!-- .site__footer -->
    
    </div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>