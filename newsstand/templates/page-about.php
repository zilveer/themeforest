<?php
	/* Template Name: About Page */
get_header(); ?>

<?php
	$show_ourmembers = get_post_meta( get_the_ID(), 'newsstand_show_ourmembers', 1, true );
?>

<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
	<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

<div class="contact-block hasMap">

    <div class="container">
    <div class="content-img" style="background-image: url(<?php echo esc_url($thumb_url); ?>)"></div>

        <div class="contact-content">
            <div class="cc-title"><?php the_title(); ?></div>
            <div class="cc-content">
                <div class="whitepart">
                    <h1 class="page-title">I am alone and feel the charm of existence</h1>
                    <?php the_content(); ?>
                </div><!-- end of whitepart -->

                <?php endwhile; ?>

				<?php if ($show_ourmembers=='on'): ?>
					<?php
						$args = array( 'post_type' => 'team', 'posts_per_page' => -1 );
						$wp_query = new WP_Query( $args );
					?>
					<?php if ($wp_query->have_posts()): ?>
						<div class="fullpart">
						    <h3 class="fp-title"><?php _e('Our Team', 'newsstand'); ?></h3>
						    <div class="fp-content">

						        <div class="ourteam-list">
						            <div class="row">

						            	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>

						            		<?php
						            			$photo = get_post_meta( get_the_ID(), 'newsstand_member_photo', 1, true );
						            			$namesurname = get_post_meta( get_the_ID(), 'newsstand_member_namesurname', 1, true );
						            			$position = get_post_meta( get_the_ID(), 'newsstand_member_position', 1, true );
						            			$shortdesc = get_post_meta( get_the_ID(), 'newsstand_member_shortdesc', 1, true );
						            			$siteurl = get_post_meta( get_the_ID(), 'newsstand_member_siteurl', 1, true );
						            			$social = get_post_meta( get_the_ID(), 'newsstand_member_social', 1, true );
						            		?>

						                <div class="col-sm-6 col-md-3">
						                    <div class="single">
						                        <div class="image" style="background-image: url(<?php echo esc_url($photo); ?>);">
						                        	<?php if (!empty($siteurl)): ?>
						                        		<a href="<?php echo esc_url($siteurl); ?>" target="_blank" class="plus-hover"><span class="plus"></span></a>
						                        	<?php endif ?>
						                        </div>
						                        <div class="info">
						                            <span class="name"><?php echo esc_html($namesurname); ?></span>
						                            <span class="position"><?php echo esc_html($position); ?></span>
						                        </div>
						                    </div>
						                </div><!-- end of col -->

						                <?php endwhile; ?>

						            </div>
						        </div>
						    </div><!-- end of fp-content -->
						</div>
					<?php endif ?>
				<?php endif ?>

				<?php wp_reset_query(); ?>

                <div class="whitepart">

                	<?php
                		$maineditor_id = get_post_meta( get_the_ID(), 'newsstand_main_editor_id', 1, true );
                		$maineditor_info = get_userdata( $maineditor_id );

                		if (!empty($maineditor_info)) {
                			$user_name = $maineditor_info->display_name;
                			$user_description = $maineditor_info->description;
                			$user_position = get_user_meta($maineditor_info->ID, 'newsstand_user_position', 1);
                			$user_photo = get_user_meta($maineditor_info->ID, 'newsstand_user_photo', 1);
                			$user_url = $maineditor_info->user_url;
                		}
                	?>

                    <?php if (!empty($maineditor_id)): ?>
                    	<h3 class="fp-title"><?php echo _e('Main Editor', 'newsstand'); ?></h3>
                    	<div class="fp-content">

                    	    <div class="maineditor-list">
                    	        <div class="single">
                    	            <div class="image" style="background-image: url(<?php echo esc_url($user_photo); ?>);">
                    	            	<?php if (!empty($user_url)): ?>
                    	            		<a href="<?php echo esc_url($user_url); ?>" target="_blank" class="plus-hover"><span class="plus"></span></a>
                    	            	<?php endif ?>
                    	            </div>
                    	            <div class="info">
                    	                <span class="name"><?php echo esc_html($user_name); ?></span>
                    	                <div class="desc"><?php echo esc_html($user_position); ?></div>
                    	                <p><?php echo esc_html($user_description) ?></p>
                    	            </div>
                    	        </div><!-- end of single -->
                    	    </div>
                    	</div><!-- end of fp-content -->
                    <?php endif ?>

                    <?php wp_reset_query(); ?>

                    <?php
                    	$args = array( 'post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => get_option( 'sticky_posts' ) );
                    	$wp_query = new WP_Query( $args );
                    ?>
                    <?php if ($wp_query->have_posts()): ?>
                    	<h3 class="fp-title"><?php _e('Latest Blog Posts', 'newsstand'); ?></h3>
                    	<div class="fp-content">

                    	    <div class="latestblog-list">

                    	        <div class="row">

                    	        	<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
                    	        		<?php $thumb_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>

                    	            <div class="col-sm-4">
                    	                <div class="single">
                    	                    <div class="image" style="background-image: url(<?php echo esc_url($thumb_url); ?>);"><a href="<?php the_permalink(); ?>" class="plus-hover"><span class="plus"></span></a></div>
                    	                    <div class="info">
                    	                        <span class="post-info">
                    	                            <span><?php the_time($newsstand_dateformat); ?></span>
                    	                            <span><i class="fa fa-clock-o"></i> <?php the_time($newsstand_timeformat); ?></span>
                    	                        </span>
                    	                        <a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
                    	                        <p><?php echo newsstand_excerpt(90); ?> </p>
                    	                    </div>
                    	                </div> <!-- end of row -->
                    	            </div><!-- end of col -->

                    	            <?php endwhile; ?>

                    	        </div>

                    	    </div>
                    	</div><!-- end of fp-content -->
                    <?php endif ?>

                    <?php wp_reset_query(); ?>

                    <?php
                    	$contact_shortcode = get_post_meta( get_the_ID(), 'newsstand_contact_shortcode', 1, true );
                    ?>

					<?php if (!empty($contact_shortcode)): ?>
						<h3 class="fp-title"><?php _e('Contact Us', 'newsstand'); ?></h3>
						<div class="fp-content">
							<?php echo do_shortcode($contact_shortcode); ?>
						</div><!-- end of fp-content-->
					<?php endif ?>

                </div>

            </div>
        </div>
    </div>
</div>

<?php wp_reset_query(); ?>

<?php get_template_part('inc/theme/strip_text'); ?>

<?php get_footer(); ?>