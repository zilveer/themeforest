<?php
    wp_register_script( 'slider', get_template_directory_uri().'/js/slider.js', array('jquery'), '1.0', true );
    wp_enqueue_script( 'slider' );
    wp_register_style( 'animate', get_template_directory_uri().'/css/animate.css', true, '1.0' );
    wp_enqueue_style( 'animate' );
    $default_bg = $slider['general']['slider_default_bg'];
    if($default_bg =='') $default_bg = get_template_directory_uri().'/images/bg/slide_bg4.jpg';
?>
<div class="header_slider">
    <div id="tf-carousel" class="carousel slide">
        <div class="carousel-inner">
        <?php $c = 0;
            foreach($slider['slides'] as $slide){
            $c++;
            if($slide['slide_type_align']=='right'){
                $class = 'invert';
                $li_class = 'align_right';
            }
            else {
                $class = '';
                $li_class = 'align_left';
            }
            if($c==1) $class = $class.' active';
            if($slide['slide_type_slide']=='video'){ ?>
                <div class="item slide3 <?php echo $class; ?>">
                    <img src="<?php if($slide['slide_bg']!='') echo $slide['slide_bg']; else echo $default_bg;?>" alt="">
                    <div class="item_inner">
                        <?php echo $slide['slide_video_frame']; ?>
                        <div class="description" style="width:414px;">
                            <h2 class="slide_title animate5" data-animate="bounceIn"><?php echo $slide['slide_title']; ?></h2>
                            <p data-animate="lightSpeedIn" class="animate5"><?php echo $slide['slide_subtitle']; ?></p>
                            <a href="<?php echo $slide['slide_button_link']; ?>" class="button large blue animate5" data-animate="bounceInLeft"><span><?php echo $slide['slide_button_text']; ?></span></a>
                        </div>
                    </div>
                </div>
            <?php }
            elseif($slide['slide_type_slide']=='bg_list'){ ?>
                <div class="item slide2 <?php echo $class; ?>">
                    <img src="<?php if($slide['slide_bg']!='') echo $slide['slide_bg']; else echo $default_bg;?>" alt="">
                    <div class="item_inner">
                        <div class="description text-center">
                            <h2 class="slide_title animate3" data-animate="fadeInDown"><?php echo $slide['slide_title']; ?></h2>
                            <a href="<?php echo $slide['slide_button_link']; ?>" class="button large blue animate5" data-animate="fadeInDown"><span><?php echo $slide['slide_button_text']; ?></span></a>
                        </div>
                        <ul class="service-list <?php echo $li_class; ?>">
                            <?php
                                $list = explode("\n",$slide['slide_list']);
                                $animate = 3;
                                foreach($list as $item){
                                    echo '<li data-animate="fadeInRightBig" class="animate'.$animate.'">'.$item.'</li>';
                                    $animate++;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php }
            elseif($slide['slide_type_slide']=='center_img'){ ?>
                <div class="item slide5 <?php echo $class; ?>">
                    <img src="<?php if($slide['slide_bg']!='') echo $slide['slide_bg']; else echo $default_bg;?>" alt="">
                    <div class="item_inner">
                        <img src="<?php echo $slide['slide_src']; ?>" alt="" data-animate="fadeIn" class="animate2">
                        <ul class="service-list" style="width:180px;">
                            <?php
                            $list = explode("\n",$slide['slide_list']);
                            $animate = 2;
                            foreach($list as $item){
                                echo '<li data-animate="fadeInRightBig" class="animate'.$animate.'">'.$item.'</li>';
                                $animate++;
                            }
                            ?>
                        </ul>

                        <div class="description" style="width:285px;">
                            <h2 class="slide_title animate3" data-animate="fadeInLeft"><?php echo $slide['slide_title']; ?></h2>
                            <p class="animate4" data-animate="fadeInLeft"><?php echo $slide['slide_subtitle']; ?></p>
                            <a href="<?php echo $slide['slide_button_link']; ?>" class="button large blue animate5" data-animate="fadeInLeft"><span><?php echo $slide['slide_button_text']; ?></span></a>
                        </div>
                    </div>
                </div>
            <?php }
            elseif($slide['slide_type_slide']=='img_2buttons'){ ?>
                <div class="item slide1 <?php echo $class; ?>">
                    <img src="<?php if($slide['slide_bg']!='') echo $slide['slide_bg']; else echo $default_bg;?>" alt="">
                    <div class="item_inner">
                        <img src="<?php echo $slide['slide_src']; ?>" alt="" data-animate="bounceInUp" class="animate2">
                        <div class="description" style="width:330px;">

                            <h2 class="slide_title animate1" data-animate="swing"><?php echo $slide['slide_title']; ?></h2>
                            <p class="text-green animate3" data-animate="bounceInLeft"><?php echo $slide['slide_subtitle']; ?></p>

                          <span class="slide_btn animate3" data-animate="bounceIn">
                            <a href="<?php echo $slide['slide_button_link']; ?>" class="wp"><?php echo $slide['slide_button_text']; ?></a>
                            <span class="or"><?php _e('or','tfuse'); ?></span>
                            <a href="<?php echo $slide['slide_button_link2']; ?>" class="get"><?php echo $slide['slide_button_text2']; ?></a>
                          </span>
                        </div>
                    </div>
                </div>
            <?php }
            elseif($slide['slide_type_slide']=='gallery'){ ?>
                <div class="item slide4 <?php echo $class; ?>">
                    <img src="<?php if($slide['slide_bg']!='') echo $slide['slide_bg']; else echo $default_bg;?>" alt="">
                    <div class="item_inner">
                        <div class="gallery_list">
                            <?php
                            $list = explode("\n",$slide['slide_gallery']);
                            $animate = 1;
                            foreach($list as $item){
                                $animate++;
                                echo '<img src="'.$item.'" alt="" class="img'.($animate-1).' animate'.$animate.'" data-animate="fadeInRight">';
                                if($animate == 6) break;
                            }
                            ?>
                        </div>
                        <div class="description" style="width:325px;">
                            <h2 class="slide_title animate4" data-animate="flipInY"><?php echo $slide['slide_title']; ?></h2>
                            <p class="animate5" data-animate="bounceIn"><?php echo $slide['slide_subtitle']; ?></p>
                            <a href="<?php echo $slide['slide_button_link']; ?>" class="button large blue animate5" data-animate="flipInX"><span><?php echo $slide['slide_button_text']; ?></span></a>
                        </div>
                    </div>
                </div>
            <?php }
            else{ //image ?>
                <div class="item slide6 <?php echo $class; ?>">
                    <img src="<?php if($slide['slide_bg']!='') echo $slide['slide_bg']; else echo $default_bg;?>" alt="">
                    <div class="item_inner">
                        <img src="<?php echo $slide['slide_src']; ?>" alt="" data-animate="bounceInUp" class="animate3">
                        <div class="description" style="width:495px;">
                            <h2 class="slide_title animate5" data-animate="bounceInDown"><?php echo $slide['slide_title']; ?></h2>
                        </div>
                        <ul class="service-list <?php echo $li_class; ?>">
                            <?php
                            $list = explode("\n",$slide['slide_list']);
                            $animate = 1;
                            foreach($list as $item){
                                echo '<li data-animate="fadeInRightBig" class="animate'.$animate.'">'.$item.'</li>';
                                $animate++;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php }?>

        <?php } ?>
        </div><!-- carousel-inner -->
        <a class="left carousel-control" href="#tf-carousel" data-slide="prev"></a>
        <a class="right carousel-control" href="#tf-carousel" data-slide="next"></a>
    </div><!-- /.carousel -->

    <div class="slider_footer clearfix">
        <h1><?php echo $slider['general']['slider_text']; ?></h1>
        <span class="arrow_ico"></span>
    </div>
</div><!-- /.header_slider -->
<script>
    jQuery(window).load(function() {
        jQuery('#tf-carousel').oneCarousel({
            interval: 325000
        });
    });
</script>