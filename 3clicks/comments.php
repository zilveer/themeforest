<?php
/**
 * The Template Part for displaying Comments.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme02
 * @since G1_Theme02 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php if ( post_password_required() ): ?>
    <!-- post-password-required -->
<?php elseif( get_comments_number() || comments_open() ): ?>
    <section id="comments" itemscope itemtype="http://schema.org/UserComments">
    <?php
        // Comments?
        $g1_comments_count = count($comments_by_type['comment']);

        // Pingbacks & Trackbacks ?
        $g1_pings_count = count($comments_by_type['pings']);

        // Capture the pagination
        $g1_pagination = paginate_comments_links( array( 'echo' => false ) );
    ?>
    <?php if ( $g1_comments_count ): ?>
        <div class="g1-replies g1-replies--comments">
            <h2>
                <?php
                    printf(
                        _n( 'One Comment', '%1$s Comments', $g1_comments_count, 'g1_theme' ),
                        number_format_i18n( $g1_comments_count )
                    );
                ?>
            </h2>
            <ol class="commentlist">
                <?php
                    wp_list_comments( array(
                        'type'      => 'comment',
                        'callback'  => 'g1_wp_list_comments_callback')
                    );
                ?>
            </ol>
            <?php if ( strlen( $g1_pagination ) ): ?>
                <nav class="g1-comment-pagination">
                    <p>
                        <strong><?php _e( 'Pages', 'g1_theme'); ?></strong>
                        <?php echo $g1_pagination; ?>
                    </p>
                </nav>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ( $g1_pings_count ): ?>
        <div class="g1-replies g1-replies--pings">
            <h2>
                <?php
                    printf(
                        _n( 'One Ping', '%1$s Pings & Trackbacks', $g1_pings_count, 'g1_theme' ),
                        number_format_i18n( $g1_pings_count )
                    );
                ?>
            </h2>
            <ol class="commentlist">
                <?php
                    wp_list_comments( array(
                        'type'      => 'pings',
                        'page'      => 1,
                        'per_page'  => $g1_pings_count,
                        'callback' => 'g1_wp_list_comments_callback',
                    ));
                ?>
            </ol>
        </div>
    <?php endif; ?>

    <?php if ( comments_open() ): ?>
        <?php if ( is_front_page() ): ?>
            <?php
                $g1_helpmode = new G1_Helpmode(
                    'hide_comments',
                    __('Do you want to hide comments?', 'g1_theme'),
                    '<ul>' .
                        '<li>' . sprintf(__('When <a href="%s">editing this page</a> make sure the "Discussion" box is visible: configure your screen options in the top-right section of the WordPress Admin. Sometimes this box can be hidden.', 'g1_theme'), get_edit_post_link()) . '</li>' .
                        '<li>' . __('Uncheck "Allow comments" and "Allow trackbacks and pingbacks on this page".', 'g1_theme') . '</li>' .
                        '<li>' . __('Save changes', 'g1_theme') . '</li>' .
                        '</ul>',
                    'warning'
                );
                $g1_helpmode->render();
            ?>
        <?php endif; ?>

        <?php comment_form(); ?>

    <?php endif; ?>
    </section><!-- #comments -->
<?php endif; ?>