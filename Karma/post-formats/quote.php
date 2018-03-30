<?php
/**
 * The template for displaying posts in the Quote post format
 *
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('masonry-section'); ?>>
	<blockquote class="tt-post-quote">
		<span class="quote-entry-icon fa fa-quote-left"></span>
	 	<?php
	 	//setup our "continue reading" button setting from site option
	 	global $ttso;
	 	$ka_blogbutton            = $ttso->ka_blogbutton;
	 	$ka_blogbutton_color      = $ttso->ka_blogbutton_color;
	 	$ka_blogbutton_size       = $ttso->ka_blogbutton_size;
	 		 	
	 	//pre-define values for backward compatibility
	 	if ('' == $ka_blogbutton_color): 'black'  == $ka_blogbutton_color; endif;
	 	if ('' == $ka_blogbutton_size):  'small'  == $ka_blogbutton_size;  endif;
	 	
	 	//format "continue reading" button
	 	$formatted_size    =  strtolower($ka_blogbutton_size);
	 	$formatted_button  =  $formatted_size.'_button '.$formatted_size.'_'.$ka_blogbutton_color;
	 	
	 	//original codes from wp-includes post template function the_content(), omit the apply_filters to avoid Karma theme's auto p tags..
	 	//This code allows user to insert more tag in content, to force a read more "continue reading" button. Defaults to none..
	 	$content = get_the_content('<span class="ka_button '.$formatted_button.'"><span>'.$ka_blogbutton.'</span></span>');
	 	$content = str_replace( ']]>', ']]&gt;', $content );
	 	echo $content;
	 	?>
    	<span class="quote-entry-icon fa fa-quote-right"></span>
	</blockquote>
</article><!-- .masonry-section -->