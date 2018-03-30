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

<div class="team-section">
    <?php foreach( $team_members as $member ): ?>
        <div class="member">

            <?php if( has_post_thumbnail( $member->ID ) && !is_rtl() ): ?>
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
    <?php endforeach; ?>
</div>

<?php
    endif;
endif;
?>