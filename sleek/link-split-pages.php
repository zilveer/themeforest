<?php

wp_link_pages(
	array(
		'before' => '<div class="post__navigation post__navigation--pages">',
		'after' => '</div>',
		'next_or_number'   => 'next',
		'nextpagelink'     => __( 'Next page', 'sleek' ) . ' <i class="icon-arrow-right"></i>',
		'previouspagelink' => '<i class="icon-arrow-left"></i> ' . __( 'Previous page', 'sleek' ),
	)
);