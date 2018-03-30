<?php
if ($view_params['excerpt_length'] != 0) {
    ob_start();
    mk_excerpt_max_charlength($view_params['excerpt_length']);
    echo '<p class="the-excerpt">' . ob_get_clean() . '</p>';
}
