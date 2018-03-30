<?php
/**
 * The template for displaying header call to action.
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

  <header id="header-action" class="group">
	<div class="margin group">
		<?php echo do_shortcode( shortcode_unautop( wpautop( prima_get_setting( 'calltoaction_text' ) ) ) ); ?>
		<?php $target = prima_get_setting( 'calltoaction_target' ) ? 'target="_blank"' : ''; ?>
		<a class="header-action-button" href="<?php prima_setting( 'calltoaction_url' ); ?>" <?php echo $target ?> >
			<?php prima_setting( 'calltoaction_button' ); ?>
		</a>
	</div>
  </header>
