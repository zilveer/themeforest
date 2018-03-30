<?php

require_once(TEMPLATEPATH.'/library/models/admin/option/select.php');
class BFIAdminOptionSelectDefaultPageMedia extends BFIAdminOptionSelect {
    
    protected function setProperties($args) {
        // this option has a specific id
        $args['id'] = BFI_SHORTNAME . '_' . BFI_OPTIONDEFAULTPAGEMEDIA;
        parent::setProperties($args);
    }
    
    public function display() {
        // Get page media posts and display them in the selection for page media.
        $pagemediaOptions = array("None, don't use any");
        $pagemediaValues = array("none");
        $mediaTypeOptions = BFIPagemediaController::$loadedPagemediaNames;
        $mediaTypeValues = BFIPagemediaController::$loadedPagemediaSlugs;

        // the "use default" option will be displayed by default (lol) unless 'showdefault' is false
        if ($this->getShowdefault() === false) {
            array_shift($pagemediaOptions);
            array_shift($pagemediaValues);
        }
        
        $pagemediaOptions["Created Page Media"] = array();
        $pagemediaValues["Created Page Media"] = array();
        
        $loop = new WP_Query( array( 'post_type' => BFIPagemediaModel::POST_TYPE, 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'title' ) );
        while ( $loop->have_posts() ) : $loop->the_post();
            $mediaType = bfi_get_post_meta(get_the_ID(), 'pagemedia_type', true);
            $pagemediaOptions["Created Page Media"][] = get_the_title() . " (" . $mediaTypeOptions[array_search($mediaType, $mediaTypeValues)] . ")";
            $pagemediaValues["Created Page Media"][]  = get_the_ID();
        endwhile;
        wp_reset_postdata();
        
        $values = $pagemediaValues;
        
        $this->echoOptionHeader();
        ?><select name="<?php echo $this->getID(); ?>" id="<?php echo $this->getID(); ?>"><?php 
        foreach ($pagemediaOptions as $key => $option) {
             
            // this is if we have option groupings
            if (is_array($option)) {
                ?><optgroup label="<?php echo $key?>"><?php
                foreach ($option as $key2 => $subOption) {
                    printf("<option value=\"%s\" %s>%s</option>",
                        $values[$key][$key2],
                        $this->getValue() == $values[$key][$key2] ? 'selected="selected"' : '',
                        $subOption
                        );
                }
                ?></optgroup><?php
                
            // this is for normal list of options
            } else {
                printf("<option value=\"%s\" %s>%s</option>",
                    $values[$key],
                    $this->getValue() == $values[$key] ? 'selected="selected"' : '',
                    $option
                    );
            }
        } 
        ?></select><?php
        $this->echoOptionFooter();
    }
}
