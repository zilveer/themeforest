<?php
/**
 * Short Post or Page
 *
 * Used in loop-search.php and loop-blog.php for posts and pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-short' ); ?>>
	
	<header>

		<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
		
		<?php if ( 'post' == get_post_type() ) : // don't show date or author for Page ?>
		<div class="box blog-header-meta">

			<div class="blog-time-author">
		
				<time datetime="<?php the_time( 'c' ); ?>"><?php echo risen_date_ago( get_the_time( 'U' ), 5 ); // show up to "5 days ago" but actual date if older ?></time>

				<span class="blog-header-meta-author">
					<?php
					printf(
						_x( 'by <a href="%1$s">%2$s</a>', 'author', 'risen'),
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), // author URL
						get_the_author() // author name
					);
					?>
				</span>
			
			</div>

			<ul class="blog-header-meta-icons risen-icon-list">
				
				<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if now new comments are off (unless password protected) ?>
				<li><?php comments_popup_link( _x( '0', 'comment count', 'risen' ), _x( '1', 'comment count', 'risen' ), '%', 'single-icon comment-icon', '' ); ?><?php comments_popup_link( _x( '0', 'comment count', 'risen' ), _x( '1', 'comment count', 'risen' ), '%', 'risen-icon-label', '' ); ?></li>
				<?php endif; ?>

			</ul>
			
			<div class="clear"></div>
			
		</div>
		<?php endif; ?>
		
	</header>
	
	<?php if ( has_post_thumbnail() && get_post_type() != 'risen_staff' ) : ?>
	<div class="image-frame blog-short-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'risen-post', array( 'title' => '' ) ); ?></a></div>
	<?php endif; ?>
	
	<div class="blog-short-excerpt">
		<?php the_excerpt(); ?>
	</div>

</article>