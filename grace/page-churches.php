<?php
/**
 * @package Grace - Religious WordPress Theme
 * @subpackage grace
 * @author Theme Blossom - www.themeblossom.net
 * 
 * Template Name: Churches
 * 
 */

get_header();
st_before_content($columns='');

/* @start LOOP */
$args = array();
$args['post_type'] = TB_CHURCH_CPT;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args['paged'] = $paged;

?>

<h1 class="entry-title"><?php the_title(); ?></h1>

<?php

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
				
				$address = $postCustom['_tb_address'][0];
				$phone = $postCustom['_tb_phone'][0];
				$mobile = $postCustom['_tb_mobile'][0];
				
				if ($address) $infoLine[] = "<li><span class='icon-home' arria-hidden='true'></span> $address</li>";
				if ($phone) $infoLine[] = "<li><span class='icon-phone' arria-hidden='true'></span> $phone</li>";
				if ($mobile) $infoLine[] = "<li><span class='icon-phone' arria-hidden='true'></span> $mobile</li>";
				
				echo '<div class="address_info clearfix"><ul>' . implode($infoLine) . "</ul></div>";
				
				the_excerpt();
				?>
			</div><!-- .entry-summary -->
	
		</div><!-- #post-## -->
					
		<div class="contentSpacer"></div>

<?php endwhile; /* @end LOOP */ ?>

<?php
// get total number of pages
$total = $theQuery->max_num_pages;

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
/* @end LOOP */

st_after_content();
get_sidebar();
get_footer();
?>