<?php
/**
 * The navigation menu of the panel page. 
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */
?>

<!-- START WP ADMIN MENU -->
<div id="yit-adminmenuback"></div>
<div id="yit-adminmenuwrap">
<!--    <div id="yit-adminmenuwrap-shadow"></div>-->
    
    
    <ul role="navigation">
    <?php foreach ( $var['menu'] as $key => $value ) : ?>
		<li class="yit-menu-top menu-icon-<?php echo $key; ?> <?php if ( isset($var['submenu'][$key]) ) : ?>yit-has-submenu<?php endif ?>" id="yit-menu-<?php echo $key; ?>" >
			<div class="yit-menu-arrow"><div></div></div>
			<span class="yit-menu-icon"></span>
			
			<a title="<?php echo $value; ?>" href="#yit_tabs_<?php echo $var['id'] ?>_<?php echo $key ?>"><?php echo $value; ?></a>
			
			<?php if ( isset($var['submenu'][$key]) ) : ?>
			<ul class="yit-submenu">
				<?php foreach ( $var['submenu'][$key] as $sub_key => $sub_value ) : ?>
					<li id="yit-menu-<?php echo $key.'_'.$sub_key ?>">
						<a href="#yit_tabs_<?php echo $var['id'] ?>_<?php echo $key.'_'.$sub_key ?>" title="<?php echo $sub_value ?>" ><?php echo $sub_value ?></a>
					</li>
				<?php endforeach ?>
			</ul>
			<?php endif ?>
		</li>	
    <?php endforeach; ?>
    </ul>
    <div class="clear"></div>
</div>					
<!-- END WP ADMIN MENU -->