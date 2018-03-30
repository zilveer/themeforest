<?php

// =============================================================================
// VIEWS/GLOBAL/_SCRIPT-ISOTOPE-INDEX.PHP
// -----------------------------------------------------------------------------
// Isotope script call for index output.
// =============================================================================

$is_rtl = is_rtl();

?>

<script>

  jQuery(document).ready(function($) {

    <?php if ( $is_rtl ) : ?>

      $.Isotope.prototype._positionAbs = function( x, y ) {
        return { right: x, top: y };
      };

    <?php endif; ?>

    var $container = $('#x-iso-container');

    $container.before('<span id="x-isotope-loading"><span>');

    $(window).load(function() {
      $container.isotope({
        itemSelector   : '.x-iso-container > .hentry',
        resizable      : true,
        filter         : '*',
        <?php if ( $is_rtl ) : ?>
          transformsEnabled : false,
        <?php endif; ?>
        containerStyle : {
          overflow : 'hidden',
          position : 'relative'
        }
      });
      $('#x-isotope-loading').stop(true,true).fadeOut(300);
      $('#x-iso-container > .hentry').each(function(i) {
        $(this).delay(i * 150).animate({'opacity' : 1}, 500);
      });
    });

    $(window).smartresize(function() {
      $container.isotope({  });
    });

  });

</script>