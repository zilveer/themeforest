<?php if( get_the_content() != '' ): ?>
<div class="stack stack-page-content" id="<?php echo $stack['id']; ?>">
<div class="container">
<div class="row">
	
	<div class="span8">
	<div class="padding-right-20">
		<?php the_content(); ?>

		<!-- Comment -->
		<?php if( comments_open() && !( is_page() && theme_options('page', 'comment_enable') == 'off' ) ): ?>
			<?php comments_template(); ?>
		<?php endif; ?>
	</div>
	</div>

	<aside class="span4 sidebar">
		<?php 
			global $post;
			if ( get_post_meta($post->ID, '_general_custom_sidebar', true) ) dynamic_sidebar( get_post_meta($post->ID, '_general_custom_sidebar', true) );
			elseif ( is_single() || is_home() ) dynamic_sidebar( 'blog' );
			elseif ( is_front_page() ) dynamic_sidebar( 'home' );
			else dynamic_sidebar( 'page' );
		?>
	</aside>
	
</div>
</div>
</div>
<?php endif; ?>