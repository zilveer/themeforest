<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.1.3
 * 
 * Search Page Template
 * Created by CMSMasters
 * 
 */


get_header();


list($cmsms_layout) = cmsms_theme_page_layout_scheme();


echo '<!--_________________________ Start Content _________________________ -->' . "\n";

if ($cmsms_layout == 'r_sidebar') {
	echo '<div class="content entry" role="main">' . "\n\t";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo '<div class="content entry fr" role="main">' . "\n\t";
} else {
	echo '<div class="middle_content entry" role="main">' . "\n\t";
}

echo '<div class="cmsms_search">' . "\n";


if (!have_posts()) : 
	echo '<h2>' . esc_html__('No posts found', 'cmsmasters') . '</h2>';
else : 
	$cmsms_posts_count = 1;
	$cmsms_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	if ($cmsms_page > 1) {
		$cmsms_posts_count = ((int) ($cmsms_page - 1) * (int) get_query_var('posts_per_page')) + 1;
	}

	while (have_posts()) : the_post();
?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class('cmsms_search_post'); ?>>
			<div class="cmsms_search_post_number"><?php echo $cmsms_posts_count ?></div>
			<div class="cmsms_search_post_cont">
				<header class="cmsms_search_post_header entry-header">
					<h1 class="cmsms_search_post_title entry-title">
						<a href="<?php the_permalink(); ?>">
							<?php cmsms_title(get_the_ID(), true); ?>
						</a>
					</h1>
				</header>
				<?php 
				if (
					get_post_type() != 'page' && 
					get_post_type() != 'profile'
				) {
					echo '<div class="cmsms_search_post_cont_info entry-meta">' . 
						'<span class="cmsms_search_post_user_name">' . 
							__('By', 'cmsmasters') . ' ' . 
							'<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" rel="author" title="' . __('Posts by', 'cmsmasters') . ' ' . get_the_author_meta('display_name') . '">' . get_the_author_meta('display_name') . '</a>' . 
						'</span>';
					
					
					if (
						(
							get_post_type() == 'post' && 
							get_the_category()
						) || (
							get_post_type() == 'project' && 
							get_the_terms(get_the_ID(), 'pj-categs')
						)
					) {
						echo '<span class="cmsms_search_post_category">' . 
							__('In ', 'cmsmasters') . 
							(get_post_type() == 'post' ? get_the_category_list(', ') : '') . 
							(get_post_type() == 'project' ? get_the_term_list(get_the_ID(), 'pj-categs', '', ', ', '') : '') . 
						'</span>';
					}
					
					
					if (
						(
							get_post_type() == 'post' && 
							get_the_tags()
						) || (
							get_post_type() == 'project' && 
							get_the_terms(get_the_ID(), 'pj-tags')
						)
					) {
						echo '<span class="cmsms_search_post_tags">' . 
							__('Tags ', 'cmsmasters') . 
							(get_post_type() == 'post' ? get_the_tag_list('', ', ', '') : '') . 
							(get_post_type() == 'project' ? get_the_term_list(get_the_ID(), 'pj-tags', '', ', ', '') : '') . 
						'</span>';
					}
					
					echo '</div>';
				}
				
				
				echo cmsms_divpdel('<div class="cmsms_search_post_content entry-content">' . "\n" . 
					wpautop(theme_excerpt(55, false)) . 
				'</div>' . "\n");
				?>
				<footer class="cmsms_search_post_footer entry-meta">
					<div class="cmsms_search_post_meta_info">
					<?php 
					echo '<abbr class="published cmsms_search_post_date cmsms-icon-calendar-8" title="' . get_the_date() . '">' . 
						get_the_date() . 
					'</abbr>';
					
					
					if (comments_open()) {
						echo '<a class="cmsms_search_post_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>';
					}
					?>
					</div>
					<?php 
					echo '<a class="button cmsms_search_post_read_more" href="' . get_permalink() . '">' . __('Read More', 'cmsmasters') . '</a>'
					?>
				</footer>
			</div>
		</article>
	
<?php 
		$cmsms_posts_count += 1;
		
	endwhile;
	
	
	echo pagination();
endif;
			
echo '</div>' . "\n" . 
'</div>' . "\n" . 
'<!-- _________________________ Finish Content _________________________ -->' . "\n\n";


if ($cmsms_layout == 'r_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
} elseif ($cmsms_layout == 'l_sidebar') {
	echo "\n" . '<!-- _________________________ Start Sidebar _________________________ -->' . "\n" . 
	'<div class="sidebar fl" role="complementary">' . "\n";
	
	get_sidebar();
	
	echo "\n" . '</div>' . "\n" . 
	'<!-- _________________________ Finish Sidebar _________________________ -->' . "\n";
}


get_footer();

