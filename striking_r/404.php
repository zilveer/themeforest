<?php
/**
 * The template for displaying 404 pages (Not Found).
 */
$layout=theme_get_option('advanced','404_layout');
if($layout == 'default'){
	$layout = theme_get_option('blog','layout');
}
$content_width = ($layout === 'full')? 960: 630;

get_header(); ?>
<?php echo theme_generator('introduce');?>
<div id="page">
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?>">
		<div id="main">
			<div class="content">

<?php
$content = theme_get_option('advanced', '404_content');
if(!empty($content)){
	echo apply_filters('the_content', stripslashes( $content ));
}
$items = theme_get_option('advanced','404_items');
if(!empty($items)){
	$outputs = array();
	foreach($items as $item){
		switch($item){
			case 'pages':
				if (theme_get_option('general','enable_nav_menu') && has_nav_menu( 'primary-menu' ) ) {
					$content =  wp_nav_menu( array( 
						'theme_location' => 'primary-menu',
						'container_class' => '',
						'container' => '',
			 	 	 	'sort_column' => 'menu_order',
			 	 	 	'echo' => 0
					));
				}else{
					$excluded_pages_with_childs = theme_get_excluded_pages();
					
					$content = '<ul>';
					$content .= wp_list_pages("sort_column=menu_order&exclude=$excluded_pages_with_childs&title_li=&echo=0");
					$content .= '</ul>';
					
				}
				if(!empty($content)){
					$outputs[] = '<h2>'.__('Pages', 'striking-r').'</h2>'.$content;
				}
				break;
			case 'categories':
				$exclude_cats = theme_get_option('blog','exclude_categorys');
				$content = '<h2>'.__('Category Archives', 'striking-r').'</h2>';
				$content .= '<ul>';
				$content .= wp_list_categories(array( 
					'exclude'=> implode(",",$exclude_cats), 
					'feed' => __( 'RSS', 'striking-r' ), 
					'show_count' => true, 
					'use_desc_for_title' => false, 
					'title_li' => false,
					'echo' => 0
				));
				$content .= '</ul>';
				$outputs[] = $content;
				break;
			case 'tags':
				$content = '<h2>'.__('Tags Archives', 'striking-r').'</h2>';
				$content .= wp_tag_cloud(array(
					'echo' => 0
				));
				$outputs[] = $content;
				break;
			case 'posts':
				$exclude_cats = theme_get_option('blog','exclude_categorys');
				$archive_query = new WP_Query( array('showposts' => 1000,'category__not_in' => $exclude_cats ));
				$content = '<h2>'.__('Blog Posts', 'striking-r').'</h2>';
				$content .= '<ul>';
				while ($archive_query->have_posts()) {
					$archive_query->the_post();
					$content .= '<li><a href="'.get_permalink().'" rel="bookmark" title="'.sprintf( __("Permanent Link to %s", 'striking-r'), get_the_title() ).'">'.get_the_title().'</a> ('.get_comments_number().')</li>';
				}
				$content .= '</ul>';
				$outputs[] = $content;
				break;
			
		}
	}
	$output = implode('<div class="divider top"><a href="#">'.__('Top','striking-r').'</a></div>',$outputs);
	echo $output;
}
?>
				<div class="divider top"><a href="#"><?php _e('Top','striking-r');?></a></div>
			</div>
		</div>
		<?php if($layout != 'full') {
			$sidebar=theme_get_option('advanced','404_sidebar');
			if($sidebar){
				get_sidebar(); 
			} else {
?>
				<aside id="sidebar">
					<div id="sidebar_content"><?php get_search_form(); ?></div>
				</aside>
<?php
			}
		} ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
