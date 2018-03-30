<?php
/**
 * @package cshero
 */
?>
<?php global $smof_data; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="cs-blog cs-blog-item cs-event-item text-center">
		<?php if ($smof_data['post_featured_images'] == '1' ) : ?>
			<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
				<div class="cs-blog-thumbnail">
					<?php the_post_thumbnail('full'); ?>
				</div><!-- .entry-thumbnail -->
			<?php endif; ?>
		<?php endif; ?>
		<div class="cs-event-content-wrap">
			<header class="cs-blog-header">
				<div class="cs-blog-meta cs-itemBlog-meta">
					<?php if($smof_data['show_post_title'] == '1'): ?>
					<div class="cs-blog-title"><<?php echo $smof_data['detail_title_heading'];?>><?php the_title(); ?></<?php echo $smof_data['detail_title_heading'];?>></div>
					<?php endif; ?>
					<!-- .info-bar -->
					<div>
					    <div class="event-date primary-color">
					    <?php
					    $event_start = get_post_meta(get_the_ID(), 'cs_start_date', true);
					    if($event_start){
					        $event_start = strtotime($event_start);
					        echo '<span class="date"><i class="fa fa-calendar-o"></i>&nbsp;&nbsp;';
					        echo date('d M Y', $event_start).'</span>';
					        echo '<span class="time"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;';
					        echo date('h:i A', $event_start).'</span>';
					    }
					    ?>
					    </div>
					    <?php
	                    $event_location_name = get_post_meta(get_the_ID(), 'cs_event_location_name', true);
	                    $event_address = get_post_meta(get_the_ID(), 'cs_event_address', true);
	                    $event_city = get_post_meta(get_the_ID(), 'cs_event_city', true);
	                    if($event_location_name && $event_address && $event_city){
	                        $event_state = get_post_meta(get_the_ID(), 'cs_event_state', true);
	                        $event_postcode = get_post_meta(get_the_ID(), 'cs_event_postcode', true);
	                        $event_region = get_post_meta(get_the_ID(), 'cs_event_region', true);
	                        $even_country = get_post_meta(get_the_ID(), 'cs_even_country', true);
	                        echo '<div class="event-where">';
	                        echo $event_location_name.',&nbsp;'.$event_address.',&nbsp;'.$event_city;
	                        if($event_state){ echo ',&nbsp;'.$event_state; }
	                        if($event_postcode){ echo ',&nbsp;'.$event_postcode; }
	                        if($event_region){ echo ',&nbsp;'.$event_region; }
	                        if($even_country){ echo ',&nbsp;'.$even_country; }
	                        echo '</div>';
	                    }
	            	    ?>
					</div>
				</div>
			</header><!-- .entry-header -->
			<div class="cs-blog-content">
				<?php
					the_content();
					wp_link_pages( array(
						'before'      => '<div class="pagination loop-pagination"><span class="page-links-title">' . __( 'Pages:',THEMENAME) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span class="page-numbers">',
						'link_after'  => '</span>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php if($smof_data['show_social_post']):?>
	        <div class="cs-blog-share">
	            <?php
	                $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full', false);
	                $img = esc_attr($attachment_image[0]);
	                $title = get_the_title();
	                echo cshero_socials_share(get_the_permalink(),$img, $title,get_comments_link($post->ID));
	            ?>
	        </div>
	        <?php endif; ?>
	    </div>
	</div>
</article><!-- #post-## -->