<?php
/**
* template part for header toolbar contacts. views/header/toolbar
*
* @author 	Artbees
* @package 	jupiter/views
* @version 	5.0.0
*/

global $mk_options;

if (!empty($mk_options['header_toolbar_phone'])) { ?>

	<span class="header-toolbar-contact">
		<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-phone-3', 16) ?>
		<a href="tel:<?php echo str_replace(' ', '', str_replace('(0)', '', stripslashes($mk_options['header_toolbar_phone']))); ?>"><?php echo stripslashes($mk_options['header_toolbar_phone']); ?></a>
	</span>

<?php 
}
if (!empty($mk_options['header_toolbar_email'])) { ?>

    <span class="header-toolbar-contact">
    	<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-envelop', 16) ?>
    	<a href="mailto:<?php echo antispambot( sanitize_email( $mk_options['header_toolbar_email'] ) ); ?>"><?php echo antispambot( sanitize_email( $mk_options['header_toolbar_email'] ) ); ?></a>
    </span>

<?php 
}
