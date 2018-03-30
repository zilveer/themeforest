<?php

class BFIShortcodePortfolioModel extends BFIShortcodeModel implements iBFIShortcode {
    
    const SHORTCODE = 'portfolio';
    
    public $class = '';
    
    public $categories = '';
    public $orderby = '';
    
    public $page = '1';
    
    public function render($content = NULL, $unusedAttributeString = '') {
        $num = 3; 
        
        // these are the initial query args
        $args = array(
            'post_type' => BFIPortfolioModel::POST_TYPE,
            'posts_per_page' => $num,
            'ignore_sticky_posts' => true,
            );
        
        // page
        $args['offset'] = ((int)$this->page - 1) * $num;
        
        // categories
        if ($this->categories) {
            $args['portfolio_category'] = '';
            
            $catsToCheck = array();
            if (stripos($this->categories, ',') !== false) {
                $catsToCheck = explode(',', $this->categories);
            } else {
                $catsToCheck[] = $this->categories;
            }
            
            // check the categories available and find for a match
            $categories = bfi_get_all_portfolio_categories();
            foreach ($catsToCheck as $catToCheck) {
                $catToCheck = trim(strtolower($catToCheck));
                
                $found = false;
                foreach ($categories as $category) {
                    if ($catToCheck == strtolower($category->name) ||
                        $catToCheck == $category->slug) {
                        $args['portfolio_category'] .= $args['portfolio_category'] ? ',' : '';
                        $args['portfolio_category'] .= bfi_get_taxonomy_slug($category->cat_ID);
                        $found = true;
                        break;
                    }
                }
                if (!$found) {
                    $args['portfolio_category'] .= $args['portfolio_category'] ? ',' : '';
                    $args['portfolio_category'] .= bfi_get_taxonomy_slug($catToCheck);
                }
            }
            
            // this is the default behavior if nothing matched above
            if (!$args['portfolio_category']) {
                $cats = explode(',', $this->categories);
                $args['portfolio_category'] = '';
                foreach ($cats as $cat) {
                    $args['portfolio_category'] .= $args['portfolio_category'] ? ',' : '';
                    $args['portfolio_category'] .= bfi_get_taxonomy_slug($cat);
                }
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
        
            // get the properties of the item
            if ( has_post_thumbnail( get_the_ID() ) ) {
                $image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
            } else {
                $image = bfi_get_post_meta(get_the_ID(), "preview_image");
            }
            $subtitle      = bfi_get_post_meta(get_the_ID(), "subtitle");
            $previewAction = bfi_get_post_meta(get_the_ID(), "preview_action");
            $url           = bfi_get_post_meta(get_the_ID(), "url_action");
            $newWindow     = bfi_get_post_meta(get_the_ID(), "url_new_window");
            $mediaImage    = bfi_get_post_meta(get_the_ID(), "media_image");
            $mediaVideo    = bfi_get_post_meta(get_the_ID(), "media_video");
            
            $width = 300;
            $height = 225;
            $class = 'one-third';
            
            // image links to portfolio page
            if ($previewAction == 'page') {
                $preview = sprintf("<a href='%s' class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                    get_permalink(),
                    "lightbox icon-plus icon-3x",
                    bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                    bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')), // blank image
                    bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)) // orig image
                );
            // image lightbox
            } else if ($previewAction == 'image') {
                $preview = do_shortcode(sprintf("[lightbox href='%s' src='%s' blank='%s']",
                    $mediaImage,
                    bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                    bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')) // blank image
                ));
            // video lightbox
            } else if ($previewAction == 'video') {
                $preview = do_shortcode(sprintf("[lightbox href='%s' src='%s' blank='%s']",
                    $mediaVideo,
                    bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                    bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')) // blank image
                ));
            // another link
            } else if ($previewAction == 'link') {
                $preview = sprintf("<a href='%s' %s class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                    $url,
                    $newWindow ? "target='_blank'" : '',
                    "lightbox icon-external-link icon-3x",
                    bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)), // orig image
                    bfi_thumb(BFI_BLANKIMAGE, array('height' => $height, 'width' => $width, 'crop' => true, 'format' => '1')), // blank image
                    bfi_thumb($image, array('height' => $height, 'width' => $width, 'crop' => true)) // orig image
                );
            }
            
            if ($i == 1) {
                $class .= ' alpha';
            } elseif ($i == 3) {
                $class .= ' omega';
            }
            
            $ret .= "
            <article class='portfolio column $class'>
                $preview
                <div>
                    <h4><a href='".get_permalink()."'>".get_the_title()."</a></h4>
                </div>
            </article>
            ";
            if ($i == 3) break;
            $i++;
        
        endwhile;
        unset($loop);
        wp_reset_postdata();
        
        while ($i < 3) {
            $class = '';
            $class = $i == 1 ? "alpha" : $class;
            $class = $i == 3 ? "omega" : $class;
            $ret .= "<article class='portfolio column one-third $class'></article>";
            $i++;
        }
        
        $ret .= "<div class='clearfix'></div>";
        
        return $ret;
    }
}
