<?php get_header(); ?>
<section class="main single" itemscope itemtype="http://schema.org/Article">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<article class="post">
			<?php $hide_title = get_post_meta(get_the_id(), 'hide_title', true);?>
			<?php if(!$hide_title) : ?><h1><?php the_title(); ?> <?php edit_post_link(esc_attr__('Edit this entry', 'multipurpose'), '', ''); ?></h1><?php endif; ?>
			<p class="post-meta" itemprop="datePublished" content="<?php the_time('Y-m-d') ?>"><?php the_time(get_option( 'date_format')) ?><span>|</span> <?php esc_attr__('by', 'multipurpose') ?> <span class="author" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name" class="author"><?php the_author(); ?></span></span> <span>|</span> <?php the_category(", "); ?> <?php if ( comments_open() ) : ?><?php comments_popup_link('0', '1', '%', 'comment-link'); ?><?php endif; ?></p>
			<?php 
			$iframe_video = get_post_meta(get_the_id(), 'single_meta_video_iframe', true);
			if($iframe_video):
				echo '<p>'.$iframe_video.'</p>'; 
			else :
				if(has_post_thumbnail()) {
					$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
					if ($sidebar_position == 2) {
						the_post_thumbnail('thumbnail-high-extra-large');
					} else {
						the_post_thumbnail('thumbnail-high-large');
					}
				}
			endif; ?>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p class="pages"><strong>'.esc_attr__('Pages', 'multipurpose').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			<?php if(has_tag()): ?><p class="tags"><?php esc_attr_e('Tags', 'multipurpose'); ?>: <?php the_tags(""); ?></p><?php endif; ?>
			<?php 
			$share_links = get_theme_mod('share_links');
			if (empty($share_links)) $share_links = 2;
			if($share_links == 2) : 
				get_template_part('share');
			endif; 
			?>
		</article>

		<?php
		$show_author = get_theme_mod('show_post_author');		
		if(!$show_author):
		?>
			<section class="post-author">
				<?php echo get_avatar(get_the_author_meta( 'ID' )) ?>
				<div>
					<h3>Author: <?php the_author_link(); ?></h3>
					<p><?php echo get_the_author_meta( 'description' ); ?></p>
				</div>
			</section>
		<?php endif; ?>

		<?php 
		$show_related = get_theme_mod('show_related');
		if(!$show_related) related_posts($post);
		
		comments_template(); 
		?>

		<nav class="project-nav">
			<span class="prev"><?php next_post_link('%link'); ?></span>
			<span class="next"><?php previous_post_link('%link'); ?></span>
		</nav>


	<?php endwhile; endif; ?>
	<meta itemprop="dateModified" content="<?php the_modified_time('c'); ?>">
	<meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink();?>"/>
	<meta itemprop="headline" content="<?php the_title(); ?>">
	
	<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
	<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
	<meta itemprop="url" content="<?php echo esc_url(get_theme_mod( 'logo_upload' ));?>">
	</span>
	<meta itemprop="name" content="<?php bloginfo('name'); ?>">
	</span>
	<?php
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	$img = wp_get_attachment_image_src( $thumbnail_id, 'post-thumbnail' );
	$src = $img[0];
	$width = $img[1];
	$height = $img[2];
	?>
	<span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">	
	<meta itemprop="url" content="<?php echo $src;?>">
	<meta itemprop="width" content="<?php echo $width;?>">
	<meta itemprop="height" content="<?php echo $height;?>">
	</span>
</section>
<?php 
$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
if($sidebar_position == 3) $sidebar_position = $sidebar_pos_global;
if($sidebar_position != 2) {
	$sidebar = get_post_meta(get_the_id(), 'custom_sidebar', true) ? get_post_meta(get_the_id(), 'custom_sidebar', true) : "default";
	if($sidebar != 'no') {
		if($sidebar && $sidebar != "default") get_sidebar("custom");
		else get_sidebar();	
	}
}
?>
<?php get_footer(); ?>
