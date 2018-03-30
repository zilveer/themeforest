<?php

$view_all = '<a href="' . esc_url( get_permalink($view_params['view_all']) ) . '" class="view-all page-bg-color">' . __('VIEW ALL', 'mk_framework') . '</a>';

echo mk_get_view('global', 'shortcode-heading', true, ['title' => $view_params['title'], 'content_after' => $view_all]);