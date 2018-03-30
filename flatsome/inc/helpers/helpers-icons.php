<?php

function get_flatsome_icon($name, $size = null){
  if($size) $size = 'style="font-size:'.$size.';"';
  return '<i class="'.$name.'" '.$size.'></i>';
}