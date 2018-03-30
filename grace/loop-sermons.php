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
			$featuredArea = isset($postCustom['_tb_featured_area'][0]) ? $postCustom['_tb_featured_area'][0] : FALSE;
			$thumbnailSize = 'article_thumbnail';
			if ($featuredArea != 'i2') $thumbnailSize = 'article_thumbnail_high';
			?>

			<?php if (has_post_thumbnail())	{ ?>
				<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" class="thumb" style="display: block;"><?php echo get_the_post_thumbnail($postID, $thumbnailSize, array('class' => 'imageBorder single-article')); ?></a>
			<?php } ?>
					
			<div class="entry-meta">
				
				<?php
				$sermontDate = isset($postCustom['_tb_date'][0]) ? $postCustom['_tb_date'][0] : FALSE;
				$sermonTime = isset($postCustom['_tb_time'][0]) ? $postCustom['_tb_time'][0] : FALSE;				
				?>
				
				<div class="tb_date_box"><span class="day"><?php echo date_i18n('d', $sermontDate); ?></span><span class="month"><?php echo date_i18n('M', $sermontDate); ?></span></div>
			
				<h2 class="entry-title">
					<a href="<?php echo $postPermalink; ?>" title="<?php printf( esc_attr__( '%s', 'grace' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h2>
				
				<?php
				$infoLine = array();
				
				$church = isset($postCustom['_tb_church'][0]) ? $postCustom['_tb_church'][0] : FALSE;
				if ($church) $infoLine[] = "<a href='" . get_permalink($church) . "'>" . get_the_title($church) . "</a>";
				
				if ($sermontDate) $infoLine[] = date_i18n(get_option('date_format'), $sermontDate);
				if ($sermonTime) $infoLine[] = $sermonTime;
				
				if (count($infoLine)) {
					echo '<div class="info13">' . implode(' ', $infoLine) . '</div>';
				}
				?>
				
				
			</div><!-- .entry-meta -->

			<div class="entry-summary">	
				
				<?php
					$video = isset($postCustom['_tb_video'][0]) ? $postCustom['_tb_video'][0] : FALSE;
					$mp3 = isset($postCustom['_tb_mp3'][0]) ? $postCustom['_tb_mp3'][0] : FALSE;
					$pdf = isset($postCustom['_tb_pdf'][0]) ? $postCustom['_tb_pdf'][0] : FALSE;
					
					$sermonData = array();
					
					if ($video) {
						$sermonData[] = "<a href='$video' class='icon video iframe' rel='prettyPhoto'>" . __('Play Video', 'grace') . '</a>';
					}
					
					if ($mp3) {
						$themeOptions = of_get_all_options();
						$listenAudio = isset($themeOptions['_tb_listen_audio']) ? $themeOptions['_tb_listen_audio'] : FALSE;
						if ($listenAudio) {
							$listenAudioURL = get_permalink($listenAudio);
							$mp3iframe = $listenAudioURL . '?pid=' . $postID . '&iframe=true&width=350&height=70';
							$sermonData[] = "<a href='$mp3iframe' class='icon listen iframe map_excluded' rel='prettyPhoto'>" . __('Play Audio', 'grace') . '</a>';	
						}
						
						$sermonData[] = "<a href='$mp3' class='icon download map_excluded'>" . __('Download Audio', 'grace') . '</a>';
					}
					
					if ($pdf) {
						$sermonData[] = "<a href='$pdf' class='icon pdf'>" . __('Download PDF', 'grace') . '</a>';
					}
					
					if (count($sermonData)) {
						$sermonEcho = '<div class="widget_sermon_menu">';
						$sermonEcho .= '<ul>';

						foreach ($sermonData as $sermonLine) {
							$sermonEcho .= "<li class='fulldp'>$sermonLine</li>";
						}
					
						$sermonEcho .= '</ul>';
						$sermonEcho .= '</div><div class="clearfix"></div>';
						
						echo $sermonEcho;
					}
				?>			
				
				<?php
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