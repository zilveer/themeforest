<?php
/*
* See: http://wordpress.stackexchange.com/questions/1447/
*
*/
// - grab wp load, wherever it's hiding -
if(file_exists('../../../../wp-load.php')) :
    include '../../../../wp-load.php';
else:
    include '../../../../../wp-load.php';
endif;
global $wpdb;
header('Content-Type:application/json');
$events = array();
$result = new WP_Query('post_type=post&posts_per_page=-1');
foreach($result->posts as $post) {
  $events[] = array(
    'title'   => $post->post_title,
    'start'   => get_post_meta($post->ID,'_start_datetime',true),
    'end'     => get_post_meta($post->ID,'_end_datetime',true),
    'allDay'  => (get_post_meta($post->ID,'_all_day',true) ? 'true' : 'false'),
    );
}
echo json_encode($events);
exit;
?>