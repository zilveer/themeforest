<?php

//nav tab
add_shortcode( 'lefttab', 'navtabgroup' );
function navtabgroup( $atts, $content ){
	$GLOBALS['tab_count'] = 0;

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
		foreach( $GLOBALS['tabs'] as $tab ){
			$tabs[] = '<li class="'.$tab['state'].'"><a href="#'.str_replace(' ','_',$tab['title']).'" data-toggle="tab">'.str_replace(' ','&nbsp;',$tab['title']).'</a></li>';
			$panes[] = '<div id="'.str_replace(' ','_',$tab['title']).'" class="tab-pane '.$tab['state'].'"><p>'.$tab['content'].'</p></div>';
		}
		$return = "\n".'<div id="left-nav">
<div class="tabbable tabs-left">
<div class="navi-top"></div><ul id="myTab" class="nav nav-tabs left-navi">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab-content">'.implode( "\n", $panes ).'</div></div>
</div>'."\n";
	}
	return $return;
}

add_shortcode( 'ltab', 'ntabs' );
function ntabs( $atts, $content ){
	extract(shortcode_atts(array(
	'title' => 'Tab %d',
	'state' => ''
			), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'state' => sprintf( $state, $GLOBALS['tab_count'] ), 'content' =>  do_shortcode($content) );

	$GLOBALS['tab_count']++;
}
?>