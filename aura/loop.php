<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="wmffrow">
        	<div class="col-12 wmffcol-xs-12 wmffcol-sm-12 wmffcol-md-12 wmffcol-lg-12">
               
                <!-- article -->
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <?php 
                    if ( function_exists( 'get_post_format' )){
                            
                        if(!get_post_format( $post->ID )){
							?>
                            
                            <div class="post-mtitle"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
                            <div class="post-content">
                            <?php aurawp_excerpt();?>
                            </div>
                            <div class="post-minfo"><?php the_time('F j, Y'); ?> / <?php comments_popup_link( '', __( '1 Comment / ', 'aurat2d' ), __( '% Comments / ', 'aurat2d' )); ?><?php _e( 'by', 'aurat2d' ); ?> <?php the_author_posts_link(); ?> <?php echo "/  "; the_tags(); ?></div>

                            <?php
                        }else{
                            get_template_part('content',get_post_format());
                        }
                    }
                    ?>
                    
                </article>
                <!-- /article -->
                
                <!-- Bottom info-->
                <div class="post-binfo"></div>
                <!-- Bottom info finish -->
		</div>
    </div>
	
<?php endwhile; ?>

<?php else: ?>
	<div class="wmffrow">
        	<div class="col-12 wmffcol-xs-12 wmffcol-sm-12 wmffcol-md-12 wmffcol-lg-12">
                
                <!-- article -->
                <article>
                    <h2><?php _e( 'Sorry, nothing to display.', 'aurat2d' ); ?></h2>
                </article>
                <!-- /article -->
		</div>
    </div>
<?php endif; ?>