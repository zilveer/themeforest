<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$team = ( ! empty( $team ) ) ? $team : false;
$nitems = ( isset( $nitems ) && intval( $nitems ) ) ? $nitems : -1;
$show_role = ( isset( $show_role ) && $show_role == 'yes' ) ? true : false;

if( $team !== false ):
    $team_members = get_posts( array(
        'post_type' => $post_type,
        'posts_per_page' => $nitems
    ) );

    if( ! empty( $team_members )  ):
        ?>
        <div class="team-section <?php echo esc_attr( $vc_css ); ?>">
            <div class="swiper_container full-height team-<?php the_ID() ?>" data-postid="<?php the_ID() ?>" >
                <div class="swiper-wrapper">
                    <?php
                    $first = true;
                    $last = false;
                    foreach( $team_members as $key => $member ):
                        $last = ( $key == ( count( $team_members ) - 1 ) ) ?  true : false;
                        $next = ($last) ? $team_members[0] : $team_members[ $key + 1 ];
                        if( $first ){
                            $prev = array_slice($team_members, -1, 1);
                            $prev = $prev[0];
                        }
                        else{
                            $prev = $team_members[ $key - 1 ];
                        }
                        $role = get_post_meta( $member->ID, '_member_role', true );
                        ?>
                        <div class="member swiper-slide">
                            <div class="row">


                                <?php if(!is_rtl()): ?>
                                    <div class="thumb col-sm-4">
                                        <?php
                                        if( has_post_thumbnail( $member->ID ) ):
                                            yit_image( array(
                                                'post_id' => $member->ID,
                                                'size' => 'thumb_team_big',
                                                'class' => 'img-responsive'
                                            ) );
                                        else:
                                            ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/images/no-image.jpg" class="img-responsive" />
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                <?php endif ?>

                                <div class="member-info col-sm-8">
                                    <div class="member-name">
                                        <h4><?php echo $member->post_title ?></h4>
                                        <?php
                                        if( $show_role && ! empty( $role ) ):
                                            ?>
                                            <span class="role"><?php echo esc_attr( $role );?></span>
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div class="member-description">
                                        <?php echo wpautop($member->post_content)?>
                                    </div>
                                    <div class="links">
                                        <a href="#" class="previous"><span class="fa fa-chevron-left"></span><?php echo  $prev->post_title ?></a>
                                        <a href="#" class="next"><?php echo $next->post_title ?> <span class="fa fa-chevron-right"></span></a>
                                    </div>
                                </div>

                                <?php if(is_rtl()): ?>
                                    <div class="thumb col-sm-4">
                                        <?php
                                        if( has_post_thumbnail( $member->ID ) ):
                                            yit_image( array(
                                                'post_id' => $member->ID,
                                                'size' => 'thumb_team_big',
                                                'class' => 'img-responsive'
                                            ) );
                                        else:
                                            ?>
                                            <img src="<?php echo get_template_directory_uri() ?>/images/no-image.jpg" class="img-responsive" />
                                        <?php
                                        endif;
                                        ?>
                                    </div>
                                <?php endif ?>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <?php
                        $first = false;
                    endforeach;
                    ?>
                </div>
            </div>
            <div class="tabs pagination-post-<?php the_ID() ?> row">
                <?php $first = true; ?>
                <?php
                $i =0;
                foreach( $team_members as $member ):
                    $role = get_post_meta( $member->ID, '_member_role', true );
                    ?>
                    <div class="navigation col-md-2 col-sm-3 col-xs-6 <?php if( $first ) echo 'active' ?>"  data-item="<?php echo $i; ?>">
                        <div class="thumb">
                            <?php
                            if( has_post_thumbnail( $member->ID ) ):
                                yit_image( array(
                                    'post_id' => $member->ID,
                                    'size' => 'thumb_team_big',
                                    'class' => 'img-responsive'
                                ) );
                            else:
                                ?>
                                <img src="<?php echo get_template_directory_uri() ?>/images/no-image.jpg" class="img-responsive" />
                            <?php
                            endif;
                            ?>
                            <div class="overlay">
                                <div class="inner">
                                    <div class="name"><?php echo $member->post_title?></div>
                                    <?php if( $show_role && ! empty( $role ) ): ?>
                                        <div class="role"><?php echo esc_attr( $role ) ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $first = false; $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>

        <script>
            jQuery(document).ready(function($) {
                "use strict";

                var teamSwiper = $('.team-<?php the_ID()?>.swiper_container').swiper({
                    mode:'horizontal',
                    loop: true,
                    speed: 750,
                    calculateHeight: false,
                    keyboardControl: true,
                    autoresize: true,
                    resizeReInit:true,
                    slideToClickedSlide: true,
                    onSlideChangeEnd: function(teamSwiper){
                        $(".tabs .navigation.active").removeClass('active');
                        $(".tabs .navigation").eq(teamSwiper.activeIndex-1).addClass('active');

                        $('.swiper_container').css({
                            height:''
                        });
                        //Calc Height
                        $('.swiper_container').css({
                            height: $('.swiper_container .swiper-slide-active').children().first().height()
                        });
                        //ReInit Swiper
                         teamSwiper.updateSlidesSize();
                    }
                });

                $(".tabs .navigation.active").removeClass('active');

                $(".tabs .navigation").eq(teamSwiper.activeIndex-1).addClass('active');

                $('.swiper_container').css({
                    height:''
                });
                //Calc Height
                $('.swiper_container').css({
                    height: $('.swiper_container .swiper-slide-active').children().first().height()
                });
                //ReInit Swiper
                teamSwiper.updateSlidesSize();

                $(".tabs .navigation").on('touchstart mousedown',function(e){
                    e.preventDefault();
                    $(".tabs .navitagion.active").removeClass('active');
                    $(this).addClass('active');
                    teamSwiper.fixLoop();
                    teamSwiper.slideTo( $(this).data('item')+1 );
                });

                $(".links .previous").click(function(e){
                    e.preventDefault();
                    e.stopPropagation();

                    teamSwiper.slidePrev();
                });

                $(".links .next").click(function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    teamSwiper.slideNext();
                });

            })
        </script>

    <?php
    endif;
endif;
?>

