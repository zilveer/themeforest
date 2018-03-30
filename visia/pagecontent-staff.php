<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $hasFeatImage = $content->hasFeatImage(); ?>
<?php if ( defined( 'HOME_SLIDER') ) echo '<div class="slider-cover">'; ?>
<!-- Begin Team -->
<section class="content container" id="<?php $content->slug(); ?>">

		<div class="title grid-full">
			<h2><?php $content->title(); ?></h2>
			<span class="border"></span>

			<div class="sub-heading">			
				<?php $content->content(); ?>
			</div>
		</div>
		<div class="clearfix"></div>

		<?php 

		if (empty($meta->staff->members)) { 

			$staffs = get_posts( array( 'post_type' => 'staff', 'posts_per_page' => -1 ) );

			if ( is_array( $staffs ) ) {

				foreach( $staffs as $staff ) {

					$staffarray[] = $staff->ID;

				}

				$meta->staff->members = $staffarray;

			}

		}

		?>

		<?php if (!empty($meta->staff->members)) { ?>

		<?php

			if ($loop = $t->data->customLoop((object) array("post_type"=>"staff","id" => $meta->staff->members,"orderby" => "post__in",))) {
				?>
				<!-- Icons -->
				<ul class="team-list clearfix">
				<?php

				while ($content->looping()) {

					$meta =& $content->meta();
					$social = isset( $meta->info->social ) ? $meta->info->social : '';
					$position = isset( $meta->info->position ) ? $meta->info->position : '';
					?><li class="team-member grid-2">			

						<div class="name">
							<h4><?php $content->title(); ?></h4>
							<h6><em><?php echo $position; ?></em></h6>
						</div>
						<?php $content->content(); ?>

						<?php if ( isset( $social ) && is_array( $social ) ): ?>
						<ul class="social-list">
						<?php foreach ( $social as $icon ) { ?>
							<li>
								<a href="<?php echo $icon['url']; ?>" target="_blank">
									<p>
										<span class="icon-circle dark">
											<i class="<?php echo $icon['icon']; ?>"></i>
										</span>
									</p>
								</a>
							</li>
						<?php } ?>
						</ul>
						<?php endif; ?>

					</li><?php

				}

				?>
				</ul>
				<?php

				$content->resetLoop();

			}
		?>

		<?php } ?>
		
	<?php
		if ( $hasFeatImage ) {

			echo '<div class="animated slide" data-appear-bottom-offset="100">';

			$content->img(960,330);

			echo '</div>';

		}
	?>
</section>
<?php if ( defined( 'HOME_SLIDER') ) echo '</div>'; ?>