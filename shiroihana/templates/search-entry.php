<article <?php post_class( 'search-entry' ); ?> itemscope itemtype="https://schema.org/CreativeWork">

	<?php if( has_post_thumbnail() ) : ?>

		<figure class="entry-thumbnail search-thumbnail">
			<?php the_post_thumbnail( 'thumbnail' ); ?>
		</figure>

	<?php endif; ?>

	<header class="entry-header search-header">

		<?php $post_type = get_post_type_object( get_post_type() );

		if( is_object( $post_type ) ) : ?>

			<div class="entry-meta search-meta">

				<ul class="entry-meta-list plain-list"><?php

					?><li>
						<?php if( $post_type->has_archive ) : ?>
							<a href="<?php echo esc_url( get_post_type_archive_link( get_post_type() ) ); ?>">
								<?php echo esc_html( $post_type->labels->singular_name ); ?>
							</a>
						<?php else:
							echo esc_html( $post_type->labels->singular_name );
						endif; ?>
					</li><?php

					?><li>

						<time datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>" itemprop="datePublished">
							<?php echo get_the_time( get_option( 'date_format' ) ); ?>
						</time>

					</li>
				</ul>

			</div>

		<?php endif; ?>

		<?php the_title( '<h2 class="entry-title search-title" itemprop="headline name"><a href="' . get_permalink() . '" title="' . the_title_attribute( array( 'echo' => false ) ) . '" itemprop="url">', '</a></h2>' ); ?>

		<div class="entry-body search-body">
			<?php the_excerpt(); ?>
		</div>

	</header>

</article>
