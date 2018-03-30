<?php get_header(); ?>
</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php
$ka_blogtitle             = get_option('ka_blogtitle');
$ka_searchbar             = get_option('ka_searchbar');
$ka_crumbs                = get_option('ka_crumbs');
$ka_blogbutton            = get_option('ka_blogbutton');
$ka_blogbutton_color      = get_option('ka_blogbutton_color');
$ka_blogbutton_size       = get_option('ka_blogbutton_size');
$content_default          = get_option('ka_tt_content_default');
$ka_page_title_bar_select = get_option('ka_page_title_bar_select');//@since 4.6
$show_page_title_bar      = get_option('ka_tools_panel');//@since 4.6
$header_shadow_style      = get_option('ka_header_shadow_style');//@since 4.8

//pre-define values for backward compatibility
if ('' == $ka_blogbutton_color): 'black'     == $ka_blogbutton_color; endif;
if ('' == $ka_blogbutton_size):  'small'     == $ka_blogbutton_size;  endif;
if ('' == $content_default):     'false'     == $content_default;     endif;
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;

//format "continue reading" button
$formatted_size    =  strtolower($ka_blogbutton_size);
$formatted_button  =  $formatted_size.'_button '.$formatted_size.'_'.$ka_blogbutton_color;
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

<div class="tt-masonry-wrap" id="tt-blog-container">

		<?php /* Start the Loop */
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			// The following determines what the post format is and shows the correct file accordingly
            $format = get_post_format();
            get_template_part( 'post-formats/'.$format );
                
            if($format == '')
            get_template_part( 'post-formats/standard' );

		endwhile; endif; ?>

</div><!-- .container-fluid.masonry-section-wrap -->

<section id="tt-karma-masonry-pagination">
	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else {
	//do not remove this function...needed for theme_check 
	paginate_links(); } ?>
</section>

<?php get_footer(); ?>