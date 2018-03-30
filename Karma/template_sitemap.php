<?php
/*
Template Name: Sitemap
*/
?>
<?php
get_header();

//grab custom page settings
$karma_slider_type              = get_post_meta($post->ID, 'karma_slider_type', true);
$cu3er_page_slider              = get_post_meta($post->ID, 'slider_3d_cu3er_id', true);
$slider_custom_shortcode        = get_post_meta($post->ID, 'slider_custom_shortcode', true);
$custom_menu_slug               = get_post_meta($post->ID, 'truethemes_custom_sub_menu',true);
$slider_disable_toolbar         = get_post_meta($post->ID, 'slider_disable_toolbar',true);
$tt_karma_slider_category       = get_post_meta($post->ID, 'tt_karma_slider_category',true);
$slider_full_width              = get_post_meta($post->ID, 'truethemes_slider_full_width',true);
$ka_page_title_bar_select       = get_option('ka_page_title_bar_select');//@since 4.6
$ka_page_title_bar_select       = apply_filters('pagetitle_style',$ka_page_title_bar_select); //karma filter
$show_page_title_bar            = get_option('ka_tools_panel');//@since 4.6

//define new options for backward compatible
if ('' == $slider_custom_shortcode):  'null'    == $slider_custom_shortcode; endif;
if ('' == $slider_disable_toolbar):   'false'   == $slider_disable_toolbar; endif;

//define custom slider class for div#main
if ('' != $karma_slider_type) $karma_slider_class       = $karma_slider_type;
if ('' != $cu3er_page_slider) $karma_slider_class       = 'karma-3d-slider';
if ('' != $slider_custom_shortcode) $karma_slider_class = 'karma-custom-shortcode-slider';

//jquery2 slider
if ('karma-custom-jquery-2' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-2','childtheme'); endif;

//3D slider
if (is_numeric($cu3er_page_slider)): ?>
		<div class="cu3er-slider-wrap">
			<?php
            $slider_output = '[CU3ER slider=\''.$cu3er_page_slider.'\']';
            echo '<div id="CU3ER'.$cu3er_page_slider.'" class="embedCU3ER">'.do_shortcode($slider_output).'</div><!-- END CU3ER -->';
            ?>
        </div><!-- END cu3er-slider-wrap -->
<?php endif;?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main" class="tt-slider-<?php echo @$karma_slider_class;?>">
	<?php
	//jquery3 slider
	if ('karma-custom-jquery-3' == $karma_slider_type): echo '<div id="tt-slider-full-width">';
		get_template_part('theme-template-part-slider-jquery-3','childtheme');
	echo '</div>'; endif;
	
	//custom slider (shortcode) full-width version
        if (('true' == $slider_full_width) && ('null' != $slider_custom_shortcode)): echo '<div id="tt-slider-full-width">';
			echo do_shortcode(''.$slider_custom_shortcode.'');
		echo '</div>'; endif;
	?>

	<?php
// full-width page title bar
// @since 4.6
if( ('Full Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
get_template_part('theme-template-part-tools-fullwidth','childtheme');
endif;
?>

	<div class="main-area">
		<?php
		
        //jquery1 slider
        if ('karma-custom-jquery-1' == $karma_slider_type): get_template_part('theme-template-part-slider-jquery-1','childtheme'); endif;
        
        //custom slider (shortcode)
        if (('null' != $slider_custom_shortcode) && empty($slider_full_width)): echo do_shortcode(''.$slider_custom_shortcode.''); endif;
        
        //page-title-bar (breadcrumbs, etc)
		if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) && ('true' != $slider_disable_toolbar) && (!is_page_template('template-blank-canvas.php')) && (!is_page_template('template-page-builder.php')) ):
		get_template_part('theme-template-part-tools','childtheme');
		endif;
		
		?>
		
		<main role="main" id="content" class="content_full_width">
		<?php if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif; 
		comments_template('/page-comments.php', true);
		get_template_part('theme-template-part-inline-editing','childtheme'); ?>
		
		<?php function five_get_ancestors(){
		//get all ancestor pages, pages with no post parent from wordpress database
		
		global $wpdb;
		$result = $wpdb->get_results("SELECT ID, post_title, guid FROM $wpdb->posts WHERE post_type = 'page' AND post_parent = 0 AND post_status = 'publish'");
		return $result;
		}
		
		function five_print_ancestors_with_child(){
		//get ancestors
		$result = five_get_ancestors();
			if($result){
				//loop result from above database query and list child pages of ancestors
				foreach ($result as $res){
				//prepare ancestor id for wp_list_pages
				$ancestor_id = $res->ID;
				//get all child and grand child of ancestor page
				$children = wp_list_pages("title_li=&child_of=$ancestor_id&echo=0");
					//if there is children
					if($children){
					echo '<div class="sitemap_with_child">';
					$link = get_permalink($ancestor_id);
					//this is the ancestors
					//echo "<a href='$res->guid'>$res->post_title</a><ul>";
					echo "<a href='$link'>$res->post_title</a><ul>";
					//this is the children
					echo $children;
					echo '</ul></div>';
					}
				}
			}
		}
		
		function five_print_ancestors_without_child(){
		//get ancestors
		$result = five_get_ancestors();
			if($result){
				//prepare div to contain all pages without children
				echo '<div class="sitemap_without_child">';
				echo '<ul>';
				//loop result from above database query and list child pages of ancestors
				foreach ($result as $res){
				//prepare ancestor id for wp_list_pages
				$ancestor_id = $res->ID;
				//check if got any child and grand child of this ancestor page
				$children = wp_list_pages("title_li=&child_of=$ancestor_id&echo=0");
					//if there is no children
					if(!$children){
						//this is the ancestors only
					$link = get_permalink($ancestor_id);	
					//echo "<li><a href='$res->guid'>$res->post_title</a></li>";
					echo "<li><a href='$link'>$res->post_title</a></li>";			
					}
				}
				echo '</ul>';
				echo '</div>';
			}
		}
		//print out results, all no child first in one div, 
		//than follow by those with children in their own div container.
		five_print_ancestors_without_child();
		five_print_ancestors_with_child();
		?>
		</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>