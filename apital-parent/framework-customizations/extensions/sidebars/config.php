<?php

$cfg = array(
	'sidebar_positions' => array(
		'full' => array(
			'icon_url' => 'full.png',
			'sidebars_number' => 0
		),
		'left' => array(
			'icon_url' => 'left.png',
			'sidebars_number' => 1
		),
		'right' => array(
			'icon_url' => 'right.png',
			'sidebars_number' => 1
		),
	),

	'dynamic_sidebar_args' => array(
		'before_widget' => '<div id="%1$s" class="space x2 %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="tittle-line tittle-sml-mg">
                            <h5>',
		'after_title' => '</h5>
                            <div class="divider-1 small">
                              <div class="divider-small"></div>
                            </div>
                          </div>',
	),
);