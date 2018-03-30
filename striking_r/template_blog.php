<?php 
/**
 * A Page Template for displaying posts index page
 */

$layout=theme_get_option('blog','layout');
$post_id = theme_get_queried_object_id();
$content_width = ($layout === 'full')? 960: 630;
get_header(); 
echo theme_generator('introduce',$post_id);?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<?php echo theme_generator('breadcrumbs',$post_id);?>
		<div id="main">
			<div class="content">
				<?php 
					$exclude_cats = theme_get_option('blog','exclude_categorys');
					$exclude_cats_for_blog_page = theme_get_option('blog','exclude_categorys_for_blog_page');
					$exclude_cats = array_merge($exclude_cats, $exclude_cats_for_blog_page);
					foreach ($exclude_cats as $key => $value) {
						$exclude_cats[$key] = -$value;
					}
					global $wp_version;
					if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
						$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
					}else{
						$paged = intval(get_query_var('paged'));
					}
					$query_string = "cat=".implode(",",$exclude_cats)."&paged=$paged";
					query_posts($query_string);
				
					get_template_part( 'loop','blog');
				?>
				<div class="clearboth"></div>
			</div>
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
