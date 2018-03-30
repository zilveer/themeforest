<?php
/**
 * Prints the content that goes before the main page/post content and after the
 * header - loads a slider if it is set and opens the main container divs.
 */
global $pexeto_page, $pexeto_slider_data;

//page title section


if ( !isset( $pexeto_page['header_display']['show_title'] ) || $pexeto_page['header_display']['show_title']==='global' ) {
	$show_title_opt = pexeto_option( 'show_page_title' );
}else if(isset($pexeto_page['header_display']['show_title'])){
	$show_title_opt = $pexeto_page['header_display']['show_title'];
}

$show_slider = isset( $pexeto_page['slider'] ) && $pexeto_page['slider']!='none' && $pexeto_page['slider']!='';
$show_title = $show_title_opt=='on' || $show_title_opt===true;
$ptitle = pexeto_get_header_title();

if ( ($show_title && !$show_slider) ) { ?>
	<div class="page-title-wrapper"><div class="page-title">
		<div class="content-boxed">
			<?php  
			if($show_title){
				if(!empty($ptitle['title'])){
			?><h1><?php echo $ptitle['title']; ?></h1>
			<?php }
				if(!empty($ptitle['subtitle'])){
			?><span class="page-subtitle"><?php echo $ptitle['subtitle']; ?></span><?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php }

//set the layout variables
$layoutclass=is_page_template('template-full-custom.php') || is_page_template('template-fullscreen-slider.php') || is_page_template('template-portfolio-gallery.php') ?'':'content-boxed';
$layoutclass.=' layout-'.$pexeto_page['layout'];

//blog layout classes
$layout_classes = array(
		'twocolumn' => 'blog-twocolumn',
		'threecolumn' => 'blog-threecolumn',
		'twocolumn-right' => 'blog-twocolumn blog-twocolumn-sidebar',
		'twocolumn-left' => 'blog-twocolumn blog-twocolumn-sidebar'
		);
if ( isset( $pexeto_page['blog_layout']) && isset($layout_classes[$pexeto_page['blog_layout']])) {
	$layoutclass.=' '.$layout_classes[$pexeto_page['blog_layout']];
}

$content_id='content';
if ( $pexeto_page['layout']=='full' ) {
	$content_id='full-width';
}
?>

<?php
//slider/static image section
if ( $show_slider ) {
	?><div id="slider-container"><?php
	//this is a slider
	if($pexeto_page['slider']!=='custom'){
		//print the theme slider
		$pexeto_slider_data=PexetoCustomPageHelper::get_slider_data( $pexeto_page['slider'] );
		locate_template( array( 'includes/'.$pexeto_slider_data['filename'] ), true, false );
	}else{
		//print the custom slider shortcode
		pexeto_print_custom_slider_shortcode();
	}
	?></div><?php
}
wp_reset_postdata();
?>
</div>
<div id="content-container" class="<?php echo $layoutclass; ?>">
<?php 
if(!is_page_template('template-fullscreen-slider.php')){
	do_action('pexeto_before_content');
} ?>
<div id="<?php echo $content_id; ?>" class="content">
