jQuery(document).ready(function($){'use strict';
    //Animated Number
    $('.themeum-counter-number').each(function(){
      var $this = $(this);
      $({ Counter: 0 }).animate({ Counter: $this.data('digit') }, {
        duration: $this.data('duration'),
        step: function () {
          $this.text(Math.ceil(this.Counter));
        }
      });
    });
});