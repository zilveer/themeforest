<?php
get_header();

$webnus_options = webnus_options();

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
      <h2 style="<?php if(!empty($titlebar_fg)) echo ' color:'.$titlebar_fg.';'; if(!empty($titlebar_fs)) echo ' font-size:'.$titlebar_fs.';';  ?>"><?php the_title(); ?></h2>
    </div>
</section>
<?php
$webnus_options['webnus_enable_breadcrumbs'] = isset( $webnus_options['webnus_enable_breadcrumbs'] ) ? $webnus_options['webnus_enable_breadcrumbs'] : '';
if( 1 == $webnus_options['webnus_enable_breadcrumbs'] ) { ?>
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

if( ('left' == $sidebar_pos) || ('both' == $sidebar_pos ) ){ ?>
	<aside class="col-md-3 sidebar leftside">
	<?php GLOBAL $webnus_page_options_meta;
	$meta = $webnus_page_options_meta->the_meta();
	$sidebar_pos = 'left';
	if(!empty($meta) && is_array($meta))
		$sidebar_pos =  isset($meta['webnus_page_options'][0]['sidebar_position'])?$meta['webnus_page_options'][0]['sidebar_position']:'none';
	dynamic_sidebar( 'Left Sidebar' ); ?>
	</aside>
<?php }
if( $have_sidebar ) {
?>
<section class="<?php  echo('both' == $sidebar_pos )?'col-md-6 cntt-w':'col-md-9 cntt-w'; ?>">
	<article>
	
<?php 
}
	
	echo '<div class="row-wrapper-x">';
		  if( have_posts() ): while( have_posts() ): the_post();
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('full');
			}
			the_content();
		  endwhile;
		  endif;
	echo '</div>';
wp_link_pages();
if (comments_open() || get_comments_number() ){
	comments_template();
}
if( $have_sidebar ){
	echo "</article></section>	";
}

if( ('right' == $sidebar_pos) || ('both' == $sidebar_pos) ){?>

<aside class="col-md-3 sidebar">
<?php GLOBAL $webnus_page_options_meta;
$meta = $webnus_page_options_meta->the_meta();
$sidebar_pos = 'left';
if(!empty($meta) && is_array($meta))
	$sidebar_pos =  isset($meta['webnus_page_options'][0]['sidebar_position'])?$meta['webnus_page_options'][0]['sidebar_position']:'none';
dynamic_sidebar( 'Right Sidebar' ); ?>
</aside>

<?php } ?>
</section>

<?php get_footer(); ?>