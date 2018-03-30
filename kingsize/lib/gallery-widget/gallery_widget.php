<?php
/*
Widget Gallery Sidebar
Credit to Website link: http://blog.splash.de/
Description: Simple widget to show the latest/random images of the WordPress media gallery as a Widget, using a shortcode or directly with a php-function.
Credit to Author: Oliver Schaal
*/
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

global $wp_version;
define('WPV28', version_compare($wp_version, '2.8', '>='));

if (!WPV28) {
    die('This version of KingSize Gallery Widget isn\'t compatible to WordPress version less than 2.8');
}


if (!class_exists("GalleryWidget")) {
    class GalleryWidget {
        // version
        var $version;

        /* __construct */
        function __construct() {  
            add_shortcode('getGWImages', array(&$this, 'getShortCodeAttachedImages'));
            add_shortcode('getGWImages2', array(&$this, 'getShortCodeAttachedImagesByCategories'));
        }
        /* __construct */        


        /* getShortCodeAttachedImages */
        function getShortCodeAttachedImages($arg) {
            $options = shortcode_atts( array(
                                             'max' => 5,
                                             'order' => 'latest',
                                             'linktype' => 'just display'
                                             ), $arg );

            return $this->getAttachedImages($options['max'], $options['order'],
                                            $options['linktype']);
        }
        /* getShortCodeAttachedImages */

        /* getShortCodeAttachedImagesByCategories */
        function getShortCodeAttachedImagesByCategories($arg) {
            $options = shortcode_atts( array(
                                             'max' => 5,
                                             'order' => 'latest',
                                             'categories' => '0',
                                             'option' => 'exclude',
                                             'linktype' => 'just display',
                                             'singleimage' => 'no'
                                             ), $arg );

            return $this->getAttachedImagesByCategories($options['max'],
                                                        $options['order'],
                                                        $options['categories'],
                                                        $options['option'],
                                                        $options['linktype'],
                                                        $options['singleimage']);
        }
        /* getShortCodeAttachedImagesByCategories */
        
        /* getImageLink */
        function getImageLink($id, $linktype, $parent_id = 0)
        {
            if ($linktype == 'direct' && $linktype != 'just display') {
                return wp_get_attachment_url($id);
            } elseif ($linktype == 'article' && $linktype != 'just display') {
                if ($parent_id == 0) {
                    $parent_id == $id;
                }
                return get_permalink($parent_id);
            } elseif($linktype != 'just display') {
                return get_attachment_link($id);
            }
			else
				return false;
        }
        /* getImageLink */

        /* getAttachedImagesByCategories */
        function getAttachedImagesByCategories($_max = 5, $order = 'latest',
            $categories = '0', $option = 'include',
            $linktype = 'just display', $linkclass = '',
            $linkrel = '', $singleimage = 'no', $titletype = 'default', $thumbsize = 'full')
        {
            global $wpdb; // wordpress database access
            $_addcss = '';
            $_addrel = '';
            
            /* if empty, set to default size, could be dropped later */
            if (empty($thumbsize))
                $thumbsize = 'full';

            if ($order == 'random') {
                $_orderby = 'ORDER BY RAND() ';
            } else {
                $_orderby = 'ORDER BY posts.post_date DESC ';
            }

            if ($singleimage == 'yes') {
                $_groupby = 'GROUP BY posts.post_parent ';
            } else {
                $_groupby = '';
            }

            if (empty($categories)) $categories = '0';    // otherwise 0 -> ''
			
			
            if ($option == 'exclude') {
                $_query = "SELECT DISTINCT ID FROM $wpdb->posts AS posts
                           INNER JOIN $wpdb->term_relationships AS tr ON ( posts.ID = tr.object_id )
                           INNER JOIN $wpdb->term_taxonomy AS tt ON ( tr.term_taxonomy_id = tt.term_taxonomy_id )
                           WHERE posts.post_type IN ('post','galleries') AND (term_id IN ( $categories )
                           OR posts.post_status = 'draft' OR posts.post_status = 'future')";

				 $_query = "SELECT DISTINCT ID
						FROM $wpdb->posts AS posts
						WHERE posts.post_type IN ('post','galleries')
						AND posts.post_status = 'publish'";
				
            } else {
                $_query = "SELECT DISTINCT ID FROM $wpdb->posts AS posts
                           INNER JOIN $wpdb->term_relationships AS tr ON ( posts.ID = tr.object_id )
                           INNER JOIN $wpdb->term_taxonomy AS tt ON ( tr.term_taxonomy_id = tt.term_taxonomy_id )
                           WHERE posts.post_type IN ('post','galleries') AND posts.post_status = 'publish'
                           AND term_id IN ( $categories )";
            }
			
           //  print ('<!-- SQL 1:'. $_query . "-->\n");

            unset($_list);
            $_idarray = $wpdb->get_results($_query, ARRAY_A);
            if (count($_idarray) > 0) {
                foreach ($_idarray as $id) {
                    $_list[] = $id['ID'];
                }
                $_list = implode(',', $_list);
            } else {
                $_list = '0';
            }

            if ($option == 'exclude') {
              
				  $_query = $wpdb->prepare("SELECT ID, post_title, post_parent FROM $wpdb->posts AS posts
                           WHERE posts.post_type = 'attachment'
                           AND posts.post_mime_type IN ('image/jpeg','image/gif','image/jpg','image/png')
                           AND posts.post_parent IN ( $_list ) ${_groupby}${_orderby}LIMIT 0 , %d", $_max);
            } else {
                $_query = $wpdb->prepare("SELECT ID, post_title, post_parent FROM $wpdb->posts AS posts
                           WHERE posts.post_type = 'attachment'
                           AND posts.post_mime_type IN ('image/jpeg','image/gif','image/jpg','image/png')
                           AND posts.post_parent IN ( $_list ) ${_groupby}${_orderby}LIMIT 0 , %d", $_max);
            }
			//print $_query;
            // print ('<!-- SQL 2:'. $_query . "-->\n");

            $_result = $wpdb->get_results($_query);

            if (count($_result) > 0) {
                $_retval = '<ul id="wGalleryId" class="wGallery">';
                foreach($_result as $_post) {
                    if (!empty($linkclass)) {
                        $_addcss = ' class="'.$linkclass.'"';
                    }
                    if (!empty($linkrel)) {
                        $_addrel = ' rel="'.$linkrel.'"';
                    }

                    if ($titletype == 'post') {
                        $_imgtitle = get_the_title($_post->post_parent);
                    } else {
                        $_imgtitle = $_post->post_title;
                    }
                    
                    $thumb = wp_get_attachment_image_src($_post->ID, $thumbsize);
					//print $thumb[0];
					//wm_image_resize('180','90',  $thumb[0])
					if($linktype == 'just display'){
				       $_retval .= '<li><img src="' .
                                $thumb[0] . '" alt="' .
                                $_imgtitle . '" title="' .
                                $_imgtitle . '"/></li>';
					}
					else{
						 $_retval .= '<li><a href="' .
                                $this->getImageLink($_post->ID, $linktype, $_post->post_parent) .
                                '"' . $_addcss . $_addrel . '><img src="' .
                                $thumb[0] . '" alt="' .
                                $_imgtitle . '" title="' .
                                $_imgtitle . '"/></a></li>';
					}
                }
                $_retval .= '</ul>';
            }

            return $_retval;
        }
        /* getAttachedImagesByCategories */

        /* getAttachedImages */
        function getAttachedImages($_max = 5, $order = 'latest', $linktype = 'page',
            $linkclass = '', $linkrel = '', $thumbsize = 'full')
        {
            $_addcss = '';
            $_addrel = '';
            $_retval = '';
            
            /* if empty, set to default size, could be dropped later */
            if (empty($thumbsize))
                $thumbsize = 'full';

            if ($order == 'random') {
                $r = new WP_Query("showposts=$_max&what_to_show=posts&post_status=inherit&post_type=attachment&orderby=rand&post_mime_type=image/jpeg,image/gif,image/jpg,image/png");
            } else {
                $r = new WP_Query("showposts=$_max&what_to_show=posts&post_status=inherit&post_type=attachment&orderby=menu_order ASC, ID ASC&post_mime_type=image/jpeg,image/gif,image/jpg,image/png");
            }

            if ($r->have_posts()) {
                $_retval = '<ul id="wGalleryId" class="wGallery">';
                while ($r->have_posts()) : $r->the_post();

                if (!empty($linkclass)) {
                    $_addcss = ' class="'.$linkclass.'"';
                }
                if (!empty($linkrel)) {
                    $_addrel = ' rel="'.$linkrel.'"';
                }
                
                $thumb = wp_get_attachment_image_src(get_the_ID(), $thumbsize);
				/////
                $url_template = get_template_directory_uri();				
				//////

				if($linktype == 'just display'){
			         $_retval .= '<li class="wGallery"><img src="' .
                                $thumb[0]  .
                                '" alt="' . get_the_title() . 
                                '" title="' . get_the_title() .
                                '"/></li>';
				}	
				else{
					$_retval .= '<li class="wGallery"><a href="' .
				     $this->getImageLink(get_the_ID(), $linktype) .
                                '"' . $_addcss . $_addrel . '><img src="' .
                                $thumb[0]  .
                                '" alt="' . get_the_title() . 
                                '" title="' . get_the_title() .
                                '"/></a></li>';
				}

                endwhile;
                $_retval .= '</ul>';
            }

            return $_retval;
        }
        /* getAttachedImages */

    }
}

if (class_exists("GalleryWidget")) {
    $galleryWidget = new GalleryWidget();
}

// WidgetObject, allows multiple instances of the widget
require_once('GalleryWidgetObject.php');


/* Wrapper for old function calls, you shouldn't use it anymore */
if (is_object($galleryWidget)) {
    function get_attached_images_by_categories($_max = 5, $order = 'latest',
    $categories = 0, $option = 'include',
    $linktype = 'page', $linkclass = '',
    $linkrel = '', $singleimage = 'no',
    $titletype = 'default',
    $thumbsize = 'full')
    {
        global $galleryWidget;
        return $galleryWidget->getAttachedImagesByCategories($_max, $order,
               $categories, $option, $linktype, $linkclass, $linkrel, $singleimage, $titletype, $thumbsize);
    }
    function get_attached_images($_max = 5, $order = 'latest', $linktype = 'page',
    $linkclass = '', $linkrel = '')
    {
        global $galleryWidget;
        return $galleryWidget->getAttachedImages($_max, $order,
               $option, $linktype, $linkclass, $linkrel);
    }
}