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
 * Checklist Admin View
 *
 * @package	Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div id="<?php echo $id ?>-container" <?php if( isset($deps) ): ?>data-field="<?php echo $id ?>" data-dep="<?php echo $deps['ids'] ?>" data-value="<?php echo $dep['values'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_multi_checkbox">
    <label class="big" ><?php echo $name ?><?php if( isset($cols) && $cols > 1): ?><small><?php echo $desc ?></small><?php endif ?></label>

    <?php
    if( isset( $cols ) && $cols > 1 ) {
        $class = ' small';
    }
    else{
        $class = '';
        $cols = 1;
    }
    $option = yit_get_option( $id );
    if( ! is_array( $option ) ){
        $option = array();
    }

    for($i = 1; $i <= $cols; $i++) :
    ?>
        <ul id="<?php echo( $id . $i ); ?>" class="list-sortable<?php echo $class?>">
            <?php
            if( isset($heads) && $heads ){
                echo '<li class="head">'.$heads[$i-1].'</li>';
            }
            foreach($values as $k => $value) : ?>
                <li>
                    <label class="radio-inline">
                        <input type="checkbox" name="<?php yit_field_name( $id ); ?>[<?php echo $i?>][]" value="<?php echo esc_attr( $k ); ?>" <?php if( isset( $option[$i] ) && is_array( $option[$i] ) ) checked( in_array( $k, $option[$i] ) ); ?> id="<?php echo( $id ); ?>-<?php echo $value ?>" class="checkbox" />&nbsp;
                        <?php echo $value; ?>
                    </label>
                </li>
            <?php endforeach;  ?>
        </ul>
    <?php endfor; ?>

    <?php if($cols == 1): ?><small><?php echo $desc ?></small><?php endif ?>
    <div class="clear"></div>
</div>