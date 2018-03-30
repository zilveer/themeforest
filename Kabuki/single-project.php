<?php get_header(); ?>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="content"><div class="post-single">
			<div class="post-wrapper">
				<div class="post-header">
				<h1><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				</div><div class="clearleft"></div><!--.postHeader-->
				<div class="top-border"></div>

		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

			<article>
				
				<div class="post-edit"><?php edit_post_link(); ?></div>
				<?php if ( has_post_thumbnail() ) { /* loads the post's featured thumbnail, requires Wordpress 3.0+ */ echo '<div class="featured-thumbnail">'; the_post_thumbnail(); echo '</div>'; } ?>
				<div class="post-content">
					<?php the_content(); ?>
					<div class="back-button"><input type="button" value="<?php echo'&#171; '.__('Back', 'satori'); ?>" 
onclick="history.go(-1)"></div>
					<?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
				</div><!--.post-content-->
				<div class="clearboth"></div>
			</article>
		</div><!-- #post-## -->
		<?php comments_template( '', true ); ?>

	<?php endwhile; /* end loop */ ?>
</div><!--#post-wrapper-->
</div><!--#content-->
</div>
<?php get_footer(); ?>