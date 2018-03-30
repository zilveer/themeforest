<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data, $wpdb; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog cs-blog-events cs-blog-item">
		<header class="cs-blog-header">
			<?php if ($smof_data['post_featured_images'] == '1' ) : ?>
				<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
					<div class="cs-blog-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div><!-- .entry-thumbnail -->
				<?php endif; ?>
			<?php endif; ?>
			<div class="cs-blog-meta cs-itemBlog-meta">
			    <div class="cs-blog-info clearfix">
    			    <div class="cs-blog-eventsDate col-xs-12 col-sm-3 col-md-3 col-lg-3">
    			        <span><?php esc_html_e('DATE / TIME', 'wp_nuvo'); ?></span>
        				<!-- .info-bar -->
                        <?php
                        $querystr = "
                            SELECT event_name,event_start_date,event_start_time,post_content
                            FROM {$wpdb->prefix}em_events
                            WHERE event_status = '1'
                            AND post_id = ".get_the_ID()."
                            ";
                        $pageposts = $wpdb->get_results($querystr, OBJECT);
                        if(count($pageposts)>0){
                            echo '<span>'.date('m/d/Y',strtotime($pageposts[0]->event_start_date)).'</span>
			                      <span>'.date('H:i',strtotime($pageposts[0]->event_start_time)).'</span>';
                        }
                        ?>
                    </div>
                    <div class="cs-blog-eventsBooking col-xs-12 col-sm-9 col-md-9 col-lg-9">
                        <a href="#" class="btn btn-primary-alt btn-white" data-toggle="modal" data-target="#modal-booking" title="<?php esc_html_e('BOOK THIS AMAZING EVENT NOW', 'wp_nuvo'); ?>"><?php esc_html_e('BOOK THIS AMAZING EVENT NOW', 'wp_nuvo'); ?></a>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="modal-booking" tabindex="-1" role="dialog" aria-labelledby="<?php esc_html_e('BOOK THIS AMAZING EVENT NOW', 'wp_nuvo'); ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title"><?php esc_html_e('BOOK THIS AMAZING EVENT NOW', 'wp_nuvo'); ?></h4>
                            </div>
                            <div class="modal-body">
                            <?php
								global $EM_Event;
								if(!empty($EM_Event)){
									echo apply_filters('em_event_output_single_booking', $EM_Event->output('#_BOOKINGFORM', 'html'));
								}
							?>
                            </div>
                            <div class="modal-footer">
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</header><!-- .entry-header -->
		<div class="cs-blog-content">
			<?php
			    if(count($pageposts)>0){
			        echo apply_filters('the_content', $pageposts[0]->post_content);
			    }
				wp_link_pages( array(
					'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . esc_html__( 'Pages:','wp_nuvo') . '</span>',
					'after'       => '</div>',
					'link_before' => '<span class="page-numbers">',
					'link_after'  => '</span>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->