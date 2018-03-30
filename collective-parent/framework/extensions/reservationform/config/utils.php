<?php
function encode_id($id){
    $s=array('A','4','G','1','E','9','S','6','T','3');
    $id = str_split(''.RESERVATION_START_NUMBER + $id.'');
    $new_id= '';
    foreach($id as $nr)
        $new_id .=$s[$nr];
    return $new_id;
}
function decode_res_id($id){
    $s=array('A'=>0,'4'=>1,'G'=>2,'1'=>3,'E'=>4,'9'=>5,'S'=>6,'6'=>7,'T'=>8,'3'=>9);
    $id = str_split($id);
    $new_id= '';
    foreach($id as $nr)
        $new_id .=$s[strtoupper($nr)];
    return $new_id-RESERVATION_START_NUMBER;
}