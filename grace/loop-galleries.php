<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
 
unset($qIndex);
$qIndex = 1;

$tbGalleryMargin = 'tb-gallery-margin';

?> 

<?php if ( !have_posts() ) :  ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php echo __( 'Not Found', 'grace' ); ?></h1>
		<div class="entry-content">
			<p><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'grace' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php else : ?>

<div id="tb_gallery">

<?php while ( have_posts() ) : the_post(); ?>

		<?php
		unset($postClasses);
		
		$postClasses = array();
		$post_id = get_the_ID();
		
		// terms list
		$gcats = get_the_terms($post_id, TB_GALLERY_TAX);
		if (!empty($gcats))
		{
			unset($gcatArray);
			
			$gcatArray = array();
			foreach ($gcats as $gcat) $gcatArray[] = $gcat->slug;

			$postClasses[] = implode($gcatArray, " ");
		}
		
		// size
		$postClasses[] = 'one_third';
		
		// first/last
		if ($qIndex % 3 == 1) $postClasses[] = 'clearfix';
		
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
					$prettyPhoto = isset($postCustom['_tb_pretty_photo'][0]) ? $postCustom['_tb_pretty_photo'][0] : 'yes';
					if ($prettyPhoto == 'yes') {
						$rel = 'rel="prettyPhoto[gallery]"';
						
						$video = (isset($postCustom['_tb_video'][0])) ? $postCustom['_tb_video'][0] : FALSE;
						
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

			<div class="entry-content">
				<div class="entry-meta">
					<h2 class="entry-title">						
						<a href="<?php echo $postURL; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
					</h2>
				</div><!-- .entry-meta -->

				<?php if (isset($postCustom['_tb_description'][0])) echo $postCustom['_tb_description'][0]; ?>
			</div><!-- .entry-content -->
	
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
	
	return false;

});
</script>

</div>

<?php endif; ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php
	
	// get total number of pages
	global $wp_query;
	$total = $wp_query->max_num_pages;

	if ($total > 1)
	{
		?>
		<div class="contentSpacer"></div>
		
		<div class="pn_pagination clearfix tb-gallery-margin">
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
	<?php } ?>
	
	<?php wp_reset_postdata(); ?>