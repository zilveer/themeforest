<?php
function Theme2035_customjs() {
global $theme_prefix; 
?>
<script type="text/javascript">

<?php 
    if($theme_prefix['slider-count'] == "3" ) { $grid_size = "380"; }
    else if ($theme_prefix['slider-count'] == "2" ) { $grid_size = "570"; }
    else if ($theme_prefix['slider-count'] == "1" ) { $grid_size = "1170"; } 
    else {  $theme_prefix['slider-count']= "1"; $grid_size = "900"; } 

    ?>


 jQuery(document).ready(function($){



  // store the slider in a local variable
  var $window = $(window),
      flexslider;
 
  // tiny helper function to add breakpoints
  function getGridSize() {
    return (window.innerWidth < 600) ? 1 :
           (window.innerWidth < 900) ? 2 : 2;
  }
 

 

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

 
  // check grid size on resize event
  $window.resize(function() {
    var gridSize = getGridSize();
 
    flexslider.vars.minItems = gridSize;
    flexslider.vars.maxItems = gridSize;
  });


if(isMobile.any()){


  $window.load(function() {
    $('.flexslider-home').flexslider({
      animation: "slide",
      animationLoop: false,
      itemWidth: 210,
      itemMargin: 5,
      minItems: getGridSize(), // use function to pull in initial value
      maxItems: getGridSize() // use function to pull in initial value
    });
  });

}else {

    $('.flexslider-home').flexslider({
    slideshow: false,
    animation: "slide",
    animationLoop: false,
    itemWidth: <?php echo esc_attr($grid_size); ?>,
    itemMargin: 10,
    minItems: <?php echo esc_attr($theme_prefix['slider-count']); ?>,
    maxItems: <?php echo esc_attr($theme_prefix['slider-count']); ?>
  });

}




  });








</script>

<?php }
add_action( 'wp_footer', 'Theme2035_customjs', 20 );
?>