<?php 
/* 
Template Name: Team
*/ ?>
<?php get_header();?>
<?php 
global $theme_shortname;
$location = icore_get_location();
$meta = icore_get_multimeta(array('Subheader'));   
 ?>
<div id="entry-full">
    <div id="left" class="full-width">
		<div id="head-line"> 
	    <h1 class="title"><?php  the_title();  ?></h1>
		</div>
        <div class="post-full single">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
            	<?php the_content(); ?>

			<?php endwhile; endif; ?>
			
                <?php
				    $blogusers = get_users();
				    foreach ($blogusers as $user) {
						
						if ( $user->display_archive == '1' ) {
							
							$user_avatar = get_avatar($user->ID, 512);
							?>

							<div class="author-wrap">
								<span class="author-image"><?php echo $user_avatar; ?></span>
								<div class='author-info'>
	 								<ul class='author-details'>
										<li class='author-info-name'><h3><?php echo $user->display_name; ?></h3></li>
										<?php if ( ! empty($user->position)) { ?>
										<li class='author-info-position'><?php echo $user->position; ?></li>
										<?php } ?>
										<?php if ( ! empty($user->description)) { ?>
											<li class='author-info-bio'><?php echo $user->description; ?></li>
										<?php } ?>

										<?php if ( ! empty($user->user_url)) { ?>
											<li class="author-social icon-link">
												<a href='<?php echo $user->user_url; ?>' target='_blank'><?php _e( 'website', 'Bonanza' ); ?></a>
											</li>
										<?php } ?>

										<?php if ( ! empty($user->twitter)) { ?>
											<li class="author-social icon-twitter">
												<a href='<?php echo $user->twitter; ?>' target='_blank'><?php _e( 'twitter', 'Bonanza' ); ?></a>
											</li>
										<?php } ?>
											<?php if ( ! empty($user->facebook)) { ?>
												<li class="author-social icon-facebook">
													<a href='<?php echo $user->facebook; ?>' target='_blank'><?php _e( 'facebook', 'Bonanza' ); ?></a>
												</li>
											<?php } ?>
											<?php if ( ! empty($user->googleplus)) { ?>
												<li class="author-social icon-google-plus">
													<a href='<?php echo $user->googleplus; ?>' target='_blank'><?php _e( 'google +', 'Bonanza' ); ?></a>
												</li>
											<?php } ?>
											<?php if ( ! empty($user->youtube)) { ?>
												<li class="author-social icon-youtube">
													<a href='<?php echo $user->youtube; ?>' target='_blank'><?php _e( 'youtube', 'Bonanza' ); ?></a>
												</li>
											<?php } ?>
											<?php if ( ! empty($user->vimeo)) { ?>
												<li class="author-social icon-vimeo">
													<a href='<?php echo $user->vimeo; ?>' target='_blank'><?php _e( 'vimeo', 'Bonanza' ); ?></a>
												</li>
											<?php } ?>

									</ul>
								</div>
							</div>
						<?php }
					}
				?>
            
         </div> <!--  end .post  -->
    </div> <!--  end #left  -->

</div> <!--  end #entry-full  -->
<?php get_footer(); ?>
