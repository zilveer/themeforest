<?php
/**
 * The template for displaying secondary sidebar.
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

<aside id="sidebarmini" class="sidebar">
  <?php if ( is_active_sidebar(prima_get_sidebar( 'sidebarmini' )) ) : ?> 
    <?php prima_dynamic_sidebar( 'sidebarmini' ); ?>
  <?php else : ?>
    <div class="widget widget-container widget-sidebar widget_text">
      <h3><?php echo prima_dynamic_sidebar_name( 'sidebarmini' ); ?></h3>
      <div class="textwidget">
      <?php printf(__('This is <strong>"%1$s"</strong> widget area. Visit your <a href="%2$s">Widgets Page</a> to add new widget to this area.', 'primathemes'), prima_dynamic_sidebar_name( 'sidebarmini' ), admin_url('widgets.php')); ?>
      </div>
    </div>
  <?php endif; ?>
</aside>
