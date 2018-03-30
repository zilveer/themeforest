<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

//gat all variables
$layout                     = apply_filters( 'yit_portfolio_layout', $portfolio->get( 'config-single_layout' ) );
$content_title              = $portfolio->get( 'content_title' );
$extra_title                = $portfolio->get( 'extra_title' );
$customer                   = $portfolio->get( 'customer' );
$year                       = $portfolio->get( 'year' );
$project                    = $portfolio->get( 'project' );
$website                    = $portfolio->get( 'website' );
$website_url                = $portfolio->get( 'website-url' );
$show_meta_section          = $year != '' || $customer != '' || $project != '' || ( $website != '' && $website != '' );
$custom_button_label        = $portfolio->get( 'custom_button_label' );
$custom_button_url          = $portfolio->get( 'custom_button_url' );
$show_custom_button         = $custom_button_label != '' && $custom_button_url != '';
$share_title                = $portfolio->get( 'share_title' );
$share_socials              = $portfolio->get( 'share_socials' );
$show_share_section         = $share_socials != '';
$show_sidebar               = $show_meta_section || $show_share_section || $show_custom_button;
$show_extra_content         = $show_meta_section || $show_share_section;
$has_thumbnail              = has_post_thumbnail();
$show_other_project_section = $portfolio->get( 'config-enable_other_project' );
$other_project_title        = $portfolio->get( 'config-other_projects_title' );
$show_other_project_title   = $other_project_title != '';
$gallery                    = $portfolio->get( 'gallery' );


$attachments_args = array(
		'post_type'      => 'attachment',
		'numberposts'    => - 1,
		'post_status'    => null,
		'post_mime_type' => 'image',
		'orderby'        => 'post__in',
		'order'          => 'ASC'
);

if ( $gallery != '' ) {
    $gallery_items[] = get_post_thumbnail_id();
    $gallery_items = array_merge($gallery_items, array_filter( explode( ',', $gallery ) ));
    $attachments_args['post__in'] = $gallery_items;
}else{
    $attachments_args['post_parent'] = get_the_ID();
}

$attachments =  get_posts( $attachments_args );

if( ! function_exists( 'print_socials' ) ){
    function print_socials( $share_title, $share_socials ){

    if( ! empty( $share_socials ) ){
        echo '<div class="socials">';

        if ( ! empty( $share_title ) ){
            echo '<h2>' . $share_title . '</h2>';
        }

        $icon_type= 'default';
        $size = '-small';

        echo '<div class="icon-wrapper">';

        foreach ( $share_socials as $i => $social ) {
            global $post;

            $url = '';

            $title = urlencode( get_the_title() );
            $permalink = urlencode( get_permalink() );
            $excerpt = urlencode( get_the_excerpt() );

            if ( $social == 'facebook' ) {
                $url = apply_filters( 'yiw_share_facebook', 'https://www.facebook.com/sharer.php?u=' . $permalink . '&t=' . $title . '' );

            } else if ( $social == 'twitter' ) {
                $url = apply_filters( 'yiw_share_twitter', 'https://twitter.com/share?url=' . $permalink . '&text=' . $title . '' );

            } else if ( $social == 'google' ) {
                $social = 'google-plus';
                $url = apply_filters( 'yiw_share_google', 'https://plus.google.com/share?url=' . $permalink . '&title=' . $title . '' );

            } else if ( $social == 'pinterest' ) {
                $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = apply_filters( 'yiw_share_pinterest', 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $src[0] . '&description=' . $excerpt );
            }
            ?>
                <div class="social-icon">
                    <a href="<?php echo $url; ?>" class="fa fa-<?php echo $social?>"></a>
                </div>
            <?php
        }

        echo "</div>";

        echo "</div>";
    }

}
}

$layout = ( $layout != '' ) ? $layout : 'big_image';
$path = $this->locate_file( 'single', $layout );

if( file_exists( $path ) ){
    include( $path );
}
?>

