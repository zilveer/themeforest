<?php

// =============================================================================
// VIEWS/GLOBAL/_HEADER-WIDGET-AREAS.PHP
// -----------------------------------------------------------------------------
// Outputs the widget areas for the widgetbar.
// =============================================================================

$n = x_header_widget_areas_count();

?>

<?php if ( ! is_page_template( 'template-blank-7.php' ) && ! is_page_template( 'template-blank-8.php' ) ) : ?>
  <?php if ( $n != 0 ) : ?>

    <div class="x-widgetbar collapse">
      <div class="x-widgetbar-inner">
        <div class="x-container max width">

          <?php

          $i = 0; while ( $i < $n ) : $i++;

            $last = ( $i == $n ) ? ' last' : '';

            echo '<div class="x-column x-md x-1-' . $n . $last . '">';
              dynamic_sidebar( 'header-' . $i );
            echo '</div>';

          endwhile;

          ?>

        </div>
      </div>
    </div>

    <a href="#" class="x-btn-widgetbar collapsed" data-toggle="collapse" data-target=".x-widgetbar">
      <i class="x-icon-plus-circle" data-x-icon="&#xf055;"><span class="visually-hidden"><?php _e( 'Toggle the Widgetbar', '__x__' ); ?></span></i>
    </a>

  <?php endif; ?>
<?php endif; ?>