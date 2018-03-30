<?php

	get_header(); 

 	global  $cs_theme_option; 

	

 ?>

<!-- Columns Start - fullwidth -->

    <!-- Page Contents Start -->

    <div class="col-md-12">

        <div class="pagenone">

            <i class="fa fa-warning colr fa-4x"></i>

            <h1 class="colr"><?php _e('Page not found','AidReform')?></h1>

            <h4><?php if(isset($cs_theme_option['trans_switcher'])){ if($cs_theme_option['trans_switcher']== "on"){ echo _e('It seems we can not find what you are looking for.','AidReform');} }else{ if(isset($cs_theme_option['trans_content_404'])){ echo $cs_theme_option['trans_content_404']; }} ?></h4>

            <!-- Password Protected Strat -->

            <div class="password_protected">   

                <form id="searchform" method="get" action="<?php echo home_url()?>"  role="search">

                    <input name="s" id="searchinput" value="<?php _e('Search for:', 'AidReform'); ?>"

                    onFocus="if(this.value=='<?php _e('Search for:', 'AidReform'); ?>') {this.value='';}"

                    onblur="if(this.value=='') {this.value='<?php _e('Search for:', 'AidReform'); ?>';}" type="text" />

                    <input type="submit" id="searchsubmit" class="backcolr" value="<?php _e('Search', 'AidReform'); ?>" />

                </form>            

                

            </div>

            <!-- Password Protected End -->

        </div>

    </div>

    <!-- Page Contents End -->

<?php get_footer(); ?>