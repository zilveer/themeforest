<?php
/**
 * The template for displaying end wrapper of WooCommerce pages.
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
	
	<?php do_action( 'prima_content_after' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebar' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebarmini' ); ?>
	
    <?php do_action( 'prima_content_block_after' ); ?>

  </div>
  
  <?php do_action( 'prima_main_inner_after' ); ?>
  
</section>

<?php do_action( 'prima_main_after' ); ?>
