<?php

class BFIWidgetPortfolioModel extends BFIWidgetModel implements iBFIWidget {
    
    // DO NOT USE __construct SINCE IT WILL CAUSE ERRORS
    function BFIWidgetPortfolioModel() {
        $this->label = 'Portfolio';
        $this->description = 'A list of portfolio items';
        $this->args = array(
            'numposts' => '5',
            'catid' => '',
            );
        parent::__construct();
    }
    
    public function render($args) {
        $category = '';
        if ($args['catid'] != '*') {
            $category = "&".BFIPortfolioModel::TAXONOMY_ID."=".bfi_get_taxonomy_slug($args['catid']);
        }
        $posts = get_posts('post_type='.BFIPortfolioModel::POST_TYPE.$category.'&order=ASC&orderby=rand&numberposts='.$args['numposts']);
        
        $width = 420;
        $height = 250;
        
        echo "<ul class='widgetportfolio'>";
        foreach ($posts as $p) {
            
            // get the properties of the item
            if ( has_post_thumbnail( $p->ID ) ) {
                $image = wp_get_attachment_url( get_post_thumbnail_id( $p->ID ) );
            } else {
                $image = bfi_get_post_meta( $p->ID, "preview_image" );
            }
            $subtitle      = bfi_get_post_meta($p->ID, "subtitle");
            $previewAction = bfi_get_post_meta($p->ID, "preview_action");
            $url           = bfi_get_post_meta($p->ID, "url_action");
            $newWindow     = bfi_get_post_meta($p->ID, "url_new_window");
            $mediaImage    = bfi_get_post_meta($p->ID, "media_image");
            $mediaVideo    = bfi_get_post_meta($p->ID, "media_video");
            
            $preview = '';
            // image links to portfolio page
            if ($previewAction == 'page') {
                $preview = sprintf("<a href='%s' class='%s'><img data-original='%s' src='%s'/><noscript><img src='%s'/></noscript></a>",
                    get_post_permalink($p->ID),
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
            
            $title = "<a href='".get_post_permalink($p->ID)."'>$p->post_title </a>";
            
            echo "<li>$preview<div>$title</div></li>";
            
        }  
        echo "</ul>";
    }
    
    public function displayForm($args) {
        $portfolioCategories = bfi_get_all_portfolio_categories();
        $portfolioCategoriesLabels = array();
        $portfolioCategoriesIDs = array();
        $portfolioCategoriesLabels[] = "All";
        $portfolioCategoriesIDs[] = "*";
        foreach ($portfolioCategories as $category) {
            $portfolioCategoriesLabels[] = $category->name;
            $portfolioCategoriesIDs[] = $category->cat_ID;
        }
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('numposts'); ?>"><?php _e('Number of posts', BFI_I18NDOMAIN); ?>:
            <input class="widefat" id="<?php echo $this->get_field_id('numposts'); ?>" name="<?php echo $this->get_field_name('numposts'); ?>" type="text" value="<?php echo $args['numposts']; ?>" />
            </label>
        </p>
    
        <p>
            <label for="<?php echo $this->get_field_id('catid'); ?>"><?php _e('Category ID', BFI_I18NDOMAIN); ?>:</label>
            <select name="<?php echo $this->get_field_name('catid')?>">
                <?php
                foreach ($portfolioCategoriesLabels as $key => $label) {
                    $selected = $portfolioCategoriesIDs[$key] == $args['catid'] ? "selected" : '';
                    echo "<option value='{$portfolioCategoriesIDs[$key]}' $selected>$label</option>";
                }
                ?>
            </select>
        </p>
        <?php
    }
}