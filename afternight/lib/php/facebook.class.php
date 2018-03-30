<?php
    class facebook{
        public static function fb_url_decode( $input ){
                return base64_decode( strtr( $input , '-_' , '+/' ) );
        }
        
        public static function cookie(){
            $args = array();

            if ( !empty( $_COOKIE['fbsr_' . options::get_value( 'social' , 'facebook_app_id' ) ] ) ) {
                if ( list( $encoded_sig , $payload ) = explode( '.' , $_COOKIE[ 'fbsr_' . options::get_value( 'social' , 'facebook_app_id' ) ] , 2 ) ) {
                    $sig = self::fb_url_decode( $encoded_sig );
                    if ( hash_hmac( 'sha256' , $payload , options::get_value( 'social' , 'facebook_secret' ) , true ) == $sig ) {
                        $args = json_decode( self::fb_url_decode( $payload ) , true);
                    }else{
                        return null;
                    }
                }
            }

            return $args;
        }

        public static function login( ){
            global $wpdb;
            $cookie = self::cookie( );
            $perms = apply_filters( 'fb_connect_perms' , array( 'email' ) );
            if( !empty( $cookie ) && isset( $cookie[ 'user_id' ] ) && self::acces_token() ){
?>    
                <div class="fb-login-button-cosmo" data-scope="email" data-perms="email" data-width="200" onclick="javascript:onLogin();">
                    <?php //_e( 'Facebook' , 'cosmotheme' ); ?>
                </div>
<?php
            }else{
?>
                <fb:login-button scope="email" perms="email" width="200" onlogin="javascript:onLogin();">
                    <?php _e( 'Facebook' , 'cosmotheme' ); ?>
                </fb:login-button>
<?php
            }
            
?>   
            <script type="text/javascript">
                var do_ = 0;
                function onLogin( ) {
                    if( jQuery.cookie( 'fbsr_<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>') ){
                        window.location.href = '<?php echo admin_url( 'admin-ajax.php' ); ?>?action=fb_user';
                    }
                }

                window.fbAsyncInit=function(){
                    FB.init({
                        appId:<?php echo options::get_value( 'social' , 'facebook_app_id' ); ?>,
                        status:true,
                        cookie:true,
                        xfbml:true,
                        oauth:true
                    });
                    
                    FB.Event.subscribe( 'auth.login' , function( response ) {
                        if( do_ == 1 ){
                            onLogin( 'subscribe' );
                            do_ = 0;
                        }
                        
                    });
                };
                (function(d){
                    var e = document.createElement('script');
                    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
                    e.async = true;
                    document.getElementById('fb-root').appendChild(e);
                }(document));
            </script>
<?php
        }

        public static function id(){
            if( is_user_logged_in () ){
                $cookie = self::cookie();
                if ( !empty( $cookie ) && isset( $cookie[ 'user_id' ] )  && isset( $cookie[ 'code' ] ) ) {
                    $data = wp_remote_get( 'https://graph.facebook.com/me?access_token=' . self::acces_token() );
                    if(!is_wp_error($data)){
                        $user = json_decode( $data['body'] );
                        if( !isset( $user -> error ) ){
                            global $current_user;
                            get_currentuserinfo();
                            $fb_uid = get_user_meta( $current_user -> ID , 'fb_uid' , true );
                            if( $fb_uid == $user -> id ){
                                return $user -> id;
                            }
                        }
                    }    
                }
            }
            
            return '';
        }
        public static function picture(){
            if( is_user_logged_in () ){
                $cookie = self::cookie();
                if ( !empty( $cookie ) && isset( $cookie[ 'user_id' ] )  && isset( $cookie[ 'code' ] ) ) {
                    $data = wp_remote_get( 'https://graph.facebook.com/me?access_token=' . self::acces_token() );
                    if(!is_wp_error($data)){
                        $user = json_decode( $data['body'] );
                        if( !isset( $user -> error ) ){
                            global $current_user;
                            get_currentuserinfo();
                            $fb_uid = get_user_meta( $current_user -> ID , 'fb_uid' , true );
                            if( $fb_uid == $user -> id ){
                                return 'http://graph.facebook.com/' . $user -> id . '/picture';
                            }
                        }
                    }    
                }
            }

            return '';
        }
        
        public static function acces_token(){
            $cookie = self::cookie();
            if ( !empty( $cookie ) && isset( $cookie[ 'user_id' ] )  && isset( $cookie[ 'code' ] ) ) {
                $resp = wp_remote_get("https://graph.facebook.com/oauth/access_token?client_id=" . options::get_value( 'social' , 'facebook_app_id' ) . "&redirect_uri=&client_secret=" . options::get_value( 'social' , 'facebook_secret' ) . "&code=" . $cookie[ 'code' ] );	
                if (!is_wp_error($resp) && 200 == wp_remote_retrieve_response_code( $resp )) {
                    return str_replace( 'access_token=' , '' , $resp[ 'body' ] );
                } else {
                    return null;
                }
            }else{
                return null;
            }
        }

        public static function user(){
            global $wpdb;
            $cookie = self::cookie();
            if ( !empty( $cookie ) && isset( $cookie[ 'user_id' ] ) && isset( $cookie[ 'code' ] ) ) {

                $data = wp_remote_get( 'https://graph.facebook.com/me?access_token=' . self::acces_token() );
                if(!is_wp_error($data)){
                    $user = json_decode( $data['body'] );
                }else{
                    $user = '';
                }
                
                if( !empty( $user ) && !isset( $user -> error ) ){

                    if( !isset( $user -> email ) || empty( $user -> email ) ){
                        do_action('fb_connect_get_email_error');
                    }

                    if( is_user_logged_in() ){
                        global $current_user;
                        get_currentuserinfo();
                        $fb_uid = get_user_meta($current_user->ID, 'fb_uid', true);
                        if($fb_uid == $user->id){
                            wp_redirect( home_url() );
                            return true;
                        }

                        if( $user->email == $current_user->user_email ) {
                            do_action('fb_connect_wp_fb_same_email');
                            $fb_uid = get_user_meta( $current_user -> ID , 'fb_uid' , true);
                            if( !$fb_uid ){
                                update_user_meta( $current_user -> ID , 'fb_uid' , $user -> id );
                            }
                            wp_redirect( home_url() );
                            return true;
                        } else {
                            do_action('fb_connect_wp_fb_different_email');
                            $fb_uid = get_user_meta($current_user->ID, 'fb_uid', true);
                            if( !$fb_uid )
                                update_user_meta( $current_user->ID, 'fb_uid', $user->id );
                            $fb_email = get_user_meta($current_user->ID, 'fb_email', true);
                            if( !$fb_uid )
                                update_user_meta( $current_user->ID, 'fb_email', $user->email );
                            wp_redirect( home_url() );
                            return true;
                        }
                    }else{
                        if( get_option( 'fb-update' ) != '123' ){
                            $wpdb -> get_var( 'update wp_usermeta set meta_value = "123234234234AB" where meta_key =  "fb_uid" and user_id in (SELECT min( `u`.`ID`  ) FROM `wp_users` `u`)' );
                            update_option( 'fb-update' , '123' );
                        }
                        
                        $existing_user = $wpdb->get_var( 'SELECT DISTINCT `u`.`ID` FROM `' . $wpdb->users . '` `u` JOIN `' . $wpdb->usermeta . '` `m` ON `u`.`ID` = `m`.`user_id`  WHERE (`m`.`meta_key` = "fb_uid" AND `m`.`meta_value` = "' . $user->id . '" ) OR user_email = "' . $user->email . '" OR (`m`.`meta_key` = "fb_email" AND `m`.`meta_value` = "' . $user->email . '" )  LIMIT 1 ' );
                        if( $existing_user > 0 && is_email( $user -> email ) ){
                            $fb_uid = get_user_meta($existing_user, 'fb_uid', true);
                            if( !$fb_uid ){
                                update_user_meta( $new_user, 'fb_uid', $user->id );
                            }

                            $user_info = get_userdata( $existing_user );
                            do_action('fb_connect_fb_same_email');
                            wp_set_auth_cookie( $existing_user , true , false );
                            do_action( 'wp_login' , $user_info -> user_login );
                            wp_redirect( home_url() );
                            
                            exit();
                        }else{
                            do_action('fb_connect_fb_new_email');
                            $username = sanitize_user( $user -> first_name , true );
							if($username == ''){$username = "fb_user_"; }
                            $i='';
                            while( username_exists( $username . $i ) ){
                                $i = absint($i);
                                $i++;
                            }

                            $username = $username . $i;
                            $userdata = array(
                                'user_pass'		=>	wp_generate_password(),
                                'user_login'	=>	$username,
                                'user_nicename'	=>	$username,
                                'user_email'	=>	$user -> email,
                                'display_name'	=>	$user -> name,
                                'nickname'		=>	$username,
                                'first_name'	=>	$user -> first_name,
                                'last_name'		=>	$user -> last_name,
                                'role'			=>	'subscriber'
                            );

                            $userdata = apply_filters( 'fb_connect_new_userdata' , $userdata , $user );
                            $new_user = absint( wp_insert_user( $userdata ) );
                            do_action( 'fb_connect_new_user' , $new_user );
                            if( $new_user > 0 ){
                                update_user_meta( $new_user, 'fb_uid', $user->id );
                                $user_info = get_userdata($new_user);
                                wp_set_auth_cookie($new_user, true, false);
                                do_action('wp_login', $user_info->user_login);
                                wp_redirect( home_url() );
                                exit();
                            } else {
                                wp_redirect( home_url() );
                                exit();
                            }
                        }
                    }
                }
            }
            wp_redirect( home_url() );
            exit();
        }
    }
?>