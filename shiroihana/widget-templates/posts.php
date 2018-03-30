<?php

global $post;

foreach( $posts as $post ) : setup_postdata( $post );

?><article <?php post_class( 'clearfix' ); ?>>

	<?php if( has_post_thumbnail() ):

	?><figure class="posts-widget-thumbnail">
		<?php the_post_thumbnail( 'thumbnail' ); ?>
	</figure>
	<?php endif;

	?><div class="posts-widget-description">

		<?php the_title( '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h5>' ); ?>
		
		<div class="entry-meta">
			<?php if( 'category' === $meta_display ):
				printf( __( 'In %s', 'shiroi' ), implode( ', ', wp_list_pluck( get_the_category(), 'name' ) ) );
			elseif( 'tags' === $meta_display ):
				printf( __( 'Tagged %s', 'shiroi' ), implode( ', ', wp_list_pluck( get_the_tags(), 'name' ) ) );
			elseif( 'author' === $meta_display ):
				printf( __( 'By %s', 'shiroi' ), get_the_author() );
			else:

			?><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>">
				<?php echo get_the_date( get_option( 'date_format' ) ); ?>
			</time>
			<?php endif; ?>
		</div>

	</div>

</article>
<?php endforeach;
