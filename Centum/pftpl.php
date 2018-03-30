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
 * @subpackage centum
 * @since centum 1.0
 */
?>
<style type="text/css">
@media only screen and (min-width: 960px) {#portfolio-wrapper iframe, #portfolio-wrapper img {min-height: 362px;}}
@media only screen and (min-width: 768px) and (max-width: 959px) {#portfolio-wrapper iframe {height: 230px;} #portfolio-wrapper img {min-height: 229px;}}
</style>


<!-- 960 Container -->
<div class="container">

	<div class="sixteen columns">

		<!-- Page Title -->
		<div id="page-title">
			<h2><?php $pf_title = get_post_meta($post->ID, 'centum_portfolio_title', true); if($pf_title) { echo $pf_title;} else { $pp_portfolio_page = ot_get_option('incr_portfolio_page');
				if (function_exists('icl_register_string')) {
                    icl_register_string('Portfolio page title','pp_portfolio_page', $pp_portfolio_page);
                    echo icl_t('Portfolio page title','pp_portfolio_page', $pp_portfolio_page); }
                else {
                    echo $pp_portfolio_page;
                } } ?> <?php if(is_tax()) { $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );  if($term) echo '<span>/ '.$term->name.'</span>'; } ?></h2>

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
			} } ?>
			<div class="clear"></div>

			<div id="bolded-line"></div>
		</div>
		<!-- Page Title / End -->

	</div>
</div>
<!-- 960 Container / End -->
<?php
if(is_tax()) {
	$desc = term_description($term->term_id,"filters");
	if($desc) { ?>
		<div class="page container" >
			<div class="sixteen columns">
				<?php echo $desc ;?>
			</div>
		</div>
	<?php }
}
?>


<!-- 960 Container -->
<div class="container">
	<!-- Portfolio Content -->
	<div id="portfolio-wrapper">
		<!-- Post -->
		<?php while (have_posts()) : the_post(); ?>

		<div <?php post_class('eight columns portfolio-item'); ?> id="post-<?php the_ID(); ?>" >

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
					$post_embed = $wp_embed->run_shortcode('[embed  width="580" ]'.$videolink.'[/embed]') ;
					echo '<div class="picture">'.$post_embed.'</div>';
				}
			} else {
				$thumbbig = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );

				if(ot_get_option('portfolio_thumb') == 'lightbox'){	?>
				<div class="picture"><a  href="<?php echo $thumbbig[0];?>"  rel="image" ><?php the_post_thumbnail("portfolio-medium"); ?><div class="image-overlay-zoom"></div></a></div>
				<?php } else { ?>
				<div class="picture"><a href="<?php the_permalink(); ?>"  ><?php the_post_thumbnail("portfolio-medium"); ?><div class="image-overlay-link"></div></a></div>
				<?php }
			} ?>


			<div class="item-description alt">
				<h5><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'centum'), the_title_attribute('echo=0')); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a></h5>
				<?php $excerpt = get_the_excerpt();
				$short_excerpt = string_limit_words($excerpt,ot_get_option('centum_portfolio_word_count',25));
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

	<?php if ($wp_query->max_num_pages > 1) : ?>
	<nav id="nav-below" class="navigation">
		<div class="nav-previous"><?php next_posts_link(__('Older items', 'centum')); ?></div>
		<div class="nav-next"><?php previous_posts_link(__('Newer items', 'centum')); ?></div>
	</nav><!-- #nav-below -->
	<?php endif;

	?>

</div>

</div> <!-- eof eleven column -->

