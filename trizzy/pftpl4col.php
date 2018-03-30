<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage trizzy
 * @since trizzy 1.0
 */

?>

<!-- Container -->
<div class="container potrfolio-container">
	<div class="sixteen columns">

		<?php
		$filterswitcher = get_post_meta($post->ID, 'pp_filters_switch', true);
		if($filterswitcher != 'no') {
			$filters = get_post_meta($post->ID, 'portfolio_filters', true);
			if(!empty($filters)) { ?>
			<div id="filters" class="filters-dropdown headline"><span></span>
				<ul class="option-set" data-option-key="filter">
					<li><a href="#filter" class="selected" data-filter="*"><?php  _e('All', 'trizzy'); ?></a></li>
					<?php
					foreach ( $filters as $id ) {
						$term = get_term( $id, 'filters' );
						echo '<li><a href="#filter" data-filter=".'.$term->slug.'">'. $term->name .'</a></li>';

					} ?>
				</ul>
			</div>
			<?php } }
			if(!is_tax()) {
				$terms = get_terms("filters");
				$count = count($terms);
				if ( $count > 0 ){ ?>
				<div id="filters" class="filters-dropdown headline">
					<ul class="option-set" data-option-key="filter">
						<li><a href="#filter" class="selected" data-filter="*"><?php  _e('All', 'trizzy'); ?></a></li>
						<?php
						foreach ( $terms as $term ) {
							echo '<li><a href="#filter" data-filter=".'.$term->slug.'">'. $term->name .'</a></li>';
						} ?>
					</ul>
				</div>

				<?php }
			} ?>

	</div>
	<div class="clearfix"></div>

		<!-- Portfolio Content -->
		<div id="portfolio-wrapper">

			<!-- Post -->
			<?php
			while (have_posts()) : the_post(); ?>

			<!-- Portfolio Item -->
				<div <?php post_class('four columns portfolio-item media'); ?> id="post-<?php the_ID(); ?>" >

					<figure>
						<div class="portfolio-holder">
							<a href="<?php the_permalink(); ?>">
								<?php
								$type  = get_post_meta($post->ID, 'pp_pf_type', true);
								$videothumbtype = ot_get_option('pp_portfolio_videothumb');
								if($type == 'video' && $videothumbtype == 'video') {
									$videoembed = get_post_meta($post->ID, 'pp_pfvideo_embed', true);
									if($videoembed) {
										echo '<div class="video">'.$videoembed.'</div>';
									} else {
										global $wp_embed;
										$videolink = get_post_meta($post->ID, 'pp_pfvideo_link', true);
										$post_embed = $wp_embed->run_shortcode('[embed  width="300" height="200"]'.$videolink.'[/embed]') ;
										echo '<div class="video">'.$post_embed.'</div>';
									}
								} else {
									$thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
									if(ot_get_option('portfolio_thumb') == 'lightbox'){
										the_post_thumbnail("portfolio-3col");
									} else {
										the_post_thumbnail("portfolio-3col");
									}
								} ?>
								<div class="hover-cover"></div>
								<div class="hover-icon"></div>
							</a>
						</div>
						<a href="<?php the_permalink(); ?>">
							<section class="item-description">

								<?php $terms = get_the_terms( $post->ID, 'filters' );
								if ( $terms && ! is_wp_error( $terms ) ) : echo '<span>';
								$filters = array();
								$i = 0;
								foreach ( $terms as $term ) {
									$filters[] = $term->name;
									if ($i++ > 2) break;
								}
								$outputfilters = join( ", ", $filters ); echo $outputfilters;
								echo '</span>';
								endif; ?>
								<h5><?php the_title(); ?></h5>
							</section>
						</a>
					</figure>

			</div>
			<!-- eof Portfolio Item -->

		<?php endwhile; // End the loop. Whew.  ?>
	</div>
	</div>
	<div class="container">
		<div class="sixteen columns">
			<div class="pagination-container">
				<?php if(function_exists('wp_pagenavi')) { ?>
				<nav class="pagination">
					<?php wp_pagenavi(); ?>
				</nav>
				<?php
			} else {
				if ( get_next_posts_link() ||  get_previous_posts_link() ) : ?>
				<nav class="pagination">
					<ul>
						<?php if ( get_previous_posts_link() ) : ?>
							<li id="next"><?php previous_posts_link(' '); ?></li>
						<?php  endif; ?>
						<?php if ( get_next_posts_link() ) : ?>
							<li id="prev"><?php next_posts_link(' '); ?></li>
						<!-- <li><a href="#" class="next"></a></li> -->
						<?php endif; ?>
					</ul>
				</nav>
			<?php endif;
			} ?>
			</div>
		</div>
	</div>