<?php
/**
 *  Single template page for portfolio - left sidebar
 * 
 * @package Toranj
 * @author owwwlab
 */
?>
<!-- Page main wrapper -->
<div id="main-content" class="dark-template">
	<div class="page-wrapper">

		<!-- Sidebar -->
		<div class="page-side hidden-sm hidden-xs">
			<div class="inner-wrapper vcenter-wrapper">
				<div class="side-content vcenter">
					
					<h2 class="title"><?php the_title( ); ?></h2>
					
					<ul class="list-items">
						<?php owlab_portfolio_meta($owlabpfl_meta); ?>
					</ul>
					<div>
						<?php echo wpautop(array_key_exists('owlabpfl_side_des', $owlabpfl_meta) ? $owlabpfl_meta["owlabpfl_side_des"][0] : ''); ?>
					</div>
				</div>
			</div>
			<!-- portfolio nav -->
			<?php owlab_portfolio_single_nav(); ?>
			<!--/ portfolio nav -->
		</div>
		<!-- /Sidebar -->

		<!-- main contents -->
		<div class="page-main">
			<div class="inner-wrapper sync-width-parent">
				
				<?php $img_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) , 'large' ); ?>
				<!-- parallax header -->
				<?php if( array_key_exists('owlabpfl_use_video', $owlabpfl_meta ) ) :
					if ( !empty($owlabpfl_meta["owlabpfl_use_video"]) && $owlabpfl_meta["owlabpfl_use_video"][0]=='on' ): ?>

						<!-- <a href="<?php echo $owlabpfl_meta["owlabpfl_video_mp4"][0]; ?>" class="videobg-fallback"> -->
							<div class="parallax-head sync-width owl-videobg autoplay" 
								data-src="<?php echo $owlabpfl_meta['owlabpfl_video_mp4'][0]; ?>"
								<?php if ( array_key_exists("owlabpfl_video_webm", $owlabpfl_meta) ): ?>
								data-src-webm="<?php echo $owlabpfl_meta['owlabpfl_video_webm'][0]; ?>"
								<?php endif; ?>
								<?php if ( array_key_exists("owlabpfl_video_ogg", $owlabpfl_meta) ): ?>
								data-src-ogg="<?php echo $owlabpfl_meta['owlabpfl_video_ogg'][0]; ?>"
								<?php endif; ?>
								data-poster="<?php echo $img_url; ?>"></div>
						<!-- </a> -->
						
					<?php else: ?>
						<div class="parallax-head set-bg sync-width">
							<img src="<?php echo $img_url ?>" class="img-responsive" alt="image" >
						</div>
					<?php endif; ?>
					
				<?php else: ?>
					<div class="parallax-head set-bg sync-width">
						<img src="<?php echo $img_url ?>" class="img-responsive" alt="image" >
					</div>

				<?php endif; ?>
				<!-- the contents of the page -->
				<div class="parallax-contents">
					
					<div class="portfolio-md-detail visible-sm visible-xs">
								
						<h2 class="title"><?php the_title(); ?></h2>
						
						<ul class="list-items">
							<?php owlab_portfolio_meta($owlabpfl_meta); ?>
						</ul>		

						<!-- portfolio nav -->
						<?php owlab_portfolio_single_nav(); ?>
						<!--/ portfolio nav -->
					</div>

					<?php if (array_key_exists('owlabpfl_short_des', $owlabpfl_meta)): ?>
					<div class="centered-description">
						<p>
						<?php echo $owlabpfl_meta["owlabpfl_short_des"][0] ?>
						</p>
					</div>	
					<?php endif; ?>
					<div>
						<?php the_content(); ?>
					</div>

				</div>
				

			</div>	
		</div>
		<!-- /main contents -->

	</div>
</div>
<!-- /Page main wrapper -->