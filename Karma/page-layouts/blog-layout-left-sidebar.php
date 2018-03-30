<?php get_header(); ?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php
$ka_blogtitle              = get_option('ka_blogtitle');
$ka_searchbar              = get_option('ka_searchbar');
$ka_crumbs                 = get_option('ka_crumbs');
$ka_page_title_bar_select  = get_option('ka_page_title_bar_select');//@since 4.6
$show_page_title_bar       = get_option('ka_tools_panel');//@since 4.6
$header_shadow_style       = get_option('ka_header_shadow_style');//@since 4.8

//define new options for backward compatible
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;

truethemes_before_main_hook();//action hook
?>

<div id="main">
	<?php
	//header shadow style
	if (('no-shadow' != $header_shadow_style) && ('Full Width' != $ka_page_title_bar_select)) : ?>
	<div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
	<?php endif; //END header shadow style

//check for full-width page title bar
if(('Full Width' === $ka_page_title_bar_select) && ('true' === $show_page_title_bar)): ?>

<div class="tools full-width-page-title-bar">
	<?php
	//header shadow style
	if ('no-shadow' != $header_shadow_style): ?>
	<div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
	<?php endif; //END header shadow style ?>

	<div class="tt-container">
		<?php
		//print page title
		echo '<h1>'.$ka_blogtitle.'</h1>';
		
		//display search box
		if ($ka_searchbar == "true"){get_template_part('searchform','childtheme');}
		
		//display breadcrumbs
		if ($ka_crumbs == "true") { $bc = new simple_breadcrumb; }
		
		// action hook
		truethemes_after_searchform_hook();
		?>
	</div><!-- END tt-container -->
</div><!-- END full-width-page-title-bar -->
<?php endif; //END check for full-width page title bar ?>

	<div class="main-area">
		<?php //check for fixed-width page title bar
		if(('Fixed Width' === $ka_page_title_bar_select) && ('true' === $show_page_title_bar)): ?>

		<div class="tools">
			<span class="tools-top"></span>
		        <div class="frame">
		        <?php truethemes_before_article_title_hook();// action hook
				
				//print page title
				echo '<h1>'.$ka_blogtitle.'</h1>';
				
				//display search box
				if ($ka_searchbar == "true"){get_template_part('searchform','childtheme');}
				
				//display breadcrumbs
				if ($ka_crumbs == "true") { $bc = new simple_breadcrumb; }
				
				// action hook
				truethemes_after_searchform_hook(); ?>
		        
		        </div><!-- END frame -->
			<span class="tools-bottom"></span>
		</div><!-- END tools -->
		<?php endif; //END check for fixed-width page title bar ?>

<main role="main" id="content" class="content_blog content_blog_left">  
    <?php
    //@since 3.0.3, modified by denzel, we do this only if WPML is installed, 
	//or exclude category will not work for other languages on posts page.
	//This is a WPML issue, not sure why it does not obey pre_get_posts hook.
if(defined('ICL_LANGUAGE_CODE')):
	//check and do this only on posts page, or we will mess up archives and categories.
	global $wp_query;
	if($wp_query->is_posts_page == true):
	    //This is the page number
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	    //get excluded category from site option.	
		$exclude = B_getExcludedCats();
		//this is 'Blog pages show at most option' in wp admin > settings > reading	
		$post_per_page = get_option('posts_per_page');
		//custom query string. 
		$query_string ="posts_per_page=$post_per_page&cat=$exclude&paged=$paged";
		query_posts($query_string);
	endif;
endif;


if (have_posts()) : while (have_posts()) : the_post();

    $format = get_post_format();
    
    //standard, image, video, and link post formats all use the same default-content.php file      
    if($format == '' || $format == 'image' || $format == 'video'){
    	get_template_part( 'post-formats/default-content' );
    }else{
        //for audio, gallery and quote post formats, use their own file.. eg.. default-audio.php
    	get_template_part( 'post-formats/default-'.$format );    
    }


endwhile; else: 
?>
<h2><?php _e('Nothing Found', 'truethemes_localize') ?></h2>
<p><?php _e('Sorry, it appears there is no content in this section.', 'truethemes_localize') ?></p>
<?php endif; ?>
<?php
if(function_exists('wp_pagenavi')) { 
wp_pagenavi(); 
} else {
//do not remove this function...needed for theme_check 
paginate_links(); 
} 
?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="left_sidebar left_sidebar_blog">
<?php dynamic_sidebar("Blog Sidebar"); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>