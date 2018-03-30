<?php
//define variables
$ka_searchbar              = get_option('ka_searchbar');
$ka_crumbs                 = get_option('ka_crumbs');
$ka_404title               = get_option('ka_404title');
$ka_results_title          = get_option('ka_results_title');
$ka_page_title_bar_select  = get_option('ka_page_title_bar_select');//@since 4.6
@$ka_search_perpage        = get_post_meta($post->ID, 'banner_search', true);
@$custom_pagetitle         = get_post_meta($post->ID, '_pagetitle_value', true);
?>

<div class="tools">
	<span class="tools-top"></span>
        <div class="frame">
        <?php truethemes_before_article_title_hook();// action hook
		
		//print page title
		echo '<h1>';
		if('' != $custom_pagetitle) { echo $custom_pagetitle; } else if (is_404()) { echo $ka_404title; } else if (is_search()) { echo $ka_results_title; } else { if(have_posts()) : while(have_posts()) : the_post(); if(!is_attachment()){the_title();} endwhile; endif; }
		echo '</h1>';
		
		//display search box
		//if (  (($ka_global_searchbar == 'true') && ($ka_search_perpage == 'yes')) ||  (($ka_global_searchbar == 'false') && ($ka_search_perpage == 'yes')) ){get_template_part('searchform','childtheme');}

		//display search box
		if (($ka_searchbar == 'true') && ($ka_search_perpage == 'yes')){ get_template_part('searchform','childtheme'); }
		
		//display breadcrumbs
		if ($ka_crumbs == 'true') { $bc = new simple_breadcrumb; }
		
		// action hook
		truethemes_after_searchform_hook(); ?>
        
        </div><!-- END frame -->
	<span class="tools-bottom"></span>
</div><!-- END tools -->