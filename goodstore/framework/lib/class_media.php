<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if (!class_exists('jwMedia')) {

    class jwMedia {

        private static $_images = array();

        /**
         * loadResponsiveImages
         * 
         * @description vrati obrazy ve vsech pozadovanych velikostech
         * 
         * @param type $json - json z media pickeru
         * @param type $sizes
         */
        public static function loadResponsiveImages($json, $sizes = 'thumbnail') {

            $json = json_decode($json);
            
            self::$_images = array();
            foreach ((array) $json as $id => $img) {
                self::$_images[$id] = array();
                if (isset($img->id)) {
                    foreach ((array) $sizes as $size) {
                        $url = wp_get_attachment_image_src($img->id, $size);
                        if (isset($url[0])) {
                            self::$_images[$id][$size] = $url[0];
                        }
                    }
                } else {
                    foreach ((array) $sizes as $size) {
                        self::$_images[$id][$size] = '';
                    }
                }
            }

            return self::$_images;
        }

        /**
         * getImageSrc
         * 
         * @description vrati src obrazku dle $id a $size
         * 
         * @param type $id
         * @param type $size
         * @return string
         */
        public static function getImageSrc($id,$size){
            $image = '';
          
            if(isset(self::$_images[$id][$size])){
               $image =  self::$_images[$id][$size];
            }
            return esc_url($image);
        }
        
        /**
         * hasImage
         * 
         * @description vrati odpoed zda-li je obrazek s danym id načten
         * 
         * @param type $id
         * @param type $size
         * @return bool
         */
        public static function hasImage($id,$size){
          
            if(isset(self::$_images[$id][$size]) && self::$_images[$id][$size] != ''){
               return true;
            }
            return false;
        }
        
        /**
         * getImages
         * 
         * @description vrati vsechny obrazky
         * 
         * @return array
         */
        public static function getImages(){
            return self::$_images;
        }
        
    }

}