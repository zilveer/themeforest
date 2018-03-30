<?php get_header(); ?>

<div class="site-content" itemscope itemtype="https://schema.org/Blog">

	<div class="site-content-header">

		<div class="container">

			<div class="row">

				<div class="col-md-12">

					<h1 class="site-content-title">
						<?php
							if( is_category() ):
								$strtr = array( '{category}' => single_cat_title( '', false ));
								$opt_prefix = 'blog_category';
							elseif( is_tag() ):
								$strtr = array( '{tag}' => single_tag_title( '', false ));
								$opt_prefix = 'blog_tag';
							elseif( is_author() ):
								$strtr = array( '{author}' => get_the_author() );
								$opt_prefix = 'blog_author';
							elseif( is_day() ):
								$strtr = array( '{date}' => get_the_date( __( 'F d, Y', 'shiroi' ) ) );
								$opt_prefix = 'blog_date';
							elseif( is_month() ):
								$strtr = array( '{date}' => get_the_date( __( 'F Y', 'shiroi' ) ) );
								$opt_prefix = 'blog_date';
							elseif( is_year() ):
								$strtr = array( '{date}' => get_the_date( __( 'Y', 'shiroi' ) ) );
								$opt_prefix = 'blog_date';
							endif;

							if( isset( $strtr, $opt_prefix ) ):
								if( $subtitle = Youxi()->option->get( $opt_prefix . '_subtitle' ) ):
									echo '<small itemprop="description">' . strtr( $subtitle, $strtr ) . '</small>';
								endif;
								echo '<span itemprop="name">' . strtr( Youxi()->option->get( $opt_prefix . '_title' ), $strtr ) . '</span>';
							endif;
						?>
					</h1>

					<?php if( $term_description = term_description() ):

						echo '<div class="site-content-description">';

							echo '<div class="row">';

								echo '<div class="col-md-6 col-md-push-3">';

									echo wpautop( $term_description );

								echo '</div>';

							echo '</div>';

						echo '</div>';

					endif; ?>

				</div>

			</div>

		</div>

	</div>

	<div class="container">

		<div class="row">

			<?php shiroi_before_entries(); ?>

				<?php if( have_posts() ) : 

					$entry_layout = Youxi()->option->get( 'blog_archive_layout_mode' );
					if( 'masonry' == $entry_layout ) {
						$entry_layout = 'grid';
					}

					while( have_posts() ) : the_post();

						Youxi()->templates->get( 'entry', get_post_format(), get_post_type(), $entry_layout );

					endwhile;

				endif; ?>

			<?php shiroi_after_entries(); ?>

		</div>

	</div>

</div>

<?php get_footer(); ?>