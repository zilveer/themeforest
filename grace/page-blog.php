<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 * 
 * Template Name: Blog Page
 */
 
global $post; 

$title = $post->post_title;
$postID = $post->ID;

if ( function_exists('yoast_breadcrumb') ) {
	$yoast = yoast_breadcrumb('<p id="breadcrumbs">' . __( 'You are here: ', 'grace'),'</p>', FALSE);
}

$postCustom = get_post_custom($postID);
if (isset($postCustom['_tb_category'][0])) $category = $postCustom['_tb_category'][0];

get_header();
st_before_content($columns = '');

?>

<h1 class="entry-title"><?php echo $title; ?></h1>

<?php
$args = array();

$args['post_type'] = 'post';
$args['post_status'] = 'publish';

if (get_query_var('paged')) {
	$paged = get_query_var('paged');
} elseif (get_query_var('page')) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

$args['paged'] = $paged; 

if (isset($category)) $args['cat'] = $category;

$tbQuery = new WP_Query($args);

if ($tbQuery->have_posts()) : while ($tbQuery->have_posts()) : $tbQuery->the_post(); ?>

<div id="post-<?php $postID = get_the_ID(); echo $postID; ?>" <?php post_class(); ?>>

	<?php $postPermalink = get_permalink(); ?>

	<?php if (has_post_thumbnail())	{ ?>
		<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="thumb" style="display: block;"><?php echo get_the_post_thumbnail($postID, 'article_thumbnail', array('class' => 'imageBorder single-article')); ?></a>
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

<?php endwhile; endif;

if (isset($yoast)) echo $yoast;

$total = $tbQuery->max_num_pages;

if ($total > 1)
{
	?>
	<div class="pn_pagination clearfix">
		<?php
		// get the current page
		if (get_query_var('paged'))
		{
			$current_page = get_query_var('paged');
		}
		else if (get_query_var('page'))
		{
			$current_page = get_query_var('page');
		}
		else
		{
			$current_page = 1;
		}
		// structure of “format” depends on whether we’re using pretty permalinks
		$permalink_structure = get_option('permalink_structure');
		if (empty($permalink_structure))
		{
			if (is_front_page())
			{
				$format = '?paged=%#%';
			}
			else
			{
				$format = '&paged=%#%';
			}
		}
		else
		{
			$format = 'page/%#%/';
		}



		echo paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => $format,
			'current' => $current_page,
			'total' => $total,
			'mid_size' => 10,
			'type' => 'list'
		));
		?>
	</div>
	
	<div class="contentSpacer"></div>
<?php }

st_after_content();
get_sidebar();
get_footer();

?>