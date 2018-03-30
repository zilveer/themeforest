<?php
global $ttso;
$inline_editing = $ttso->ka_inline_editing;

if ($inline_editing == "true") {

if (is_home() || is_single()) {
global $user_level; get_currentuserinfo();
if ($user_level == 10) { 
	edit_post_link(__('+ Edit this post' , 'truethemes_localize'), '<p class="edit-page-button">', '</p>'); 
	} 

} else {

global $user_level; get_currentuserinfo();
if ($user_level == 10) { 
	edit_post_link(__('+ Edit this page' , 'truethemes_localize'), '<p class="edit-page-button">', '</p>'); 
	} 
}

}
?>