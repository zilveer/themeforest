<?php
global $mango_settings;
if( $mango_settings['show-wpml-switcher'] ){
   if(function_exists("icl_get_languages")) {
     $languages = icl_get_languages('skip_missing=1&orderby=custom&order=asc'); 
            $active = '';
         foreach($languages as  $k=>$lang){
             if($lang['active']==1){
                 $active = $k;
                 break;
             }
  }
    ?>
<div class="dropdown language-dropdown btt-dropdown">
   <a class="dropdown-toggle" href="<?php echo esc_url($languages[$active]['url']) ?>" id="language-dropdown" data-toggle="dropdown" aria-expanded="true">
  <img src="<?php echo esc_url($languages[$active]['country_flag_url']) ?>" alt="<?php echo esc_attr($languages[$active]['native_name']) ?>"><span class="header-text"> <?php echo esc_attr($languages[$active]['native_name']) ?></span>
  <i class="fa fa-caret-down"></i>
   </a>
   <ul class="dropdown-menu" role="menu">
      <?php foreach($languages as $lan){ ?>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo esc_url($lan['url']) ?>"><img src="<?php echo esc_url($lan['country_flag_url']) ?>" alt="<?php echo esc_attr($lan['native_name']) ?>"><span class="header-text"><?php echo esc_attr($lan['native_name']) ?></span></a></li>
      <?php } ?>
   </ul>
</div>
<?php
   }
}
   ?>
<?php 
 if( $mango_settings['show-currency-switcher'] ){
   if( class_exists("WooCommerce") && function_exists("icl_get_languages") &&  has_action('currency_switcher') ){  
   ?>
<div class="dropdown currency-dropdown btt-dropdown">
   <a class="dropdown-toggle " href="#" id="currency-dropdown" data-toggle="dropdown" aria-expanded="true">
   <span class="header-text"><?php _e("Currency:",'mango')?></span>
   <span class="hidden-xss"><?php echo get_woocommerce_currency_symbol(get_woocommerce_currency()) ?></span>
   <?php echo get_woocommerce_currency(); ?>
   <i class="fa fa-caret-down"></i></a>
   <ul class="dropdown-menu pull-right" role="menu">
      <li class="currency_item" role="presentation">
         <?php if(has_action('currency_switcher')){
            do_action('currency_switcher', array('format' => '%symbol% %code%', 'switcher_style'=>'list'));
            } ?>
         <input type="hidden" id="select2" />
      </li>
   </ul>
</div>
<?php }
 }
 ?>