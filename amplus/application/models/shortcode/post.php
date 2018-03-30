<?php

class BFIShortcodePostModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'post';
    const ALIAS = 'posts';
    
    public $class = '';
    
    public $categories = '';
    public $orderby = 'date';
    
    public $page = '1';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $num = '3'; 
        
        // these are the initial query args
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'ignore_sticky_posts' => true,
            );
        
        // page
        $args['offset'] = ((int)$this->page - 1) * $num;
        
        // categories
        if ($this->categories) {
            $args['cat'] = '';
            
            $catsToCheck = array();
            if (stripos($this->categories, ',') !== false) {
                $catsToCheck = explode(',', $this->categories);
            } else {
                $catsToCheck[] = $this->categories;
            }
            
            // check the categories available and find for a match
            $categories = get_categories(array('hide_empty' => 0));
            foreach ($catsToCheck as $catToCheck) {
                $catToCheck = trim(strtolower($catToCheck));
                
                $found = false;
                foreach ($categories as $category) {
                    if ($catToCheck == strtolower($category->name) ||
                        $catToCheck == $category->slug) {
                        $args['cat'] .= $args['cat'] ? ',' : '';
                        $args['cat'] .= $category->cat_ID;
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $args['cat'] .= $args['cat'] ? ',' : '';
                    $args['cat'] .= $catToCheck;
                }
            }
            
            // this is the default behavior if nothing matched above
            if (!$args['cat']) {
                $args['cat'] = $this->categories;
            }
        }

        // orderby
        if ($this->orderby) {
            $args['orderby'] = $this->orderby;
        }
        
        // loop through posts
        $ret = "";
        $i = 1;
        $loop = new WP_Query($args);
        while ( $loop->have_posts() ) : $loop->the_post();
        
            if ( has_post_thumbnail( get_the_ID() ) ) {
                $image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
            } else {
                $image = bfi_get_post_meta(get_the_ID(), "preview_image");
            }
            $mediaType = bfi_get_post_meta(get_the_ID(), "preview_type");
            $video = bfi_get_post_meta(get_the_ID(), "preview_video");
            
            // date
            $month = get_the_date("M");
            $day = get_the_date("j");
            $year = get_the_date("Y");
            if ($year == date("Y")) { // same year
                $date = "$month $day";
            } else {
                $date = "$month $day, $year";
            }
            
            // author
            $author = sprintf('<a href="%1$s" title="%2$s">%3$s</a>',
                get_author_posts_url(get_the_author_meta('ID')),
                sprintf(__("View all posts by %s", BFI_I18NDOMAIN), get_the_author()),
                get_the_author());
        
            $preview = '';
            if ($mediaType == "image") {
                $preview = sprintf("<a href='%s' class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                    get_permalink(),
                    "lightbox icon-plus icon-3x",
                    bfi_thumb($image, array('height' => 315 * .7, 'width' => 420, 'crop' => true)), // orig image
                    bfi_thumb(BFI_BLANKIMAGE, array('height' => 315 * .7, 'width' => 420, 'crop' => true, 'format' => '1')), // blank image
                    bfi_thumb($image, array('height' => 315 * .7, 'width' => 420, 'crop' => true)) // orig image
                );
            } else {
                $video = preg_replace("/width=[\"|\']\d+[\"|\']/i", "width=\"420\"", $video);
                $video = preg_replace("/height=[\"|\']\d+[\"|\']/i", "height=\"".(315 * .7)."\"", $video);
                $preview = $video;
                $preview = "<div>$preview<div class='clearfix'></div></div>";
            }

            $class = '';
            if ($i == 1) {
                $class .= ' alpha';
            } elseif ($i == 3) {
                $class .= ' omega';
            }
            
            
            bfi_set_excerpt_readmore('');
            
            $readmore = do_shortcode(sprintf("[button class='readmore' label='%s <i class=\"icon-double-angle-right\"></i>' href='%s']", __("Read more", BFI_I18NDOMAIN), get_permalink()));
        
            $ret .= do_shortcode("<div class='shortcode-post column one-third $class'><h4><a href='".get_permalink()."'>".get_the_title()."</a></h4><small>".sprintf(__("Posted on %s by %s", BFI_I18NDOMAIN), $date, $author)."</small>$preview<div><span>".bfi_get_the_excerpt(100)."</span>$readmore</div></div>");
            
            if ($i == 3) break;
            $i++;
        
        endwhile;
        unset($loop);
        wp_reset_postdata();
        
        
        while ($i < 3) {
            $class = '';
            $class = $i == 1 ? "alpha" : $class;
            $class = $i == 3 ? "omega" : $class;
            $ret .= "<div class='shortcode-post column one-third $class'></article>";
            $i++;
        }

        $ret .= "<div class='clearfix'></div>";
        
        return $ret;
    }
}
