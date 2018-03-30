<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 * Template Name: Home Page
*/

get_header();
st_before_content($columns='sixteen');

global $post;
$postID = $post->ID;
$postCustom = get_post_custom($postID);

/* HOME PAGE SLIDER */
$sliderAlias = $postCustom['_tb_slider_alias'][0];

if (isset($sliderAlias)) {
	
	$site_layout = tb_default($themeOptions['site_layout'], 'wide');
	
	if ($site_layout == 'wide') {
		$background_height = tb_default($themeOptions['background_height'], 420);
		$sliderParams = tb_get_rev_slider_settings($sliderAlias);
		$sliderHeight = $sliderParams->height + 14;
		
		$home_slider_margin_top = ceil(($background_height - $sliderHeight) / 2);
		$home_slider_margin_bottom = $home_slider_margin_top + 40;
		$style = 'style="margin-top: ' . $home_slider_margin_top . 'px; margin-bottom: ' . $home_slider_margin_bottom . 'px;"';
	}
	
	?>
	<div id="homeSlider" <?php echo $style; ?>>
	<?php if (function_exists('putRevSlider')) putRevSlider($sliderAlias) ?>
	</div>
	<?php
}

$introTextTitle =  (isset($postCustom['_tb_intro_text_title'][0])) ? $postCustom['_tb_intro_text_title'][0] : FALSE;
$introTextSubtitle = (isset($postCustom['_tb_intro_text_subtitle'][0])) ? $postCustom['_tb_intro_text_subtitle'][0] : FALSE;
$introText = (isset($postCustom['_tb_intro_text'][0])) ? $postCustom['_tb_intro_text'][0] : FALSE;

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
$highlightArea = (isset($postCustom['_tb_highlight_sidebar_choice'][0])) ? $postCustom['_tb_highlight_sidebar_choice'][0] : FALSE;

$the_sidebars = wp_get_sidebars_widgets();
$numberOfWidgets = count($the_sidebars[$highlightArea]);

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
if (isset($postCustom['_tb_content_area'][0]) && $postCustom['_tb_content_area'][0] != 'no') {
	$contentTitle = isset($postCustom['_tb_content_title'][0]) ? $postCustom['_tb_content_title'][0] : FALSE;
	if (isset($contentTitle)) echo "<h3 class='homeTitle'>$contentTitle</h3>";
	
	if (have_posts()) : while (have_posts()) : the_post();
	the_content();
	endwhile; endif;
}

/* ARTICLES */

$numberOfArticles = isset($postCustom['_tb_number_of_articles'][0]) ? $postCustom['_tb_number_of_articles'][0] : 3;
if (isset($postCustom['_tb_articles_area'][0]) && $postCustom['_tb_articles_area'][0] == 'yes') {
	$articlesTitle = $postCustom['_tb_articles_title'][0];
	
	$latestPosts = new WP_Query(array('posts_per_page' => $numberOfArticles, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true));
	
	if ($latestPosts->have_posts()) {
		if (isset($articlesTitle)) echo "<h3 class='homeTitle'>$articlesTitle</h3>";
		
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
?>
