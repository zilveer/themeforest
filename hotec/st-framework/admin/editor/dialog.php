<?php

if ( !defined('ABSPATH') )
    die('You are not allowed to call this page directly.');
    
global $wpdb;

@header('Content-Type: ' . get_option('html_type') . '; charset=' . get_option('blog_charset'));

function st_make_admin_st_buttons($data){
    foreach($data as $button){
             $s_attr = array();
             if($button['type']=='heading'){
                 echo '<h3>'.esc_html($button['text']).'</h3>';
                 continue;
             }
            
            if(is_array($button['shortcode_attr'] )){
                foreach($button['shortcode_attr'] as $k=> $v){
                     $s_attr[] = ' '.$k.'="'.esc_attr($v).'" ';
                }
            }
            
            
            $s_attr = join('',$s_attr);
            $js_shortcode ='';
            $js_shortcode  = sprintf($button['shortcode_format'],$s_attr,esc_attr($button['text']));
            
            $js_shortcode = json_encode($js_shortcode);

              echo '<button class="'.esc_attr($button['class']).'"  onclick=\'insertStshorcode('.$js_shortcode.');\'>'.esc_html($button['text']).'</button>';
          }
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php _e('ST Short Code','smooththemes'); ?></title>
    <link  rel="stylesheet"  href="<?php echo PL_SA_URL ?>/tinymce.css"/>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/jquery.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/ui/jquery.ui.core.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/ui/jquery.ui.widget.min.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/ui/jquery.ui.position.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/jquery/ui/jquery.ui.autocomplete.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo PL_SA_URL ?>/tinymce.js"></script>
    <script type="text/javascript">
    function st_resize() {
		var vp = tinyMCEPopup.dom.getViewPort(window), el;

		el =  document.getElementById('st_shortcode');
       // alert(vp.w+' ' +vp.h);
		if (el) {
			el.style.width  = (vp.w - 15) + 'px';
			el.style.height = (vp.h - 80) + 'px';
		}
	}
    </script>
    <base target="_self" />
</head>

<body id="st_shortcode_bd" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display=''; st_resize();" onresize="st_resize();" style="display: none">

<!-- <form onsubmit="insertLink();return false;" action="#"> -->
	<div class="form">
	<div class="tabs">
		<ul>
			<li id="heading_tab" class="current"><span><a href="javascript:mcTabs.displayTab('heading_tab','heading_panel');" onmousedown="return false;"><?php echo _e( 'Headings', 'smooththemes' ); ?></a></span></li>
			<li id="buttons_tab"><span><a href="javascript:mcTabs.displayTab('buttons_tab','buttons_panel');" onmousedown="return false;"><?php echo _e(  'Buttons',  'smooththemes' ); ?></a></span></li>
			<li id="columns_tab"><span><a href="javascript:mcTabs.displayTab('columns_tab','columns_panel');" onmousedown="return false;"><?php _e('Columns', 'smooththemes'); ?></a></span></li>
             <li id="alert_tab"><span><a href="javascript:mcTabs.displayTab('alert_tab','alert_st');" onmousedown="return false;"><?php _e('Alert', 'smooththemes'); ?></a></span></li>
            <li id="other_tab"><span><a href="javascript:mcTabs.displayTab('other_tab','other_st');" onmousedown="return false;"><?php _e('Other', 'smooththemes'); ?></a></span></li>
        </ul>
	</div>
	
	<div class=""  id="st_shortcode" >
    <div class="st_shortcode_inner panel_wrapper" style="overflow: auto; height: 100%; overflow: auto;">
		<!-- gallery panel -->
		<div id="heading_panel" class="panel current">
		  
          <div class="tab_content">
        
              <?php for($i=1; $i<=6; $i++): ?>
               <div class="ilm">
                        <h<?php echo $i; ?> class="h stcode" onclick='insertStshorcode(<?php echo json_encode(' [h'.$i.']YOUR_HEADING'.$i.'_HERE[/h'.$i.'] '); ?>);'  class="left">Heading <?php echo $i; ?> </h<?php echo $i; ?>>
                    <div class="clear"></div>
               </div>
                <?php endfor ?>

         </div>
           
		</div>
		<!-- gallery panel -->
		
		<!-- buttons_panel panel -->
		<div id="buttons_panel" class="panel" >
    		 <div class="tab_content">
             
                <div class="six columns">
                    <h4>Buttons</h4>
                        <?php 
                          $normal_buttons = array(
                                 array(
                                    'class'=>'btn small',
                                    'text'=>__("Small Button",'smooththemes'),
                                    'shortcode_attr'=> array('type'=>'small','color'=>'','link'=>'#', 'icon'=>''),
                                    'shortcode_format'=>' [button %1$s  ]%2$s[/button] '
                                 ),
                                 
                                  array(
                                    'class'=>'btn medium',
                                    'text'=>__("Medium Button",'smooththemes'),
                                    'shortcode_attr'=> array('type'=>'medium','color'=>'','link'=>'#', 'icon'=>''),
                                    'shortcode_format'=>' [button %1$s  ]%2$s[/button] '
                                 ),
                                 
                                 array(
                                    'class'=>'btn large',
                                    'text'=>__("Large Button",'smooththemes'),
                                    'shortcode_attr'=> array('type'=>'large','color'=>'','link'=>'#', 'icon'=>''),
                                    'shortcode_format'=>' [button %1$s  ]%2$s[/button] '
                                 )
                                 
                          );
                          
                          st_make_admin_st_buttons($normal_buttons);
                          
                          ?>
                          <p><em>Short code:<br /> [button type="large" color="black" link="#" icon="icon-name" ]Button label[/button]</em></p>
                          <ul>
                             <li>Type: small, medium, large</li>
                             <li>Color: green, red, pink, orange, yellow, cyan, celadon, purple, gray </li>
                          </ul>
                          <p>You can get icon-name here <a  target="_blank" href="http://fortawesome.github.io/Font-Awesome/">http://fortawesome.github.io/Font-Awesome/</a></p>
  
                </div>
                
             
             
             </div>
		</div>
		<!-- buttons_panel panel -->
		
		<!-- single pic panel -->
		<div id="columns_panel" class="panel" >
    		  <div class="tab_content">
              
                    <button class="btn" onclick='insertStshorcode(" <br/>\
                    [row] <br/>\
                      [col width=\"three\"] COLUMN_1_CONTENT [/col] <br/>\
                      [col width=\"three\"] COLUMN_2_CONTENT [/col] <br/>\
                      [col width=\"three\"] COLUMN_3_CONTENT [/col] <br/>\
                      [col width=\"three\"] COLUMN_4_CONTENT [/col] <br/>\
                    [/row] <br/>\
                    ");' ><?php _e('4 Columns','smooththemes'); ?></button>
                    
                    
                    <button class="btn" onclick='insertStshorcode(" <br/>\
                    [row] <br/>\
                      [col width=\"four\"] COLUMN_1_CONTENT [/col] <br/>\
                      [col width=\"four\"] COLUMN_2_CONTENT [/col] <br/>\
                      [col width=\"four\"] COLUMN_3_CONTENT [/col] <br/>\
                    [/row] <br/>\
                    ");' ><?php _e('3 Columns','smooththemes'); ?></button>
                    
                    <button class="btn" onclick='insertStshorcode(" <br/>\
                    [row] <br/>\
                      [col width=\"six\"] COLUMN_1_CONTENT [/col] <br/>\
                      [col width=\"six\"] COLUMN_2_CONTENT [/col] <br/>\
                    [/row] <br/>\
                    ");' ><?php _e('2 Columns','smooththemes'); ?></button>
                    
                    
                    <button class="btn" onclick='insertStshorcode(" <br/>\
                    [row] <br/>\
                      [col width=\"twelve\"] COLUMN_1_CONTENT [/col] <br/>\
                    [/row] <br/>\
                    ");' ><?php _e('1 Column','smooththemes'); ?></button>
                    
              </div>
		</div>
        
        <div id="alert_st">
            <div class="tab_content">
                 <?php 
                          $border_buttons = array(
                                 array(
                                 'class'=>'btn medium',
                                    'text'=>__("Notification",'smooththemes'),
                                    'shortcode_attr'=> array('alert_type'=>''),
                                    'shortcode_format'=>' [alert %1$s  ]%2$s[/alert] '
                                 ),
                                 
                                  array(
                                  'class'=>'btn medium',
                                    'text'=>__("Info ",'smooththemes'),
                                    'shortcode_attr'=> array('alert_type'=>'info'),
                                    'shortcode_format'=>' [alert %1$s  ]%2$s[/alert] '
                                 ),
                                 
                                 array(
                                 'class'=>'btn medium',
                                    'text'=>__("Success",'smooththemes'),
                                    'shortcode_attr'=> array('alert_type'=>'success'),
                                    'shortcode_format'=>' [alert %1$s  ]%2$s[/alert] '
                                 ),
                                  array(
                                  'class'=>'btn medium',
                                    'text'=>__("Error",'smooththemes'),
                                    'shortcode_attr'=> array('alert_type'=>'error'),
                                    'shortcode_format'=>' [alert %1$s  ]%2$s[/alert] '
                                 )
                                 // Error
                                 
                          );
                          
                          st_make_admin_st_buttons($border_buttons);
                          
                          ?>
            </div>
        </div>
        
        <div id="other_st">
            <div class="tab_content">
                 
                    <?php 
                          $other_buttons = array(
                                
                                array(
                                    'type'=>'heading',
                                    'text'=>__("Dividers and Space",'smooththemes'),
                                 ),
                                 
                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Divider",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' [divider] '
                                 ),
                            
                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Block Quote",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' [block_quote] your_message [/block_quote]'
                                 ),
                                 

                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Clear",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' [clear] '
                                 ),
                                 
                                 array(
                                    'type'=>'heading',
                                    'text'=>__("Video",'smooththemes'),
                                 ),
                                 
                                 
                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Video",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' [video link="YOUTUBE_or_VIMEO_url"] '
                                 ),
                                 
                                 array(
                                    'type'=>'heading',
                                    'text'=>__("Accordion, tabs, Toggle",'smooththemes'),
                                 ),  
                                 
                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Accordion",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' 
                                        [accordion]<br/>
                                            [accordion_item title ="accordion 1"] accordion_content_1 [/accordion_item]<br/>
                                            [accordion_item title ="accordion 2"] accordion_content_3 [/accordion_item]<br/>
                                            [accordion_item title ="accordion 3"] accordion_content_3 [/accordion_item]<br/>
                                        [/accordion]
                                        
                                     '
                                 ),
                                 
                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Toggle",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' 
                                        [toggle]<br/>
                                            [toggle_item title ="toggle 1"] toggle_content_1 [/toggle_item]<br/>
                                            [toggle_item title ="toggle 2"] toggle_content_3 [/toggle_item]<br/>
                                            [toggle_item title ="toggle 3"] toggle_content_3 [/toggle_item]<br/>
                                        [/toggle]
                                        
                                     '
                                 ),
              
                                 
                                 array(
                                    'class'=>'btn',
                                    'text'=>__("Tabs",'smooththemes'),
                                    'shortcode_attr'=> array(),
                                    'shortcode_format'=>' 
                                        [tabs]<br/>
                                            [tab title="TITLE 1"] YOUR CONTENT 1 HERE [/tab]<br/>
                                            [tab title="TITLE 2"] YOUR CONTENT 2 HERE [/tab]<br/>
                                            [tab title="TITLE 3"] YOUR CONTENT 3 HERE [/tab]<br/>
                                        [/tabs]<br/>
                                     '
                                 ),
                                    
                                 
                          );
                          
                          st_make_admin_st_buttons($other_buttons);
                          
                          ?>
                 
                 
            </div>
        </div>
        
        
		<!-- single pic panel -->
	</div>
    </div>
        
        
    
        
  
	<div class="mceActionPanel" style="padding-top: 10px;">
        <p ><em><?php _e('Click to item to add to content','smooththemes'); ?></em></p>
	</div>
    
</div>

</body>
</html>