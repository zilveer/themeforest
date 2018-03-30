<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Default Main Page Template
 * Created by CMSMasters
 * 
 */


get_header();

?>
<!--_________________________ Start Content _________________________ -->
<section id="content" role="main">
	<div class="entry-summary">
		<section class="blog">
	<?php 
		if (have_posts()) :
			while (have_posts()) : the_post();
				if (get_post_format() != '') {
					get_template_part('framework/postType/blog/page/sidebar/' . get_post_format());
				} else {
					get_template_part('framework/postType/blog/page/sidebar/standard');
				}
			endwhile;
			
			pagination();
		endif;
	?>
		</section>
	</div>
</section>
<!-- _________________________ Finish Content _________________________ -->


<!-- _________________________ Start Sidebar _________________________ -->
<section id="sidebar" role="complementary">
<?php get_sidebar(); ?>
</section>
<!-- _________________________ Finish Sidebar _________________________ -->

<?php 
get_footer();

