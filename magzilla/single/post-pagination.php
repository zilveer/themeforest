<?php
//
// post pagination
//
?>
<?php
$defaults = array(
	'before' => '<div class="post-pagination text-center">
					<div class="pagination">
						<ul class="list-inline">',
    'after' => '
    					</ul>
    				</div>
    			</div>',
	'link_before'      => '<span>',
	'link_after'       => '</span>',
	'nextpagelink'     => __( 'Next <i class="fa fa-angle-double-right"></i>', 'magzilla' ),
	'previouspagelink' => __( '<i class="fa fa-angle-double-left"></i> Prev', 'magzilla' ),
	'echo'             => 1
);

    wp_link_pages( $defaults );
?>