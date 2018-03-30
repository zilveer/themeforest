<?php
global $venedor_settings;
?>
<form class="searchform" action="<?php echo home_url(); ?>/" method="get">
    <fieldset>
        <span class="text"><input name="s" id="s" type="text" value="" placeholder="<?php echo __('Search here', 'venedor'); ?>" autocomplete="off" /></span>
        <span class="button-wrap"><button class="btn btn-special" title="<?php echo __('Search', 'venedor'); ?>" type="submit"><span class="fa fa-search"></span></button></span>
    </fieldset>
</form>