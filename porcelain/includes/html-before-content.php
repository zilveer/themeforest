<?php
/**
 * Prints the content that goes before the main page/post content and after the
 * header - loads a slider if it is set and opens the main container divs.
 */
global $pexeto_page, $slider_data;

//page title section
if ( !isset( $pexeto_page['show_title'] ) || $pexeto_page['show_title']==='global' ) {
	$pexeto_page['show_title']=pexeto_option( 'show_page_title' );
}

$show_slider = isset( $pexeto_page['slider'] ) && $pexeto_page['slider']!='none' && $pexeto_page['slider']!='';
$show_title = $pexeto_page['show_title']=='on' || $pexeto_page['show_title']===true;
$ptitle = isset( $pexeto_page['title'] ) ? $pexeto_page['title'] : get_the_title();

if ( ($show_title && !$show_slider) || (!$show_title && !$show_slider && !is_page_template( 'template-portfolio-gallery.php' ))) { ?>
	<div class="page-title">
		<div class="content-boxed">
			<?php  
			if($show_title && $ptitle){
			?><h1><?php echo $ptitle; ?></h1>
			<?php } ?>
		</div>
	</div>
<?php }

//set the layout variables
$layoutclass=is_page_template('template-full-custom.php') || is_page_template('template-portfolio-gallery.php') ?'':'content-boxed';
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
	if ( $pexeto_page['slider']=='static' ) {
		//this is static image
		locate_template( array( 'includes/static-header.php' ), true, true );
	}else {
		?><div id="slider-container"><?php
		//this is a slider
		$slider_data=PexetoCustomPageHelper::get_slider_data( $pexeto_page['slider'] );
		locate_template( array( 'includes/'.$slider_data['filename'] ), true, true );
		?></div><?php
	}
}
wp_reset_postdata();
?>
</div>
<div id="content-container" class="<?php echo $layoutclass; ?>">
<div id="<?php echo $content_id; ?>" class="content">
