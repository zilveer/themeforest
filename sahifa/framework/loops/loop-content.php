<div class="post-listing">

<?php while ( have_posts() ) : the_post(); ?>

	<article <?php tie_post_class('item-list'); ?>>
	
		<h2 class="post-box-title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		
		<?php get_template_part( 'framework/parts/meta-archives' ); ?>					

		<div class="entry">
			<?php the_content( __ti( 'Read More &raquo;' ) ); ?>
		</div>
		
		<?php if( tie_get_option( 'archives_socail' ) ) get_template_part( 'framework/parts/share' );  // Get Share Button template ?>
		
		<div class="clear"></div>
	</article><!-- .item-list -->

<?php endwhile;?>
</div>
