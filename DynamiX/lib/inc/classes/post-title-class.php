<?php 
/**
 * The template for displaying Post Titles
 *
 * @package WordPress
 */
 
 	// Post Title
	if( $NV_posttitle )
	{  	
		if( $NV_posttitle != "BLANK" )
		{ 
			if(is_single())
			{ 
				echo '<h1 class="entry-title">'. htmlspecialchars( $NV_posttitle ) .'</h1>';
			}
			else
			{
				echo '<h2 class="entry-title"><a href="'. $post_link .'" rel="bookmark" title="'. __('Permanent Link to', 'themeva') .' '. the_title_attribute (array('echo' => 0) ) .'">'. htmlspecialchars( $NV_posttitle ) .'</a></h2>';
			}
		}	 
	}
	else
	{  
		if($NV_posttitle != "BLANK")
		{ 
			if(is_single())
			{
				echo '<h1 class="entry-title">'. get_the_title() .'</h1>';	
			} 
			else
			{
				echo '<h2 class="entry-title"><a href="'. $post_link .'" rel="bookmark" title="'. __('Permanent Link to', 'themeva') .' '. the_title_attribute (array('echo' => 0) ) .'">'. get_the_title() .'</a></h2>';	
			}      	
		} 
	} 
	// Post Sub Title
	if( !empty( $NV_postsubtitle ) )
	{
		echo '<h3>'. htmlspecialchars( $NV_postsubtitle ) .'</h3>';
	}