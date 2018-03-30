<?php

global $woocommerce_wpml;

if(defined('WCML_MULTI_CURRENCIES_INDEPENDENT') && $woocommerce_wpml){


	class WC_Currency_Switcher_Widget_dtbaker extends WP_Widget {

	    public function __construct() {

		    $widget_ops = array(
	            'description' => __('Use this widget to display a nice currency selection in the sidebar.', 'boutique-kids')
	        );

	        parent::__construct(false, __('Currency switcher (nice)', 'boutique-kids'), $widget_ops );
	    }

	    function widget($args, $instance) {

	        echo $args['before_widget'];
            echo isset($instance['title']) && $instance['title'] ? ($args['before_title'] . $instance['title'] . $args['after_title']) : '';

			global $woocommerce_wpml;
		    //$woocommerce_wpml->multi_currency_support->currency_switcher();
	        //do_action('currency_switcher');
		    global $sitepress, $woocommerce_wpml;
	        if ( is_page( get_option( 'woocommerce_myaccount_page_id' ) ) ) {
	           return '';
	        }
	        $settings = $woocommerce_wpml->get_settings();
	        if(!isset($args['switcher_style'])){
	            $args['switcher_style'] = isset($settings['currency_switcher_style'])?$settings['currency_switcher_style']:'dropdown';
	        }

	        if(!isset($args['orientation'])){
	            $args['orientation'] = isset($settings['wcml_curr_sel_orientation'])?$settings['wcml_curr_sel_orientation']:'vertical';
	        }

	        if(!isset($args['format'])){
	            $args['format'] = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template']:'%name% (%symbol%) - %code%';
	        }

	        $wc_currencies = get_woocommerce_currencies();

	        if(!isset($settings['currencies_order'])){
	            $currencies = $woocommerce_wpml->multi_currency_support->get_currency_codes();
	        }else{
	            $currencies = $settings['currencies_order'];
	        }
		    ?>
		    <script type="text/javascript">
			    function dtbaker_woo_currency_switch(b,currency) {
				    var data = {action: 'wcml_switch_currency', currency: currency};
				    jQuery(b).parent().find('a').hide();
				    jQuery(b).parent().find('.wcml_currency_switcher_dtbaker_loading').show();
				    jQuery.post(woocommerce_params.ajax_url, data, function () {
					    jQuery('.wcml_currency_switcher').removeAttr('disabled');
					    location.reload();
				    });
			    }
		    </script>
		    <div class="wcml_currency_switcher_dtbaker wcml_currency_switcher" style="text-align: center">
		    <div class="wcml_currency_switcher_dtbaker_loading" style="display: none"><?php _e('Loading','boutique-kids');?></div>
		    <?php


	        foreach($currencies as $currency){
	            if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
	                $selected = $currency == $woocommerce_wpml->multi_currency_support->get_client_currency() ? ' border:1px solid #4c4638 ' : '';
                    echo '<a href="#" onclick="javascript:dtbaker_woo_currency_switch(this,\''.$currency.'\');" rel="' . $currency . '" class="dtbaker_button_light" style="'.$selected.'">' . get_woocommerce_currency_symbol($currency) . ' ' .$currency.'</a> ';
		        }
	        }
            echo '</div>';


	        echo $args['after_widget'];
	    }

		/** @see WP_Widget::update */
	    function update($new_instance, $old_instance) {
	        $instance = $old_instance;
	        $instance['title'] = strip_tags($new_instance['title']);
	        return $instance;
	    }

	    function form( $instance ) {

		    $title = esc_attr(isset($instance['title']) ? $instance['title'] : '');
            ?>

		    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'boutique-kids'); ?>
		        <input type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;?>">
		    </label></p>

			<?php
	        printf('<p><a href="%s">%s</a></p>','admin.php?page=wpml-wcml#currency-switcher',__('Configure options','boutique-kids'));

	    }
	}


	add_action('widgets_init', create_function('', 'return register_widget("WC_Currency_Switcher_Widget_dtbaker");'));

}