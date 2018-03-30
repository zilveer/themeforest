<?php
    class resources{
        static $type;
        static $labels;
        static $taxonomy;
		static $box;
        static function register(){
            if( !empty( self::$type ) ){
                foreach( self::$type as $res => $args ){
                    if( empty( $args )  ){
                        self::box( $res );
                    }else{
                        $label = self::$labels[ $res ];
                        $args['labels'] = $label;
                        $args['rewrite'] =  $args['rewrite'];
                        unset( $args['__on_front_page'] );
                        $args['has_archive'] = $res;
                        register_post_type( $res , $args );
                        self::taxonomy( $res );
                        self::box( $res );
                    }
                }
            }
        }

        static function taxonomy( $res ){
            if( isset( self::$taxonomy[ $res ] ) ){
                foreach( self::$taxonomy[ $res ] as $tax => $args ){
                    register_taxonomy( $res . '-' . $tax , array( $res ) , $args );
                }
            }
        }
		//add_meta_box(	'gallery-type-div', __('Gallery Type','cosmotheme'),  'gallery_type_metabox', 'gallery', 'normal', 'low');
		static function box( $res ){
			if( isset( self::$box[ $res ] ) ){
				foreach( self::$box[ $res ] as $box => $args ){
                    add_action('admin_init', array( get_class() , 'addbox_' . $res . '_' . $box ) , 1 );
				}
			}
		}

        /* replace callStatic  with Callbox */
        static function portfolio_builder(){
            self::CallBox( 'portfolio_builder' );
        }

        static function post_builder(){
            self::CallBox( 'post_builder' );
        }

        static function page_builder(){
            self::CallBox( 'page_builder' );
        }

        static function post_shcode(){
            self::CallBox( 'post_shcode' );
        }

        static function portfolio_shcode(){
            self::CallBox( 'portfolio_shcode' );
        }

        static function testimonial_shcode(){
            self::CallBox( 'testimonial_shcode' );
        }
        
        static function event_shcode(){
            self::CallBox( 'event_shcode' );
        }
        static function event_settings(){
            self::CallBox( 'event_settings' );
        }
        static function event_layout(){
            self::CallBox( 'event_layout' );
        }


        static function team_settings(){
            self::CallBox( 'team_settings' );
        }

        static function addbox_team_settings(){
            self::CallBox( 'addbox_team_settings' );
        }
        
        static function post_layout(){
            self::CallBox( 'post_layout' );
        }

        static function post_settings(){
            self::CallBox( 'post_settings' );
        }

        static function portfolio_location(){
            self::CallBox( 'portfolio_location' );
        }

        static function portfolio_news(){
            self::CallBox( 'portfolio_news' );
        }
        
        static function event_date(){
            self::CallBox( 'event_date' );
        }

        static function event_info(){
            self::CallBox( 'event_info' );
        }

        static function event_map(){
            self::CallBox( 'event_map' );
        }
        
        static function post_news(){
            self::CallBox( 'post_news' );
        }

        static function post_format(){
            self::CallBox( 'post_format' );
        }

        static function post_source(){
            self::CallBox( 'post_source' );
        }

        static function portfolio_layout(){
            self::CallBox( 'portfolio_layout' );
        }

        static function portfolio_settings(){
            self::CallBox( 'portfolio_settings' );
        }

        static function portfolio_format(){
            self::CallBox( 'portfolio_format' );
        }

        static function portfolio_source(){
            self::CallBox( 'portfolio_source' );
        }
      
        static function testimonial_info(){
            self::CallBox( 'testimonial_info' );
        }

        static function banner_info(){
            self::CallBox( 'banner_info' );
        }

        static function box_info(){
            self::CallBox( 'box_info' );
        }

        static function page_shcode(){
            self::CallBox( 'page_shcode' );
        }

        static function page_layout(){
            self::CallBox( 'page_layout' );
        }

        static function page_settings(){
            self::CallBox( 'page_settings' );
        }

        static function addbox_page_builder(){
            self::CallBox( 'addbox_page_builder' );
        }

        static function addbox_post_builder(){
            self::CallBox( 'addbox_post_builder' );
        }

        static function addbox_post_shcode(){
            self::CallBox( 'addbox_post_shcode' );
        }
        
        static function addbox_event_shcode(){
            self::CallBox( 'addbox_event_shcode' );
        }
        static function addbox_event_settings(){
            self::CallBox( 'addbox_event_settings' );
        }
        static function addbox_event_format(){
            self::CallBox( 'addbox_event_format' );
        }
      
        static function addbox_event_layout(){
            self::CallBox( 'addbox_event_layout' );
        }

        static function addbox_portfolio_builder(){
            self::CallBox( 'addbox_portfolio_builder' );
        }

        static function addbox_portfolio_shcode(){
            self::CallBox( 'addbox_portfolio_shcode' );
        }

        static function addbox_event_date(){
            self::CallBox( 'addbox_event_date' );
        }

        static function addbox_event_info(){
            self::CallBox( 'addbox_event_info' );
        }

        static function addbox_event_map(){
            self::CallBox( 'addbox_event_map' );
        }

        static function addbox_testimonial_shcode(){
            self::CallBox( 'addbox_testimonial_shcode' );
        }

        static function addbox_post_layout(){
            self::CallBox( 'addbox_post_layout' );
        }

        static function addbox_post_settings(){
            self::CallBox( 'addbox_post_settings' );
        }

        static function addbox_post_news(){
            self::CallBox( 'addbox_post_news' );
        }

        static function addbox_post_format(){
            self::CallBox( 'addbox_post_format' );
        }

        static function addbox_post_source(){
            self::CallBox( 'addbox_post_source' );
        }

        static function addbox_portfolio_location(){
            self::CallBox( 'addbox_portfolio_location' );
        }

        static function addbox_portfolio_news(){
            self::CallBox( 'addbox_portfolio_news' );
        }
        
        static function addbox_portfolio_layout(){
            self::CallBox( 'addbox_portfolio_layout' );
        }

        static function addbox_portfolio_settings(){
            self::CallBox( 'addbox_portfolio_settings' );
        }

        static function addbox_portfolio_format(){
            self::CallBox( 'addbox_portfolio_format' );
        }

        static function addbox_portfolio_source(){
            self::CallBox( 'addbox_portfolio_source' );
        }

        static function addbox_testimonial_info(){
            self::CallBox( 'addbox_testimonial_info' );
        }

        static function addbox_box_info(){
            self::CallBox( 'addbox_box_info' );
        }

        static function addbox_banner_info(){
            self::CallBox( 'addbox_banner_info' );
        }

        static function addbox_page_shcode(){
            self::CallBox( 'addbox_page_shcode' );
        }

        static function addbox_page_layout(){
            self::CallBox( 'addbox_page_layout' );
        }

        static function addbox_page_settings(){
            self::CallBox( 'addbox_page_settings' );
        }

        
        static function  CallBox( $name , $args = null ) {
			global $post;
            $items = explode( '_' , $name );
            
            if( $items[0] == 'addbox' ){
                foreach( self::$box[ $items[1] ] as $box => $args ){
                    add_meta_box( $items[1] . '_' . $box , $args[0] , array( get_class() , $items[1] . '_' . $box ) , $items[1] , $args[1] , $args[2] );
                    if( isset( $_POST[ $box ] ) ){
                        if( isset( $args[ 'update' ] ) && $args[ 'update' ] ){
                            $new_value = $_POST[ $box ];
                            if( is_array( $args['content'] ) ){
                                foreach( $args['content'] as $name => $fields ){
                                    $type = explode( '--' , $fields['type'] );
                                    if( isset( $type[1] ) && $type[1] == 'checkbox' ){
                                        if( !isset( $new_value[ $name ] ) ){
                                            $new_value[ $name ] = '';
                                        }
                                    }
                                }
                            }
							
                            if( isset( $_POST[ 'post_ID' ] ) ){
								
								$metadata=Array();

								if(isset($_POST['attachments_type']))
								  {
									if(isset($_POST['attachments']))
									  {
										foreach($_POST['attachments'] as $attach_id)
										{
											$attachment_post=get_post($attach_id);
											$attachment_post->post_parent=$_POST['post_ID'];
											wp_update_post($attachment_post);
										}
										
										switch($_POST['attachments_type'])
										{
											case 'image':
												$metadata=array("type" => 'image', 'images'=>$_POST['attachments']);
											break;
                                            case 'gallery':
                                                $metadata=array("type" => 'gallery', 'images'=>$_POST['attachments']);
                                            break;                                            
											case 'video':
												foreach($_POST['attachments'] as $index=>$attach_id)
												{
													if($attach_id==$_POST['featured_video'])
													{
														$_POST['featured_video_id']=$attach_id;
														unset($_POST['attachments'][$index]);
														if(isset($_POST['attached_urls'][$attach_id]))
														{
                                                            if( !has_post_thumbnail( $_POST['post_ID'] )){
                                                                set_post_thumbnail($_POST['post_ID'],$attach_id);    
                                                            }
															$_POST['featured_video_url']=$_POST['attached_urls'][$attach_id];
															unset($_POST['attached_urls'][$attach_id]);
														}
													}
												}
												$metadata=array("type"=>"video", "video_ids"=>$_POST['attachments'], "feat_id"=>$_POST['featured_video_id'], "feat_url"=>$_POST['featured_video_url']);
												
												if(isset($_POST['attached_urls']))
													$metadata["video_urls"]=$_POST["attached_urls"];
												break;
											case 'audio':
												$metadata = array("audio"=>  $_POST['attachments'], "type" => 'audio');
												break;
											case 'link':
												$metadata = array("link"=>  $_POST['attachments'], "type" => 'link', 'link_id' => $_POST['attachments']);
												break;
										}
									 }
								  }
								meta::set_meta( $_POST[ 'post_ID' ] , 'format' , $metadata );

                                /*save 'start_date_time' metadata*/
                                if(isset($_POST['date']['start_date_time'])){

                                    /* we want to save  $_POST['date']['start_date_time'] as exact meta  'start_date_time' to be able to use it later */
                                    update_post_meta( $_POST[ 'post_ID' ] , 'start_date_time' , strtotime( $_POST['date']['start_date_time'] ) ) ;

                                }

                                /*we will iterate through wordpress meta to unset the start_date_time data, because we need to overwrite it with $_POST['date']['start_date_time'] */ 
                                if(isset($_POST[ 'meta' ]) && is_array($_POST[ 'meta' ])){
                                    foreach( $_POST[ 'meta' ] as $id => $whatever ){
                                    
                                        if( isset( $_POST[ 'meta' ][ $id ][ 'key' ] ) && $_POST[ 'meta' ][ $id ][ 'key' ] == 'start_date_time' ){ /*add here the key for which you are not interested in WP default meta and need to be overwritten with your custom fields*/
                                            unset( $_POST[ 'meta' ][ $id ]); /*unset $_POST['start_date_time'] meta*/
                                            break;
                                        }
                                    }    
                                }

                                if( isset( $args[ 'no_array' ] ) && $args[ 'no_array' ] ){
                                    
                                    if($box != 'news'){
                                        meta::set_meta( $_POST[ 'post_ID' ] , $box , $new_value );
                                    }
                                    
                                    
                                }else{
                                    meta::set_meta( $_POST[ 'post_ID' ] , $box , $new_value );
                                }

                                if( isset( $_POST['format'] ) ){
									
                                    set_post_format( $_POST[ 'post_ID' ] , $_POST['format']['type'] );
                                    $_POST['post_format'] = $_POST['format']['type'];
                                }

                                /*if( isset( $_POST['format']['type'] ) && !empty( $_POST['format']['audio'] ) ){
                                    
                                    $meta = meta::get_meta( $_POST[ 'post_ID' ] , 'is_audio');
                                    if( empty( $meta ) || $meta[0] == 'audio' ){
                                        $_POST['content'] = $_POST['content'] . '[audio:'.$_POST['format']['audio'].']';
                                        meta::set_meta( $_POST[ 'post_ID' ] , 'is_audio' , 'audio');
                                    }
                                }*/
                                
                                if( isset( $_POST['format']['type'] ) && !empty( $_POST['format']['video'] ) ){
                                    
                                    if( post::isValidURL( $_POST['format']['video'] ) ){
                                        $vimeo_id = post::get_vimeo_video_id( $_POST['format']['video'] );
                                        $youtube_id = post::get_youtube_video_id( $_POST['format']['video'] );
                                        $video_type = '';
                                        if( $vimeo_id != '0' ){
                                            $video_type = 'vimeo';
                                            $video_id = $vimeo_id;
                                        }

                                        if( $youtube_id != '0' ){
                                            $video_type = 'youtube';
                                            $video_id = $youtube_id;
                                        }

                                        if( !has_post_thumbnail( $_POST[ 'post_ID' ] ) && !empty( $video_type ) ){
                                            $video_image_url = post::get_video_thumbnail( $video_id , $video_type );

                                            /*attach an image to the post*/
                                            $upload =  media_sideload_image( urldecode( $video_image_url ) , $_POST[ 'post_ID' ] );

                                            /* set attached image as featured image */
                                            // Associative array of attachments, as $attachment_id => $attachment
                                            $attachments = get_children( array('post_parent' => $_POST[ 'post_ID' ] , 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID') );
                                            foreach ($attachments as $index => $id) {
                                                $attachment = $index;
                                            }

                                            set_post_thumbnail( $_POST[ 'post_ID' ] , $attachment );
                                        }
                                    }
                                }
                            }
                            
                        }
                    }
                }
            }else{
                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'callback' ] ) ){
                    
                    if( self::$box[ $items[0] ][ $items[1] ][ 'callback' ][0] == 'get_meta_records' ){
                        $fn_result =  meta::get_meta_records( $post -> ID , $items );

                        if( !empty( $fn_result ) ){
                            $classes = "postbox";
                        }else{
                            $classes = '';
                        }

                        echo '<div id="box_' . $items[0] .'_'. $items[1] .'" class="' . $classes . '" >';
                        echo $fn_result;
                        echo '</div>';
                        
                    }else{                    
                        $fn = self::$box[ $items[0] ][ $items[1] ][ 'callback' ][0];
                        $fn_result = $fn( $post -> ID , self::$box[ $items[0] ][ $items[1] ][ 'callback' ][1] ) ;
                        
                        if( !empty( $fn_result ) ){
                            $classes = "postbox";
                        }else{
                            $classes = '';
                        }

                        echo '<div id="box_' . $items[0] .'_'. $items[1] .'" class="' . $classes. '" >';
                        echo $fn_result;
                        echo '</div>';
                        
                    }
                    
                }

                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'includes' ] ) ){
                    include get_template_directory(). '/lib/php/' . self::$box[ $items[0] ][ $items[1] ][ 'includes' ];
                }

                if( isset( self::$box[ $items[0] ][ $items[1] ][ 'content' ] ) ){

                    if( isset( self::$box[ $items[0] ][ $items[1]][ 'box'  ] ) ){
                        $box = self::$box[ $items[0] ][ $items[1]][ 'box'  ];
                    }else{
                        $box = $items[1];
                    }

					echo '<div id="form' . $box . '">';


                    foreach( self::$box[ $items[0] ][ $items[1]][ 'content'  ] as $side => $field ){
                        $field['side'] 		= $side;
                        $field['box']  		= $box;
						$field['res']  		= $items[0];
						$field['post_id']  	= $post -> ID;
                        $field['pos']  		= self::$box[ $items[0] ][ $items[1]][1];
                        
                        $meta  = meta::get_meta( $post -> ID , $box );
                        
                        $value = isset( $meta[ $side ] ) ? $meta[ $side ] : '';
                        
                        if( !isset( $field['value'] ) ){
                            $field['value'] = $value;
                        }

                        if( !empty( $value ) ){
                            $field['ivalue'] = $value;
                        }

                        /* special for upload-id*/
                        $type = explode( '--' , $field['type'] );
                        if( isset( $type[1] ) && $type[1] == 'upload-id' ){
                            $value_id = isset( $meta[ $side .'_id' ] ) ? $meta[ $side .'_id' ] : 0;
                            $field['value_id'] = $value_id;
                        }

                        $field['topic']  	= $side;
						$field['group']  	= $box;

                        echo fields::layout( $field );
                    }
					echo '</div>';
                }
            }
        }
    }
?>