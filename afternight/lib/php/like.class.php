<?php
    class like{
        
        static function set( $post_id = 0 ){

            if( $post_id == 0 ){
                $post_id = isset( $_POST['post_id' ]) ? (int) $_POST['post_id'] : exit;
                $ajax = true;
            }else{
                $ajax = false;
            }


            $likes = meta::get_meta( $post_id , 'like' );

            

            $user       = true;
            $user_ip    = true;

            $ip     = $_SERVER['REMOTE_ADDR'];

            if( is_user_logged_in () ){
                $user_id = get_current_user_id();
            }else{
                $user_id = 0;
            }

            if( $user_id > 0 ){
                /* like by user */
                foreach( $likes as  $like ){
                    if( isset( $like['user_id'] ) && $like['user_id'] == $user_id ){
                       $user   = false;
                       $user_ip = false;
                    }
                }
            }else{
                
                foreach( $likes as  $like ){
                    if( isset( $like['ip'] ) && ( $like['ip'] == $ip ) ){
                        $user = false;
                        $user_ip = false;
                    }
                }
            }

            if( $user && $user_ip ){
                /* add like */
                $likes[] = array( 'user_id' => $user_id , 'ip' => $ip );
                meta::set_meta( $post_id , 'nr_like' , count( $likes ) );
                meta::set_meta( $post_id , 'like' ,  $likes );

                self::attachUserVote($post_id); /*add this post to user's voted_posts meta*/
                
                $date = meta::get_meta( $post_id , 'hot_date' );
                if( empty( $date ) ){
                    if( ( count( $likes ) >= (int)options::get_value( 'likes' , 'min_likes' ) ) ){
                        meta::set_meta( $post_id , 'hot_date' , mktime() );
                    }
                }else{
                    if( ( count( $likes ) < (int)options::get_value( 'likes' , 'min_likes' ) ) ){
                        delete_post_meta( $post_id, 'hot_date' );
                    }
                }
            }else{
                /* delete like */
                if( $user_id > 0 ){
                    foreach( $likes as $index => $like ){
                        if( isset( $like['user_id'] ) && $like['user_id'] == $user_id ){
                            unset( $likes[ $index ] );
                        }
                    }
                }else{
                    
                    foreach( $likes as $index => $like ){
                        if( isset( $like['ip'] ) && isset( $like['user_id'] ) && ( $like['ip'] == $ip ) && ( $like['user_id'] == 0 ) ){
                            unset( $likes[ $index ] );
                        }
                    }
                }
                
                self::removeUserVote($post_id); /*remove this post from user's voted_posts meta*/

                meta::set_meta( $post_id , 'like' ,  $likes );
                meta::set_meta( $post_id , 'nr_like' ,  count( $likes ) );
                if( count( $likes ) < (int)options::get_value( 'likes' , 'min_likes' ) ){
                    delete_post_meta($post_id, 'hot_date' );
                }
            }

            if( $ajax ){
                echo (int)count( $likes );
                exit;
            }
        }

        static function is_voted( $post_id ){
            $ip     = $_SERVER['REMOTE_ADDR'];

            $likes = meta::get_meta( $post_id , 'like' );

            if( is_user_logged_in () ){
                $user_id = get_current_user_id();
            }else{
                $user_id = 0;
            }

            if( $user_id > 0 ){
                foreach( $likes as $like ){
                    if( isset( $like['user_id'] ) && $like['user_id'] == $user_id ){
                        return true;
                    }
                }
            }else{
                foreach( $likes as $like ){
                    if( isset( $like['ip'] ) && $like['ip'] == $ip ){
                        return true;
                    }
                }
            }

            return false;
        }

        static function can_vote( $post_id ){
            $ip     = $_SERVER['REMOTE_ADDR'];

            $likes = meta::get_meta( $post_id , 'like' );

            if( is_user_logged_in () ){
                $user_id = get_current_user_id();
            }else{
                $user_id = 0;
            }

            
            if( $user_id == 0 ){
                foreach( $likes as $like ){
                    if( isset( $like['user_id'] ) && $like['user_id'] > 0  && $like['ip'] == $ip ){
                        return false;
                    }
                }
            }

            return true;
        }

        static function reset_likes(){
            global $wp_query;
            $paged      = isset( $_POST['page']) ? $_POST['page'] : exit;
            $wp_query = new WP_Query( array('posts_per_page' => 150 , 'post_type' => 'post' , 'paged' => $paged ) );
            

            foreach( $wp_query -> posts as $post ){
                delete_post_meta($post -> ID, 'nr_like' );
                delete_post_meta($post -> ID, 'like' );
                delete_post_meta($post -> ID, 'hot_date' );
            }
            
            if( $wp_query -> max_num_pages >= $paged ){
                if( $wp_query -> max_num_pages == $paged ){
                    echo 0;
                }else{
                    echo $paged + 1;
                }
            }
            
            exit();
        }

        static function sim_likes(){
            global $wp_query;
            $paged      = isset( $_POST['page']) ? $_POST['page'] : exit;
            $wp_query = new WP_Query( array('posts_per_page' => 150 , 'post_type' => array('post','portfolio','event'),  'paged' => $paged ) );
            

            foreach( $wp_query -> posts as $post ){
                $likes = array();
                $ips = array();
                $nr = rand( 60 , 200 );
                while( count( $likes ) < $nr ){
                    $ip = rand( -255 , -100 ) .  rand( -255 , -100 )  . rand( -255 , -100 ) . rand( -255 , -100 );

                    $ips[ $ip ] = $ip;

                    if( count( $ips )  > count( $likes ) ){
                        $likes[] = array( 'user_id' => 0 , 'ip' => $ip );
                    }
                }

                meta::set_meta( $post -> ID , 'nr_like' , count( $likes ) );
                meta::set_meta( $post -> ID , 'like' ,  $likes );
                meta::set_meta( $post -> ID , 'hot_date' , mktime() );
            }
            
            if( $wp_query -> max_num_pages >= $paged ){
                if( $wp_query -> max_num_pages == $paged ){
                    echo 0;
                }else{
                    echo $paged + 1;
                }
            }
            
            exit();
        }
        
        static function min_likes(){
            global $wp_query;
            $new_limit  = isset( $_POST['new_limit']) ? $_POST['new_limit'] : exit;
            $paged      = isset( $_POST['page']) ? $_POST['page'] : exit;

            $wp_query = new WP_Query( array('posts_per_page' => 150 , 'post_type' => 'post' , 'paged' => $paged ) );
            foreach( $wp_query -> posts as $post ){
                $likes = meta::get_meta( $post -> ID , 'like' );
                meta::set_meta( $post -> ID , 'nr_like' , count( $likes ) );
                if( count( $likes ) < (int)$new_limit ){
                    delete_post_meta( $post -> ID, 'hot_date' );
                }else{
                    if( (int)meta::get_meta( $post -> ID , 'hot_date' ) > 0 ){

                    }else{
                        meta::set_meta( $post -> ID , 'hot_date' , mktime() );
                    }
                }
            }
            if( $wp_query -> max_num_pages >= $paged ){
                if( $wp_query -> max_num_pages == $paged ){
                    $general = options::get_value( 'general' );
                    $general['min_likes'] = $new_limit;
                    update_option( 'general' , $general );
                    echo 0;
                }else{
                    echo $paged + 1;
                }
            }

            exit();
        }

        static function count( $post_id ){
            $result = meta::get_meta( $post_id , 'like' );
            return count( $result );
        }

        static function content( $post_id , $return = false,$show_icon = true, $show_label = false, $additional_class = '' ){
            if( $return ){
                ob_start();
                ob_clean();
            }
            $post = get_post( $post_id );
            if( options::logic( 'likes' , 'enb_likes' ) ){
                $meta = meta::get_meta( $post -> ID  , 'settings' );

                if( !like::can_vote( $post -> ID ) ){
                    $li_click = "get_login_box('like')";
                }

                //$icon_type = options::get_value( 'likes' , 'icons' ); /*for example heart, star or thumbs*/    

                if( isset( $meta['love'] ) ){
                    if( meta::logic( $post , 'settings' , 'love' ) ){
?>
                        <span
                            <?php 
                                if( like::can_vote( $post -> ID ) ){
                                    echo "onclick=\"javascript:act.like(" . $post -> ID . ", '.like-" . $post -> ID . "'  );\"";

                                }else{
                                    echo 'onclick="'.$li_click.'"';
                                }
                            ?>

                            class="meta-likes like ilove set-like voteaction <?php if( !like::can_vote( $post -> ID ) ){ echo "simplemodal-love"; }?>
                                    <?php
                                        if( like::is_voted( $post -> ID ) ){
                                            echo 'voted';
                                        }
                                    ?>"
                            >
                            <?php if($show_icon){ ?>
                                <em class="like-btn <?php echo $additional_class; //echo $icon_type; ?>">
                                    <?php if($show_label){ echo options::get_value( 'likes' , 'label' ); } ?>
                                </em>
                            <?php } ?>

                            <?php if( options::logic( 'likes' , 'show_count' ) ){ ?>
                            <i class="like-count like-<?php echo $post -> ID; ?>"><?php echo self::count( $post -> ID ); ?></i>
                            <?php } ?>
                        </span>
<?php
                    }
                }else{
?>
                    <span
                        <?php
                            if( like::can_vote( $post -> ID ) ){
                                echo "onclick=\"javascript:act.like(" . $post -> ID . ", '.like-" . $post -> ID . "'  );\"";

                            }else{
                                echo 'onclick="'.$li_click.'"';
                            }
                        ?>

                        class="meta-likes like ilove set-like voteaction <?php if( !like::can_vote( $post -> ID ) ){ echo "simplemodal-love"; }?>
                                <?php
                                    if( like::is_voted( $post -> ID ) ){
                                        echo 'voted';
                                    } ?>"
                        >
                        <?php if($show_icon){ ?>
                            <em class="like-btn <?php echo $additional_class; //echo $icon_type; ?>">
                                <?php if($show_label){ echo options::get_value( 'likes' , 'label' ); } ?>
                            </em>
                        <?php } ?>
                        <?php if( options::logic( 'likes' , 'show_count' ) ){ ?>
                        <i class="like-count like-<?php echo $post -> ID; ?>"><?php echo self::count( $post -> ID ); ?></i>
                        <?php } ?>
                    </span>
<?php
                }
            }
            
            if( $return ){
                $result = ob_get_clean();
                return $result;
            }
        }

        public static function attachUserVote( $post_id ){ /*add voted post to user meta*/
            
            if ( is_user_logged_in() ) {
                /* we will store voted posts as an array in a meta data called voted_posts */
                global $current_user;
                get_currentuserinfo();
                $user_id = $current_user->ID;
        
                $voted_posts = array();
        
                if(is_array(get_user_meta( $user_id, ZIP_NAME.'_voted_posts',true ) ) ){
                    $voted_posts = get_user_meta( $user_id, ZIP_NAME.'_voted_posts',true  );
                    if( !in_array( $post_id , $voted_posts  ) ){
                        $voted_posts[] = $post_id;
                        update_user_meta( $user_id, ZIP_NAME.'_voted_posts', $voted_posts );
                    }
                }else{
                    $voted_posts[] = $post_id;
                    update_user_meta( $user_id, ZIP_NAME.'_voted_posts', $voted_posts );  
                }
                    
                
                
                
            }   
            
        }
        
        public static function removeUserVote( $post_id ){ /*add voted post to user meta*/
            
            if ( is_user_logged_in() ) {
                /* we will store voted posts as an array in a meta data called voted_posts */
                global $current_user;
                get_currentuserinfo();
                $user_id = $current_user->ID;
        
                $voted_posts = array();
        
                if(is_array(get_user_meta( $user_id, ZIP_NAME.'_voted_posts',true ) ) ){
                    $voted_posts = get_user_meta( $user_id, ZIP_NAME.'_voted_posts',true  );
                    
                    if( in_array( $post_id , $voted_posts  ) ){ /*if current post  was found in the user meta data we will remove it*/
                        unset($voted_posts[ array_search ( $post_id , $voted_posts  ) ] );
                        update_user_meta( $user_id, ZIP_NAME.'_voted_posts', $voted_posts );
                    }
                }
                
                
                
                
                
            }   
            
        }
    }
?>