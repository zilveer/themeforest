<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	wp_reset_query();
	//post title
	$titleShow = get_post_meta ( $post->ID, "_".THEME_NAME."_show_single_title", true ); 
	$subTitle = get_post_meta ( $post->ID, "_".THEME_NAME."_sub_title", true ); 

?>					


<?php if($titleShow!="hide"){ ?>
		<h1 class="entry_title entry-title"><?php echo df_page_title(); ?></h1>
<?php } ?> 
<?php if($subTitle){ ?>
		<h3 class="entry_lead"><?php echo esc_html($subTitle);?></h3>
<?php } ?> 