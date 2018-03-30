<?php get_header(); ?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php
$ka_blogauthor            = get_option('ka_blogauthor');
$ka_related_posts         = get_option('ka_related_posts');
$ka_related_posts_title   = get_option('ka_related_posts_title');
$ka_related_posts_count   = get_option('ka_related_posts_count');
$ka_posted_by             = get_option('ka_posted_by');
$ka_dragshare             = get_option('ka_dragshare');
$show_post_comments       = get_option('ka_post_comments');
$ka_blogtitle             = get_option('ka_blogtitle');
$ka_searchbar             = get_option('ka_searchbar');
$ka_crumbs                = get_option('ka_crumbs');
$ka_blogbutton            = get_option('ka_blogbutton');
$ka_blogbutton_color      = get_option('ka_blogbutton_color');
$ka_blogbutton_size       = get_option('ka_blogbutton_size');
$content_default          = get_option('ka_tt_content_default');
$ka_page_title_bar_select = get_option('ka_page_title_bar_select');//@since 4.6
$show_page_title_bar      = get_option('ka_tools_panel');//@since 4.6
$htag                     = get_option('ka_heading_type');
$header_shadow_style      = get_option('ka_header_shadow_style');//@since 4.8
$layout 				  = get_option('ka_blog_layout');
$layout 				  = apply_filters('blog_layout',$layout); //karma theme's filter

if(empty($htag)){
$htag = 'h2';
}

//pre-define values for backward compatibility
if ('' == $ka_blogbutton_color): 'black'     == $ka_blogbutton_color; endif;
if ('' == $ka_blogbutton_size):  'small'     == $ka_blogbutton_size; endif;
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;

//format "continue reading" button
$formatted_color   =  preg_replace('/\s*/', '', $ka_blogbutton_color);
$formatted_color   =  strtolower($formatted_color);
$formatted_size    =  strtolower($ka_blogbutton_size);
$formatted_button  =  $formatted_size.'_button '.$formatted_size.'_'.$formatted_color;
?>

<?php truethemes_before_main_hook();// action hook ?>

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
		<?php truethemes_before_article_title_hook();// action hook ?>
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
        <!-- <h1><?php _e('Archive for','truethemes_localize');?> '<?php single_cat_title(); ?>'</h1> -->
        <h1><?php single_cat_title(); ?></h1>
        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
        <h1><?php _e('Posts Tagged','truethemes_localize');?> '<?php single_tag_title(); ?>'</h1>
        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
        <h1><?php _e('Archive for','truethemes_localize');?> <?php the_time('F jS, Y'); ?></h1>
        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <h1><?php _e('Archive for','truethemes_localize');?> <?php the_time('F, Y'); ?></h1>
        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <h1><?php _e('Archive for','truethemes_localize');?> <?php the_time('Y'); ?></h1>
        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
        <h1><?php _e('Author Archive','truethemes_localize');?></h1>
        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h1><?php _e('Blog Archives','truethemes_localize');?></h1>
        <?php } //end page title

		//display search box
		if ($ka_searchbar == "true"){get_template_part('searchform','childtheme');}
		
		//display breadcrumbs
		if ($ka_crumbs == "true") { $bc = new simple_breadcrumb; }
		
		// action hook
		truethemes_after_searchform_hook(); ?>
	</div><!-- END tt-container -->
</div><!-- END full-width-page-title-bar -->
<?php endif; //END check for full-width page title bar ?>
	

	<div class="main-area">
		<?php //check for fixed-width page title bar
		if(('Fixed Width' === $ka_page_title_bar_select) && ('true' === $show_page_title_bar)): ?>

		<div class="tools">
			<span class="tools-top"></span>
        		<div class="frame">
        		<?php truethemes_before_article_title_hook();// action hook ?>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				<?php /* If this is a category archive */ if (is_category()) { ?>
	            <!-- <h1><?php _e('Archive for','truethemes_localize');?> '<?php single_cat_title(); ?>'</h1> -->
	            <h1><?php single_cat_title(); ?></h1>
	            <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	            <h1><?php _e('Posts Tagged','truethemes_localize');?> '<?php single_tag_title(); ?>'</h1>
	            <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	            <h1><?php _e('Archive for','truethemes_localize');?> <?php the_time('F jS, Y'); ?></h1>
	            <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	            <h1><?php _e('Archive for','truethemes_localize');?> <?php the_time('F, Y'); ?></h1>
	            <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	            <h1><?php _e('Archive for','truethemes_localize');?> <?php the_time('Y'); ?></h1>
	            <?php /* If this is an author archive */ } elseif (is_author()) { ?>
	            <h1><?php _e('Author Archive','truethemes_localize');?></h1>
	            <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	            <h1><?php _e('Blog Archives','truethemes_localize');?></h1>
	            <?php } //end page title
		
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


  <main role="main" id="content" class="content_blog <?php if($layout == 'left_sidebar'){echo"content_blog_left";}?>">
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

