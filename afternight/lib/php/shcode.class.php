<?php
	class shcode{
        static function contact( $attr , $content ){
            $title          = isset( $attr['title'] ) && strlen( $attr['title'] )? '<h3>' . $attr['title'] . '</h3>' : '';
            $description    = isset( $attr['description'] ) && strlen( $attr['description'] )? '<p>' . $attr['description'] . '</p>' : '';
            if( isset( $attr['phone1'] ) && strlen( $attr['phone1'] ) && isset( $attr['phone2'] ) && strlen( $attr['phone2'] ) ){
                $phone1 = '<p>' . '<strong>'. __('Phone 1' , 'cosmotheme') . '</strong> : ' . $attr['phone1'] . '</p>';
            }elseif( isset( $attr['phone1'] ) && strlen( $attr['phone1'] ) ){
                $phone1 = '<p>' . '<strong>'. __('Phone' , 'cosmotheme') . '</strong> : ' . $attr['phone1'] . '</p>';
            }else{
                $phone1 = '';
            }
            $phone2         = isset( $attr['phone2'] ) && strlen( $attr['phone2'] )? '<p>' . '<strong>'. __('Phone 2' , 'cosmotheme') . '</strong> : ' . $attr['phone2'] . '</p>' : '';
            $fax            = isset( $attr['fax'] ) && strlen( $attr['fax'] )? '<p>' . '<strong>'. __('Fax' , 'cosmotheme') . '</strong> : ' . $attr['fax'] . '</p>' : '';
            $show_contact  = isset( $attr['hidde_contact'] ) &&  $attr['hidde_contact'] == 'yes' ? false : true;

            if( is_email( $attr['email'] ) ){
                update_option( 'contact_mail' , $attr['email'] );
                $email = '<p>' . '<strong>'. __('Email' , 'cosmotheme') . '</strong> : ' . $attr['email'] . '</p>';
                $mail = true;
            }else{
                $mail = false;
                update_option( 'contact_mail' , get_the_author_meta( 'user_email' , get_current_user_id()) );
                $email = '<strong>'. __('Email' , 'cosmotheme') . '</strong> : ' . get_the_author_meta( 'user_email' , get_current_user_id()) . '</strong><br />';
            }

            $show_map = false;
			
            if( isset( $mail ) && $mail ){
                $info       = $title . $description . $phone1 . $phone2 . $fax . $email ;
            }else{
                $info       = $title . $description . $phone1 . $phone2 . $fax ;
            }

            $result = '';

            $result .= '<div class="contact_info">'.$info . '</div><br />';
            
            if( strlen( $content ) ){
                $result .= '<p>' . $content . '</p>';
            }

            if( $show_contact ){
                $time_id = time();

                $result .= '<div class="contact-form">';
                $result .= '<form class="contactform" id="contact_form_' . $time_id . '" method="post" action="' . home_url() . '" >';
                $result .= '<fieldset>';
				$result .= '<input type="hidden" value="'.get_option( 'contact_mail').'" name="contact_email" >';    
                $result .= '<div id="contact_response" class="send-error">';
                $result .= '</div>';

                $result .= '<p class="content_name input">';
                $result .= '<label for="contact_name">';
                $result .= __('Name (required)' , 'cosmotheme') ;
                $result .= '</label>';
                $result .= '<input type="text" tabindex="1" size="22" value="" id="contact_name" name="name">';
                $result .= '</p>';


                $result .= '<p class="content_email input">';
                $result .= '<label for="contact_email">';
                $result .=  __('Email (required)' , 'cosmotheme');
                $result .= '</label>';
                $result .= '<input type="text" tabindex="2" size="22" value="" id="contact_email" name="email">';
                $result .= '</p>';



                $result .= '<p class="content_phone input">';
                $result .= '<label for="contact_phone">';
                $result .=  __('Phone' , 'cosmotheme' );
                $result .= '</label>';
                $result .= '<input type="text" tabindex="3" size="22" value="" id="contact_phone" name="phone">';
                $result .= '</p>';

                $result .= '<p class="content_message comment-form-comment textarea">';
                $result .= '<textarea tabindex="4" rows="10" cols="100%" id="contact_message" name="message"></textarea>';
                $result .= '</p>';

                $result .= '<p class="form-submit submit gray">';
                $result .= '<input type="button" value="' . __( 'Send Message' , 'cosmotheme' ) . '" tabindex="5" id="submit" name="btn_submit" onclick="javascript:act.send_mail(\'contact\' , \'#contact_form_' . $time_id . '\' , \'div#contact_response\' );">';
                $result .= '</p>';
                $result .= '<div class="container_msg"></div>';
                $result .= '</fieldset>';
                $result .= '</form>';
                $result .= '</div>';
            }

            return $result;

        }

       	static function add_button( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/button.php */
        	$sizes      = array( 'small' , 'medium' , 'large');
            $colors      = array( 'blue' , 'gray' , 'green', 'orange' , 'black', 'brown', 'pink', 'red');
            $style		= array('comment','download','print','delete','tick','info','demo','warning');
            
        	/*Set default values*/
        	$btn_size = '';
        	$btn_color = '';
        	$btn_link = '#';
        	$btn_title = 'Button';
        	$target="";
        	
        	
        	if(isset($atts[ 'style' ]) && in_array($atts[ 'style' ], $style) ){
        		$btn_style = $atts[ 'style' ];
	        }
        	
        	if(isset($atts[ 'size' ]) && in_array($atts[ 'size' ], $sizes) ){
        		$btn_size = $atts[ 'size' ];
	        	
        	}
        	
        	if(isset($atts[ 'color' ])  && in_array($atts[ 'color' ], $colors)  ){
	        	$btn_color = $atts[ 'color' ];
        	}
        	
            if(isset($atts[ 'link' ]) ){
            	$btn_link = $atts[ 'link' ];
            }

            if(isset($content) && trim($content) != ''){
            	$btn_title = $content;
            }

        	if(isset($atts[ 'new_window' ]) && $atts[ 'new_window' ] == 'true'){
            	$target='_blanck';
            }
            
            if($target == '_blanck'){
            	$onClick = 'onClick="window.open(\''.$btn_link.'\', \'_blank\')"';
            	$btn_link = 'javascript:void(0)';
            }
            else{
            	$onClick = '';
            } 
            
            if(isset($btn_style)){
            	$result = '<a href="'.$btn_link.'" '.$onClick.' class="cosmolink"><span class="cosmobutton gray '.$btn_style.'" type="button" ><span><span><span class="cosmo-ico">&nbsp;</span>'.$btn_title.'</span></span></span></a>';
            }
            else{
            	$result = '<a class="cosmolink" href="'.$btn_link.'" '.$onClick.' ><span type="button" class="cosmobutton '.$btn_color.' ' .$btn_size.'"><span><span>'.$btn_title.'</span></span></span></a>';
            }	
            
            return $result;
        }

        static function add_box( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/box.php */
        	$box_type = array('default','info','warning','download','error','tick','search','comments');
			$box_sizes = array('medium','large');

        	/*set the defaults:*/

        	$box_size = '';
        	$box_style= 'default';
            $result = '';

        	if(isset($atts[ 'type' ]) && in_array($atts[ 'type' ], $box_type)  ){
        		$box_style = $atts[ 'type' ];
        	}

        	if(isset($atts[ 'size' ]) && in_array($atts[ 'size' ], $box_sizes)  ){
        		$box_size = $atts[ 'size' ];
        	}
        	if($box_style == 'default'){
        		$ico = '';
        	}
        	else{
        		$ico = '<span class="icon-'.$box_style.'"></span>';
        	}

            $result .= '<div class="cosmo-box ' . $box_style . ' ' . $box_size . ' ">';
            $result .= '<div class="fl">' ;
            if( isset( $atts['title'] ) && !empty( $atts['title'] ) ){

                $result .= "<h5>".$ico . $atts['title'] ."</h5>";
            }else{
                $result .= $ico;
            }

            $result .= '<p class="box-content">' .  $content . '</p>';
            $result .= '</div>';


            if( ( isset( $atts['right_title'] ) || isset( $atts['right_description'] ) ) && ( !empty( $atts['right_title'] ) || !empty( $atts['right_description'] ) ) ){

                if( isset( $atts['style'] ) ){
                    $style = $atts['style'];
                }else{
                    $style = '';
                }
                $result .= '<div class="fr ' . $style . '">';
                if( isset( $atts['url'] ) ){
                    $link = $atts['url'];
                }else{
                    $link = '';
                }
                $result .= '<a href="' . $link . '" class="button medium rectangle blue">' . $atts['right_title'] . '<span class="desc">' . $atts['right_description'] .'</span></a>';
                $result .= '</div>';
            }

            $result .= ' </div>';

            return $result;
        }

    	static function add_unordered_list( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/list.php */
        	$ul_styles = array('bullet','arrow','star','cancel','tick');
			
	
        	if(isset($atts[ 'style' ]) && in_array($atts[ 'style' ], $ul_styles) ){
        	
            	return '<div class="cosmo-unorderedlist '.$atts[ 'style' ].'">'.$content.'</div>';
        	}	
        }
        
    	static function add_ordered_list( $atts , $content ){
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/template/shcode/list.php */
        	$ol_styles = array(	'decimal', 'armenian',	'decimal-leading-zero',	'georgian','lower-alpha',	'lower-greek',	'lower-latin',	'lower-roman',	'upper-alpha',	'upper-latin',	'upper-roman');
			
	
        	if(isset($atts[ 'style' ]) && in_array($atts[ 'style' ], $ol_styles) ){
        	
            	return '<div class="cosmo-orderedlist '.$atts[ 'style' ].'">'.$content.'</div>';
        	}	
        }

        
    	static function add_highlight( $atts , $content ){
        	if(trim($content) != '')
        	{
        		return '<span class="cosmo-highlight">'.do_shortcode($content).'</span>';	
        	}
        		
        }
        
   		static function add_dropcap( $atts , $content ){
        	if(trim($content) != '')
        	{
        		if(strlen($content)>1){
        			$content_left = mb_substr($content,1,strlen($content));
        		}
        		else{
        			$content_left = '';
        		} 
        		
        		return '<span class="dropcap">'.mb_substr($content,0,1).'</span>'.$content_left;	
        	}
        		
        }
        
        static function de_demo( $atts , $content ){
            $result = '<div class="shortcode_demo">';
            $result .= '<span class="demo_btn">+ Code Snippet</span>';
            $result .= '<div class="demo_code">';
            $result .= $content;
            $result .= '</div>';
            $result .= '</div>';

            return $result;
        }
		
        static function add_tabs( $atts , $content ){  
        	
        	$tabs_header_title = '';
        	if(isset($atts['title']) && $atts['title'] != '') $tabs_header_title = '<h4 class="tabs_title">'.$atts['title'].'</h4>';
        	
        	$style ='';
        	if(isset($atts['style']) && $atts['style'] != '') {$style = $atts['style'];}
        	if($tabs_header_title != '') {$style .= ' has_title';}
        	
			$tabs_ = explode('[/tab]',trim( trim( $content ) , '<br />'));  /*get an array of tabs*/
			
			/*count tabs that have content*/
			$nr_tabs_content = 0;
			foreach ($tabs_ as $tab_content) {
				if(trim( trim( $tab_content ) , '<br />') !='')  $nr_tabs_content ++;
				
			}
			if(count($tabs_)){
				$tabs_title = '<ul class="tabs-nav"> ';
				$tabs_content = '';
				
				$i=1;
				foreach ($tabs_ as $tab_content) {
					if(trim( trim( $tab_content ) , '<br />') !=''){
					
					preg_match_all( '/tab title="([^\"]+)"/i', $tab_content , $title_matches, PREG_OFFSET_CAPTURE );	
					$tab_title = '';
					if ( isset( $title_matches[1][0][0] ) ) { $tab_title = $title_matches[1][0][0]; } // End IF Statement
					
					
					$content = preg_replace('/\[tab title=.*?]/i','',$tab_content);
					
					if($i == 1) $title_class = 'first'; 
					else if($i == $nr_tabs_content) $title_class = 'last'; 
					else $title_class = '';
					
					$tab_id = mt_rand(1, 10000);
					$tabs_title .= '<li class="'.$title_class.'"><a href="#t'.$tab_id.'"><span>'.$tab_title.'</span></a></li>'; 
					$tabs_content .= '<div class="tabs-container" id="t'.$tab_id.'"><p>'.do_shortcode(trim(trim($content))).'</p></div>';
						
					}
					
					$i++;
				}
				$tabs_title .= '</ul>';
			}	
			
			return $tabs_header_title.'<div class="cosmo-tabs '.$style.'" id="'.mt_rand(1, 100).'">'.$tabs_title.$tabs_content.'<div class="clear"></div></div>';
			
		}
        
    	static function add_accordion( $atts , $content ){ 
        	
    		$tabs_ = explode('[/acc]',$content);  /*get an array of tabs*/
    		
    		if(count($tabs_)){
				
				$acc_content = '<div class="cosmo-accordion"> ';
				
				foreach ($tabs_ as $tab_content) {
					if(trim( trim( $tab_content ) , '<br />') !=''){
					
					preg_match_all( '/acc title="([^\"]+)"/i', $tab_content , $title_matches, PREG_OFFSET_CAPTURE );	
					$tab_title = '';
					if ( isset( $title_matches[1][0][0] ) ) { $tab_title = $title_matches[1][0][0]; } // End IF Statement
					
					
					$content = preg_replace('/\[acc title=.*?]/i','',$tab_content);
					
					$acc_content .= '<h2 class="cosmo-acc-trigger"><a href="#">'.$tab_title.'</a></h2>';
					$acc_content .= '<div class="cosmo-acc-container"><div class="cosmo-acc-container-margin">'.do_shortcode(trim($content)).'</div></div>';
					
					}
					
					
				}
				$acc_content .= '</div>';
				
				return $acc_content;
			}	
        }
		
    	static function add_hr( $atts , $content ){ 
        	return '<div class="cosmo-hr">&nbsp;</div>';
        }
    	
        static function add_divider( $atts , $content ){
        	return '<div class="cosmo-divider">&nbsp;</div>';
        }
        
     	static function add_toggle( $atts , $content ){
        	$defaults = array( 'title_open' => 'Hide the Content', 'title_closed' => 'Show the Content', 'hide' => 'true', 'border' => 'yes' );
        	extract( shortcode_atts( $defaults, $atts ) );

        	if($hide == 'true'){
        		$ico_class = 'show';
        		$title_closed_class = 'visible';
        		$title_open_class = 'hidden';
        		$div_class = 'open_title';
        	}
        	else{
        		$ico_class = 'hide';
        		$title_closed_class = 'hidden';
        		$title_open_class = 'visible';
        		$div_class = 'close_title';
        	}
     		return '<div class="cosmo-toggle"><div class="'.$div_class.'"><h2 class="cosmo-toggle-h2"><a class="'.$ico_class.'"><span class="title_closed '.$title_closed_class.'">'.$title_open.'</span><span class="title_open '.$title_open_class.'" >'.$title_closed.'</span></a></h2></div><div class="cosmo-toggle-container '.$title_open_class.'"><div class="cosmo-toggle-container-margin">'.do_shortcode($content).'</div></div></div>';
        }
        
    	static function add_quote( $atts , $content ){
        	if(isset($atts['style']) ) {$style = $atts['style']; } else {$style = '';}
     		if(isset($atts['float']) ) {$float = $atts['float']; } else {$float = '';} 
        	return '<div class="cosmo-blockquote '.$style.' '.$float.' "><p>'.$content.'</p></div>';
        }
        
        
        /*Functions for columns shorcodes*/
    	static function de_twocol_one( $atts , $content ){ 
        	return  '<div class="twocol_one">'.do_shortcode($content).'</div>';
        }
        
    	static function de_twocol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="twocol_one first">'.do_shortcode($content).'</div>';
        }
    	static function de_twocol_one_last( $atts , $content ){ 
        	return  '<div class="twocol_one last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_threecol_one( $atts , $content ){ 
        	return  '<div class="threecol_one">'.do_shortcode($content).'</div>';
        }
    	static function de_threecol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="threecol_one first">'.do_shortcode(($content)).'</div>';
        }
    	static function de_threecol_one_last( $atts , $content ){ 
        	return  '<div class="threecol_one last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
 	   	static function de_threecol_two( $atts , $content ){ 
        	return  '<div class="threecol_two">'.do_shortcode($content).'</div>';
        }
        
    	static function de_threecol_two_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="threecol_two first">'.do_shortcode($content).'</div>';
        }
    	static function de_threecol_two_last( $atts , $content ){ 
        	return  '<div class="threecol_two last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fourcol_one( $atts , $content ){ 
        	return  '<div class="fourcol_one">'.do_shortcode($content).'</div>';
        }
    	static function de_fourcol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fourcol_one first">'.do_shortcode($content).'</div>';
        }
    	static function de_fourcol_one_last( $atts , $content ){ 
        	return  '<div class="fourcol_one last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fourcol_two( $atts , $content ){ 
        	return  '<div class="fourcol_two">'.do_shortcode($content).'</div>';
        }
    	static function de_fourcol_two_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fourcol_two first">'.do_shortcode($content).'</div>';
        }
        static function de_fourcol_two_last( $atts , $content ){ 
        	return  '<div class="fourcol_two last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fourcol_three( $atts , $content ){ 
        	return  '<div class="fourcol_three">'.do_shortcode($content).'</div>';
        }
    	static function de_fourcol_three_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fourcol_three first">'.do_shortcode($content).'</div>';
        }
    	static function de_fourcol_three_last( $atts , $content ){ 
        	return  '<div class="fourcol_three last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
   		static function de_fivecol_one( $atts , $content ){ 
        	return  '<div class="fivecol_one">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_one_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_one first">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_one_last( $atts , $content ){ 
        	return  '<div class="fivecol_one last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fivecol_two( $atts , $content ){ 
        	return  '<div class="fivecol_two">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_two_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_two first">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_two_last( $atts , $content ){ 
        	return  '<div class="fivecol_two last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fivecol_three( $atts , $content ){ 
        	return  '<div class="fivecol_three">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_three_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_three first">'.do_shortcode($content).'</div>';
        }
        static function de_fivecol_three_last( $atts , $content ){ 
        	return  '<div class="fivecol_three last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
        
    	static function de_fivecol_four( $atts , $content ){ 
        	return  '<div class="fivecol_four">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_four_first( $atts , $content ){ 
        	return  '<p class="clearfix"></p><div class="fivecol_four first">'.do_shortcode($content).'</div>';
        }
    	static function de_fivecol_four_last( $atts , $content ){ 
        	return  '<div class="fivecol_four last">'.do_shortcode($content).'</div><p class="clearfix"></p>';
        }
    }
?>