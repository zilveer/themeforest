<?php
/**
 * The Template Part for displaying search form.
 *
 * @package BTP_Flare_Theme
 */
?>
<div class="searchform">
<form method="get" id="searchform" action="<?php echo home_url(); ?>">
    <fieldset class="compact">
        <input type="text" value="" name="s" id="s" size="15" placeholder="<?php esc_attr( _e('Search...', 'btp_theme') ); ?>" />        
        <input id="searchsubmit" class="no-replace" type="submit" value="<?php _e( 'Search', 'btp_theme'); ?>" />
    </fieldset>
</form>
</div>