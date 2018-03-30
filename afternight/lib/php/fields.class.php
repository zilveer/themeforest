<?php
    class fields {
        static function layout( $field ){
            /* return field attributes */
            if( !is_array( $field ) || empty( $field ) ){
                return '';
            }

            foreach( $field as $attribut => $attribut_value ){
                $$attribut = $attribut_value;
            }

            /* if no specified type */
            if( !isset( $type ) ){
                return '';
            }

            /* return layout type from field type */
            $field_side = explode( '--' ,  $type );
            $layout_type = $field_side[ 0 ];

            /* generate label for field with $id */
            $field_id = isset( $id ) && strlen( $id ) ? $id  : '';

            $id = strlen( $field_id ) ? 'id="' . $field_id . '"' : '';

            $label_id = strlen( $field_id ) ? 'for="' . $field_id . '"' : '';

            $label = isset( $label ) ? '<label ' . $label_id . '>' . $label . '</label>' : '';

            $group = isset( $group ) ? $group : '';
            $topic = isset( $topic ) ? $topic : '';
            $index = isset( $index ) ? $index : '';

            $id     = isset( $id ) ? 'id="' . $id . '"' : '';

            $cid    = isset( $cid ) ? 'id="'.$cid.'"' : '';

            $hc     = isset( $hclass ) ? $hclass : '';
            $hint   = isset( $hint ) ? '<div class="generic-hint ' . $hc . '">' . $hint . '</div>': '' ;
            $help   = isset( $help ) ? '<span class="generic-help" ' . self::action( $help ) . '></span>': '' ;
   
            $classes = isset( $classes ) ? $classes : '';

            /* reset field type */
            $field['type'] = $field_side[ 1 ];

            $field_type    = str_replace( 'm-' , '' , $field_side[ 1 ] );

            $result = '';

            switch( $layout_type ){
                /*
                    fields layout type
                    --------------------------------------------------
                    cd--*   - HTML Code
                    no--*   - not use layout
                    ni--*   - not input type
                    st--*   - sdandard layout
                    sh--*   - short layoutsult .
                    ln--*   - in line layout

                    * - field type
                 */

                /* code type layout */
                case 'cd' : {
                    $result .= $content;
                    break;
                }
                /* without layout  */
                case 'no'  :{
                    $result .= self::field( $field );
                    break;
                }
                /* not input type  */
                case 'ni' : {
                    $result .= '<div class="standard-generic-field generic-field-' . $group . ' ' . $classes . '">';
                    $result .= '<div class="generic-field full" ' . $cid . '>' . self::field( $field ) . $help . $hint . '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }
                /* standard layout  */
                case 'st' : {
                    
                    $result .= '<div class="standard-generic-field generic-field-' . $group . ' ' . $classes . '">';
                    $result .= '<div class="generic-label">'. $label .'</div>';
                    $result .= '<div class="generic-field generic-field-' . $field_type  . '" ' . $cid . '>' . self::field( $field ) . $help . $hint . '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }

                /* standard layout with 'custom-meta-container' div before it  
                    stcm - standard custom meta
                */
                case 'stcm' : {
                    $unique_class = $group.'_'.$topic;

                    $result .= '<div class="standard-generic-field  custo-container-sortable  '.$unique_class.'">';
                    if(is_array($value) && sizeof($value)){
                        foreach ($value as $key => $val) {
                            $unique_class_label = $unique_class.'_'.trim(str_replace(' ', '_', $key));

                            $result .=' <div class="custom-field-holder '.$unique_class_label.'">
                                            <div class="generic-label draggable_area" title="'.__('Drag this row to sort the fields','cosmotheme').'">
                                                <label>'.$key.'</label>
                                            </div>
                                            <div class="generic-field generic-field-text"> 
                                                <input type="text" name="'.$group.'['.$topic.']['.$key.']" value="'.htmlspecialchars($val).'" class="generic-record  generic-info"> 
                                                <a href="javascript:deleteCustomField(\''.$group.'\',\''.$topic.'\',\''.trim(str_replace(' ', '_', $key)).'\')">'.__('Delete','cosmotheme').'</a>
                                            </div>  
                                            <div class="clear"></div>  
                                        </div>';
                        }
                    }
                    $result .= '</div>';
                    
                    $result .= '<div class="standard-generic-field generic-field-' . $group . ' ' . $classes . '">';
                    $result .= '<div class="generic-label">'. $label .'</div>';
                    $result .= '<div class="generic-field generic-field-' . $field_type  . '" ' . $cid . '>' . self::field( $field ) . $help . $hint . '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    break;
                }
                
                /* short layout */
                case 'sh' : {
                    $result .= '<div class="short-generic-field generic-field-' . $group . ' ' . $classes . '">';
                    $result .= '<div class="generic-label">'. $label .'</div>';
                    $result .= '<div class="generic-field generic-field-' . $field_type  . '" ' . $cid . '>' . self::field( $field ) . $help . $hint . '</div>';
                    $result .= '</div>';
                    break;
                }
                /* in line layout */
                case 'ln' : {
                    $result .= '<span class="inline-generic-field generic-field-' . $group . ' ' . $classes . '">';
                    $result .= '<span class="generic-label">'. $label .'</span>';
                    $result .= '<span class="generic-field generic-field-' . $field_type  . '" ' . $cid . '>' . self::field( $field ) . $help . $hint . '</span>';
                    $result .= '</span>';
                    break;
                }

                case 'ex' : {
                    $result .= '<div class="extra-generic-group extra-generic-' . $group . '" ' . $cid . '>';
                    $result .= extra::get( $group );
                    $result .= '</div>';
                    break;
                }
            }

            return $result;
        }

        static function field( $field ){
            /* return field attributes */
            foreach( $field as $attribut => $attribut_value ){
                $$attribut =  $attribut_value;
            }

            if(isset($name_format) && $name_format =='exact_name'){ 
                /*we need this for not updatable settings , for example it is used on post Skins settings where we need the color pickers 
                    to have the exact given name without appending the group name to it
                */
                $name       = isset( $single ) ?  $topic : $topic ;
            }else{
                /* otherwise the neme is composed from group & topic */
                $name       = isset( $single ) ?  $topic : $group . '[' . $topic . ']';
            }
            
            $name_id    = isset( $single ) ?  $topic . '_id' : $group . '[' . $topic . '_id]';
            $iname      = isset( $topic ) ? $topic : '';
            $classes    = isset( $iclasses ) ? $iclasses  : '';
            $field_id   = isset( $id ) ? $id  : '';
            
            $id         = strlen( $field_id ) ? 'id="' . $field_id . '"' : '';
            $result_id  = strlen( $field_id ) ? 'id="' . $field_id . '_result"' : '';

            $group = isset( $group ) ? $group : '';
            $topic = isset( $topic ) ? $topic : '';
            $index = isset( $index ) ? $index : '';
            
            /* field classes */
            $fclasses   = 'generic-' . $group . ' generic-' . $topic . ' ' . $group . '-' . $topic . ' ' . $group . '-' . $topic . '-' . $index;

            $action = isset( $action ) ? $action : '';

            $result = '';
            
            switch( $type  ){
                /* no input type */
                case 'delimiter' : {
                    $result .= '<hr>';
                    break;
                }
                case 'title' : {
                    $result .= '<h3 class="generic-record-title '  . $fclasses .  '" >' . $title . '</h3>';
                    break;
                }
                case 'hint' : {
                    $result .= $value;
                    break;
                }
                case 'preview' : {
                    $result .= $content;
                    break;
                }
                case 'image' : {
                    $width  .= isset( $width ) ? ' width="' . $width . '" ' : '';
                    $heigt  .= isset( $heigt ) ? ' height="' . $height . '" ' : '';
                    $result .= '<div class="generic-record-icon '  . $fclasses .  '" ><img src="' . $src  . '" ' . $width . $height . ' class="generic-record  '  . $fclasses .  '"/></div>';
                    break;
                }

                case 'color-picker' : {
                    $result .= '<input type="text" name="' . $name . '" id="pick_' . $iname . '" value="' .  $value . '" class="generic-record settings-color-field '  . $fclasses .  ' ' . $classes . '" />';
                    break;
                }

                case 'm-color-picker' : {
                    $result .= '<input type="text" name="' . $name . '[]" id="pick_' . $iname . '" value="' .  $value . '" class="generic-record settings-color-field '  . $fclasses .  ' ' . $classes . '" />';
                    break;
                }

                case 'extra' : {
                    $result .= '<div id="container_' . $group . '">' . extra::get( $group ) . '</div>';
                    break;
                }

                case 'post-upload' : {
                    $result .= '<a class="thickbox" href="media-upload.php?post_id=' . $post_id  . '&type=image&TB_iframe=1&width=640&height=381">' . $title . '</a>';
                    break;
                }

				case "form-upload-init":
				  $result.='<div id="hidden_inputs_container" class="">';
				  $result.='</div>';
				  $result.='<script type="text/javascript">';
				  $result.='window.update_hidden_inputs=function(ids,type,urls,feat_vid)';
				  $result.="{";
					$result.='jQuery("#hidden_inputs_container").html("");';
					$result.='jQuery("#hidden_inputs_container").append("<input type=\\"hidden\\" name=\\"attachments_type\\" value=\\""+type+"\\">");';
					$result.='var i;';
					$result.='for(i=0;i<ids.length;i++)';
					  $result.="{";
						$result.='jQuery("#hidden_inputs_container").append("<input type=\\"hidden\\" name=\\"attachments[]\\" value=\\""+ids[i]+"\\">");';
						$result.="if(urls){";
						  $result.="if(urls[ids[i]]){";
							$result.='jQuery("#hidden_inputs_container").append("<input type=\\"hidden\\" name=\\"attached_urls["+ids[i]+"]\\" value=\\""+urls[ids[i]]+"\\">");';
						  $result.="}";
						$result.="}";
					  $result.="}";
					$result.="if(feat_vid){";
					  $result.='jQuery("#hidden_inputs_container").append("<input type=\\"hidden\\" name=\\"featured_video\\" value=\\""+feat_vid+"\\">");';
					$result.="}";
				  $result.="}";
				  $result.='</script>';
				  break;
				case "form-upload" :
				  $result.='<iframe id="'.$format.'_upload_iframe"  class="upload_iframe" src="'.get_template_directory_uri().'/upload_iframe.php?isadmin=true&type='.$format.(isset($post_id)?('&post='.$post_id):"").'"></iframe>';
				break;

                case 'link' : {
                    $result .= '<a href="' . $url  . '">' . $title . '</a>';
                    break;
                }

                case 'callback' : {
                    $result .= '<span ' . $id . '> -- </span>';
                    break;
                }

                case 'radio' : {
                    if( !isset( $ivalue ) && isset( $cvalue ) ){
                        $ivalue = $cvalue;
                    }
                    foreach( $value as $index => $etichet ){
                        if( isset( $ivalue ) && $ivalue == $index ){
                            $status = ' checked="checked" ' ;
                        }else{
                            $status = '' ;
                        }
                        $result .= '<label for="' . $name . '_' . $index . '" class="menu_type_' . $index . '">';
                            $result .= '<input name="' . $name . '" type="radio" value="' . $index . '" ' . $status . ' class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'select' ) . '>' . $etichet . '<br>';
                        $result .= '</label>';
                    }
                    break;
                }

                case 'slider' :{
                    $result .= '<div class="fvisible field">';

                    $result .= '<div  class="input">';
                    $result .= '<input  type="hidden" id="' . $id . '" class="slider_value '.$classes.'" name="' . $name . '" value="' . stripslashes( $value ) . '" />';
                    $result .= '<div class="ui_slider" data-val="'.stripslashes( $value ).'" data-min="1" data-max="100" ></div> <span class="slider_val" >'.stripslashes( $value ).'</span>';
                    
                    // if(isset($hint)){
                    //     $result .= '<span class="hint">'.$hint.'</span>';    
                    // }
                    $result .= '</div>';
                    $result .= '<div class="clear"></div>';
                    $result .= '</div>';
                    $result .= '<script>init_ui_slider(\'.ui_slider\');</script>';
                    
                    break;
                } 
                
                case 'header-preview':
                    global $is_for_backend;
                    $is_for_backend = true;
                    wp_enqueue_style( 'header-preview-styles', get_template_directory_uri() . '/lib/css/header.css' );
                    $label = __( 'Preview' , 'cosmotheme' );
                    $header_types = options::$fields[ 'header' ][ 'header_type' ][ 'images' ];
                    $menu_types = options::$fields[ 'header' ][ 'menu_type' ][ 'images' ];
                    $result .= '<div class="header-preview-wrapper container">';
                        $result .= '<div class="header-preview">';
                            $result .= '<div class="header-mask"></div>';
                            $result .= "<h3>$label</h3>";
                            $result .= '<div class="header-slider">';
                                foreach( $header_types as $header_type => $whatever ){
                                    $header = new CustomHeader( $header_type );
                                    $result .= $header;
                                }
                            $result .= '</div>';
                            $result .= '<div class="menus-container">';
                                foreach( $menu_types as $menu_type => $whatever ){
                                    $menu = new CosmoCustomHeaderMenu( $menu_type );
                                    $result .= $menu;
                                }
                            $result .= '</div>';
                        $result .= '</div>';
                    $result .= '</div>';
                break;

                case 'image-select':
                    $html = '';
                    foreach( $images as $val => $image_url ){
                        $full_url = get_template_directory_uri() . '/lib/images/header_thumbs/' . $image_url;
                        if( $value == $val ){
                            $checked = 'checked="checked"';
                        }else{
                            $checked = '';
                        }
                        $label = $labels[ $val ];
                        $html .= <<<endhtml
                            <a class="has-popup" href="javascript:void(0);">
                                <label for="${topic}_$val">
                                    <img src="${full_url}">
                                    <input type="radio" value="$val" id="${topic}_$val" name="$name" class="$fclasses $classes hidden" $checked>
                                </label>
                                <div class="popup">
                                    <div class="maybe-pointer"></div>
                                    $label
                                </div>
                            </a>
endhtml;
                    }
                    $result .= $html;
                break;

                case 'radio-icon' : {
                    if( is_array( $value ) && !empty( $value ) ){
                        $path   = isset( $path ) ? $path : '';
                        $in_row = isset( $in_row ) ? $in_row : 8;
                        $i = 0;
                        foreach( $value  as $index => $icon ){
                            if( $i == 0 ){
                                $result .= '<div>';
                            }
                                if( isset( $ivalue ) &&  $ivalue == get_template_directory_uri() . '/lib/images/' . $path . $icon ){
                                        $s = 'checked="checked"';
                                        $sclasses = 'selected';
                                }else{
                                        $s = '';
                                        $sclasses = '';
                                }
                                $action['group'] = $group;
                                $action['topic'] = $topic;
                                $action['index'] = $index;

                                $result .= '<div class="generic-input-radio-icon ' . $index . ' hidden">';
                                $result .= '<input type="radio" value="' . get_template_directory_uri() . '/lib/images/' . $path . $icon . '" name="' . $name . '" class="generic-record  hidden ' . $fclasses . $index. ' ' . $classes . '" ' . $id . ' ' . $s . '>';
                                $result .= '</div>';
                                $result .= '<img ' . self::action( $action , 'radio-icon' ) . ' title="' . $icon . '" class="pattern-texture '. $sclasses . ' ' . $fclasses . $index. '" alt="' . $icon . '" src="' . get_template_directory_uri() . '/lib/images/' . $path . $icon . '" />';
                            $i++;
                            if( $i % $in_row == 0 ){
                                $i = 0;
                                $result .='<div class="clear"></div></div>';
                            }
                        }

                        if( $i % $in_row != 0){
                            $result .='<div class="clear"></div></div>';
                        }
                    }
                    break;
                }

                case 'our_themes' :{ 
                    ob_start(); 
                    ob_clean();
                    get_template_part( '/lib/templates/our_themes' );
                    $our_themes = ob_get_clean();
                    $result .= $our_themes;

                    break;
                }

                /*case 'layout-builder' :
                        $builder = new LBTemplateBuilder( $group );
                        $builder -> render();
                    break;*/

                case 'sidebar-resizer':
                        $resizer = new LBSidebarResizer( $templatename );
                        $result .= $resizer -> render();

                        /*we want to output the Bulk update post layout button only for the followinf templates*/
                        /*array key is the template name (the name of the tab from layout settings page), and array value is the post type*/
                        $templates_to_update_layout = array('single'=>'post', 'portfolio' => 'portfolio', 'event' => 'event', 'page' => 'page');
                        if(array_key_exists($templatename, $templates_to_update_layout) ){
                            $result .= '<button class="update_post_layout_meta" data-template="'.$templatename.'" data-post-type="'.$templates_to_update_layout[$templatename].'"   >'.__('Update all posts','cosmotheme').'</button>'; 
                            $result .= '<span class="spinner bulk_update_post_layout" style="display: none;"></span>';
                            $result .= '<span class="hint error">'.__('Warning!!! This will update all existing posts of this type with the layout settings defined above. Use this button only if you really need to bulk update the layout for all the existing posts. If you want to affect the future posts as well, use the "Update settings" button bellow.','cosmotheme').'</span>';   
                        }
                    break;

                case 'logic-radio' : {
                    
                    /*for non array meta data we want to ovewrite $value with 'yes' and 'no'*/
                    
                    if(isset($no_array) && $no_array ){
                        if(isset($value) && ($value == 'y' || $value == 'n') ){
                            if($value == 'n'){
                                $value = 'no';    
                            }else if($value == 'y'){
                                $value = 'yes';    
                            }
                            
                        }
                        
                    }

                    if( $value == 'yes' ){
                        $c1 = 'checked="checked"';
                        $c2 = '';
                    }else{
                        if( $value == 'no' ){
                            $c1 = '';
                            $c2 = 'checked="checked"';
                        }else{
                            if( isset( $cvalue ) ){
                                if( $cvalue == 'yes' ){
                                    $c1 = 'checked="checked"';
                                    $c2 = '';
                                }else{
                                    $c1 = '';
                                    $c2 = 'checked="checked"';
                                }
                            }else{
                                $c1 = '';
                                $c2 = 'checked="checked"';
                            }
                        }
                    }

                    $result  = '<input type="radio" value="yes" name="' . $name . '" class="generic-record  '  . $fclasses .  ' ' . $classes . ' yes" ' . $id . ' ' . $c1 . ' ' . self::action( $action , 'logic-radio' ) . ' /> ' . __( 'Yes' , 'cosmotheme' ) . '&nbsp;&nbsp;&nbsp;';
                    $result .= '<input type="radio" value="no" name="' . $name . '" class="generic-record  '  . $fclasses .  ' ' . $classes . ' no" ' . $id . ' ' . $c2 . ' ' . self::action( $action , 'logic-radio' ) . ' /> ' . __( 'No' , 'cosmotheme' );
                    break;
                }

                case 'label-logic-radio' : {
                    if( $value == 'yes' ){
                        $c1 = 'checked="checked"';
                        $c2 = '';
                    }else{
                        if( $value == 'no' ){
                            $c1 = '';
                            $c2 = 'checked="checked"';
                        }else{
                            if( isset( $cvalue ) ){
                                if( $cvalue == 'yes' ){
                                    $c1 = 'checked="checked"';
                                    $c2 = '';
                                }else{
                                    $c1 = '';
                                    $c2 = 'checked="checked"';
                                }
                            }else{
                                $c1 = '';
                                $c2 = 'checked="checked"';
                            }
                        }
                    }

                    $result  = '<input type="radio" value="yes" name="' . $name . '" class="generic-record  '  . $fclasses .  ' ' . $classes . ' yes" ' . $id . ' ' . $c1 . ' ' . self::action( $action , 'logic-radio' ) . ' /> ' . $rlabel[0] . '&nbsp;&nbsp;&nbsp;';
                    $result .= '<input type="radio" value="no" name="' . $name . '" class="generic-record  '  . $fclasses .  ' ' . $classes . ' no" ' . $id . ' ' . $c2 . ' ' . self::action( $action , 'logic-radio' ) . ' /> ' . $rlabel[1];
                    break;
                }

                /* single type records */
                case 'hidden' : {
                    $result .= '<input type="hidden" name="' . $name . '" value="' . $value . '" class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . '  />';
                    break;
                }
                case 'text' : {
                    $result .= '<input type="text" name="' . $name . '" value="' . $value . '" class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'text' ) . ' />';
                    break;
                }

                case 'user_defined_text' : {

                    /*
                    'group' is defined when field is added in the code by the developer
                    'topic' is defined by the user 
                    */
                    $unique_class = $group.'_'.$topic; /*group with topic will create a unique class for our custom meta blocks*/
                    
                    $result .= '<input type="text" value="" class="custom-meta-name generic-record '.$unique_class.'" /> <input type="button" class="button-primary" value="'.__('Add custom field','cosmotheme').'" onclick="add_cosmo_custom_field(\'custom_cosmo_meta\',\''.$group.'\', \''.$topic.'\')">';
                    break;
                }

                case 'digit' : {
                    if( ( isset( $cvalue) && is_numeric( $cvalue ) ) && ( !isset( $value ) || !is_numeric( $value ) ) ){
                        $val = $cvalue;
                    }else{
                        $val = $value;
                    }
                    $result .= '<input type="text" name="' . $name . '" value="' . $val . '" class="generic-record  digit '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'text' ) . ' />';
                    break;
                }
                
                case 'digit-like' : {
                    $result .= '<input type="text" name="' . $name . '" value="' . $value . '" class="generic-record  digit like '  . $fclasses .  ' ' . $classes . '" ' . $id . ' />';
                    $result .= '<input type="button" name="' . $name . '" value="' . __( 'Reset Value' , 'cosmotheme' ) . '" class="generic-record-button  button-primary" ' . self::action( $action , 'digit-like' ) . ' /> <span class="digit-btn result"></span>';
                    break;
                }
                
                case 'textarea' : {
                    $result .= '<textarea name="' . $name . '" class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'textarea' ) . '>' . $value . '</textarea>';
                    break;
                }

                case 'radio' : {
                    if( isset( $iname ) && $iname == $value ){
                        $status = ' checked="checked" ' ;
                    }else{
                        $status = '' ;
                    }

                    $name = isset( $single ) ? $iname : $group . '[' . $iname . ']';

                    $result .= '<input type="radio" name="' . $name . '" value="' . $value . '"  ' . $status . ' class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'radio' ) . ' />';
                    break;
                }
                
                case 'search' : {
                    if( !empty( $value ) && (int)$value > 0 ){
                        $p = get_post( $value );
                        $title = $p -> post_title;
                        $post_id = $p -> ID;
                    }else{
                        $title = '';
                        $post_id = '';
                    }
                    
                    $result .= '<input type="text" class="generic-record-search" value="' . $title . '" ' . self::action( $action , 'search' ) . '>';
                    $result .= '<input type="hidden" name="' . $name . '" class="generic-record generic-value  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' value="' . $post_id . '" />';
                    $result .= '<input type="hidden" class="generic-params" value="' . urlencode( json_encode( $query ) ) . '" />';
                    break;
                }

                 case 'datetimepicker' : {  /*outputs a datepicker with timepicker */
                    
                    $result .= '<input type="text" name="' . $name . '"   value="'.$value.'" class="DateTimePicker generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'datetimepicker' ) . '>';
                    
                    break;
                }

                case 'select' : {
                    $result .= '<select  name="' . $name . '" class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'select' ) . ' >';
                    if( !isset( $ivalue ) && isset( $cvalue ) ){
                        $ivalue = $cvalue;
                    }
                    foreach( $value as $index => $etichet ){
                        if( isset( $ivalue ) && $ivalue == $index ){
                            $status = ' selected="selected" ' ;
                        }else{
                            $status = '' ;
                        }

                        $result .= '<option value="' . $index . '" ' . $status . ' >' . $etichet . '</option>';
                    }
                    $result .= '</select>';
                    break;
                }

                case 'preview-select' : {
                    $result .= '<select  name="' . $name . '" class="generic-record  '  . $fclasses  . ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'select' ) . ' >';
                    if( !isset( $ivalue ) && isset( $cvalue ) ){
                        $ivalue = $cvalue;
                    }
                    foreach( $value as $index => $etichet ){
                        if( isset( $ivalue ) && $ivalue == $index ){
                            $status = ' selected="selected" ' ;
                        }else{
                            $status = '' ;
                        }

                        $result .= '<option value="' . $index . '" ' . $status . ' >' . $etichet . '</option>';
                    }
                    $result .= '</select>';
                    $result .= '<div class="preview ' . $ivalue . '">';
                    $result .= '</div>';
                break;
                }

                case 'multiple-select' : {
                    $result .= '<select  name="' . $name . '[]" multiple="multiple" class="generic-record  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'multiple-select' ) . ' style="height:200px !important;" >';
                    foreach( $value as $index => $etichet ){
                        if( isset( $ivalue ) && is_array( $ivalue ) && in_array( $index , $ivalue) ){
                            $status = ' selected="selected" ' ;
                        }else{
                            $status = '' ;
                        }

                        $result .= '<option value="' . $index . '" ' . $status . ' >' . $etichet . '</option>';
                    }
                    $result .= '</select>';
                    break;
                }

                case 'checkbox' : {
                    if( isset( $iname ) && $iname == $ivalue ){
                        $status = ' checked="checked" ' ;
                    }else{
                        $status = '' ;
                    }

                    $result .= '<input type="checkbox" name="' . $name . '" value="' . $iname . '"  ' . $status . ' class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'checkbox' ) . ' />';
                    break;
                }

                case 'button' : {
                    $result .= '<input type="button" name="' . $name . '" value="' . $value . '" class="generic-record-button  button-primary  ' . $classes . '" ' . $id . ' ' . self::action( $action , 'button' ) . ' /> <span class="btn result"></span>';
                    break;
                }

                case 'attach' : {
                    //'action' => "meta.save_data('presentation','speaker' , extra.val('select#field_attach_presentation'), [ { 'name':'speaker[idrecord][]' , 'value' : extra.val('select#field_attach_presentation') } ] );"
                    $action['res'] = $group;
                    $action['group'] = $res;
                    $action['post_id']  = $post_id;
                    $action['attach_selector'] = $attach_selector;
                    if( !isset( $selector ) ){
                        $selector = 'div#' . $res . '_' . $group . ' div.inside div#box_' . $res . '_' . $group;
                    }
                    $action['selector'] = $selector;
                    $result .= '<input type="button" name="' . $name . '" value="' . $value . '" class="generic-record-button  button-primary  ' . $classes . '" ' . $id . ' ' . self::action( $action , 'attach' ) . ' /> <p id="attach_' . $res . '_' . $group . '" class="attach_alert hidden">'.__( ' Attached ' , 'cosmotheme' ).'</sp>';
                    break;
                }

                case 'meta-save' : {
                    $action['res']      = $res;
                    $action['group']    = $group;
                    $action['post_id']  = $post_id;
                    $action['selector'] = $selector;
                    $result .= '<input type="button" name="' . $name . '" value="' . $value . '" class="generic-record-button  button-primary  ' . $classes . '" ' . $id . ' ' . self::action( $action , 'meta-save' ) . ' />';
                    break;
                }

                case 'upload' : {
                    $result .= '<input type="text" name="' . $name . '"  value="' . $value  . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' /><input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" ' . self::action( $field_id , 'upload' ) . ' />';
                    break;
                }
                
                case 'generate' : {
                    $result .= '<input type="text" name="' . $name . '"  value="' . $value  . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' /><input type="button" class="button-primary" value="'.__('Generate Key','cosmotheme').'" ' . self::action( '?t=' . security::t().'&amp;n=' . security::n() , 'generate' ) . ' />';
                    break;
                }

                case 'upload-id' :{
                    
                    $action['group'] = $group;
                    $action['topic'] = $topic;
                    $action['index'] = $index;

                    $result .= '<input type="text" name="' . $name . '" value="' . $value . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . '  /><input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" ' . self::action( $action , 'upload-id' ) . ' />';
                    $result .= '<input type="hidden" name="' . $name_id . '" id="' . $field_id . '_id"  class="generic-record generic-single-record '  . $fclasses .  '" value="' . $value_id . '"/>';
                    break;
                }

                /* multiple type records */
                case 'm-hidden' : {
                    $result .= '<input type="hidden" name="' . $name . '[]" value="' . $value . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . '  />';
                    break;
                }
                case 'm-text' : {
                    $result .= '<input type="text" name="' . $name . '[]" value="' . $value . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'text' ) . ' />';
                    break;
                }
                case 'm-digit' : {
                    $result .= '<input type="text" name="' . $name . '[]" value="' . $value . '" class="generic-record digit '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'text' ) . ' />';
                    break;
                }
                case 'm-textarea' : {
                    $result .= '<textarea name="' . $name . '[]" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'textarea' ) . '>' . $value . '</textarea>';
                    break;
                }

                case 'm-radio' : {
                    if( isset( $iname ) && $iname == $value ){
                        $status = ' checked="checked" ' ;
                    }else{
                        $status = '' ;
                    }

                    $name = isset( $single ) ? $iname : $group . '[' . $iname . ']';

                    $result .= '<input type="radio" name="' . $name . '[]" value="' . $value . '"  ' . $status . ' class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'radio' ) . ' />';
                    break;
                }
                
                case 'm-search' : {
                    if( !empty( $value ) && (int)$value > 0 ){
                        $p = get_post( $value );
                        $title = $p -> post_title;
                        $post_id = $p -> ID;
                    }else{
                        $title = '';
                        $post_id = '';
                    }
                    
                    $result .= '<input type="text"  class="generic-record-search" value="' . $title . '" ' . self::action( $action , 'search' ) . '>';
                    $result .= '<input type="hidden" name="' . $name . '[]" class="generic-record generic-value  '  . $fclasses .  ' ' . $classes . '" ' . $id . ' value="' . $post_id . '" />';
                    $result .= '<input type="hidden" class="generic-params" value="' . urlencode( json_encode( $query ) ) . '" />';
                    break;
                }

                case 'm-select' : {
                    $result .= '<select  name="' . $name . '[]" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'select' ) . ' >';
                    foreach( $value as $index => $etichet ){
                        if( isset( $ivalue ) && $ivalue == $index ){
                            $status = ' selected="selected" ' ;
                        }else{
                            $status = '' ;
                        }

                        $result .= '<option value="' . $index . '" ' . $status . ' >' . $etichet . '</option>';
                    }
                    $result .= '</select>';
                    break;
                }

                case 'm-multiple-select' : {
                    $result = '<select  name="' . $name . '[]" multiple="multiple" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'multiple-select' ) . ' >';
                    foreach( $value as $index => $etichet ){
                        if( isset( $ivalue ) && is_array( $ivalue ) && in_array( $index , $ivalue) ){
                            $status = ' selected="selected" ' ;
                        }else{
                            $status = '' ;
                        }

                        $result .= '<option value="' . $index . '" ' . $status . ' >' . $etichet . '</option>';
                    }
                    $result .= '</select>';
                    break;
                }

                case 'm-checkbox' : {
                     if( isset( $iname ) && $iname == $value ){
                        $status = ' checked="checked" ' ;
                    }else{
                        $status = '' ;
                    }

                    $result .= '<input type="checkbox" name="' . $name . '[]" value="' . $value . '"  ' . $status . ' class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' ' . self::action( $action , 'checkbox' ) . ' />';
                    break;
                }
                case 'm-upload' : {
                    $result .= '<input type="text" name="' . $name . '[]"  value="' . $value  . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . ' /><input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" ' . self::action( $field_id , 'upload' ) . ' />';
                    break;
                }

                case 'm-upload-id' :{

                    $action['group'] = $group;
                    $action['topic'] = $topic;
                    $action['index'] = $index;

                    $result .= '<input type="text" name="' . $name . '[]" value="' . $value . '" class="generic-record '  . $fclasses .  ' ' . $classes . '" ' . $id . '  /><input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" ' . self::action( $action , 'upload-id' ) . ' />';
                    
                    $result .= '<input type="hidden" name="' . $name_id . '[]" id="' . $field_id . '_id"  class="generic-record '  . $fclasses .  '" />';
                    break;
                }
            }
            
            return $result;
        }

        static function action( $action , $type ){

            if( empty( $action ) ){
                return '';
            }
            
            $result = '';
            switch( $type ){
                case 'text' : {
                    $result = 'onkeyup="javascript:' . $action . ';"';
                    break;
                }
                case 'radio-icon' : {
                    $result = 'onclick="javascript:act.radio_icon(\'' . $action['group'] . '\' , \'' . $action['topic'] . '\' ,  \'' . $action['index'] . '\' );"';
                    break;
                }
                case 'textarea' : {
                    $result = 'onkeyup="javascript:' . $action . ';"';
                    break;
                }
                case 'radio' : {
                    $result = 'onclick="javascript:' . $action . ';"';
                    break;
                }
                case 'checkbox' : {
                    $result = 'onclick="javascript:' . $action . ';"';
                    break;
                }
                
                case 'search' : {
                    $result = 'onchange="javascript:' . $action . ';"';
                    break;
                }
                
                case 'datetimepicker' : {
                    $result = 'onchange="javascript:' . $action . ';"';
                    break;
                }

                case 'select' : {
                    $result = 'onchange="javascript:' . $action . ';"';
                    break;
                }
                case 'logic-radio' : {
                    $result = 'onclick="javascript:' . $action . ';"';
                    break;
                }
                case 'm-select' : {
                    $result = 'onchange="javascript:' . $action . ';"';
                    break;
                }
                case 'button' : {
                    $result = 'onclick="javascript:' . $action . ';"';
                    break;
                }
                case 'digit-like' : {
                    $result = 'onclick="javascript:' . $action . ';"';
                    break;
                }
                case 'meta-save' : {
                    $result = 'onclick="javascript:meta.save(\'' . $action['res'] . '\' , \'' . $action['group'] . '\' , '.$action['post_id'].' , \''.$action['selector'].'\' );meta.clear(\'.generic-' . $action['group'] . '\');"';
                    break;
                }
                case 'attach' : {
                    $result = 'onclick="javascript:meta.save_data(\'' . $action['res'] . '\' , \'' . $action['group'] . '\' , extra.val(\''.$action['attach_selector'].'\') , [ { \'name\' : \''.$action['group'].'[idrecord][]\' , \'value\' : ' . $action['post_id'] . ' }] , \''.$action['selector'].'\' );"';
                    break;
                }
                case 'upload' : {
                    $result = 'onclick="javascript:act.upload(\'input#' . $action . '\' );"';
                    break;
                }
                case 'generate' : {
                    $result = 'onclick="javascript:act.generate( \'' . $action . '\' );"';
                    break;
                }
                case 'upload-id' : {
					if(isset($action['upload_url']) && $action['upload_url'] != ''){  
						$upload_url =  $action['upload_url'];
					}else{
						$upload_url =  '';
					}	
                    $result = 'onclick="javascript:act.upload_id(\'' . $action['group'] . '\' , \'' . $action['topic'] . '\' , \''.$action['index'].'\',\''.$upload_url.'\' );"';
                    break;
                }

                case 'extern-upload-id' : {
					if(isset($action['upload_url']) && $action['upload_url'] != ''){
						$upload_url =  $action['upload_url'];
					}else{
						$upload_url =  '';
					}
                    $result = 'onclick="javascript:act.extern_upload_id(\'' . $action['group'] . '\' , \'' . $action['topic'] . '\' , \''.$action['index'].'\',\''.$upload_url.'\' );"';
                    break;
                }

			  case "":
			  break;
            }

            return $result;
        }
        
        static function digit_array( $to , $from = 0 , $twodigit = false ){
            $result = array();
            for( $i = $from; $i < $to + 1; $i ++ ){
                if( $twodigit ){
                    $i = (string)$i;
                    if( strlen( $i ) == 1 ){
                        $i = '0' . $i;
                    }
                    $result[$i] = $i;
                }else{
                    $result[$i] = $i;
                }
            }

            return $result;
        }

        static function months_array( ){
            $result = array(
                '01' =>  __( 'January' , 'cosmotheme' ),
                '02' =>  __( 'February', 'cosmotheme' ),
                '03' =>  __( 'March' , 'cosmotheme' ),
                '04' =>  __( 'April', 'cosmotheme' ),
                '05' =>  __( 'May', 'cosmotheme' ),
                '06' =>  __( 'June', 'cosmotheme' ),
                '07' =>  __( 'July', 'cosmotheme' ),
                '08' =>  __( 'August', 'cosmotheme' ),
                '09' =>  __( 'September', 'cosmotheme' ),
                '10' =>  __( 'October', 'cosmotheme' ),
                '11' =>  __( 'November', 'cosmotheme' ),
                '12' =>  __( 'December', 'cosmotheme' )
            );

            return $result;
        }

        static function monts_days_array( $month , $year  ){
            $days = date( 't' , mktime( 0 , 0 , 0 , $month, 0 , $year, 0 ) );
            return self::digit_array( $days , 1 , true );
        }
    }
?>