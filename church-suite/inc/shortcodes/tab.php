<?php


 // Tabs
 add_shortcode( 'tabgroup', 'tabgroup' );
 function tabgroup( $atts, $content ){
 	$GLOBALS['tab_count'] = 0;

 	do_shortcode( $content );

 	if( is_array( $GLOBALS['tabs'] ) ){
 		foreach( $GLOBALS['tabs'] as $tab ){
 			$tabs[] = '<li class="'.$tab['state'].'"><a href="#'.str_replace(' ','_',$tab['title']).'" data-toggle="tab">'.str_replace(' ','&nbsp;',$tab['title']).'</a></li>';
 			$panes[] = '<div id="'.str_replace(' ','_',$tab['title']).'" class="tab-pane '.$tab['state'].'"><p>'.$tab['content'].'</p></div>';
 		}
 		$return = "\n".'<ul id="myTab" class="nav nav-tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div id="myTabContent" class="tab-content">'.implode( "\n", $panes ).'</div>'."\n";
 	}
 	return $return;
 }

 add_shortcode( 'tab', 'tabs' );
 function tabs( $atts, $content ){
 	extract(shortcode_atts(array(
 	'title' => 'Tab %d',
 	'state' => ''
			), $atts));

 	$x = $GLOBALS['tab_count'];
 	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'state' => sprintf( $state, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode($content) );

 	$GLOBALS['tab_count']++;
 }


?>