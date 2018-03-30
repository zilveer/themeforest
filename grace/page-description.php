<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 * 
 * Template Name: Description Page
 */

global $post;
$postID = $post->ID;
$postContent = apply_filters('the_content', $post->post_content);
$postCustom = get_post_custom($postID);
$sidebar = $postCustom['_tb_sidebar_choice'][0];

include('lib/plugins/simple_html_dom.php');

$inputHTML = str_get_html($postContent);

$listOfSections = array();
$sectionIndex = 0;

foreach ($inputHTML->find('h4') as $heading) {
	$currentIndex = 'section' . $sectionIndex;
	$heading->id = $currentIndex;
	$heading->class = 'description-section-title';
	$listOfSections[] = '<a href="#">' . ucwords(strtolower($heading->plaintext)) . '</a>' . '<a href="#' . $currentIndex . '" class="scroll fulld">' . ucwords(strtolower($heading->plaintext)) . '</a>';
	$headerInner = $heading->innertext . '<a href="#top" class="scroll" title="back to top">back to top</a>';
	$heading->innertext = $headerInner;
	$sectionIndex++;
}

$postContent = $inputHTML;

unset($inputHTML);

get_header();
st_before_content($columns = '');
?>

<div id="post-<?php echo $postID; ?>" <?php echo get_post_class('', $postID); ?>>
				
	<h1 class="entry-title"><?php echo $post->post_title; ?></h1>

	<div class="entry-content">
		<?php echo $postContent; ?>
	</div><!-- .entry-content -->

	<?php if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>');
	} ?>

</div><!-- #post-## -->

<?php
st_after_content();

// SIDEBAR
do_action('st_before_sidebar');

if (count($listOfSections) > 0) {
	echo '<ul><li id="description-page" class="widget-container">';
	echo '<h3 class="widget-title">' . __('Table of contents', 'grace') . '</h3>';
	echo '<ul>';
	foreach ($listOfSections as $section) {
		echo '<li class="fulldp">' . $section . '</li>';
	}
	echo '</ul></li></ul>';
}
	
if ( is_active_sidebar( $sidebar ) ) : ?>
	<ul>
		<?php dynamic_sidebar( $sidebar ); ?>
	</ul>
<?php endif;

do_action('st_after_sidebar');

get_footer();

?>