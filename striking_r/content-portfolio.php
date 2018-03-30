<?php
/**
 * The default template for displaying portfolio content in single-portfolio.php template
 */
$post_id = get_queried_object_id();
$layout = theme_get_inherit_option($post_id, '_layout', 'portfolio','layout');
$effect = theme_get_option('portfolio','sinle_effect');
$featured_image = theme_get_inherit_option($post_id, '_featured_image', 'portfolio','featured_image');
?>
<div id="post-<?php the_ID(); ?>" class="entry content entry-content type-portfolio">
<?php if($featured_image):?>
	<header>
		<?php echo theme_generator('portfolio_featured_image',$layout,$effect,true); ?>
	</header>
<?php endif; ?>
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'striking-r' ), 'after' => '</div>' ) ); ?>
	<footer>
	<?php edit_post_link(__('Edit', 'striking-r'),'<p class="entry_edit">','</p>'); ?>
	<time class="published updated hidden" datetime="<?php echo get_the_modified_time('Y-m-d');?>"><a href="<?php echo get_permalink();?>"><?php echo get_the_modified_date();?></a></time>
<?php if(theme_get_inherit_option($post->ID,'_author','portfolio','author')): echo theme_generator('blog_author_info');else:?>
<span class="author vcard hidden"><span class="fn"><?php echo get_the_author();?></span></span>
<?php endif;?>
<?php if(theme_get_inherit_option($post->ID,'_related_popular','portfolio','related_recent')):?>
		<div class="related_recent_wrap">
			<div class="one_half">
				<?php echo theme_generator('portfolio_related_posts');?>
			</div>
			<div class="one_half last">
				<?php echo theme_generator('portfolio_recent_posts');?>
			</div>
			<div class="clearboth"></div>
		</div>
<?php endif;?>
<?php if(theme_get_option('portfolio','single_navigation')):?>
		<nav class="entry_navigation">
			<div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous portfolio link', 'striking-r' ) . '</span> %title' ,false); ?></div>
			<div class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next portfolio link', 'striking-r' ) . '</span>' ,false); ?></div>
		</nav>
<?php endif;?>
	</footer>
	<div class="clearboth"></div>
</div>