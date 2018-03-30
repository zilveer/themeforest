<?php

/**
 * Widget that adds search form
 *
 * Class HashmagMikadoSearchForm
 */
class HashmagMikadoSearchForm extends HashmagMikadoWidget
{
    /**
     * Set basic widget options and call parent class construct
     */
    public function __construct() {
        parent::__construct(
            'mkdf_search_form', // Base ID
            'Mikado Search Form' // Name
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array();
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {

        if (is_search())
            $placeholder = get_query_var('s');
        else
            $placeholder = esc_html('Search Here', 'hashmag'); ?>


        <form class="mkdf-search-menu-holder" action="<?php echo esc_url(home_url('/')); ?>" method="get">
            <div class="mkdf-form-holder">
                <div class="mkdf-column-left">
                    <input type="text" placeholder="<?php echo esc_html($placeholder); ?>" name="s" class="mkdf-search-field" autocomplete="off"/>
                </div>
                <div class="mkdf-column-right">
                    <button class="mkdf-search-submit" type="submit" value="Search"><span class="ion-search"></span>
                    </button>
                </div>
            </div>
        </form>

    <?php }
}