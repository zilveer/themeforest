<?php 
global $options_data;
$loadmore_btn_text = __('View more','richer');
if($options_data['load_more_btn'] != '')
	$loadmore_btn_text = apply_filters('richer_text_translate', 'load_more_btn', $options_data['load_more_btn']);
echo'<p></p><div class="pagination portfolio span12 display"><a class="button default medium loadmore">'.$loadmore_btn_text.'</a><div style="display:none;">'.pagination().'</div></div><p></p>';

?>      