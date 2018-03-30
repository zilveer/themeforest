<?php
get_header();

GLOBAL $webnus_options;

$last_time = get_the_time(' F Y');


GLOBAL $webnus_page_options_meta;


$show_titlebar = null;
$titlebar_bg = null;
$titlebar_fg = null;
$have_sidebar = false;
$sidebar_pos = null;

$meta = $webnus_page_options_meta->the_meta();

if(!empty($meta)){
$show_titlebar =  isset($meta['webnus_page_options'][0]['show_page_title_bar'])?$meta['webnus_page_options'][0]['show_page_title_bar']:null;
$titlebar_bg =  isset($meta['webnus_page_options'][0]['title_background_color'])?$meta['webnus_page_options'][0]['title_background_color']:null;
$titlebar_fg =  isset($meta['webnus_page_options'][0]['title_text_color'])?$meta['webnus_page_options'][0]['title_text_color']:null;
$titlebar_fs =  isset($meta['webnus_page_options'][0]['title_font_size'])?$meta['webnus_page_options'][0]['title_font_size']:null;
$sidebar_pos =  isset($meta['webnus_page_options'][0]['sidebar_position'])?$meta['webnus_page_options'][0]['sidebar_position']:'right';
$have_sidebar = !( 'none' == $sidebar_pos )? true : false;

}
if('hide' != $show_titlebar):
?>
<section id="headline" style="<?php if(!empty($titlebar_bg)) echo ' background-color:'.$titlebar_bg.';'; ?>">
    <div class="container">
      <h3 style="<?php if(!empty($titlebar_fg)) echo ' color:'.$titlebar_fg.';'; if(!empty($titlebar_fs)) echo ' font-size:'.$titlebar_fs.';';  ?>"><?php the_title(); ?></h3>
    </div>
</section>
<?php if( 1 == $webnus_options->webnus_enable_breadcrumbs() ) { ?>
      <div class="breadcrumbs-w"><div class="container"><?php if('webnus_breadcrumbs') webnus_breadcrumbs(); ?></div></div>
<?php } ?>
<?php
endif;
?>

<section id="main-content" class="container">
<!-- Start Page Content -->
<?php
/*
	LEFT SIDEBAR
*/

if( ('left' == $sidebar_pos) || ('both' == $sidebar_pos ) ) get_sidebar('left');
if( $have_sidebar ) {
?>
<section class="<?php  echo('both' == $sidebar_pos )?'col-md-4 alpha omega':'col-md-8 omega'; ?>">
	<article>
	
<?php 
}
	
	echo '<div class="row-wrapper-x">';
		  if( have_posts() ): while( have_posts() ): the_post();
			the_content();
		  endwhile;
		  endif;
	echo '</div>';
wp_link_pages();
if ( comments_open() && ( $webnus_options->webnus_allow_comments_on_page() == 1) )

comments_template(); 


		  if( $have_sidebar ) {
?>
	</article>
</section>	

<?php
}
/*
	RIGHT SIDEBAR
*/

if( ('right' == $sidebar_pos) || ('both' == $sidebar_pos) ) get_sidebar('right');

?>

</section>

<?php get_footer(); ?>