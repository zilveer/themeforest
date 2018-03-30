

<?php $slider_style = get_option('iam_theme_3D_slider_style', true); ?>

<?php if($slider_style == 1) { ?>
<div class="grid_24 slider">
	<!-- Elastix Slider JS-->
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.eislideshow.js"></script>
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript">
        $(function() {
        $('#ei-slider').eislideshow({
        easing		: 'easeOutExpo',
        titleeasing	: 'easeOutExpo',
        titlespeed	: 1200
                        });
        });
    </script>
    
    <!-- Elastix Slider-->
    <div id="ei-slider" class="ei-slider">
        <ul class="ei-slider-large">
    <?php
    $slider_thumbs = '';      
    $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='homepage_slider' ORDER BY ord ASC");
    while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
    {
        $q_slider_id = $list_homepage_slider['id'];
        $q_slider_image_url = $list_homepage_slider['value1'];
        $q_slider_title = $list_homepage_slider['value2'];
        $q_slider_description = $list_homepage_slider['value3'];
        $q_slider_description = $list_homepage_slider['value4'];
    ?>
             <li>
                <img src="<?php echo $q_slider_image_url; ?>" alt="<?php bloginfo('template_url'); ?>/image<?php echo $q_slider_id; ?>" title="<?php echo $q_slider_title; ?>" />
                <div class="ei-title">
                    <h2><?php echo $q_slider_title; ?></h2>
                    <h3><?php echo $q_slider_description; ?></h3>
                </div>
            </li>
    <?php 
        $slider_thumbs = $slider_thumbs.'<li><a href="#">Slide '.$q_slider_id.'</a><img src="'.$q_slider_image_url.'" alt="thumb'.$q_slider_id.'" title="<?php echo $q_slider_title; ?>" /></li>';
    } 
    ?>
        </ul><!-- /.ei-slider-large -->
        <ul class="ei-slider-thumbs">
            <li class="ei-slider-element">Current</li>
            <?php echo $slider_thumbs; ?>
        </ul><!-- /.ei-slider-thumbs -->
    </div><!-- /.ei-slider -->
</div> <!-- /.grid_24 .slider -->
<?php } ?>





<?php if($slider_style == 2) { ?>
<div class="grid_24 slider-two">    
    <!-- jmpress plugin -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jmpress.min.js"></script>
		<!-- jmslideshow plugin : extends the jmpress plugin -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jmslideshow.js"></script>
    
    <section id="jms-slideshow" class="jms-slideshow">
        <?php
		$i = 0;
        $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='homepage_slider' ORDER BY ord ASC");
        while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
        {
            $q_slider_id = $list_homepage_slider['id'];
            $q_slider_image_url = $list_homepage_slider['value1'];
            $q_slider_title = $list_homepage_slider['value2'];
            $q_slider_link = $list_homepage_slider['value3'];
            $q_slider_description = $list_homepage_slider['value4'];
			$i++;
			
			if($i == 1){$data = '';}
			else if($i == 2){$data = 'data-y="500" data-scale="0.4" data-rotate-x="30"';}
			else if($i == 3){$data = 'data-x="2000" data-z="3000" data-rotate="170"';}
			else if($i == 4){$data = 'data-x="3000"';}
			else if($i == 4){$data = 'data-x="4500" data-z="1000" data-rotate-y="45"';}
			else{$i = 1; $data = '';}
        ?>
            <div class="step" data-color="color-<?php echo $i; ?>" <?php echo $data; ?>>
                <div class="jms-content">
                    <h3><?php echo $q_slider_title; ?></h3>
                    <p><?php echo $q_slider_description; ?></p>
                </div>
                <img src="<?php echo $q_slider_image_url; ?>" width="400" height="300" />
            </div>
            
        <?php } ?>
    </section>
	<script type="text/javascript">
        $(function() {
            $( '#jms-slideshow' ).jmslideshow();
        });
    </script>
</div>
<?php } ?>





