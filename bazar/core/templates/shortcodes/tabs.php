<?php
	$html = '<div class="tabs-container">'."\n";
    $html .= '    <ul class="tabs">'."\n";
    
    unset($var['content']);
	unset($var['other_atts']);
    
	foreach ( $var as $tab => $title ) {   
    	$html .= '<li><h4><a href="javascript:void();" data-tab="' . $tab . '" title="' . $title . '">' . $title . '</a></h4></li>'. PHP_EOL;
    }
        
    //$html .= '<li><h4><a href="#tab1" title="'.$tab1.'">'.$tab1.'</a></h4></li>'."\n";
    //$html .= '<li><h4><a href="#tab2" title="'.tab2.'">'.$tab2.'</a></h4></li>'."\n";
        
        
    
    $html .= '    </ul>'."\n";
    
    $html .= '<div class="border-box group">' . do_shortcode($content) . '</div>';
    
    $html .= '</div>'."\n";
?>

<?php echo $html; ?>