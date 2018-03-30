<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
        <input type="text" value="<?php _e( 'Search...', 'framework' ) ?>" name="s" id="s" onblur="if (this.value == '')  {this.value = '"<?php _e( 'Search...', 'framework' ) ?>';}" onfocus="if (this.value == '"<?php _e( 'Search...', 'framework' ) ?>')  
{this.value = '';}" />
<?php if( is_home() || 'post' == get_post_type() || is_category() || is_tag() ) { ?><input type="hidden" name="post_type" value="post" /><?php } ?>
</form>