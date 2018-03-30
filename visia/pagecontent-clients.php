<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php if ( defined( 'HOME_SLIDER') ) echo '<div class="slider-cover">'; ?>
<!-- Begin Services -->
<section class="parallax black clearfix" id="<?php $content->slug(); ?>" style="background-image: url('<?php echo $meta->clients->background; ?>');">
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

		if (empty($meta->clients->members)) { 

			$clients = get_posts( array( 'post_type' => 'testimonial', 'posts_per_page' => -1 ) );

			if ( is_array( $clients ) ) {

				foreach( $clients as $client ) {

					$clientsarray[] = $client->ID;

				}

				$meta->clients->members = $clientsarray;

			}

		}

		?>

		<?php if (!empty($meta->clients->members)) { ?>
		<!-- Logos -->
		<ul class="animated fade grid-full id-bx-pager" data-appear-bottom-offset="150">

		<?php

			if ($loop = $t->data->customLoop((object) array("post_type"=>"testimonial","id" => $meta->clients->members,"orderby" => "post__in",))) {

				$count = 0;

				?>
				<!-- Icons -->
				<?php

				while ($content->looping()) {

					$meta =& $content->meta();
					?>
					<li><a data-slide-index="<?php echo $count; ?>" href=""><?php $content->img(142,95); ?></a></li>
					<?php $count++; ?>
					<?php

				}

				?>
				<?php

				$content->resetLoop();

			}
		?>

		<?php $content =& $t->content; ?>
		<?php $meta =& $content->meta(); ?>

		</ul>

		<div class="id-bx-prev"></div>
		<div class="id-bx-next"></div>


		<!-- Testimonials -->
		<div class="grid-full">
			<ul class="bxslider">

				<?php

					if ($loop = $t->data->customLoop((object) array("post_type"=>"testimonial","id" => $meta->clients->members,"orderby" => "post__in",))) {

						?>
						<!-- Icons -->
						<?php

						while ($content->looping()) {

							$meta =& $content->meta();
							?>
							<li>
								<?php $content->content(); ?>
								<h6><?php echo $meta->info->type; ?></h6>
							</li>
							<?php

						}

						?>
						<?php

						$content->resetLoop();

					}
				?>

			</ul>
		</div>

		<?php } ?>
		
	</div>	
</section>
<?php if ( defined( 'HOME_SLIDER') ) echo '</div>'; ?>