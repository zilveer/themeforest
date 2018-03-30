


<?php wp_enqueue_script('slideLp', BASE_URL . 'js/slideLp.min.js', false, '', true); ?>

<script type="text/javascript">
jQuery(document).ready(function($){  

$("#banner_rotator").slideLp({
effects: "slide", //"pageHoriz", "slide", "fade", "pageVert"
auto: true, // enable auto play
timeBanner: 7000,
timeDelay: 500,
timeSlide: 800,
timeDelayIn: 500,
timeDelayOut: 700,
timerClock: <?php if (get_option('op_rotator_timer') !== 'false') { ?> true <?php } else { ?> false <?php } ?>,
timerClockSize: 30,
barCounter: false, // enable bar counter
pagination: false, // enable pagination
paginationThumb: false, // display a thumbnail on hover
thumbSizeWidth: 150,
thumbSizeHeight: 150,
paginationHover: false, // display the pagination on over
paginationCounter: false, // enable pagination counter
paginationCounterTab: "/",
navButtons: false,
prevName: "<",
nextName: ">",
keyboard: true, // enable keyboard navigation
touch: true, // enable touch swipe navigation
thresholdX: 100,
thresholdY: 100,
touchName: "",
fullScreen: false, // enable fullscreen mode
adjustmentSize: 0,
responsive: true, // enable responsive layout
adjustmentResponsiveHeight: 1,
concertinaMaxWidth: 64,
concertinaAdjustmentFloat: "-0.5",
glassPositionStart: 1,
glassVisible: false,
heigthAuto: false,
heigthAutoSpeed: 300
});

});
</script>


<section id="banner_rotator">
 
<section class="wrapHighlight">
<ul class="listCont">
 
<?php if (get_option('op_rotator_image_1') !== '') { ?> 
<li>
<div class="cont"> 
<a href="<?php echo get_option('op_br_link_1'); ?>" alt="<?php echo get_option('op_br_title_1'); ?>" target="_blank"> 
<img src="<?php echo get_option('op_rotator_image_1'); ?>" alt="<?php echo get_option('op_br_title_1'); ?>" />
<?php if (get_option('op_br_title_1') !== '') { ?> 
<div class="title_lp"><?php echo get_option('op_br_title_1'); ?></div>
<?php } else {} ?>
</a> 
</div>
</li>
<?php } else {} ?>
 
<?php if (get_option('op_rotator_image_2') !== '') { ?> 
<li>
<div class="cont"> 
<a href="<?php echo get_option('op_br_link_2'); ?>" alt="<?php echo get_option('op_br_title_2'); ?>" target="_blank"> 
<img src="<?php echo get_option('op_rotator_image_2'); ?>" alt="<?php echo get_option('op_br_title_2'); ?>" />
<?php if (get_option('op_br_title_2') !== '') { ?> 
<div class="title_lp"><?php echo get_option('op_br_title_2'); ?></div>
<?php } else {} ?>
</a> 
</div>
</li>
<?php } else {} ?>

<?php if (get_option('op_rotator_image_3') !== '') { ?> 
<li>
<div class="cont"> 
<a href="<?php echo get_option('op_br_link_3'); ?>" alt="<?php echo get_option('op_br_title_3'); ?>" target="_blank"> 
<img src="<?php echo get_option('op_rotator_image_3'); ?>" alt="<?php echo get_option('op_br_title_3'); ?>" />
<?php if (get_option('op_br_title_3') !== '') { ?> 
<div class="title_lp"><?php echo get_option('op_br_title_3'); ?></div>
<?php } else {} ?>
</a> 
</div>
</li>
<?php } else {} ?>

<?php if (get_option('op_rotator_image_4') !== '') { ?> 
<li>
<div class="cont"> 
<a href="<?php echo get_option('op_br_link_4'); ?>" alt="<?php echo get_option('op_br_title_4'); ?>" target="_blank"> 
<img src="<?php echo get_option('op_rotator_image_4'); ?>" alt="<?php echo get_option('op_br_title_4'); ?>" />
<?php if (get_option('op_br_title_4') !== '') { ?> 
<div class="title_lp"><?php echo get_option('op_br_title_4'); ?></div>
<?php } else {} ?>
</a> 
</div>
</li>
<?php } else {} ?>

<?php if (get_option('op_rotator_image_5') !== '') { ?> 
<li>
<div class="cont"> 
<a href="<?php echo get_option('op_br_link_5'); ?>" alt="<?php echo get_option('op_br_title_5'); ?>" target="_blank"> 
<img src="<?php echo get_option('op_rotator_image_5'); ?>" alt="<?php echo get_option('op_br_title_5'); ?>" />
<?php if (get_option('op_br_title_5') !== '') { ?> 
<div class="title_lp"><?php echo get_option('op_br_title_5'); ?></div>
<?php } else {} ?>
</a> 
</div>
</li>
<?php } else {} ?>

 
</ul>
</section>
  
</section>