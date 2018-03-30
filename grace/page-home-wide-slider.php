<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 * Template Name: Home Page - Full Width Slider
*/

$themeOptions = of_get_all_options();
$site_layout = tb_default($themeOptions['site_layout'], 'wide');	

if ($site_layout == 'wide') {
	
global $post;
$postID = $post->ID;
$postCustom = get_post_custom($postID);

get_header();

/* HOME PAGE SLIDER */
$sliderAlias = isset($postCustom['_tb_slider_alias'][0]) ? $postCustom['_tb_slider_alias'][0] : FALSE;

if ($sliderAlias) {
	?>
	<div id="homeSlider">
	<?php if (function_exists('putRevSlider')) putRevSlider($sliderAlias) ?>
	</div>
	<?php
}

?>

		<div class="container">
		<div id="contentarea">

<?php

st_before_content($columns='sixteen');

$introTextTitle = isset($postCustom['_tb_intro_text_title'][0]) ? $postCustom['_tb_intro_text_title'][0] : FALSE;
$introTextSubtitle = isset($postCustom['_tb_intro_text_subtitle'][0]) ? $postCustom['_tb_intro_text_subtitle'][0] : FALSE;
$introText = isset($postCustom['_tb_intro_text'][0]) ? $postCustom['_tb_intro_text'][0] : FALSE;

if ($introTextTitle || $introTextSubtitle || $introText) {
	echo '<div id="promoText">';
	
	echo '<div class="contentSpacer"></div>';
	
	if ($introTextTitle) echo "<h2>$introTextTitle</h2>";
	if ($introTextSubtitle) echo "<h3>$introTextSubtitle</h3>";
	if ($introText) echo apply_filters('the_content', $introText);
	
	echo '<div class="contentSpacer"></div>';
	
	echo '</div>';
}

/* HOME PAGE HIGHLIGHT AREA */
$highlightArea = isset($postCustom['_tb_highlight_sidebar_choice'][0]) ? $postCustom['_tb_highlight_sidebar_choice'][0] : FALSE;

$the_sidebars = wp_get_sidebars_widgets();

$numberOfWidgets = isset($highlightArea) ? count($the_sidebars[$highlightArea]) : FALSE;

if ($numberOfWidgets) {
	echo '<div id="highlightArea"><ul>';
	dynamic_sidebar($highlightArea);
	echo '</ul></div>';
	
	if ($numberOfWidgets == 2) {
		$classFA = 'one_half';
	} elseif ($numberOfWidgets == 4) {
		$classFA = 'one_fourth';
	} else {
		$classFA = 'one_third';
		$numberOfWidgets = 3;
	}
	?>
	
	<script type="text/javascript">
		jQuery('#highlightArea .widget-container').addClass('<?php echo $classFA; ?>');
		jQuery('#highlightArea .widget-container:nth-child(<?php echo $numberOfWidgets; ?>n)').addClass('last');
	</script>
	
	<?php
}

st_after_content();

st_before_content('', 'home2');

/* CONTENT AREA */
if ($postCustom['_tb_content_area'][0] != 'no') {
	$contentTitle = isset($postCustom['_tb_content_title'][0]) ? $postCustom['_tb_content_title'][0] : FALSE;
	if ($contentTitle) echo "<h3 class='homeTitle'>$contentTitle</h3>";
	
	if (have_posts()) : while (have_posts()) : the_post();
	the_content();
	endwhile; endif;
}

/* ARTICLES */

$numberOfArticles = $postCustom['_tb_number_of_articles'][0];
if ($postCustom['_tb_articles_area'][0] == 'yes') {
	$articlesTitle = $postCustom['_tb_articles_title'][0];
	
	$latestPosts = new WP_Query(array('posts_per_page' => $numberOfArticles, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
	
	if ($latestPosts->have_posts()) {
		if ($articlesTitle) echo "<h3 class='homeTitle'>$articlesTitle</h3>";
		
		while ($latestPosts->have_posts()) : $latestPosts->the_post();
		?>
		
		<div id="post-<?php $pID = get_the_ID(); echo $pID; ?>" <?php post_class(); ?>>
		
			<?php $postPermalink = get_permalink($pID); ?>

			<?php if (has_post_thumbnail($pID))	{ ?>
				<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="thumb" style="display: block;"><?php echo get_the_post_thumbnail($pID, 'article_thumbnail', array('class' => 'imageBorder single-article')); ?></a>
			<?php } ?>
					
			<div class="entry-meta">
				<?php skeleton_posted_on(); ?>
				<?php skeleton_posted_in(0); ?>
				<h2 class="entry-title"><a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			</div><!-- .entry-meta -->

			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	
		</div><!-- #post-## -->
		
		<div class="contentSpacer"></div>
		<?php
		endwhile;
	}
}

st_after_content();
get_sidebar();

get_footer();

} else {
	get_template_part('page', 'home');
}
?>
