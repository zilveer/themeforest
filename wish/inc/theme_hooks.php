<?php  
// topbar hook, add html into topbar with this hook
function wish_hook_after_topbar() {
    do_action('wish_hook_after_topbar');
}

function wish_hook_before_topbar(){
	do_action('wish_hook_before_topbar');
}


function wish_hook_after_menu(){
	do_action('wish_hook_after_menu');
}

function wish_hook_before_logo(){
	do_action('wish_hook_before_logo');
}

//test
// function output_about_text() {
//     echo '<p>This site is amazing.</p>';
// }

// add_action('wish_hook_before_logo','output_about_text');

?>