<!-- searchform-->
<div>
         <form id="searchform" method="get" action="<?php echo home_url() ?>/">
                 <div>
                         <input type="text" name="s" id="searchinput" value="<?php _e('Search here ...', 'clubber') ?>" onblur="if (this.value == '') {this.value = '<?php _e('Search here ...', 'clubber') ?>';}" onfocus="if (this.value == '<?php _e('Search here ...', 'clubber') ?>') {this.value = '';}"/>
                         <input type="submit" class="button1" id="search-button" value="<?php _e('GO', 'clubber') ?>" />                         
                 </div>
         </form>
</div>

<div class="clear">
</div><!-- .clear-->