<?php

if ( !defined( 'ABSPATH' ) ) exit;

get_header(vibe_get_header());

$request_body = file_get_contents('php://input');
$request_body = urldecode($request_body);
$malformed_jsons = explode('"',$request_body);
$record=array();
foreach($malformed_jsons as $key=>$value){
    if(strstr($value,'course_id')){
        $record['courseid'] = $value;
    }else if($value == 'verb'){
        $record['verb'] = $malformed_jsons[$key+2];
    }else if($value == 'object'){
        $record['object'] = $malformed_jsons[$key+4];
    }
}
//print_r($record);

$wplms_tincan = new wplms_tincan();

$wplms_tincan->articulate_payload($record,$_SERVER['HTTP_REFERER']);
get_footer(vibe_get_footer());
?>
