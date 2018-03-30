<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Wish
 */
?>
<div class="wish-content">
<div class="row profiles">
				<div class="intro">
				</div>

<?php
				$article = 100;
				$args = array( 'numberposts' => -1, 'post_type' => 'wish_team', 'order' => 'DESC', 'suppress_filters' => false );
$team_posts = get_posts( $args );
				foreach ( $team_posts as $post ): 
				setup_postdata($post);
				$article = $article + 100;
				$thumb_src = null;
				if ( has_post_thumbnail($post->ID) ) {
					$src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'team-thumb' );
					$thumb_src = $src[0];
				}
				 $president_check = get_post_meta($post->ID, 'wish_president_check', true);
				?>


	
    <?php if( $president_check == 1 ) { ?>
   
    <div class="row">
    <article class="col-sm-12 profile animated" data-animation="fadeInUp" data-animation-delay="<?php echo esc_attr($article); ?>">
					<div class="profile-header">
						<?php if ( $thumb_src ): ?>
						<img src="<?php echo esc_url($thumb_src); ?>" alt="<?php the_title(); ?>, <?php echo get_post_meta($post->ID, 'wish_member', true); ?>" class="img-circle">
                      
						<?php endif; ?>
					</div>
					
					<div class="profile-content">
						<h4><?php the_title(); ?></h4>
						<p class="lead position"><?php echo get_post_meta($post->ID, 'wish_designation', true); ?></p>
						<?php echo wish_filter_html($post->post_content); ?>
					</div>
					
					<div class="profile-footer">
					<?php 
					$member_email = get_post_meta($post->ID, 'wish_member_email', true);
					$wish_member_fb = get_post_meta($post->ID, 'wish_member_fb', true);
					$wish_member_tw = get_post_meta($post->ID, 'wish_member_tw', true);
					$wish_member_goo = get_post_meta($post->ID, 'wish_member_goo', true);
					$wish_member_sk = get_post_meta($post->ID, 'wish_member_sk', true);
					$wish_member_li = get_post_meta($post->ID, 'wish_member_li', true);
					?>
					<?php if ( $wish_member_fb ): ?>
						<a href="<?php echo esc_url($wish_member_fb); ?>"><i class="fa fa-facebook"></i></a>
						<?php endif; ?>
						<?php if ( $wish_member_goo ): ?>
						<a href="<?php echo esc_url($wish_member_goo); ?>"><i class="fa fa-google-plus"></i></a>
						<?php endif; ?>
<?php if(!empty($member_email)){ ?><a href="mailto:<?php echo antispambot( $member_email ); ?>"><i class="fa fa-envelope"></i></a><?php } ?>
						<?php if ( $wish_member_tw ): ?>
						<a href="<?php echo esc_url($wish_member_tw); ?>"><i class="fa fa-twitter"></i></a>
						<?php endif; ?>
						<?php if ( $wish_member_li ): ?>
						<a href="<?php echo esc_url($wish_member_li); ?>"><i class="fa fa-linkedin"></i></a>
						<?php endif; ?>
						<?php if ( $wish_member_sk ): ?>
						<a href="<?php echo esc_url($wish_member_sk); ?>"><i class="fa fa-skype"></i></a>
						<?php endif; ?>
					</div>
				</article>
    </div>
    <?php } ?>
    <!--====================================== Founder CEO and Vice President ends here ==================-->
     <?php if( $president_check == 1 ) { continue; } ?>	
						
			
				<article class="col-sm-6 profile animated" data-animation="flipInX" data-animation-delay="<?php echo esc_attr($article); ?>">
					<div class="profile-header">
						<?php if ( $thumb_src ): ?>
						<img src="<?php echo esc_url($thumb_src); ?>" alt="<?php the_title(); ?>, <?php echo get_post_meta($post->ID, 'wish_member', true); ?>" class="img-circle">
                      
						<?php endif; ?>
					</div>
					
					<div class="profile-content">
						<h4><?php the_title(); ?></h4>
						<p class="lead position"><?php echo get_post_meta($post->ID, 'wish_designation', true); ?></p>
						<?php echo wish_filter_html($post->post_content); ?>
					</div>
					
					<div class="profile-footer">
					<?php 
					$member_email = get_post_meta($post->ID, 'wish_member_email', true);
					$wish_member_fb = get_post_meta($post->ID, 'wish_member_fb', true);
					$wish_member_tw = get_post_meta($post->ID, 'wish_member_tw', true);
					$wish_member_goo = get_post_meta($post->ID, 'wish_member_goo', true);
					$wish_member_sk = get_post_meta($post->ID, 'wish_member_sk', true);
					$wish_member_li = get_post_meta($post->ID, 'wish_member_li', true);
					?>
					<?php if ( $wish_member_fb ): ?>
						<a href="<?php echo esc_url($wish_member_fb); ?>"><i class="fa fa-facebook"></i></a>
						<?php endif; ?>
						<?php if ( $wish_member_goo ): ?>
						<a href="<?php echo esc_url($wish_member_goo); ?>"><i class="fa fa-google-plus"></i></a>
						<?php endif; ?>
<?php if(!empty($member_email)){ ?><a href="mailto:<?php echo antispambot( $member_email ); ?>"><i class="fa fa-envelope"></i></a><?php } ?>
						<?php if ( $wish_member_tw ): ?>
						<a href="<?php echo esc_url($wish_member_tw); ?>"><i class="fa fa-twitter"></i></a>
						<?php endif; ?>
						<?php if ( $wish_member_li ): ?>
						<a href="<?php echo esc_url($wish_member_li); ?>"><i class="fa fa-linkedin"></i></a>
						<?php endif; ?>
						<?php if ( $wish_member_sk ): ?>
						<a href="<?php echo esc_url($wish_member_sk); ?>"><i class="fa fa-skype"></i></a>
						<?php endif; ?>
					</div>
				</article><!-- /.profile -->
				<?php endforeach; ?>
				<?php wp_reset_postdata();?>
			</div><!-- /.row -->
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'wish' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

