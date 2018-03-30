<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<div data-css-class="woof_sku_search_container" class="woof_sku_search_container woof_container">

    <div class="woof_container_inner">

        <?php

        $mad_woof_sku = '';
        $request = $this->get_request_data();

        if (isset($request['mad_woof_sku']))  {
            $mad_woof_sku = $request['mad_woof_sku'];
        }

        $p = __('enter a product sku here ...', 'flatastic');
        $unique_id = uniqid('mad_woof_sku_search_');

        ?>

        <div class="woof_sku_table">
            <input type="search" class="mad_woof_show_sku_search <?php echo $unique_id ?>" data-uid="<?php echo $unique_id ?>" placeholder="<?php echo esc_attr($p) ?>" name="mad_woof_sku" value="<?php echo $mad_woof_sku ?>" />
        </div>

    </div>

</div>