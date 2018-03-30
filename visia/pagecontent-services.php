<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php if ( defined( 'HOME_SLIDER') ) echo '<div class="slider-cover">'; ?>
<!-- Begin Services -->
<section class="parallax clearfix" id="<?php $content->slug(); ?>" style="background-image: url(' <?php echo $meta->services->background; ?>');">
	<div class="content dark padded container">

		<div class="title grid-full">
			<h2><?php $content->title(); ?></h2>
			<span class="border"></span>

			<div class="sub-heading">			
				<?php $content->content(); ?>
			</div>
		</div>
		<div class="clearfix"></div>

		<?php 

		if (empty($meta->services->services)) { 

			$services = get_posts( array( 'post_type' => 'service', 'posts_per_page' => -1 ) );

			if ( is_array( $services ) ) {

				foreach( $services as $service ) {

					$servicesarray[] = $service->ID;

				}

				$meta->services->services = $servicesarray;

			}

		}

		?>

		<?php if (!empty($meta->services->services)) { ?>
		

		<?php
			if ($loop = $t->data->customLoop((object) array("post_type"=>"service","id" => $meta->services->services,"orderby" => "post__in",))) {
				?>
				<!-- Icons -->
				<ul class="icons clearfix">
				<?php

				while ($content->looping()) {

					$meta =& $content->meta();
					$features = isset( $meta->info->features ) ? $meta->info->features : '';
					$icon = isset( $meta->info->icon ) ? $meta->info->icon : '';
					?>
					<!-- Single Icon -->
					<li class="overview animated entrance" data-appear-bottom-offset="100">

						<!-- Feature List -->
						<div class="tooltip">
							<div class="details">
								<?php if ( isset( $features ) && is_array( $features ) ): ?>
								<ul class="feature-list">
								<?php foreach ( $features as $feature ) { ?>
									<li><span class="list-dot"></span><?php echo $feature; ?></li>
								<?php } ?>
								</ul>
								<?php endif; ?>
							</div>
						</div>

						<span class="arrow-down"></span>
						<span class="feature-icon feature">
							<i class="<?php echo $icon; ?>"></i>
						</span>

						<!-- Title -->
						<h4><?php $content->title(); ?></h4>
					</li>
					<?php

				}

				?>
				</ul>
				<?php

				$content->resetLoop();

			}
		?>

		<?php } ?>
		
	</div>	
</section>
<?php if ( defined( 'HOME_SLIDER') ) echo '</div>'; ?>