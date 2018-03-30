<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * The navigation menu of the panel page.
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>


<div id="yit-adminmenuback"></div>
<div id="yit-adminmenuwrap" class="yit-adminmenuwrap">
    <div id="yit-adminmenuwrap-shadow"></div>


    <ul role="navigation" class="yit-adminmenu">
        <?php foreach( $tabs as $category => $subcategory ): ?>
        <li class="yit-menu-top yit-has-submenu">
            <div class="yit-menu-arrow"><div></div></div>
            <span class="yit-menu-icon <?php echo $category?>"></span>

            <a title="<?php echo yit_format_tab_name($category) ?>" href="#"><?php echo yit_format_tab_name($category) ?></a>

            <ul class="yit-submenu">
                <?php foreach( $subcategory as $tab => $options ) : ?>
                    <li>
                        <a href="#yit-panel-<?php echo $category . '-' . $tab ?>" title="<?php echo yit_format_tab_name( $tab ) ?>" ><?php echo yit_format_tab_name($tab) ?></a>
                    </li>
                <?php endforeach ?>
            </ul>
        </li>
        <?php endforeach ?>
        <?php /*
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
        */ ?>
    </ul>
    <div class="clear"></div>
</div>
<!-- END WP ADMIN MENU -->