<?php if($slider_style == 3) { ?>
<div class="grid_24 slider-two">    
    <!-- jmpress plugin -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jmpress.min.js"></script>
		<!-- jmslideshow plugin : extends the jmpress plugin -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jmslideshow.js"></script>
    
    <section id="jms-slideshow" class="jms-slideshow">
        <?php
		$i = 0;
        $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='homepage_slider' ORDER BY ord ASC");
        while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
        {
            $q_slider_id = $list_homepage_slider['id'];
            $q_slider_image_url = $list_homepage_slider['value1'];
            $q_slider_title = $list_homepage_slider['value2'];
            $q_slider_link = $list_homepage_slider['value3'];
            $q_slider_description = $list_homepage_slider['value4'];
			$i++;
			
			if($i == 1){$data = '';}
			else if($i == 2){$data = 'data-y="500" data-scale="0.4" data-rotate-x="30"';}
			else if($i == 3){$data = 'data-x="2000" data-z="3000" data-rotate="170"';}
			else if($i == 4){$data = 'data-x="3000"';}
			else if($i == 4){$data = 'data-x="4500" data-z="1000" data-rotate-y="45"';}
			else{$i = 1; $data = '';}
        ?>
            <div class="step" data-color="color-<?php echo $i; ?>" <?php echo $data; ?>>
                <div class="jms-content">
                    <h3><?php echo $q_slider_title; ?></h3>
                    <p><?php echo $q_slider_description; ?></p>
                </div>
                <img src="<?php echo $q_slider_image_url; ?>" width="400" height="300" />
            </div>
            
        <?php } ?>
    </section>
	<script type="text/javascript">
		$(function() {
				
				var jmpressOpts	= {
					animation		: { transitionDuration : '0.8s' }
				};
				
				$( '#jms-slideshow' ).jmslideshow( $.extend( true, { jmpressOpts : jmpressOpts }, {
					autoplay	: true,
					bgColorSpeed: '0.8s',
					arrows		: false
				}));
				
			});    
     </script>
</div>
<?php } ?>





<?php if($slider_style == 4) { ?>
<div class="grid_24 slider-two">    
    <!-- jmpress plugin -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jmpress.min.js"></script>
		<!-- jmslideshow plugin : extends the jmpress plugin -->
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.jmslideshow.js"></script>
    
    <section id="jms-slideshow" class="jms-slideshow">
        <?php
		$i = 0;
        $query_homepage_slider = mysql_query("SELECT * FROM ".$prefix."iam WHERE title='homepage_slider' ORDER BY ord ASC");
        while($list_homepage_slider = mysql_fetch_assoc($query_homepage_slider))
        {
            $q_slider_id = $list_homepage_slider['id'];
            $q_slider_image_url = $list_homepage_slider['value1'];
            $q_slider_title = $list_homepage_slider['value2'];
            $q_slider_link = $list_homepage_slider['value3'];
            $q_slider_description = $list_homepage_slider['value4'];
			$i++;
			
			if($i == 1){$data = '';}
			else if($i == 2){$data = 'data-y="500" data-scale="0.4" data-rotate-x="30"';}
			else if($i == 3){$data = 'data-x="2000" data-z="3000" data-rotate="170"';}
			else if($i == 4){$data = 'data-x="3000"';}
			else if($i == 4){$data = 'data-x="4500" data-z="1000" data-rotate-y="45"';}
			else{$i = 1; $data = '';}
        ?>
            <div class="step" data-color="color-<?php echo $i; ?>" <?php echo $data; ?>>
                <div class="jms-content">
                    <h3><?php echo $q_slider_title; ?></h3>
                    <p><?php echo $q_slider_description; ?></p>
                </div>
                <img src="<?php echo $q_slider_image_url; ?>" width="400" height="300" />
            </div>
            
        <?php } ?>
    </section>
	<script type="text/javascript">
        $(function() {
            $( '#jms-slideshow' ).jmslideshow();
        });
    </script>
</div>
<?php } ?>