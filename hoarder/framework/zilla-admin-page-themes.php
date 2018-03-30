<?php

/**
 * Theme Collection Page
 */
function zilla_themes_page(){
	?>
	<div class="wrap">
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'More Themes by ThemeZilla', 'zilla' ); ?></h2>
		<div id="zilla-more-themes">
		    <ul>
    			<?php
    			if($rss_items = zilla_get_more_themes_rss()){
    				foreach ( $rss_items as $item ){
    					?>
    					<li>
        					<div class="theme">
        						<h3><a href="<?php echo $item->get_link(); ?>?ref=framework" target="_blank"><?php echo $item->get_title(); ?></a></h3>
        						<p><?php echo html_entity_decode($item->get_content()); ?></p>
        						<p><a href="<?php echo $item->get_link(); ?>?ref=framework" class="button-primary" target="_blank">More Info</a></p>
        					</div>
    					</li>
    					<?php
    				}
    			} else {
    				_e( '<p>Error: Unable to fetch more themes.</p>', 'zilla' );
    			}
    			?>
			</ul>
		</div>
	</div>
	<?php
}

?>