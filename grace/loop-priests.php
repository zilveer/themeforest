<?php
/*
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php
				$postID = get_the_ID();
				$postCustom = get_post_custom();
				
				?>


				<div id="post-<?php echo $postID; ?>" <?php post_class('single'); ?>>
					

					<div class="entry-content">
						
						<?php
						$title = get_the_title();
						$href = get_permalink();
						
						$email = isset($postCustom['_tb_email'][0]) ? $postCustom['_tb_email'][0] : FALSE;
						$twitter = isset($postCustom['_tb_twitter'][0]) ? $postCustom['_tb_twitter'][0] : FALSE;
						$facebook = isset($postCustom['_tb_facebook'][0]) ? $postCustom['_tb_facebook'][0] : FALSE;		
						$hasPostThumbnail = has_post_thumbnail();
										
						?>

						<?php if ($hasPostThumbnail) { ?>
							<a href="<?php echo $href; ?>" title="<?php echo $title; ?>" class="thumb">
								<?php echo get_the_post_thumbnail($postID, 'bio_thumbnail', array('class' => 'imageBorder alignleft bio_thumbnail_small')); ?>
							</a>
						<?php } ?>
						
						<h2 class="entry-title"><a href="<?php echo $href; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a></h2>
						
						<?php
						$priestTitle = isset($postCustom['_tb_title'][0]) ? $postCustom['_tb_title'][0] : FALSE;
						$priestChurch = isset($postCustom['_tb_church'][0]) ? $postCustom['_tb_church'][0] : FALSE;
						
						if ($priestTitle || $priestChurch) {
							echo '<p>';
							if ($priestTitle) echo $priestTitle;
							if ($priestTitle && $priestChurch) echo ' at ';
							if ($priestChurch) echo '<a href="' . get_permalink($priestChurch) . '">' . get_the_title($priestChurch) . '</a>';
							echo '</p>';
						}
						
						?>


					</div><!-- .entry-content -->
					
					<div class="contentSpacer"></div>
				</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>

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