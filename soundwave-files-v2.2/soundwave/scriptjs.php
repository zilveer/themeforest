<?php
$type = of_get_option('type_background');
$image = of_get_option('background_upload');
$radio_ip = of_get_option('radio_ip');
$radioplay = of_get_option('radio_autoplay');
$radioopened = of_get_option('radio_opened');
$playerar = of_get_option('player_audio_radio');
$speedslideshow = of_get_option('slider_speed_slideshow');
$speedanimation = of_get_option('slider_speed_animation');
 
echo'
<script type="text/javascript">
jQuery(document).ready(function($){';

switch ($type) {
		 case "image": 
		 echo '
$.backstretch("'.$image.'");';
break;
}

switch ($playerar) {
case "player_radio":
echo'
$("#jquery_jplayer_1").jPlayer({
    ready: function () {
        $(this).jPlayer("setMedia", {
            mp3: "http://'.$radio_ip.'/;stream/1"
        })';
		
		switch ($radioplay) {
		case "radio_autoplay_on":
		echo '.jPlayer("play")';
		break;
		}
echo';	
		debug($(this));
    },
	swfPath: "'.get_template_directory_uri().'/swf/",
    supplied: "mp3",
	volume: 1
});';

switch ($radioopened) {
case "radio_opened_visible":  
  echo '
  $(".radio-wz-open-hidden").click(function () {
    $("#radio-wz #radio-wz-col").slideToggle({
      direction: "up"
    }, 100);
    $(this).toggleClass("clientsClose");
  });
   $("#radio-wz-col").show();
   
   function mouseHandler(e){
  if ($(this).hasClass("radio-wz-hidden-open")) {
    $(this).removeClass("radio-wz-hidden-open");
  } else {
    $(".radio-wz-hidden-open").removeClass("radio-wz-hidden-open");
    $(this).addClass("radio-wz-hidden-open");
  } 
}
function start(){
  $(".radio-wz-open-hidden").bind("click", mouseHandler);
}
$(document).ready(start);
   ';
break;
case "radio_opened_hidden": 
echo '
  $(".radio-wz-open").click(function () {
    $("#radio-wz #radio-wz-col").slideToggle({
      direction: "up"
    }, 100);
    $(this).toggleClass("clientsClose");
  });
  function mouseHandler(e){
 if ($(this).hasClass("radio-wz-open-hidden")) {
   $(this).removeClass("radio-wz-open-hidden");
  } else {
   $(".radio-wz-open-hidden").removeClass("radio-wz-open-hidden");
   $(this).addClass("radio-wz-open-hidden");
  } 
}
function start(){
   $(".radio-wz-open").bind("click", mouseHandler);
}
$(document).ready(start);
  ';
break;
}  
break;
} 

if (of_get_option('slider_active', '1') == '1') {
	if (is_front_page()){ 
echo'
		if ( jQuery(".flexslider").length && jQuery() ) {
		jQuery(".flexslider").flexslider({
			controlNav: true,
			animationLoop: true,  
			controlsContainer:"",
			pauseOnAction: false,
			pauseOnHover: true,
			smoothHeight: true,
			nextText:"&rsaquo;",
			prevText:"&lsaquo;",
			keyboardNav: false, 		
			slideshowSpeed: '.$speedslideshow.',
			animationSpeed: '.$speedanimation.',
	        start: function(slider) {
            slider.removeClass("loading");
            }
		});			
		}';
	} 
}
echo'
});
 </script>';
 
?>