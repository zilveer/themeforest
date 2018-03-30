<?php
//Get post format type
$postformat = get_post_format();
//If post format is null then it is a standard post type
if($postformat == "") $postformat="standard";

//get the post formats as per name basis
get_template_part( 'includes/postformats/'.$postformat );

// style them with the switch
switch ($postformat) {

	case "link" :
		
		break;
		
	case "image" :
		
		break;
		
	case "standard" :
		
		break;
		
	case "quote" :
		
		break;
		
	case "aside" :
		
		break;
		
	default :
		get_template_part( 'includes/postformats/default' );

}
?>