<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 */
?>

<?php
/* @start LOOP */

global $wp_query;

$term = $wp_query->query_vars;

$args = array();
$args['post_type'] = TB_EVENT_CPT;

$args['tax_query'] = array(
	array(
		'taxonomy' => TB_EVENT_TAX,
		'field' => 'slug',
		'terms' => $term["term"]
	)
);

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

// use WP timezone	
$timezone = get_option('timezone_string');
if (isset($timezone) && $timezone) date_default_timezone_set($timezone);
	
$today = strtotime("today");

$args['orderby'] = 'meta_value';
$args['meta_key'] = '_tb_start_date';

$theQuery = new WP_Query( $args );

if ( $theQuery->have_posts() ) while ( $theQuery->have_posts() ) : $theQuery->the_post(); ?>

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
				
				$venue = $postCustom['_tb_venue'][0];
				$address = $postCustom['_tb_address'][0];
				$location = $postCustom['_tb_location'][0];
				
				$addressArray = array();
				
				if ($venue) $addressArray[] = $venue;
				if ($address) $addressArray[] = $address;
				if ($location) $addressArray[] = $location;
				
				$startDate = $postCustom['_tb_start_date'][0];
				$startTime = $postCustom['_tb_start_time'][0];
				
				if (count($addressArray)) $infoLine[] = "<li><span aria-hidden='true' class='icon-home'></span> " . implode(', ', $addressArray) . "</li>";
				if ($startDate) $infoLine[] = "<li><span aria-hidden='true' class='icon-calendar'></span> " . date_i18n(get_option('date_format'), $startDate) . "</li>";
				if ($startTime) $infoLine[] = "<li><span aria-hidden='true' class='icon-time'></span> $startTime</li>";
				
				if (get_the_terms($postID, TB_EVENT_TAX)) {
					$infoLine[] = "<li><span aria-hidden='true' class='icon-tags'></span> " . get_the_term_list($postID, TB_EVENT_TAX, '', ', ', '') . "</li>";
				}
				
				if (count($infoLine)) {
					echo '<div class="address_info clearfix wide"><ul>' . implode($infoLine) . "</ul></div>";
				}
				
				
				the_excerpt();
				?>
			</div><!-- .entry-summary -->
					
			<div class="contentSpacer"></div>
	
		</div><!-- #post-## -->

<?php endwhile; /* @end LOOP */ ?>

<?php
// get total number of pages
$total = $theQuery->max_num_pages;

if ($total > 1)
{
	?>
					
	<div class="contentSpacer"></div>
	
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
<?php } 
/* @end LOOP */ ?>