<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 * 
 * Template Name: Gallery Page
 */

get_header();
st_before_content($columns = 'sixteen');

global $post;
$pageID = $post->ID;
$pageCustom = get_post_custom($pageID);

// size
if (isset($pageCustom['_tb_number_of_columns'][0])) {
	$numberOfColumns = $pageCustom['_tb_number_of_columns'][0];
} else {
	$numberOfColumns = 3;
}

if (isset($pageCustom['_tb_show_pagination'][0]) && $pageCustom['_tb_show_pagination'][0] == 'no') {
	$postsPerPage = -1;
} else {
	$postsPerPage = get_option('posts_per_page') ;
	$postsPerPage = floor($postsPerPage / $numberOfColumns) * $numberOfColumns;
}

if (!$postsPerPage) $postsPerPage = 1;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'posts_per_page'	=> $postsPerPage,
  'paged' 			=> $paged,
  'post_type'		=> TB_GALLERY_CPT
);

unset($qIndex);
$qIndex = 1;
		
$tbGalleryMargin = 'tb-gallery-margin';

$theQuery = new WP_Query( $args );

if ( !$theQuery->have_posts() ) {  ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php echo __( 'Not Found', 'grace' ); ?></h1>
		<div class="entry-content">
			<p><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'grace' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php } else { ?>

<h1 class="entry-title <?php echo $tbGalleryMargin; ?>"><?php the_title(); ?></h1>


<?php

if ($pageCustom['_tb_show_filter'][0] == 'yes') {


$terms = get_terms(TB_GALLERY_TAX);
$count = count($terms);
if ( $count > 0 ) { ?>

	<div class="pn_pagination filter clearfix <?php echo $tbGalleryMargin; ?>">
	<ul id="tb_filters">
	<li><span class="current">FILTER</span></li>
	<li><a href="#self" data-filter="*">all</a></li>

	<?php
	foreach ( $terms as $term ) {
		echo '<li><a href="#self" data-filter=".' . $term->slug .'">' . $term->name . "</a></li>";
	} ?>
	
	</ul>
	</div>
<?php

}

}
?>

<div id="tb_gallery">

<?php while ( $theQuery->have_posts() ) : $theQuery->the_post(); ?>

		<?php
		unset($postClasses);
		
		$postClasses = array();
		
		// terms list
		$gcats = get_the_terms($post_id, TB_GALLERY_TAX);
		if (!empty($gcats))
		{
			unset($gcatArray);
			
			$gcatArray = array();
			foreach ($gcats as $gcat) $gcatArray[] = $gcat->slug;

			$postClasses[] = implode($gcatArray, " ");
		}

		if ($numberOfColumns == 2) {
			$postClasses[] = 'one_half';
		} elseif ($numberOfColumns == 4) {
			$postClasses[] = 'one_fourth';
		} else {
			$postClasses[] = 'one_third';
		}		
		
		?>
			
		<div id="post-<?php $postID = get_the_ID(); echo $postID; ?>" <?php post_class($postClasses); ?>>
		
			<?php $postPermalink = get_permalink(); $postURL = $postPermalink; ?>
			<?php $postCustom = get_post_custom($postID); ?>
			
			<?php
			$thumbnailSize = 'tb_gallery_small';
			?>

			<?php if (has_post_thumbnail())	{ ?>
				<?php
					$rel = 'rel=""bookmark';
					$prettyPhoto = $postCustom['_tb_pretty_photo'][0];
					if ($prettyPhoto == 'yes' || $pageCustom['_tb_preview'][0] == 'nothing') {
						$rel = 'rel="prettyPhoto[gallery]"';
						
						$video = 0;
						if (isset($postCustom['_tb_video'][0])) $video = $postCustom['_tb_video'][0];
						
						if ($video) {
							$postPermalink = $video;
						} else {
							$postThumbnailID = get_post_thumbnail_id( $postID );
							$postThumbnailURL = wp_get_attachment_image_src( $postThumbnailID , 'full' );
							$postURL = $postPermalink;
							$postPermalink = $postThumbnailURL[0];
						}
					}
				?>
				<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" <?php echo $rel; ?> class="thumb" style="display: block;"><?php echo get_the_post_thumbnail($postID, $thumbnailSize, array('class' => 'imageBorder single-article')); ?></a>
			
			<?php if ($pageCustom['_tb_preview'][0] != 'nothing') { ?>
			<div class="entry-content">
				<div class="entry-meta">
					<h2 class="entry-title">
						<a href="<?php echo $postURL; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
					</h2>
				</div><!-- .entry-meta -->

				<?php if ($postCustom['_tb_description'][0] && $pageCustom['_tb_preview'][0] == 'description') echo $postCustom['_tb_description'][0]; ?>
			</div><!-- .entry-content -->
			<?php } ?>
	
			<?php } ?>
					
		</div><!-- #post-## -->

<?php $qIndex++; ?>
<?php endwhile; // End the loop. ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#tb_gallery').imagesLoaded( function() {
		jQuery('#tb_gallery').isotope({
			itemSelector : '.type-<?php echo strtolower(TB_GALLERY_CPT); ?>',
			layoutMode : 'fitRows'
		});
	});
	
	jQuery('#tb_filters a').click(function(){
		jQuery("#tb_filters").find('.selected').removeClass('selected');
		
		jQuery(this).addClass('selected');
	
		var selector = jQuery(this).attr('data-filter');
		jQuery('#tb_gallery').isotope({
			itemSelector : '.type-<?php echo strtolower(TB_GALLERY_CPT); ?>',
			filter: selector,
			layoutMode : 'fitRows'
  		});
	});
  	
	return false;

});
</script>
  
</div>

<?php }

// get total number of pages
$total = $theQuery->max_num_pages;

if ($total > 1 && $postsPerPage > -1)
{
	?>
	<div class="contentSpacer"></div>
	
	<div class="pn_pagination clearfix  <?php echo $tbGalleryMargin; ?>">
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


		$customPagination = paginate_links(array(
			'base' => get_pagenum_link(1) . '%_%',
			'format' => $format,
			'current' => $current_page,
			'total' => $total,
			'mid_size' => 10,
			'type' => 'list'
		));
		
		echo $customPagination;
		
		?>
	</div>
	
	<div class="contentSpacer"></div>
<?php } 

st_after_content();
get_footer();

?>