<?php
/**
 * The template for displaying footer. 
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

  <?php do_action( 'prima_footer' ); ?>

  </div> <!--! end of .container-inner -->
  </div> <!--! end of #container -->

<?php do_action( 'prima_after' ); ?>

<?php wp_footer(); ?>

</body>
</html>