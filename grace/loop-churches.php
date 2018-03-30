<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>


<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php echo __( 'Not Found', 'grace' ); ?></h1>
		<div class="entry-content">
			<p><?php echo __( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'grace' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

		<div id="post-<?php $postID = get_the_ID(); echo $postID; ?>" <?php post_class(); ?>>
		
			<?php $postPermalink = get_permalink(); ?>
			<?php $postCustom = get_post_custom($postID); ?>
			
			<?php
			$featuredArea = $postCustom['_tb_featured_area'][0];
			$thumbnailSize = 'article_thumbnail';
			if ($featuredArea != 'i2') $thumbnailSize = 'article_thumbnail_high';
			?>

			<?php if (has_post_thumbnail())	{ ?>
				<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="thumb" style="display: block;"><?php echo get_the_post_thumbnail($postID, $thumbnailSize, array('class' => 'imageBorder single-article')); ?></a>
			<?php } ?>
					
			<div class="entry-meta">
				<h2 class="entry-title">
					<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
			</div><!-- .entry-meta -->

			<div class="entry-summary">
				<?php
				$infoLine = array();
				
				$address = $postCustom['_tb_address'][0];
				$phone = $postCustom['_tb_phone'][0];
				$mobile = $postCustom['_tb_mobile'][0];
				
				if ($address) $infoLine[] = "<li><span aria-hidden='true' class='icon-home'></span> $address</li>";
				if ($phone) $infoLine[] = "<li><span aria-hidden='true' class='icon-phone'></span> $phone</li>";
				if ($mobile) $infoLine[] = "<li><span aria-hidden='true' class='icon-mobile-phone'></span> $mobile</li>";
				
				echo '<div class="address_info clearfix"><ul>' . implode($infoLine) . "</ul></div>";
				
				the_excerpt();
				?>
			</div><!-- .entry-summary -->
	
		</div><!-- #post-## -->
					
		<div class="contentSpacer"></div>

<?php endwhile; // End the loop. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
	<?php
	// get total number of pages
	global $wp_query;
	$total = $wp_query->max_num_pages;
// only bother with the rest if we have more than 1 page!
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
	<?php } ?>