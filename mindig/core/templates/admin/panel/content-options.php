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
 * The content of the panel options.
 *
 * @package	Yithemes
 * @author Antonino Scarfi' <antonino.scarfi@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php foreach( $tabs as $category => $subcategory ): ?>
    <?php foreach( $subcategory as $tab => $options ) : ?>
        <div id="yit-panel-<?php echo $category . '-' . $tab ?>" class="yit-box" style="display: none;">
            <div class="yit-options">
                <?php foreach( $options as $option ): ?>
                    <?php $type->render( $option ); ?>
                <?php endforeach ?>
            </div>
        </div>
    <?php endforeach ?>
<?php endforeach ?>