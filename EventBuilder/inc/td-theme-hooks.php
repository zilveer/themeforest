<?php 

#-----------------------------------------------------------------
# Themes Dojo Hooks
#-----------------------------------------------------------------
   
/*
* Located in header.php after <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />  
*/
function td_meta_hook(){

	do_action('td_meta_hook');

}

/*
* Located in header.php after , only gets used when Yoast Yeo is inactive  
*/
function td_meta_theme_hook(){

	do_action('td_meta_theme_hook');

}

/*
* Located in header.php before <header> 
*/
function td_before_header_hook(){

	do_action('td_before_header_hook');

}


/*
* Located in header.php before <div class="container">
*/
function td_before_content_hook(){

	do_action('td_before_content_hook');

}


/*
* Located in footer.php before <footer> 
*/
function td_before_footer_hook(){

	do_action('td_before_footer_hook');

}

/*
* Located in footer.php after </footer>
*/
function td_after_footer_hook(){

	do_action('td_after_footer_hook');

}

/*
* Located in footer.php after </footer>
*/
function td_java_footer_hook(){

	do_action('td_java_footer_hook');

}


?>