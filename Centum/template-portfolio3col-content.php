<?php
/**
 * Template Name: Portfolio page 3 colums + content
 *
 * A custom page template without sidebar.
 *
 */

get_header(); ?>
<style type="text/css">
	@media only screen and (min-width: 960px) { #portfolio-wrapper iframe {min-height: 200px }  #portfolio-wrapper img {min-height: 189px;}}
	@media only screen and (min-width: 768px) and (max-width: 959px) { #portfolio-wrapper iframe {height: 157px;} #portfolio-wrapper img {min-height: 149px;}}
</style>

<?php while (have_posts()) : the_post(); ?>
	<!--  Page Title -->

	<!-- 960 Container Start -->
	<div class="container">
		<div class="sixteen columns">
			<div id="page-title">
				<?php $bredcrumbs = ot_get_option('centum_breadcrumbs'); ?>
				<h1 <?php if($bredcrumbs == 'yes') echo 'class="has-breadcrumbs"';?>>
					<?php the_title(); ?>
					<?php $subtitle  = get_post_meta($post->ID, 'incr_subtitle', true);
					if ( $subtitle) {
						echo ' <span>/ '.$subtitle.'</span>';
					} ?>
				</h1>
				<?php if(ot_get_option('centum_breadcrumbs') == 'yes') echo dimox_breadcrumbs() ;?>
				<div id="bolded-line"></div>
			</div>
		</div>
	</div>
	<!-- 960 Container End -->

	<!-- Page Title End -->

		<!-- Post -->
		<div class="container">
			<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >
				<div class="sixteen columns">
					<?php the_content() ?>
				</div>
			</div>
		</div>

		<!-- Post -->
	<?php endwhile; // End the loop. Whew.  ?>
<!-- eof page content -->

<!-- 960 Container -portfolio -->
<div class="container">
	<?php $showpost = ot_get_option('portfolio_showpost','9');
$filters = get_post_meta($post->ID, 'portfolio_filters', true);
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
if(empty($filters)) {
	query_posts(array (
		'post_type' => 'portfolio',
		'paged' => $paged,
		'posts_per_page' => $showpost
	));
} else {
	query_posts(array (
		'post_type' => 'portfolio',
		'posts_per_page' => $showpost,
		'paged' => $paged,
		'tax_query' => array(
			array(
				'taxonomy' => 'filters',
				'field' => 'id',
				'terms' => $filters,
				'operator' => 'IN',
				'include_children' => false
			)
		)
	));
} ?>
	<div class="sixteen columns">

		<!-- Page Title -->
		<div id="page-title">
			<h2><?php $pf_title = get_post_meta($post->ID, 'centum_portfolio_title', true); if($pf_title) { echo $pf_title;} else { echo ot_get_option('incr_portfolio_page'); } ?> <?php if(is_tax()) { $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  if($term) echo '<span>/ '.$term->name.'</span>'; } ?></h2>

			<!-- Filters -->


			<?php
			$filterswitcher = get_post_meta($post->ID, 'centum_filters_switch', true);
			if($filterswitcher != 'no') {
			$filters = get_post_meta($post->ID, 'portfolio_filters', true);
			if(!empty($filters)) { ?>
			<div id="filters">
				<ul class="option-set" data-option-key="filter">
					<li><a href="#filter" class="selected" data-option-value="*"><?php  _e('All', 'centum'); ?></a></li>
					<?php
					foreach ( $filters as $id ) {
						$term = get_term( $id, 'filters' );
						echo '<li><a href="#filter" data-option-value=".'.$term->slug.'">'. $term->name .'</a></li>';

					} ?>
				</ul>
			</div>
			<?php }
			if(!is_tax()) {

			$terms = get_terms("filters");
			$count = count($terms);
			if ( $count > 0 ){ ?>
			<div id="filters">
				<ul class="option-set" data-option-key="filter">
					<li><a href="#filter" class="selected" data-option-value="*"><?php  _e('All', 'centum'); ?></a></li>
					<?php
					foreach ( $terms as $term ) {
						echo '<li><a href="#filter" data-option-value=".'.$term->slug.'">'. $term->name .'</a></li>';

					} ?>
				</ul>
			</div>
			<?php }
			} }?>
			<div class="clear"></div>

			<div id="bolded-line"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->

<!-- 960 Container -->
<div class="container">
	<!-- Portfolio Content -->
	<div id="portfolio-wrapper">


		<!-- Post -->
		<?php

		while (have_posts()) : the_post(); ?>

		<div <?php post_class('one-third column portfolio-item'); ?> id="post-<?php the_ID(); ?>" >

			<?php
			$type  = get_post_meta($post->ID, 'incr_pf_type', true);
			$videothumbtype = ot_get_option('portfolio_videothumb');
			if($type == 'video' && $videothumbtype == 'video') {
				$videoembed = get_post_meta($post->ID, 'incr_pfvideo_embed', true);
				if($videoembed) {
					echo '<div class="picture embedcode">'.$videoembed.'</div>';
				} else {
					global $wp_embed;
					$videolink = get_post_meta($post->ID, 'incr_pfvideo_link', true);
					$post_embed = $wp_embed->run_shortcode('[embed  width="300" height="200"]'.$videolink.'[/embed]') ;
					echo '<div class="picture">'.$post_embed.'</div>';
				}
			} else {
				$thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );

				if(ot_get_option('portfolio_thumb') == 'lightbox'){	?>
				<div class="picture"><a  href="<?php echo $thumbbig[0];?>"  rel="image" ><?php the_post_thumbnail("portfolio-thumb"); ?><div class="image-overlay-zoom"></div></a></div>
				<?php } else { ?>
				<div class="picture"><a href="<?php the_permalink(); ?>"  ><?php the_post_thumbnail("portfolio-thumb"); ?><div class="image-overlay-link"></div></a></div>
				<?php }
			} ?>
			<div class="item-description alt">
				<h5><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'centum'), the_title_attribute('echo=0')); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a></h5>
				<?php 	$excerpt = get_the_excerpt();
				$short_excerpt = string_limit_words($excerpt,ot_get_option('centum_portfolio_word_count',15));
				if(ot_get_option('centum_portfolio_text')== 'excerpt') {
					echo '<p>'.$excerpt.'</p>';
				} else {
					echo '<p>'.$short_excerpt.'</p>';
				} ?>
			</div>
		</div>
		<!-- Post -->
	<?php endwhile; // End the loop. Whew.  ?>


</div>
<div class="pagination">

	<?php previous_posts_link(); ?>
	<?php next_posts_link(); ?>

</div>

</div> <!-- eof eleven column -->

<?php get_footer(); ?>