<?php


function  faq_shortcode($attributes, $content)
{

	extract(shortcode_atts(array('faq_id'=>''),$attributes));
	
	if(empty($faq_id) || $faq_id == '-1')
	$wpbp = new WP_Query(array( 'post_type' => 'faq','nopaging'=>true));
	else
	{
		$post_id = explode(',', $faq_id);	
		$wpbp = new WP_Query(array( 'post_type' => 'faq','nopaging'=>true,'post__in'=>$post_id));
	}
	
	$temp_out = "";
	if ($wpbp->have_posts()) : while ($wpbp->have_posts()) : $wpbp->the_post();
	
	$temp_out .= "[accordion title='".get_the_title()."']". get_the_content(). "[/accordion]";
	
	endwhile; endif;
	
	wp_reset_query();
	
	$out = do_shortcode($temp_out);
	
	return $out;
	
}
add_shortcode("faq", 'faq_shortcode');
?>