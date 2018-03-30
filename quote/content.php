<?php
/**
 * @package quote
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-12 post post-item'); ?>>
	<header class="entry-header">
		<?php if ( 'post' == get_post_type() ) : ?>
   		<div class="item-inner">
            <?php the_post_thumbnail( 'main-featured', array( 'class' => 'img-responsive' ) ); ?>
            <div class="overlay">
                <a class="preview btn btn-outlined btn-primary" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-link"></i></a>          
            </div>
            <div class="post-meta">
                <span class="post-date">
                	<a href="<?php echo get_month_link('', ''); ?>" class="thedate"><?php echo get_the_date( 'j' ); ?></a>
                	<a href="<?php echo get_month_link('', ''); ?>" class="themonth"><?php echo get_the_date( 'F' ); ?></a>
            	</span>
                <span class="post-comment"><i class="fa fa-comments"></i> <a href="<?php the_permalink(); ?>"><?php echo get_comments_number( 'ID' ); ?></a></span>
            </div>         
        </div>
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'quote' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'quote' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'quote' ) );
				if ( $categories_list && quote_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'quote' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'quote' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'quote' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'quote' ), __( '1 Comment', 'quote' ), __( '% Comments', 'quote' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'quote' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->