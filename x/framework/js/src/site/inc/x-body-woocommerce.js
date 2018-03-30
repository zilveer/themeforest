// =============================================================================
// JS/SRC/SITE/INC/X-BODY-WOOCOMMERCE.JS
// -----------------------------------------------------------------------------
// Includes all additional WooCommerce functionality tied into the theme.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. WooCommerce Functionality
// =============================================================================

// WooCommerce Functionality
// =============================================================================

jQuery(document).ready(function($) {

  //
  // Notifications.
  //

  var $notification = $('.x-cart-notification');

  if ( $notification.length > 0 ) {

    $('.add_to_cart_button.product_type_simple').on('click', function(e) {
      $notification.addClass('bring-forward appear loading');
    });

    $('body').on('added_to_cart', function(e, fragments, cart_hash) {
      setTimeout(function() {
        $notification.removeClass('loading').addClass('added');
        setTimeout(function() {
          $notification.removeClass('appear');
          setTimeout(function() {
            $notification.removeClass('added bring-forward');
          }, 650);
        }, 1000);
      }, 650);
    });

  }


  //
  // Star ratings.
  //

  var $container = $('p.stars');
  var $stars     = $container.find('a');

  function starsLeave(e) {
    if ( $container.hasClass('selected') ) {
      $container.find('a.active').nextAll('a').removeClass('x-active');
    } else {
      $stars.removeClass('x-active');
    }
  }

  function starClick(e) {
    $(this).nextAll('a').removeClass('x-active');
  }

  function starOver(e) {
    starsLeave();
    $(this).addClass('x-active').prevAll('a').addClass('x-active');
  }

  $container.on('mouseleave', starsLeave);
  $stars.on('click', starClick);
  $stars.on('mouseover', starOver);

});