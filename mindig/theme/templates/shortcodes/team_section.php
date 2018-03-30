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

$nitems = ( isset( $nitems ) ) ? intval( $nitems ): -1;
$show_role = ( isset( $show_role ) && $show_role == 'yes' ) ? true : false;
$show_social = ( isset( $show_social ) && $show_social == 'yes' ) ? true : false;
$socials = array( 'facebook', 'twitter', 'google-plus', 'pinterest', 'instagram' );
$items_per_row = ( isset( $items_per_row ) ) ? $items_per_row : 4;
if($items_per_row == 3 || $items_per_row == 4 ) {

    $items_span = 12 / $items_per_row;
}
else $items_span = 3;

if( $team !== false ):
    $team_members = get_posts( array(
        'post_type' => substr( YIT_Team()->post_type_prefix . $team, 0, 20 ),
        'posts_per_page' => $nitems
    ) );

    if( ! empty( $team_members )  ):
        ?>

        <div class="team-section row <?php echo esc_attr( $vc_css ); ?>">
            <?php foreach( $team_members as $member ): ?>

                <div class="col-sm-<?php echo $items_span; ?> col-xs-6">
                    <div class="member">
                    <?php if( has_post_thumbnail( $member->ID ) && !is_rtl() ): ?>
                        <div class="thumb">
                            <?php
                            if( function_exists( 'yit_image' ) ){
                                yit_image( array(
                                    'post_id' => $member->ID,
                                    'size' => 'thumb_team_big',
                                    'class' =>'img-responsive'
                                ) );
                            }
                            else{
                                echo get_the_post_thumbnail( $member->ID, 'thumb_team_big' );
                            }
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="member-info">
                        <div class="member-name">
                            <h4><?php echo $member->post_title ?></h4>
                            <?php
                            if( $show_role ){
                                $role = get_post_meta( $member->ID, '_member_role', true );
                                if( ! empty( $role ) ){
                                    echo esc_attr( $role );
                                }
                            }
                            ?>
                        </div>
                        <div class="member-description">
                            <?php echo $member->post_content?>
                        </div>


                    </div>


                    <?php if( has_post_thumbnail( $member->ID ) && is_rtl() ): ?>
                        <div class="thumb">
                            <?php
                            if( function_exists( 'yit_image' ) ){
                                yit_image( array(
                                    'post_id' => $member->ID,
                                    'size' => 'thumb_team_big'
                                ) );
                            }
                            else{
                                echo get_the_post_thumbnail( $member->ID, 'thumb_team_big' );
                            }
                            ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <?php if( $show_social): ?>
                        <div class="member-social">
                            <?php foreach($socials as $social ){
                                $curr_social = get_post_meta( $member->ID, '_'.$social, true );
                                if( $curr_social != ''){
                                    echo do_shortcode('[social icon_size="14"  circle_size="25" circle_border_size="1" href="'.$curr_social.'" title="'.$social.'" icon_type="icon" icon_social="'.$social.'" circle="yes" target="" ]');
                                }
                            }
                            ?>
                        </div>
                    <?php endif ?>
                </div>
            <?php endforeach; ?>
        </div>

    <?php
    endif;
endif;
?>