//retrieve all post meta of posts in the loop.
$linkpost           = get_post_meta($post->ID, "_jcycle_url_value", $single = true);
$external_image_url = get_post_meta($post->ID,'truethemes_external_image_url',true);
$video_url          = get_post_meta($post->ID,'truethemes_video_url',true);
$permalink          = get_permalink($post->ID);

//prepare to get image
$thumb              = get_post_thumbnail_id();
$image_width        = 538;
$image_height       = 218;

//use truethemes image croping script
$image_src = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);

//define post_class
//http://codex.wordpress.org/Template_Tags/post_class
//http://codex.wordpress.org/Function_Reference/get_post_class
$array_post_classes = get_post_class(); 
$post_classes = '';
foreach($array_post_classes as $post_class){
$post_classes .= " ".$post_class;
}
?>

<article class="blog_wrap <?php echo $post_classes;if ('' == ($video_url || $external_image_url || $thumb)):echo ' tt-blog-no-feature';endif;?>">
<div class="post_title">
<?php truethemes_begin_post_title_hook(); // action hook ?>

<?php if ('' == $linkpost): ?>
<<?php echo $htag; ?> class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $htag; ?>> <?php else: ?>

<<?php echo $htag; ?> class="entry-title"><a href="<?php echo $linkpost; ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></<?php echo $htag; ?>> <?php endif; ?>

<?php if ('true' != $ka_posted_by): ?>
<p class="posted-by-text"><span><?php _e('Posted by:', 'truethemes_localize') ?></span> <span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span></p> <?php endif; ?>

<?php truethemes_end_post_title_hook(); // action hook ?>
</div><!-- END post_title -->


<div class="post_content">
<?php truethemes_begin_post_content_hook(); // action hook ?>

<?php
//generate image using custom function
//find this function near line 122 of /framework/theme-functions.php
$html = truethemes_generate_blog_image($image_src,$image_width,$image_height,$blog_image_frame='',$linkpost,$permalink,$video_url);
echo $html;
?>

<?php 
//@since 4.0
//check for content() enabled in Site Options, if not load custom function
if ("true" == $content_default) {
	the_content('<span class="ka_button '.$formatted_button.'"><span>'.$ka_blogbutton.'</span></span>');
} else {
	limit_content(80,  true, '');
	echo '<a class="ka_button '.$formatted_button.'" href="'.get_permalink().'" rel="bookmark" title="';_e('Continue reading ', 'truethemes_localize'); echo get_the_title().'">
	<span>'.$ka_blogbutton.'</span></a>';
}
get_template_part('theme-template-part-inline-editing','childtheme');

//shareaholic plugin (display if installed)
if(function_exists('selfserv_shareaholic')) { selfserv_shareaholic(); } ?>

<div class="post_date">
    <span class="day date updated"><?php the_time('j'); ?></span>
    <br />
    <span class="month"><?php echo strtoupper(get_the_time('M')); ?></span>
    <br /> 
    <span class="year"><?php the_time('Y'); ?></span>
</div><!-- END post_date -->

<div class="post_comments">
	<a href="<?php echo the_permalink().'#post-comments'; ?>"><span><?php comments_number('0', '1', '%'); ?></span></a>
</div><!-- END post_comments -->

<?php global $post; 
$post_title = get_the_title($post->ID);
$permalink = get_permalink($post->ID);
if ($ka_dragshare == "true"){ echo "<a class='post_share sharelink_small' href='$permalink' data-gal='prettySociable'>Share</a>"; }
?>

<?php truethemes_end_post_content_hook();// action hook ?>
</div><!-- END post_content -->

<div class="post_footer">
    <?php truethemes_begin_post_footer_hook();// action hook ?>
        <p class="post_cats"><?php the_category(', '); ?></p>
        
        <?php if (get_the_tags()) : ?>
        <p class="post_tags"><?php the_tags('', ', '); ?></p>
    
    <?php endif; truethemes_end_post_footer_hook();// action hook?>
    </div><!-- END post_footer -->
</article><!-- END blog_wrap -->


<?php endwhile; else: ?>
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
<?php if($layout == 'right_sidebar'):?>
<aside role="complementary" id="sidebar" class="sidebar_blog">
<?php endif;
if($layout == 'left_sidebar'):?>
<aside role="complementary" id="sidebar" class="left_sidebar left_sidebar_blog">
<?php endif;?>
<?php dynamic_sidebar("Blog Sidebar"); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>