<?php get_header();

global $ttso;
$ka_results_fallback      = $ttso->ka_results_fallback;
$ka_page_title_bar_select = $ttso->ka_page_title_bar_select;//@since 4.6
$show_page_title_bar      = $ttso->ka_tools_panel;//@since 4.6
$header_shadow_style      = $ttso->ka_header_shadow_style;//@since 4.8

//define new options for backward compatible
if ('' == $header_shadow_style): 'no-shadow' ==  $header_shadow_style; endif;
?>

</div><!-- END header-area -->
</div><!-- END header-overlay -->
</div><!-- END header-holder -->
</header><!-- END header -->

<?php truethemes_before_main_hook();// action hook ?>

<div id="main">
    <?php
    //header shadow style
    if (('no-shadow' != $header_shadow_style) && ('Full Width' != $ka_page_title_bar_select)) : ?>
    <div class="karma-header-shadow"></div><!-- END karma-header-shadow --> 
    <?php endif; //END header shadow style ?>

    <?php
    // full-width page title bar
    // @since 4.6
    if( ('Full Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) ):
    get_template_part('theme-template-part-tools-fullwidth','childtheme');
    endif;
    ?>

<div class="main-area">
	<?php
    //page-title-bar (breadcrumbs, etc)
    if( ('Fixed Width' == $ka_page_title_bar_select) && ('true' == $show_page_title_bar) ):
    get_template_part('theme-template-part-tools','childtheme');
    endif; ?>

<main role="main" id="content" style="margin-left: 0;">
	<h2 class="search-title"><?php _e('Search Results for','truethemes_localize'); ?> "<?php the_search_query(); ?>"</h2><br />
	<ul class="search-list">
	<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
	<li><strong><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></strong><br />
	<?php
	ob_start();
	the_content();
	$old_content = ob_get_clean();
	$new_content = strip_tags($old_content);
	echo substr($new_content,0,300).'...';
	?>
	</li>

<?php endwhile; ?>
	</ul>
<?php else: echo $ka_results_fallback; ?>
<?php endif; ?>

<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
</main><!-- END main #content -->

<aside role="complementary" id="sidebar" class="right_sidebar">
<?php dynamic_sidebar("Search Results Sidebar"); ?>
</aside><!-- END sidebar -->
</div><!-- END main-area -->

<?php get_footer(); ?>