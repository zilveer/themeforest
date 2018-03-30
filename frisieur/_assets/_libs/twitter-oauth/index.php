<?php

   /**
    *   
    * Class WordPress Twitter API
    *
    * @version 1.0.0
    * @url https://github.com/micc83/Twitter-API-1.1-Client-for-Wordpress
    * 
    * small modifications by Martanian            
    *     
    */
    
    class Wp_Twitter_Api {
  
       /**
        *
        * define class variables
        * 
        */                                 
        
        var $bearer_token = '';
        var $has_error = false;
        
        var $args = array(
            'consumer_key' => '',
            'consumer_secret' => ''
        );

        var $query_args = array(
            'type' => 'statuses/user_timeline',
            'cache' => 1800
        );

       /**
        *       
        * WordPress Twitter API Constructor
        *
        * @param array $args
        *         
        */
        
        public function __construct( $args = array() ) {

            if( is_array( $args ) && !empty( $args ) ) $this -> args = array_merge( $this -> args, $args );
            if( !$this -> bearer_token = get_option( 'twitter_bearer_token' ) ) $this -> bearer_token = $this -> get_bearer_token();
        }
        
       /**
        *        
        * Get the token from oauth Twitter API
        *
        * @return string Oauth Token
        *         
        */
        
        private function get_bearer_token() {
                
            $bearer_token_credentials = $this -> args['consumer_key'] . ':' . $this -> args['consumer_secret'];
            $bearer_token_credentials_64 = base64_encode( $bearer_token_credentials );
            
            $args = array(
                'method' => 'POST',
                'timeout' => 5,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'headers' => array(
                    'Authorization' => 'Basic '. $bearer_token_credentials_64,
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
                    'Accept-Encoding' => 'gzip'
                ),
                'body' => array( 'grant_type' => 'client_credentials' ),
                'cookies' => array()
            );
            
            $response = wp_remote_post( 'https://api.twitter.com/oauth2/token', $args );

            if( is_wp_error( $response ) || 200 != $response['response']['code'] ) return false;
            $result = json_decode( $response['body'] );
            
            update_option( 'twitter_bearer_token', $result -> access_token );
            return $result -> access_token;
        }
        
       /**
        *        
        * Query twitter's API
        *
        * @uses $this->get_bearer_token() to retrieve token if not working
        *
        * @param string $query Insert the query in the format "count=1&include_entities=true&include_rts=true&screen_name=micc1983!
        * @param array $query_args Array of arguments: Resource type (string) and cache duration (int)
        * @param bool $stop Stop the query to avoid infinite loop
        *
        * @return bool|object Return an object containing the result
        *          
        */
     
        public function query( $query, $query_args = array() ) {

            if( $this -> has_error || $this -> bearer_token == false ) return false;
            if( is_array( $query_args ) && !empty( $query_args ) ) $this -> query_args = array_merge( $this -> query_args, $query_args );

            # $transient_name = 'wta_'. md5( $query );
            # if( false !== ( $data = get_transient( $transient_name ) ) ) return json_decode( $data );

            $args = array(
                'method' => 'GET',
                'timeout' => 5,
                'redirection' => 5,
                'httpversion' => '1.0',
                'blocking' => true,
                'compress' => false,
                'decompress' => true,
                'headers' => array(
                    'Authorization' => 'Bearer '. $this -> bearer_token,
                    'Accept-Encoding' => 'gzip'
                ),
                'body' => null,
                'cookies' => array()
            );

            $response = @wp_remote_get( 'https://api.twitter.com/1.1/'. $this -> query_args['type'] .'.json?'. $query, $args );
            if( is_wp_error( $response ) || 200 != $response['response']['code'] ) return false;

            # set_transient( $transient_name, $response['body'], $this -> query_args['cache'] );
            return json_decode( $response['body'] );
        }
        
       /**
        *
        * end of methods
        * 
        */                                
    }
    
   /**
    *
    * end of class
    * 
    */
    
?>                