<div class="qodef-post-info-category">
    <?php
        if(!isset($params['show_category_label']) || $params['show_category_label'] !== 'no') {
            esc_html_e('in ','startit');
        }

        if(!isset($params['show_category_delimiter']) || $params['show_category_delimiter'] !== 'no') {
            the_category(', ');
        }
        else {
            the_category(' ');
        }
    ?>
</div>