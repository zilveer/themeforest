<?php global $unf_options; ?>


		<?php // LARGE POST LAYOUT
			if( $unf_options['unf_post_layout'] == '1') { ?>
			<div <?php post_class( 'clearfix blog-posts thepost' ); ?>>
				<div class="titlewrap clearfix">
					<h2 class="post-title entry-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<?php get_template_part('library/unf/postmeta');?>
				</div>
				<?php
				if (has_post_thumbnail()){
					get_template_part( 'library/unf/featured', 'image' );
				}?>
				<div class="entry-content ">
				<?php
					unf_post_excerpt_long();
					get_template_part( 'library/unf/readmoreviewcomments');
				?>
				</div>
			</div>
		<?php } ?>



		<?php // COMPACT POST LAYOUT
			if( $unf_options['unf_post_layout'] == '2') { ?>
			<div <?php post_class( 'clearfix blog-posts thepost' ); ?>>

				<div class="row compact-post-layout <?php if ( has_post_thumbnail() ) { echo'has-post-image';}?>">
					<?php
					if (has_post_thumbnail()){
					?>
					<div class="col-sm-5">
						<?php get_template_part( 'library/unf/featured', 'compactimage' ); ?>
					</div>
					<?php
					} // if has thumbnail ?>
					<div class="<?php  if(has_post_thumbnail()) {?>col-sm-7<?php } else {?>col-sm-12<?php } ?>">
						<div class="titlewrap clearfix">
							<h2 class="post-title entry-title">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
									<?php the_title(); ?>
								</a>
							</h2>
							<?php get_template_part('library/unf/postmeta');?>
						</div>
						<div class="entry-content ">
						<?php
							unf_post_excerpt();
							get_template_part( 'library/unf/readmoreviewcomments');
						?>
						</div>
					</div>
				</div>


			</div>
		<?php } ?>
