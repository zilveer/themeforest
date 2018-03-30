<form method="get" id="searchform" action="<?php echo home_url(); ?>/"  class="showtextback">
<ul>
    <li><input type="text" class='search showtextback' value="<?php _e("type and hit enter..", "rt_theme"); ?>" name="s" id="s" /></li>
    <?php if( defined( "ICL_LANGUAGE_CODE" ) ) : ?><input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/><?php endif;?>			
</ul>
</form>
