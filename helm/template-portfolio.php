<?php
/*
Template Name: Portfolio
*/
?>
<?php
$count=0;
$portfolio_column_count=1;
$portfolio_style= get_post_meta($post->ID, MTHEME . '_portfolio_style', true);
$portfolio_category= get_post_meta($post->ID, MTHEME . '_portfolio_category', true);
$portfolio_perpage= get_post_meta($post->ID, MTHEME . '_portfolio_perpage', true);
$portfolio_link= get_post_meta($post->ID, MTHEME . '_portfolio_link', true);

if ($portfolio_perpage=="list all") { $portfolio_perpage="-1"; }

$portfolio_cat= get_term_by ( 'name', $portfolio_category,'types' );
$portfolio_cat_slug=$portfolio_cat -> slug;
$portfolio_cat_ID=$portfolio_cat -> term_id;

$portfolio_category=$portfolio_cat_slug;

if ($portfolio_style=="Ajax Portfolio" || $portfolio_style=="Filterable Portfolio" ) {
FlexiSlideScripts();
wp_enqueue_script( 'quicksand', MTHEME_JS . '/quicksand/jquery.quicksand.js', array( 'jquery' ), null,false );
}
get_header();

Switch ( $portfolio_style ) {	
	case "Ajax Portfolio" :
		$columns=4;
		require ( MTHEME_INCLUDES . 'portfolio/portfolio-ajax-gallery.php' );
	break;
	case "Filterable Portfolio" :
		$columns=4;
		require ( MTHEME_INCLUDES . 'portfolio/portfolio-filterable.php' );
	break;
	case "4 Column" :
		$columns=4;
		require ( MTHEME_INCLUDES . 'portfolio/portfolio-four.php' );
	break;
	
	case "3 Column" :
		$columns=3;
		require ( MTHEME_INCLUDES . 'portfolio/portfolio-three.php' );
	break;
	
	case "2 Column" :
		$columns=2;
		require ( MTHEME_INCLUDES . 'portfolio/portfolio-two.php' );
	break;	
	
	case "1 Column" :
		$columns=1;
		require ( MTHEME_INCLUDES . 'portfolio/portfolio-one.php' );
	break;
}

?>
<?php get_footer(); ?>