<?php
/**
 * Template Name: Sitemap
 * Description: A Page Template for displaying sitemaps
 */
$post_id = theme_get_queried_object_id();
$layout = theme_get_inherit_option($post_id, '_layout', 'general','layout');
$content_width = ($layout === 'full')? 960: 630;
get_header(); 
echo theme_generator('introduce',$post_id );?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<?php echo theme_generator('breadcrumbs',$post_id );?>
		<div id="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="content">
				<?php the_content(); ?>

				<h2><?php _e('Pages','striking-r');?></h2>
				<?php if (theme_get_option('general','enable_nav_menu') && has_nav_menu( 'primary-menu' ) ) {
			wp_nav_menu( array( 
				'theme_location' => 'primary-menu',
				'container_class' => '',
				'container' => '',
	 	 	 	'sort_column' => 'menu_order'
			));
		}else{
			$excluded_pages_with_childs = theme_get_excluded_pages();
			
			$output = '<ul>';
			$output .= wp_list_pages("sort_column=menu_order&exclude=$excluded_pages_with_childs&title_li=&echo=0");
			$output .= '</ul>';
			
			echo $output;
		}
?>
				<div class="divider top"><a href="#"><?php _e('Top','striking-r');?></a></div>

<?php 
	$exclude_cats = theme_get_option('blog','exclude_categorys');
?>
				<h2><?php _e( 'Category Archives','striking-r'); ?></h2>
				<ul>
					<?php wp_list_categories( array( 'exclude'=> implode(",",$exclude_cats), 'feed' => __( 'RSS', 'striking-r' ), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) ); ?>
				</ul>
				<div class="divider top"><a href="#"><?php _e('Top','striking-r');?></a></div> 
<?php 
	$archive_query = new WP_Query( array('showposts' => 1000,'category__not_in' => $exclude_cats ));
?>
				<h2><?php _e( 'Blog Posts','striking-r'); ?></h2>
				<ul>
<?php while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", 'striking-r'), get_the_title() ); ?>"><?php the_title(); ?></a> (<?php comments_number('0', '1', '%'); ?>)</li>
<?php endwhile; ?>
				</ul>
				<div class="divider top"><a href="#"><?php _e('Top','striking-r');?></a></div> 

<?php 
	$portfolio_query = new WP_Query( array('post_type' => 'portfolio','showposts' => 1000 ));
	if($portfolio_query->have_posts()):
?>
				<h2><?php _e( 'Portfolios','striking-r'); ?></h2>
				<ul>
<?php while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>
					<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", 'striking-r'), get_the_title() ); ?>"><?php the_title(); ?></a><?php if(theme_get_option('portfolio','enable_comment')):?> (<?php comments_number('0', '1', '%'); ?>)<?php endif;?></li>
<?php endwhile; ?>
				</ul>

				<div class="divider top"><a href="#"><?php _e('Top','striking-r');?></a></div> 
<?php endif;?>
				<?php wp_reset_postdata();edit_post_link(__('Edit', 'striking-r'),'<footer><p class="entry_edit">','</p></footer>'); ?>
				<div class="clearboth"></div>
			</div>
<?php endwhile; ?>
			<div class="clearboth"></div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
