<?php
	class meta{

        static function get_input_ID( $res , $box , $id , $name ){
            return $res . '_' . $box . '_' . $name . $id;
        }

        static function get_no_attachment( $attach_type , $size ){
            $result = '';
            switch( $attach_type ){
                case 'image' : {
                    $result = get_template_directory_uri() . '/lib/images/no.image.' . $size[0] . 'x' . $size[1] . '.png';
                    break;
                }
                case 'music' : {
                    $result = get_template_directory_uri() . '/lib/images/no.music.' . $size[0] . 'x' . $size[1] . '.png';
                    break;
                }

                case 'video' : {
                    $result = get_template_directory_uri() . '/lib/images/no.video.' . $size[0] . 'x' . $size[1] . '.png';
                    break;
                }
            }

            return $result;
        }

        static function get_attachment_post( $record , $size ){
            if(isset($_GET['post_id'])){
            $src = array();
            if( isset( $record['type_res'] ) ){
                if( $record['type_res'] == 'post' ){
                    $src = wp_get_attachment_image_src( get_post_thumbnail_id( (int)$record[ 'resources'] ) , $size , true );
                }
            }

            if( !empty( $src ) && isset( $src[1] ) && isset( $src[2] ) ){
                if( (int) $src[1] * (int)$src[2] > 0 ){
                    return $src[0];
                }
            }
            return '';
            }
        }

        static function get_attachment( $struct , $res , $box , $post_id ,  $index , $name , $value , $attach_type , $size , $extra = '' ){
            $result = '';
            switch( $attach_type ){
                case 'background-image' : {
                    if( empty( $value ) ){
                        $value = self::get_no_attachment( $attach_type , $size );
                    }
                    $meta = self::get_meta(  $post_id , $box );
                    $record = $meta[ $index ];
                    $ivalue = self::get_attachment_post( $record , $size );

                    if( isset( $struct['icon-column']['name'] ) && $struct['icon-column']['name'] == $name ){
                        
                        if( isset( $record[ $name.'_id'] ) && $record[ $name.'_id'] > 0 ){
                            $src = wp_get_attachment_image_src( (int)$record[ $name.'_id'] , $size , true );
                            if( (int) $src[1] * (int)$src[2] > 0 ){
                                $result .= '<img src="' . $src[0] . '">';
                            }else{
                                $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                            }
                        }else{
                            if( strlen( $ivalue ) ){
                                $result .= '<img  src="' . $ivalue . '" />';
                            }else{
                                $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                            }
                        }
                    }else{ 
                        if( strlen( $ivalue ) ){
                            $result .= '<img  src="' . $ivalue . '" />';
                        }else{
                            $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                        }
                    }
                    break;
                }
                case 'image' : {
                    if( empty( $value ) ){
                        $value = self::get_no_attachment( $attach_type , $size );
                    }
                    $meta = self::get_meta(  $post_id , $box );
                    $record = $meta[ $index ];
                    $ivalue = self::get_attachment_post( $record , $size );

                    if( isset( $struct['icon-column']['name'] ) && $struct['icon-column']['name'] == $name ){
                        
                        if( isset( $record[ $name.'_id'] ) && $record[ $name.'_id'] > 0 ){
                            $src = wp_get_attachment_image_src( (int)$record[ $name.'_id'] , $size , true );
                            if( (int) $src[1] * (int)$src[2] > 0 ){
                                $result .= '<img src="' . $src[0] . '">';
                            }else{
                                $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                            }
                        }else{
                            if( strlen( $ivalue ) ){
                                $result .= '<img  src="' . $ivalue . '" />';
                            }else{
                                $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                            }
                        }
                    }else{ 
                        if( strlen( $ivalue ) ){
                            $result .= '<img  src="' . $ivalue . '" />';
                        }else{
                            $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                        }
                    }
                    break;
                }
                case 'music' : {
                    if( strlen( $value ) ){
                        $value = self::get_no_attachment( $attach_type , $size );
                    }
                    if( isset( $struct['icon-column']['name'] ) && $struct['icon-column']['name'] == $name ){
                        $meta = self::get_meta(  $post_id , $box );
                        $record = $meta[ $index ];
                        if( isset( $record[ $name.'_id'] ) && $record[ $name.'_id'] > 0 ){
                            $src = wp_get_attachment_image_src( (int)$record[ $name.'_id']);
                            $result .= $src[0];
                        }else{
                            $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                        }
                    }else{
                        $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                    }
                    break;
                }

                case 'video' : {
                    if( strlen( $value ) ){
                        $value = self::get_no_attachment( $attach_type , $size );
                    }

                    if( isset( $struct['icon-column']['name'] ) && $struct['icon-column']['name'] == $name ){
                        $meta = self::get_meta(  $post_id , $box );
                        $record = $meta[ $index ];

                        if( isset( $struct[ 'info-column-0' ][ 0 ][ 'name' ] ) && $struct[ 'info-column-0' ][ 0 ][ 'name' ] == 'video_type' && isset( $record[ 'video_type' ] ) ){
                            switch( $record[ 'video_type' ] ){
                                case 'local' : {
									$result .= do_shortcode('[video mp4="'.$record[ 'video_path' ].'" width="'.$size[ 0 ].'" height="'.$size[ 1 ].'" ]');
                                    /*$result .= '<div class="video flash-player">';
                                    $result .= '<div id="mediaspace-' . $index . '">' . __('Video player loads here.' , 'cosmotheme') . '</div>';
                                    $result .= '<script type="text/javascript">';
                                    $result .= 'jwplayer("mediaspace-' . $index . '").setup({';
                                    $result .= 'flashplayer: "' . get_template_directory_uri() . '/js/video-player.swf",';
                                    $result .= 'file: "' . $record[ 'video_path' ] . '",';
                                    $result .= 'width: ' . $size[ 0 ] . ',';
                                    $result .= 'height: ' . $size[ 1 ];
                                    $result .= '});';
                                    $result .= '</script>';
                                    $result .= '</div>';*/
                                    break;
                                }
                                case 'vimeo' : {
                                    $result .= '<iframe src="http://player.vimeo.com/video/' . $record['video_path'] . '?title=0&amp;byline=0&amp;portrait=0" width="' . $size[ 0 ] . '" height="' . $size[ 1 ] . '" frameborder="0"></iframe>';
                                    break;
                                }
                                case 'youtube' : {
                                    $result .= '<iframe width="' . $size[ 0 ] . '" height="' . $size[ 1 ] . '" src="' . str_replace( '.be' , 'be.com/embed' , $record['video_path'] ) . '" frameborder="0" allowfullscreen></iframe>';
                                    break;
                                }
                                default : {
                                    $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                                    break;
                                }
                            }
                        }else{
                            $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" src="'.$value.'" />';
                        }
                    }
                    break;
                }

                default :{
                        if( is_array( $extra ) ){
                            $result .= '<p class="' . $extra[1] . '">';
                            $result .= '<img  class="meta-box-field field-' . $box . '   ' . $res . '-' . $box . '-' . $name . '-' . $index . ' upload-images" width="'.$size[0].'" height="'.$size[1].'" src="'.$extra[0].'" />';
                            $result .= '<a href="' . $value . '">' . $value . '</a></p>';
                            $result .= '<div class="generic-field generic-field-upload ' . $extra[2] . '">';
                                $result .= '<input type="text" name="' . $name . '" value="' . $value . '" class="generic-record generic-general ' . $name . '_path" id="' . $name . '_path" />';
                                $result .= '<input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" onclick="javascript:act.upload(\'input#' . $name . '_path\' );">';
                            $result .= '</div>';
                        }
                    break;
                }
            }

            return $result;
        }
        
        static function min_structure( $res , $box ){
            $struct  = resources::$box[ $res  ][ $box ]['struct'];
            $struct  = self::new_structure( $struct );
            $result  = array();
            foreach( $struct as $container => $field_ ){
                switch( substr($container , 0 , 12) ){
                    case 'check-column' : {
                        $field_['key'] = '';
                        $field_['res'] = $res;
                        $field_['box'] = $box;
                        $field_['value'] = '';
                        $result[] = $field_;
                        break;
                    }
                    case 'icon-column-' : {
                        $field_['key'] = '';
                        $field_['res'] = $res;
                        $field_['box'] = $box;
                        $field_['value'] = '';
                        $result[] = $field_;
                        break;
                    }
                    case 'info-column-' : {
                        foreach ( $field_ as $field ){
                            $field['key'] = '';
                            $field['res'] = $res;
                            $field['box'] = $box;
                            $field['value'] = '';
                            $result[] = $field;
                        }
                        break;
                    }
                }
            }

            return $result;
        }

        static function new_structure( $struct ){
            $result = array();
            if( is_array( $struct ) ){
                foreach( $struct as $container => $fields ){
                    if( substr( $container , 0 , 12 ) == 'info-column-' ){
                        foreach($fields as $index => $field ){
                            $result = self::add_attachment_structure( $field , $result );
                        }
                    }else{
                        $result = self::add_attachment_structure( $fields , $result );
                    }
                }
            }

            if( !empty( $result ) ){
                $struct['info-column-0'] = array_merge( $struct['info-column-0'] , $result );
            }

            return $struct;
        }



        static function add_attachment_structure( $field_ , $result ){
            if( isset( $field_['type'] ) && $field_['type'] == 'attachment' && strlen( $field_['attach_type'] ) ){
                $name = $field_['name'];
                $attachment = array(
                    0 => array(
                        'name' => $name,
                        'type' => 'text',
                        'label' =>  'Attachment URL',
                        'upload' => true,
                        'param' => 'readonly',
                        'hint' => __('To change attachment click on the icon' , 'cosmotheme'),
                        'lvisible' => false,
                        'evisible' => true
                    ),
                    1 => array(
                        'name' => $name .'_id',
                        'type' => 'hidden',
                        'upload' => true
                    ),
                );

                if( isset( $field_['lvisible'] ) ){
                    $attachment[0]['lvisible']  = $field_['lvisible'];
                    $attachment[1]['lvisible']  = true;
                }

                if( isset( $field_['evisible'] ) ){
                    $attachment[0]['evisible']  = $field_['evisible'];
                }

                if( isset( $field_[ 'label' ] ) ){
                    $attachment[ 0 ][ 'label' ] = $field_[ 'label' ];
                }

                $result = array_merge( $result , $attachment );
            }
            return $result;
        }

        /* use for ajax - callback  */
		static function save(){
            $res		= isset( $_POST[ 'res' ] ) && strlen( trim( $_POST['res'] ) ) ? trim( $_POST[ 'res' ] ) : exit;
			$box 		= isset( $_POST[ 'box' ] ) && strlen( trim( $_POST['box'] ) ) ? trim( $_POST[ 'box' ] ) : exit;
			$post_id	= isset( $_POST[ 'post_id' ] )&& (int)$_POST[ 'post_id' ] > 0 ? (int)$_POST[ 'post_id' ] : exit;
			$data		= isset( $_POST[ 'data' ] ) && !empty( $_POST[ 'data' ] ) ? $_POST[ 'data' ] : exit;
            $meta_box   = self::get_meta( $post_id , $box );

            $new = array();
            $unic = false;
            
            if( isset( resources::$box[ $res  ][ $box ][ 'struct' ][ 'idrecord' ] ) ){
                if( resources::$box[ $res  ][ $box ][ 'struct' ][ 'idrecord' ] == 'unic' ){
                    $unic = true;
                }
            }
			foreach( $data as $index => $items ){
				$l1 = (int)strlen( str_replace( '[]' , '' , $items['name'] ) );
				$l2 = (int)strlen( $items['name'] );

				if( $l1 < $l2 ){
					$topic = trim( rtrim( str_replace( $box . '[' , '' , $items[ 'name' ] ) , '][]' ) );
                    $new[ $topic ] = $items[ 'value' ];
				}else{
					$topic = trim( rtrim( str_replace( $box . '[' , '' , $items[ 'name' ] ) , ']' ) );
                    if( $unic ){ 
                        if( !in_array( $items[ 'value' ] , $meta_box )  ){
                            $meta_box[ $topic ] = $items[ 'value' ];
                        }
                    }else{
                        $meta_box[ $topic ] = $items[ 'value' ];
                    }
				}
			}

            if( !empty( $new ) ){
                if( $unic ) {
                    if (!in_array( $new , $meta_box )  ){
                        $meta_box[] = $new;
                    }
                }else{
                        $meta_box[] = $new;
                }
            }
			self::set_meta(  $post_id, $box , $meta_box );
            echo self::get_meta_records( $post_id , array( $res , $box ) );

			exit;
		}
		
		static function delete( $res = '' , $box = '' , $post_id = '' , $topic = '' , $id = '' ){
            if( empty( $res ) ){
                $res		= isset( $_POST[ 'res' ] ) && strlen( trim( $_POST['res'] ) ) ? trim( $_POST[ 'res' ] ) : exit;
                $box 		= isset( $_POST[ 'box' ] ) && strlen( trim( $_POST['box'] ) ) ? trim( $_POST[ 'box' ] ) : exit;
                $post_id	= isset( $_POST[ 'post_id' ] )&& (int)$_POST[ 'post_id' ] > 0 ? (int)$_POST[ 'post_id' ] : exit;
                $topic		= isset( $_POST[ 'topic' ] )&& strlen( trim( $_POST[ 'topic' ] ) ) ? trim( $_POST[ 'topic' ] ) : '';
                $id			= isset( $_POST[ 'index' ] ) && strlen( trim( $_POST[ 'index' ] ) ) ? (int)$_POST[ 'index' ] : -1;
                $ajax       = true;
            }else{
                $ajax       = false;
            }
			$meta_box = self::get_meta( $post_id , $box );
		
			if( $id > -1 ){
				if( strlen( $topic ) ){
					unset( $meta_box[ $id ][ $topic ] );
				}else{
					unset( $meta_box[ $id ] );
				}
                self::set_meta(  $post_id, $box , $meta_box );
			}else{
				if( strlen( $topic ) ){
					unset( $meta_box[ $topic ] );
                    self::set_meta(  $post_id, $box , $meta_box );
				}else{
					delete_post_meta($post_id, $box );
				}
			}

            if( $ajax ){
                echo self::get_meta_records( $post_id , array( $res , $box ) );
                exit;
            }else{
                return self::get_meta_records( $post_id , array( $res , $box ) );
            }
		}

        static function update(){
            $res 		= isset( $_POST[ 'res' ] ) && strlen( trim( $_POST['res'] ) ) ? trim( $_POST[ 'res' ] ) : exit;
			$box 		= isset( $_POST[ 'box' ] ) && strlen( trim( $_POST['box'] ) ) ? trim( $_POST[ 'box' ] ) : exit;
			$post_id	= isset( $_POST[ 'post_id' ] )&& (int)$_POST[ 'post_id' ] > 0 ? (int)$_POST[ 'post_id' ] : exit;
			$id			= isset( $_POST[ 'index' ] ) && strlen( trim( $_POST[ 'index' ] ) ) ? (int)$_POST[ 'index' ] :exit;
            $data		= isset( $_POST[ 'data' ] ) ? $_POST[ 'data' ] :exit;
			$meta_box = self::get_meta( $post_id , $box );

            foreach( $data as $index => $value ){
                $meta_box[ $id ][ $value['name'] ] = $value['value'];
            }
            self::set_meta(  $post_id, $box , $meta_box );
            echo trim( self::layout_a( $res , $box , $post_id ) );
			exit;
		}

        static function set(){

        }

        static function sort(){
            $res 		= isset( $_POST[ 'res' ] ) && strlen( trim( $_POST['res'] ) ) ? trim( $_POST[ 'res' ] ) : exit;
            $box 		= isset( $_POST[ 'box' ] ) && strlen( trim( $_POST['box'] ) ) ? trim( $_POST[ 'box' ] ) : exit;
			$post_id	= isset( $_POST[ 'post_id' ] )&& (int)$_POST[ 'post_id' ] > 0 ? (int)$_POST[ 'post_id' ] : exit;
            $data		= isset( $_POST[ 'data' ] ) ? $_POST[ 'data' ] :exit;

            $meta       = self::get_meta( $post_id , $box );

            if( !is_array( $meta ) ){
                $meta = array();
            }

            $new_meta    = array();

            if( isset( resources::$box[ $res ][ $box ]['struct']['check-column'] ) ){
                $name = resources::$box[ $res ][ $box ]['struct']['check-column']['name'];
            }else{
                exit;
            }

            $index = 0;

            foreach($data as $value ){
                if( $value['name'] == $name.'[]' ){
                    if( isset( $meta[ $value[ 'value' ] ] ) ){
                        $new_meta[ $index ] =  $meta[ $value[ 'value' ] ];
                        $new_meta[ $index ][ $name ] = $index;
                        unset( $meta[ $value['value' ] ] );
                        $index++;
                    }
                    
                }
            }

            $new_index = count( $new_meta );
            foreach( $meta as $value){
                $new_meta[ $new_index ] = $value;
                $new_index++;
            }

            self::set_meta( $post_id , $box , $new_meta );
            echo trim( self::layout_a( $res , $box , $post_id ) );
            exit;
        }
		
        /* optimized */
        static function get_meta( $post_id , $box  ){
            $array_meta_box = get_post_meta( $post_id , $box );
            
			if( isset( $array_meta_box[0] ) ){
				$meta_box = $array_meta_box[0];
			}else{
				$meta_box = array();
			}

            return $meta_box;
        }

        static function set_meta( $post_id , $box , $value ){
			update_post_meta( $post_id, $box , $value );
        }

        static function get_check_name( $res , $box , $wexit = true ){
            if( isset( resources::$box[ $res ][ $box ]['struct']['check-column'] ) ){
                $check_name = resources::$box[ $res ][ $box ]['struct']['check-column']['name'];
            }else{
                if( $wexit ){
                    exit;
                }else{
                    return '';
                }
            }

            return $check_name;
        }

        static function get_actions( $struct , $res , $box , $post_id , $data = null ,$index = -1 , $selector = '' , $status = '' ){
            $result = '';
            $args   = '';
            $act = '';
            if( isset( $struct['actions'] ) && is_array( $struct['actions'] )  ){
			
				/* compose actions */
                $result .= '<p class="actions-box-container"><span class="actions action-'.$box.'">';
                foreach( $struct['actions'] as $key => $action ){
					/* compose args for js function */
					$params = " '".$res."' , '" . $box . "' , " . $post_id;
					
					/* check struct if exists action label */
                    $label = isset( $action['label'] ) ? $action['label'] : '';
					
					/* check struct if exists arg data */
					if( isset( $action[ 'args' ] ) && isset( $action[ 'args' ][ 'data' ] ) ){
						if( !empty( $data ) ){
							$args = " , { ";
							$elem = '';
							foreach( $data as $p => $v ){
								if( strlen( $elem ) == 0 ){
									$elem = " '" . $p . "' : " . $v ;
								}else{
                                    $elem .= ", '" . $p . "' : " . $v;
                                }
							}
                            $args .= $elem;
							$args .= " } ";
						}else{
                            if( !empty( $action[ 'args' ][ 'data' ] ) ){
                                $args = " , { ";
                                $elem = '';
                                foreach( $action[ 'args' ][ 'data' ] as $p => $v ){
                                    if( strlen( $elem ) == 0 ){
                                        $elem = " '" . $p . "' : " . $v ;
                                    }else{
                                        $elem .= ", '" . $p . "' : " . $v ;
                                    }
                                }
                                $args .= $elem;
                                $args .= " } ";
                            }
                        }
						$params .= $args;
					}
					
					/* check struct if exists arg index of record */
					if( isset( $action[ 'args' ] ) && isset( $action[ 'args' ][ 'index' ] ) ){
						if( $index > -1 ){
							$params .= " , " .$index . " " ;
						}
					}

					/* check struct if exists selector */
					if( isset( $action[ 'args' ] ) && isset( $action[ 'args' ][ 'selector' ] ) ){
						if( strlen( $action[ 'args' ][ 'selector' ] ) ){
							$params .= " , '" . $action[ 'args' ][ 'selector' ] . "' ";
						}else{
							if( strlen( $selector ) ){
								$params .= " , '" . $selector . "' ";
							}
						}
					}else{
                        if( strlen( $selector ) ){
                            $params .= " , '" . $selector . "' ";
                        }
                    }
					if( $action['slug'] == 'update' ){
                        $classes = $action['slug'] . '-action hidden';
                    }else{
                        $classes = $action['slug'] . '-action';
                    }
                    $act .= '<a class="' . $classes . '" href="javascript:meta.' . $action['slug'] . '(' . $params . ');">';
                    $act .= '<input type="button" class="button-primary" value="' . $label . '">';
                    $act .= '</a>' . $status ;
                }

                $result .= $act;
                $result .= '</span></p>';
            }
            return $result;
        }


        static function layout_a( $res , $box , $post_id ){
            $result =   '';
            $struct =   resources::$box[ $res ][ $box ]['struct'];
            $struct =   self::new_structure( $struct );
            $cols   =   count( resources::$box[ $res ][ $box ]['struct'] );
            $meta   =   self::get_meta( $post_id , $box  );
            $check  =   self::get_check_name( $res , $box );
            if( is_array( $meta ) ){

                foreach( $meta as $index => $m ) {

                    $result .= '<div id="meta_' . $box . '_' . $index . '" class="meta-box meta-'. $box .' meta-' . $box .'-' . $index . '">';
                    $k = 1;
                    $actions = '';
                    foreach( $struct as $container => $field_ ){
                        switch( substr($container , 0 , 12) ){
                            case 'check-column' : {
                                $field_[ 'index' ]      = $index;
                                $field_[ 'res' ]        = $res;
                                $field_[ 'box' ]        = $box;
                                $field_[ 'post_id' ]    = $post_id;

                                if( isset( $m[ $field_['name'] ] ) ){
                                    $field_[ 'value' ] = $m[ $field_[ 'name' ] ];
                                }else{
                                    $field_[ 'value' ] = null;
                                }

                                $actions .= '<div class="check-column">';
                                $actions .= self::field( $field_ );
                                $actions .= self::get_actions( $struct , $res , $box , $post_id , null , $index , '#' . $res . $box . $index );
                                $actions .= '</div>';
                                break;
                            }
                            case 'icon-column' : {
                                $field_[ 'index' ]      = $index;
                                $field_[ 'res' ]        = $res;
                                $field_[ 'box' ]        = $box;
                                $field_[ 'post_id' ]    = $post_id;
                                
                                if( isset( $m[ $field_[ 'name' ] ] ) ){
                                    $field_[ 'value' ] = $m[ $field_[ 'name' ] ];
                                }else{
                                    $field_[ 'value' ] = null;
                                }
                                
                                $result .= '<div class="icon-column">';
                                $result .= self::field( $field_ );
                                $result .= '</div>';
                                break;
                            }
                            case 'info-column-' : {
                                $html = '';
                                $info_classes = 'not-text-slide-info-column';
                                foreach ( $field_ as $field ){
                                    $field[ 'index' ]       = $index;
                                    $field[ 'res' ]         = $res;
                                    $field[ 'box' ]         = $box;
                                    $field[ 'post_id' ]     = $post_id;
                                    if( isset( $m[ $field[ 'name' ] ] ) ){
                                        $field[ 'value' ] = $m[ $field[ 'name' ] ];
                                    }else{
                                        $field[ 'value' ] = null;
                                    }

                                    $html .= self::field( $field );
                                }
                                $result .= '<div class="info-column ' . $info_classes . '">';
                                    $result .= $html;
                                $result .= '</div>';
                                break;
                            }
                        }
                        $k++;
                    }
                    $result .= $actions;
                    $result .= '</div>';
                }
            }

            return $result;
		}


        static function field( $field ){
            foreach( $field as $var => $attr ){
                    $$var = $attr;
            }

            if( !isset( $before ) ){
                $before = '';
            }

            if( !isset( $after ) ){
                $after = '';
            }
            
            if( !isset( $fbefore ) ){
                $fbefore = '';
            }

            if( !isset( $fafter ) ){
                $fafter = '';
            }

            $struct     = resources::$box[ $res ][ $box ][ 'struct' ];

            $lv_class   = isset($lvisible) && @$lvisible ? 'lvisible blocked' : 'lvisible hidden';
            $ev_class   = isset($evisible) && @$evisible ? 'fvisible blocked' : 'fvisible hidden';
            if( isset( $field[ 'classes' ] ) ){
                $ev_class .= ( ' ' . $field[ 'classes' ] );
            }
            $label      = isset( $label) ? $label : '';
            $hint       = isset( $hint ) ? $hint : '';
            $fclasses   = $res . '-' . $box . ' ' . $res . '-' . $box . '-' . $name . ' ' . $res . '-' . $box . '-' . $name . '-' . $index;
            $up_action  = isset( $upload ) ? '' /*onclick="'.self::upload_action( $res , $box , $name , $index ).'"' */ : '';
            $fstyle     = isset( resources::$box[ $res ][ $box ]['struct']['field-style'] ) ?  resources::$box[ $res ][ $box ]['struct']['field-style'] : '';


            if( isset( $length ) ){
                if( strlen( $value ) > $length ){
                    $value = mb_substr( $value , 0 , $length ) . '...';
                }
            }
            
            if( isset( $attach_type ) ){
                $no_attach  = isset( $value ) && empty( $value ) ? self::get_no_attachment( $attach_type , array( $width , $height ) ) : '';
            }
            $extra      = isset( $extra ) ? $extra : '';

            $result = '';
            switch( $type ){
                case 'text' :{
                    if( $fstyle == 'line' ){
                        if( isset( $post_link )  ){
                            if( $value > 0 ){
                                $p = get_post( $value );
                                $result .= '<p class="' . $lv_class . '">'  . $before . '<a href="post.php?post=' . $value . '&action=edit">' . __( 'Edit post' , 'cosmotheme' ) . ' - <strong>' . $p -> post_title . '</strong></a>' . $after . '</p>';
                                $result .= '<p class="' . $ev_class . '">'  . $before . '<a href="post.php?post=' . $value . '&action=edit">' . __( 'Edit post' , 'cosmotheme' ) . ' - <strong>' . $p -> post_title . '</strong></a>' . $after . '</p>';
                            }
                        }else{
                            $result .= '<p class="' . $lv_class . '">'  . $before . $value . $after . '</p>';
                        }

                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<input type="text" id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . ' " name="'.$name.'" value="'.$value.'">';
                        if( isset( $upload ) ){
                            $remove_translation = __( 'Remove' , 'cosmotheme' );
                            $result .= <<< endhtml
                                <a href="javascript:void(0);" onclick="jQuery( this ).parent().next().val('');jQuery( this ).prev().val('');">
                                    $remove_translation
                                </a>
endhtml;
                            $result .= '<input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" onclick="javascript:act.upload_id(\'' . $res . '_' . $box . '\' , \''.$name.'\' , ' .$index . ' );"><br>';
                        }
                        $result .= '</span>' . $fafter ;
                    }else{
                        if( isset( $upload ) ){
                            $result .= '<p class="' . $lv_class . '">'  . $before . $value . $after . '</p>';
                            $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                            $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                            $result .= '<input type="text" id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . ' " name="'.$name.'" value="'.$value.'">';
                            $result .= '<input type="button" class="button-primary" value="'.__('Choose File','cosmotheme').'" onclick="javascript:act.upload_id(\'' . $res . '_' . $box . '\' , \''.$name.'\' , ' .$index . ' );">';
                            $result .= "<br /><small>" . $hint . "</small>";
                            $result .= '</div>';
                        }else{
                            if( isset( $post_link )  ){
                                if( $value > 0 ){
                                    $p = get_post( $value );
                                    $result .= '<p class="' . $lv_class . '">'  . $before . '<a href="post.php?post=' . $value . '&action=edit">' . __( 'Edit post' , 'cosmotheme' ) . ' - <strong>' . $p -> post_title . '</strong></a>' . $after . '</p>';
                                    $result .= '<p class="' . $ev_class . '">'  . $before . '<a href="post.php?post=' . $value . '&action=edit">' . __( 'Edit post' , 'cosmotheme' ) . ' - <strong>' . $p -> post_title . '</strong></a>' . $after . '</p>';
                                }
                            }else{
                                $result .= '<p class="' . $lv_class . '">'  . $before . $value . $after . '</p>';
                            }
                            $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                            $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                            $result .= '<input type="text" id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . ' " name="'.$name.'" value="'.$value.'">';
                            $result .= "<br /><small>" . $hint . "</small>";
                            $result .= '</div>';
                        }
                    }
                    break;
                }

                case 'color-picker' : {
                    $iname  = self::get_input_ID( $res, $box, $index, $name );
                    $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . $iname . '">' . $label . '</label><br>';
                        $result .= '<input type="text" name="' . $name . '" id="' . $iname . '" op_name="' . $iname . '" value="' .  $value . '" class="generic-meta-color-picker generic-record settings-color-field '  . $fclasses .  ' " />';

                    $result .= '</div>';
                    break;
                }

                case 'checkbox' :{
                    $result .= '<div  class="meta-box-field">';
                    $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';

                    $c = '';

                    $check = self::get_check_name( $res , $box , false );

                    if( $check == $name ){
                        if( strlen( $value )  &&  (int)$value == $index ){
                            $c = 'checked="checked"';
                        }else{
                            $value = $index;
                        }
                    }else{
                        if( $value == $name ){
                            $c = 'checked="checked"';
                        }else{
                            $value = $name;
                        }
                    }

                    $result .= '<input type="checkbox" id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="' .$name. '[]" value="'.$value.'" '.$c.' "/>'; //onclick="' . self::set_action( $res , $box , $index ) . '
                    $result .= '</div>';

                    break;
                }

                case 'hidden' :{
                    if( isset( $post_link )  ){
                        if( $value > 0 ){
                            $p = get_post( $value );
                            $result .= '<p class="' . $lv_class . '">'  . $before . '<a href="post.php?post=' . $value . '&action=edit">' . __( 'Edit post' , 'cosmotheme' ) . ' - <strong>' . $p -> post_title . '</strong></a>' . $after . '</p>';
                            $result .= '<p class="' . $ev_class . '">'  . $before . '<a href="post.php?post=' . $value . '&action=edit">' . __( 'Edit post' , 'cosmotheme' ) . ' - <strong>' . $p -> post_title . '</strong></a>' . $after . '</p>';
                        }
                    }else{
                        if( isset($ilabel) && @$ilabel ){
                            $result .= '<p class="' . $lv_class . '">'  . $before . $value . $after . '</p>';
                        }
                    }
                    
                    $id =  self::get_input_ID( $res , $box , $index , $name );
                    $check = self::get_check_name( $res , $box , false );

                    if( $check == $name ){
                        if( strlen( $value )  &&  (int)$value == $index ){
                        }else{
                            $value = $index;
                        }
                        $name .= '[]';
                    }else{
                        if( !isset( $upload ) ){
                            if( $value == $name ){
                            }else{
                                $value = $name;
                            }
                        }
                    }

                    
                    
                    $result .= '<input type="hidden" id="' . $id . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="' .$name. '" value="'.$value.'"/>';

                    break;
                }

                case 'attachment' :{
                    $icon = isset( $icon ) ? $icon : '';
                    $result .= self::get_attachment( $struct , $res , $box , $post_id , $index , $name , $value , $attach_type , array( $width , $height ) , array( $icon , $lv_class , $ev_class ) );
                    break;
                }

                case 'textarea' :{
                    $result .= '<p class="' . $lv_class . '">' . $before . $after . '</p>';
                    $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                    $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                    $result .= '<textarea id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">'.$value.'</textarea>';
                    $result .= "<br /><small>" . $hint . "</small>";
                    $result .= '</div>';

                    break;
                }

                case 'label' : {
                    if( isset( $asoc ) && isset( $asoc[ $value ] ) ){
                        $value = $asoc[ $value ];
                    }
                    $result .= '<label>' . $before . $value . $after .'</label>';
                    break;
                }

                case 'months' : {
                    if( isset( $asoc ) && isset( $asoc[ $value ] ) ){
                        $new_value = $asoc[ $value ];
                    }
                    if( $fstyle == 'line' ){
                        $result .= '<label class="' . $lv_class . '">' . $before . $new_value . $after .'</label>';
                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::months_array( ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= '</span>' . $fafter ;
                    }else{
                        $result .= '<p class="' . $lv_class . '">' . $before . $new_value . $after . '</p>';
                        $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::months_array( ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= "<br /><small>" . $hint . "</small>";
                        $result .= '</div>';
                    }
                    break;
                }

                case 'select' : {
                    if( $fstyle == 'line' ){
                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( $assoc as $k => $v ){
                            if( $value == $k ){
                                $result .= '<option value="'.$k.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$k.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= '</span>' . $fafter ;
                    }else{
                        $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( $assoc as $k => $v ){
                            if( $value == $k ){
                                $result .= '<option value="'.$k.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$k.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= "<br /><small>" . $hint . "</small>";
                        $result .= '</div>';
                    }
                    break;
                }

                case 'year' : {
                    if( $fstyle == 'line' ){
                        $result .= '<label class="' . $lv_class . '">' . $before . $value . $after .'</label>';
                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( date('Y') + 10 , date('Y') , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= '</span>' . $fafter ;
                    }else{
                        $result .= '<p class="' . $lv_class . '">' . $before . $value . $after . '</p>';
                        $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( date('Y') + 10 , date('Y') , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= "<br /><small>" . $hint . "</small>";
                        $result .= '</div>';
                    }
                    break;
                }

                case 'day' : {
                    if( $fstyle == 'line' ){
                        $result .= '<label class="' . $lv_class . '">' . $before . $value . $after .'</label>';
                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( 31 , 1 , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= '</span>' . $fafter ;
                    }else{
                        $result .= '<p class="' . $lv_class . '">' . $before . $value . $after . '</p>';
                        $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( 31 , 1 , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= "<br /><small>" . $hint . "</small>";
                        $result .= '</div>';
                    }
                    break;
                }

                case 'hour' : {
                    if( $fstyle == 'line' ){
                        $result .= '<label class="' . $lv_class . '">' . $before . $value . $after .'</label>';
                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( 23 , 1 , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= '</span>' . $fafter ;
                    }else{
                        $result .= '<p class="' . $lv_class . '">' . $before . $value . $after . '</p>';
                        $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( 23 , 1 , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= "<br /><small>" . $hint . "</small>";
                        $result .= '</div>';
                    }
                    break;
                }

                case 'min' : {
                    if( $fstyle == 'line' ){
                        $result .= '<label class="' . $lv_class . '">' . $before . $value . $after .'</label>';
                        $result .= $fbefore;
                        $result .= '<span  class="meta-box-field ' . $ev_class . '">';
                         $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( 59 , 0 , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= '</span>' . $fafter ;
                    }else{
                        $result .= '<p class="' . $lv_class . '">' . $before . $value . $after . '</p>';
                        $result .= '<div  class="meta-box-field ' . $ev_class . '">';
                        $result .= '<label for="' . self::get_input_ID( $res , $box , $index , $name ) . '"  >'.$label.'</label><br />';
                        $result .= '<select id="' . self::get_input_ID( $res , $box , $index , $name ) . '" class="meta-box-field field-' . $box . ' ' . $fclasses . '" name="'.$name.'">';
                        foreach( fields::digit_array( 59 , 0 , true ) as $m => $v ){
                            if( $value == $m ){
                                $result .= '<option value="'.$m.'" selected="selected">' . $v . '</option>';
                            }else{
                                $result .= '<option value="'.$m.'">' . $v . '</option>';
                            }
                        }
                        $result .= '</select>';
                        $result .= "<br /><small>" . $hint . "</small>";
                        $result .= '</div>';
                    }
                    break;
                }
            }

            return $result;
        }

        static function get_meta_records( $post_id = null , $args = null ){
             if( is_array( $args ) && !empty( $args ) ){
                $res    = $args[ 0 ];
                $box    = $args[ 1 ];

                $ajax   = false;
            }else{
                $ajax   = true;
                $res    = isset( $_POST['res'] ) ? $_POST['res'] : exit;
                $box    = isset( $_POST['box'] ) ? $_POST['box'] : exit;

            }

            /* if not use standart callback */
            if( resources::$box[ $res ][ $box  ][ 'callback' ][ 0 ] != 'get_meta_records' ){
                $fn = resources::$box[ $res ][ $box  ][ 'callback' ][ 0 ];
                $args = resources::$box[ $res ][ $box  ][ 'callback' ][ 1 ];
                return $fn( $post_id , $args );
                
            }

            //delete_option( $group );

            $result  = '<script>';
            $result .= 'jQuery(document).ready(function(){';
            
            $result .= 'jQuery("div.sort-' . $res .'-'. $box . '").sortable({ beforeStop : function(){';

            $result .= 'meta.sort( "'.$res.'" , "'.$box.'" , '.$post_id.' , "'.resources::$box[ $res ][ $box  ][ 'struct' ]['check-column']['name'].'");';
            $result .= '}});';
            $result .= '});';
            $result .= '</script>';
            $struct  = self::new_structure( resources::$box[ $res ][ $box  ][ 'struct' ] );
            $result .= '<form id="serial_' . $res .'_'. $box . '" action="" method="post" >';
            /*if( isset( admin_options::$inputs[ $group ][ $side ][ 'classes' ] ) ){
                $classes = admin_options::$inputs[ $group ][ $side ][ 'classes' ];
            }else{
                $classes = 'list-rows';
            }*/
            if( isset( resources::$box[ $res ][ $box ][ 'hint' ] ) ){
                $result .= '<p class="form-hint">' . resources::$box[ $res ][ $box ][ 'hint' ] . '</p>';
            }
            $result .= '<div class="sort-' . $res . '-' . $box . ' layout-a meta-box">';
            $content = trim( self::layout_a( $res , $box , $post_id ) );
            if( strlen( $content ) ){
                $result .= self::layout_a( $res , $box , $post_id );
            }else{
                if( $ajax ){
                    echo '';
                    exit;
                }else{
                    return '';
                }
            }
            $result .= '<div class="clear"></div>';
            $result .= '</div>';
            $result .= '</form>';
            if( $ajax ){
                echo $result;
                exit;
            }else{
                return $result;
            }
        }

        static function logic( $post , $box , $side = null ){
            $meta = self::get_meta( $post -> ID , $box );

            /* check for default value */
            if( isset( resources::$box[ $post -> post_type ][ $box ]['content'][ $side ]['cvalue'] ) ){
                $value = resources::$box[ $post -> post_type ][ $box ]['content'][ $side ]['cvalue'];
            }
            
            if( !empty( $side ) && isset( $meta[ $side ] ) ){
                $result = $meta[ $side ];    
            }
            
            if( isset( $result ) && !is_array( $result ) ){
                if( $result == 'yes' ){
                    return true;
                }

                if( $result == 'no' ){
                    return false;
                }
            }

            
            /* default value */
            if( isset( $value ) ){
                if( $value == 'yes' ){
                    return true;
                }

                if( $value == 'no' ){
                    return false;
                }
            }

            return false;
        }

        static function update_post_layout_meta(){

            $template_name = $_POST['template_name'];

            $paged      = isset( $_POST['page']) ? $_POST['page'] : exit;
            $args = array('posts_per_page' => 150 , 'post_type' => array($_POST['post_type']),  'paged' => $paged );
            $wp_query = new WP_Query( $args );
            $all_posts = get_posts( $args );

            if ($wp_query) { 
                foreach( $wp_query -> posts as $post ){
                    

                    update_post_meta( $post->ID, 'layout', $_POST[$template_name.'_layout'] ); 
                }

                if( $wp_query -> max_num_pages >= $paged ){
                if( $wp_query -> max_num_pages == $paged ){
                    echo 0;
                }else{
                    echo $paged + 1; //output the next page number that will be used in hte next itteration
                }
            }
            }

                       
            exit;
        }
	}
?>