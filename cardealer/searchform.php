<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<div class="widget_search clearfix">

    <form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">

        <input type="text" name="s" placeholder="<?php _e('Search', 'cardealer'); ?>" value="<?php echo get_search_query(); ?>" />
        <button type="submit" id="searchsubmit"></button>

    </form>

</div>