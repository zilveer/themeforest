<?php
/**
 * The Template for displaying all single posts.
 *
 * @subpackage newidea
 * @since newidea 4.0
 */
global $pages_rel, $page_id;

$pages_rel = newidea_get_menus();
$page_id = 'post-'.get_the_ID();

get_header();

// theme config
get_template_part('template/theme-config'); 
?>
<!-- All content elements -->
<section id="content-elements">
	<input id="content-elements-single" type="hidden" value="<?php echo $page_id; ?>" ></input>
<?php
	// single posts
	$post_type = get_post_type();
	if(!($post_type == 'services' || $post_type == 'portfolio')){
		$post_type = '';
	}
	get_template_part('template/single/content', $post_type);
	// show pages
	get_template_part('template/pages/loop');
?>
</section>
<?php get_footer(); ?>