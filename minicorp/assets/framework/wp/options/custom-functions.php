<?php
/**
 * Created by JetBrains PhpStorm.
 * User: VlooMan
 * Date: 17.2.2013
 * Time: 10:20
 * To change this template use File | Settings | File Templates.
 */

remove_filter( 'the_content', 'post_formats_compat', 7 );

define( 'PREV_DEFAULT', __( 'Older Post &gt;', 'ishyoboy' ) );
define( 'NEXT_DEFAULT',  __( '&lt; Newer Post', 'ishyoboy' ) );

if ( ! function_exists( 'ishyoboy_get_boxed_layout_class' ) ) {
    function ishyoboy_get_boxed_layout_class(){
    global $ish_options, $ish_woo_id, $id_404, $wp_query;

    if ( is_404() ){
        $post_id = $id_404;
    }
    elseif ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }else{
        $pst = get_post();
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ish_get_the_ID();
    }

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $state = isset( $meta['ishyometa_ishyoboy_boxed_layout'] ) ? $meta['ishyometa_ishyoboy_boxed_layout'][0] : '';
    }elseif ( null != $post_id ){
        $state = IshYoMetaBox::get('ishyoboy_boxed_layout', true, $post_id);
    }else{
        if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
            $state = '';
        }else{
            $state = IshYoMetaBox::get('ishyoboy_boxed_layout' );
        }
    }

    if ('' == $state){
        if ( isset( $ish_options['boxed_layout'] ) && '' != $ish_options['boxed_layout'] ){
            return $ish_options['boxed_layout'];
        }
        else {
            return DEFAULT_BOXED_LAYOUT;
        }
    }
    else{
        return $state;
    }


}
}
if ( ! function_exists( 'ishyoboy_get_post_format_quote' ) ) {
    function ishyoboy_get_post_format_quote(){

    if (function_exists('get_post_format_meta')){

        /**
         *   Adding support fo WP >= 3.6.0
         */
        $meta =  get_post_format_meta( get_the_ID() );
        return $meta['quote'];
    } else{

        /**
         *   WP <= 3.5.9
         */
        return IshYoMetaBox::get('ishyoboy_post_quote');
    }

}
}

if ( ! function_exists( 'ishyoboy_get_post_format_quote_source' ) ) {
    function ishyoboy_get_post_format_quote_source(){

    if (function_exists('get_post_format_meta')){

        /**
         *   Adding support fo WP >= 3.6.0
         */
        $meta =  get_post_format_meta( get_the_ID() );
        return $meta['quote_source'];
    } else{

        /**
         *   WP <= 3.5.9
         */
        return IshYoMetaBox::get('ishyoboy_post_quote_source');
    }

}
}

if ( ! function_exists( 'ishyoboy_get_post_format_url' ) ) {
    function ishyoboy_get_post_format_url() {


    if (function_exists('get_the_post_format_url')){

        /**
         *   Adding support fo WP >= 3.6.0
         */
        $url =  get_the_post_format_url();
        return ($url) ? $url : apply_filters( 'the_permalink', get_permalink() );
    } else{

        /**
         *   WP <= 3.5.9
         */
        switch (get_post_format()){
            case 'quote' :
                $url = IshYoMetaBox::get('ishyoboy_post_quote_url');
                break;
            default :
                $url = IshYoMetaBox::get('ishyoboy_post_url');
                break;
        }
        return ($url) ? $url : apply_filters( 'the_permalink', get_permalink() );
    }
}
}

if ( ! function_exists( 'ishyoboy_the_post_video' ) ) {
    function ishyoboy_the_post_video($id){
    global $content_width;

    if (function_exists('get_the_post_format_media')){

        /**
         *   Adding support fo WP >= 3.6.0
         */
        $video =  get_the_post_format_media('video');
        if ( '' != $video ) {
            echo '<div class="post-video-content">', $video, '</div>';
        }

    } else{

        /**
         *   WP <= 3.5.9
         */
        if ( ( 'true' == IshYoMetaBox::get('ishyoboy_post_embedded_video', true, $id) ) ){ ?>

            <?php
            $video = IshYoMetaBox::get('ishyoboy_post_video', true, $id);

            if ( '' != $video ) {?>
                <div class="post-video-content">
                    <!-- EMBEDDED VIDEO BEGIN -->
                    <?php
                    if ( substr($video, 0, 4) == "http" ){
                        global $wp_embed;
                        echo do_shortcode($wp_embed->run_shortcode('[embed]'. $video . '[/embed]'));
                    }else{
                        echo str_replace( '&', '&amp;', $video );
                    }

                    ?>
                    <!-- EMBEDDED VIDEO END -->
                </div>
            <?php } else { ?>
                <div class="main-post-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :  ?>
                            <?php echo get_the_post_thumbnail($id, 'theme-large'); ?>
                        <?php endif; ?>
                    </a>
                </div>
            <?php } ?>

        <?php } else { ?>

            <?php if ( '' != IshYoMetaBox::get('ishyoboy_post_video_mp4', true, $id) || '' != IshYoMetaBox::get('ishyoboy_post_video_webm', true, $id) ) {?>
                <div class="post-video-content">
                    <!-- HTML5 VIDEO BEGIN -->
                    <video class="video-js vjs-default-skin" controls preload="none" width="<?php echo $content_width; ?>" <?php if ('' != IshYoMetaBox::get('ishyoboy_post_video_poster', true, $id)) echo 'poster="' . IshYoMetaBox::get('ishyoboy_post_video_poster', true, $id) . '"'; ?>>
                        <?php if ('' != IshYoMetaBox::get('ishyoboy_post_video_mp4', true, $id)) echo '<source src="' . IshYoMetaBox::get('ishyoboy_post_video_mp4', true, $id) . '" type="video/mp4"/>'; ?>
                        <?php if ('' != IshYoMetaBox::get('ishyoboy_post_video_webm', true, $id)) echo '<source src="' . IshYoMetaBox::get('ishyoboy_post_video_webm', true, $id) . '" type="video/webm"/>'; ?>
                    </video>
                    <!-- HTML5 VIDEO END -->
                </div>
            <?php } else { ?>
                <div class="main-post-image">
                    <a href="<?php the_permalink(); ?>">
                        <?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) :  ?>
                            <?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
                        <?php endif; ?>
                    </a>
                </div>
            <?php } ?>



        <?php }
    }
}
}

if ( ! function_exists( 'ishyoboy_the_post_audio' ) ) {
	function ishyoboy_the_post_audio($id){
		if ( '' != IshYoMetaBox::get('ishyoboy_post_audio', true, $id) ) {?>

			<?php wp_enqueue_script( 'audiojs' ); ?>

			<div class="post-audio-content">
				<div class="post-audio-image main-post-image">
					<?php if ( !is_single() ) { ?>
						<a href="<?php the_permalink(); ?>">
							<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {  ?>
								<?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
							<?php } ?>
						</a>
					<?php } else { ?>
						<?php
						$img_details = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'full' );
						?>
						<a href="<?php echo esc_attr($img_details[0]); ?>"  target="_blank">
							<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {  ?>
								<?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
							<?php } ?>
						</a>
					<?php } ?>
				</div>
				<div class="post-audio-player">
					<!-- AUDIO BEGIN -->
					<?php echo '<audio src="' . IshYoMetaBox::get('ishyoboy_post_audio', true, $id) . '" preload="none" class="audio-audiojs"></audio>'; ?>
					<!-- AUDIO END -->
				</div>
			</div>
		<?php } else { ?>
			<div class="main-post-image">
				<a href="<?php the_permalink(); ?>">
					<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {  ?>
						<?php  echo get_the_post_thumbnail($id, 'theme-large'); ?>
					<?php } ?>
				</a>
			</div>
		<?php }
	}
}

if ( ! function_exists( 'ishyoboy_get_lead' ) ) {
	function ishyoboy_get_lead($id){
		global $post, $page, $ish_woo_id, $wp_query;

		if ( null == $id ){
			if ( !is_tax() && !is_404() && !is_search() ){
				$id = get_the_ID();
			}
		}

		if ( null != $id ){
			$return = '';
			$return .= '<!-- Lead part section -->' . "\n";
			$display_lead = IshYoMetaBox::get('ishyoboy_display_lead', true, $id);
			if ( ( 'true' == $display_lead || '' == $display_lead ) ){

				$lead = IshYoMetaBox::get('ishyoboy_lead', true, $id);
				if (empty($lead)){
					$lead = '[headline tag="h1" color="color1"][the_title][/headline]';
				};
				$box_type = IshYoMetaBox::get('ishyoboy_lead_type', true, $id);
				if ( ( '' != $lead ) ){

					global $wp_embed;

					$has_rev_slider = has_shortcode($lead, 'rev_slider');
					$has_rev_class = ($has_rev_slider) ? ' ish-has-rev' : '';

					$return .= '<section class="part-lead' . $has_rev_class . ( ('unboxed' == $box_type) ? ' lead-unboxed' : ' lead-boxed' ) . '" id="part-lead">' . "\n";

					if ( 'unboxed' != $box_type  ){
						$return .= '  <div class="row">' . "\n";
						$return .= '      <section class="grid12">' . "\n";
					}

					if ($has_rev_slider){
						$return .= do_shortcode($lead);
					}
					else{
						$return .= wpautop(do_shortcode($wp_embed->run_shortcode($lead))) . "\n";
					}

					if ( 'unboxed' != $box_type  ){
						$return .= '      </section>' . "\n";
						$return .= '  </div>' . "\n";
					}

					$return .= '</section>' . "\n";
				}

			}
			$return .= '<!-- Lead part section END -->' . "\n";

			echo apply_filters( 'ishyoboy_lead', $return );
		}
		else{
			$current_term = get_queried_object();
			//<!-- Lead part section -->
			$lead = '<div class="category-lead">';
			$lead .= '<h1 class="color1">';

			if ( is_tax( 'product_tag' ) ){
				$lead .= __( 'Tag: ', 'ishyoboy' );
			} else if ( is_tax( 'product_cat' ) ){
				$lead .= __( 'Category: ', 'ishyoboy' );
			}
			$lead .= $current_term->name;
			$lead .= '</h1>';
			$lead .= ('' != do_shortcode($current_term->description)) ? do_shortcode($current_term->description) : '';
			$lead .= '</div>';
			ishyoboy_custom_lead($lead);
			//<!-- Lead part section -->
		}
	}
}

if ( ! function_exists( 'ishyoboy_custom_lead' ) ) {
	function ishyoboy_custom_lead($content){
		global $post, $page, $wp_embed;
		$return = '';
		$return .= '<!-- Lead part section -->' . "\n";
		$return .= '<section class="part-lead lead-boxed" id="part-lead">' . "\n";
		$return .= '  <div class="row">' . "\n";
		$return .= '      <section class="grid12">' . "\n";
		$return .= '          ' .  wpautop(do_shortcode($wp_embed->run_shortcode($content))) . "\n";
		$return .= '      </section>' . "\n";
		$return .= '  </div>' . "\n";
		$return .= '</section>' . "\n";
		$return .= '<!-- Lead part section END -->' . "\n";

		echo apply_filters( 'ishyoboy_lead', $return );
	}
}

if ( ! function_exists( 'ishyoboy_get_home_lead' ) ) {
	function ishyoboy_get_home_lead(){
		global $post, $page;
		$meta = get_post_meta( get_option( 'page_for_posts' ) );
		$return = '';
		$return .= '<!-- Lead part section -->' . "\n";
		if ( ( isset($meta['ishyometa_ishyoboy_display_lead']) && 'true' == $meta['ishyometa_ishyoboy_display_lead'][0] ) ){
			$lead = isset($meta['ishyometa_ishyoboy_lead']) ? $meta['ishyometa_ishyoboy_lead'][0] : '' ;
			$box_type = isset($meta['ishyometa_ishyoboy_lead_type']) ? $meta['ishyometa_ishyoboy_lead_type'][0] : '' ;
			if ( ( '' != $lead ) ){
				global $wp_embed;

				$has_rev_slider = has_shortcode($lead, 'rev_slider');
				$has_rev_class = ($has_rev_slider) ? ' ish-has-rev' : '';

				$return .= '<section class="part-lead' . $has_rev_class . ( ('unboxed' == $box_type) ? ' lead-unboxed' : ' lead-boxed' ) . '" id="part-lead">' . "\n";

				if ( 'unboxed' != $box_type  ){
					$return .= '  <div class="row">' . "\n";
					$return .= '      <section class="grid12">' . "\n";
				}

				if ($has_rev_slider){
					$return .= do_shortcode($lead);
				}
				else{
					$return .= wpautop(do_shortcode($wp_embed->run_shortcode($lead))) . "\n";
				}

				if ( 'unboxed' != $box_type  ){
					$return .= '      </section>' . "\n";
					$return .= '  </div>' . "\n";
				}

				$return .= '</section>' . "\n";
			}
		}
		$return .= '<!-- Lead part section END -->' . "\n";
		echo apply_filters( 'ishyoboy_lead', $return );
	}
}

if ( ! function_exists( 'ishyoboy_show_breadcrumbs' ) ) {
    function ishyoboy_show_breadcrumbs(){
    global $ish_options, $ish_woo_id, $id_404;

    if ( is_404() ){
        $post_id = $id_404;
    }
    elseif ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }else{
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $show = isset( $meta['ishyometa_ishyoboy_show_breadcrumbs'] ) ? $meta['ishyometa_ishyoboy_show_breadcrumbs'][0] : '';
    }elseif ( null != $post_id ){
        $show = IshYoMetaBox::get('ishyoboy_show_breadcrumbs', true, $post_id );
    }else{
        if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
            $show = '';
        }else{
            $show = IshYoMetaBox::get('ishyoboy_show_breadcrumbs' );
        }
    }

    if ('' == $show){
        if (isset($ish_options['show_breadcrumbs']) && '1' == $ish_options['show_breadcrumbs'] ){
            echo '<div class="space"></div>' . do_shortcode('[breadcrumbs]');
        }
    }
    else{
        if ('1' == $show){
            echo '<div class="space"></div>' . do_shortcode('[breadcrumbs]');
        }
    }

}
}

if ( ! function_exists( 'ishyoboy_get_sidebar_position' ) ) {
    function ishyoboy_get_sidebar_position($post_id = null){
    global $ish_options;

    if ( $post_id ) {
        $id = $post_id;
    }else{
        $id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    if ( is_home() ){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $sidebar_position = isset( $meta['ishyometa_ishyoboy_sidebar_position'] ) ? $meta['ishyometa_ishyoboy_sidebar_position'][0] : '';
    }
    elseif( null != $id ){
		$sidebar_position = IshYoMetaBox::get('ishyoboy_sidebar_position', true, $id );
    }
    else{
        if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
            $sidebar_position = '';
        }
        else{
            $sidebar_position = IshYoMetaBox::get('ishyoboy_sidebar_position' );
        }
    }

    if ('' == $sidebar_position){
        // Use global settings

        if ( ($id == $ish_options['page_for_custom_post_type_portfolio-post']) || (is_singular('portfolio-post')) || is_tax('portfolio-category')){
            // PORTFOLIO OVERVIEW
            //echo '<h1>SETTINGS: PORTFOLIO OVERVIEW</h1>';
            if (isset($ish_options['show_portfolio_sidebar']) && '1' == $ish_options['show_portfolio_sidebar']){
                // Portfolio sidebar turned ON
                //echo '<h1>SETTINGS: PORTFOLIO SIDEBAR ON</h1>';
                if (isset($ish_options['portfolio_sidebar_position']) && '' != $ish_options['portfolio_sidebar_position']){
                    $sidebar_position = $ish_options['portfolio_sidebar_position'];
                }
                else{
                    $sidebar_position = 'right';
                }
            }else{
                // Portfolio sidebar turned OFF
                //echo '<h1>SETTINGS: PORTFOLIO SIDEBAR OFF</h1>';
                $sidebar_position = '';
            }
        }else{

            if ( function_exists('is_woocommerce') && ( is_woocommerce() || is_woocommerce_page() ) ) {

                if (isset($ish_options['show_woocommerce_sidebar']) && '1' == $ish_options['show_woocommerce_sidebar']){
                    // Sidebar ON
                    if (isset($ish_options['woocommerce_sidebar_position']) && 'left' == $ish_options['woocommerce_sidebar_position']){
                        $sidebar_position = $ish_options['woocommerce_sidebar_position'];
                    }else{
                        $sidebar_position = 'right';
                    }
                }else{
                    // Sidebar OFF
                    $sidebar_position = '';
                }

            }
            else{

                if (is_home() || is_singular('post') || is_category() || is_tag() || is_archive() ){
                    // BLOG OVERVIEW
                    //echo '<h1>SETTINGS: BLOG OVERVIEW</h1>';
                    if (isset($ish_options['show_blog_sidebar']) && '1' == $ish_options['show_blog_sidebar']){
                        // Blog sidebar turned ON
                        //echo '<h1>SETTINGS: BLOG SIDEBAR ON</h1>';
                        if (isset($ish_options['blog_sidebar_position']) && '' != $ish_options['blog_sidebar_position']){
                            $sidebar_position = $ish_options['blog_sidebar_position'];
                        }
                        else{
                            $sidebar_position = 'right';
                        }
                    }
                    else{
                        // Blog sidebar turned OFF
                        //echo '<h1>SETTINGS: BLOG SIDEBAR OFF</h1>';
                        $sidebar_position = '';
                    }
                }else{
                    // REGULAR PAGE
                    //echo '<h1>SETTINGS: REGULAR PAGE</h1>';
                    if (isset($ish_options['show_page_sidebar']) && '1' == $ish_options['show_page_sidebar']){
                        // Page sidebar turned ON
                        //echo '<h1>SETTINGS: PAGE SIDEBAR ON</h1>';
                        if (isset($ish_options['page_sidebar_position']) && '' != $ish_options['page_sidebar_position']){
                            $sidebar_position = $ish_options['page_sidebar_position'];
                        }
                        else{
                            $sidebar_position = 'right';
                        }
                    }
                    else{
                        // Page sidebar turned OFF
                        //echo '<h1>SETTINGS: PAGE SIDEBAR OFF</h1>';
                        $sidebar_position = '';
                    }

                }
            }
        }
    }
    else{
        //echo '<h1>CUSTOM SETTINGS: ' . $sidebar_position . '</h1>';
    }

    return $sidebar_position;
}
}

if ( ! function_exists( 'ishyoboy_get_sidebar' ) ) {
    function ishyoboy_get_sidebar($post_id = null){
    global $ish_options;

    if ( $post_id ) {
        $id = $post_id;
    }else{
        $id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $sidebar_position = isset( $meta['ishyometa_ishyoboy_sidebar_position'] ) ? $meta['ishyometa_ishyoboy_sidebar_position'][0] : '';
    }elseif( null != $id ){
        $sidebar_position = IshYoMetaBox::get('ishyoboy_sidebar_position', true, $id );
    }
    else{
        if ( ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ){
            $sidebar_position = '';
        }else{
            $sidebar_position = IshYoMetaBox::get('ishyoboy_sidebar_position' );
        }
    }

    if ('' != $sidebar_position){
        // Local settings exist
        if (is_home()){
            $sidebar = isset( $meta['ishyometa_ishyoboy_sidebar'] ) ? $meta['ishyometa_ishyoboy_sidebar'][0] : '';
        }else{
            $sidebar = IshYoMetaBox::get('ishyoboy_sidebar', true, $id );
        }

    }else{
        // Use global settings
        if (($id == $ish_options['page_for_custom_post_type_portfolio-post']) || is_singular('portfolio-post') || is_tax('portfolio-category') ){
            // PORTFOLIO OVERVIEW
            //echo '<h1>DEFAULT: PORTFOLIO OVERVIEW</h1>';
            if (isset($ish_options['show_portfolio_sidebar']) && '1' == $ish_options['show_portfolio_sidebar']){
                // Portfolio sidebar set
                $sidebar = $ish_options['portfolio_sidebar'];
            }else{
                // Portfolio sidebar not set
                $sidebar = '';
            }
        }else{
            if ( function_exists('is_woocommerce') && ( is_woocommerce() || is_woocommerce_page() ) ) {

                if (isset($ish_options['show_woocommerce_sidebar']) && '1' == $ish_options['show_woocommerce_sidebar']){
                    $sidebar = $ish_options['woocommerce_sidebar'];
                }else{
                    $sidebar = '';
                }

            }
            else{

                if ( is_home() || is_singular('post') || is_category() || is_tag() || is_archive() ){
                    // BLOG OVERVIEW
                    //echo '<h1>DEFAULT: BLOG OVERVIEW</h1>';
                    if (isset($ish_options['show_blog_sidebar']) && '1' == $ish_options['show_blog_sidebar']){
                        $sidebar = $ish_options['blog_sidebar'];
                    }else{
                        $sidebar = '';
                    }
                }else{
                    // REGULAR PAGE
                    //echo '<h1>DEFAULT: REGULAR PAGE</h1>';
                    if (isset($ish_options['show_page_sidebar']) && '1' == $ish_options['show_page_sidebar']){
                        $sidebar = $ish_options['page_sidebar'];
                    }else{
                        $sidebar = '';
                    }
                }
            }
        }
    }
    return $sidebar;
}
}

if ( ! function_exists( 'ishyoboy_get_content_class' ) ) {
    function ishyoboy_get_content_class($post_id = null){
    $sidebar_position = ishyoboy_get_sidebar_position($post_id);

    switch ($sidebar_position){
        case 'none':
            return ' grid12 no-sidebar';
            break;
        case 'left':
            return ' grid9 with-left-sidebar';
            break;
        case 'right':
            return ' grid9 with-right-sidebar';
            break;
        default :
            return ' grid12 no-sidebar';
            break;
    }
}
}

if ( ! function_exists( 'ishyoboy_expandable_opened' ) ) {
    function ishyoboy_expandable_opened(){
    global $ish_options, $ish_woo_id, $id_404;

    if ( is_404() ){
        $post_id = $id_404;
    }
    elseif ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }
    else{
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    $local = '';

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $local = isset( $meta['ishyometa_ishyoboy_use_header_sidebar'] ) ? $meta['ishyometa_ishyoboy_use_header_sidebar'][0] : '';
    }elseif(null != $post_id){
        $local = IshYoMetaBox::get('ishyoboy_use_header_sidebar', true, $post_id );
    }
    else{
        if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
            $local = '';
        }else{
            $local = IshYoMetaBox::get('ishyoboy_use_header_sidebar' );
        }
    }

    if ('' != $local){

        if ( '1' == $local ){
            // Use expandable
            if (is_home()){
                $opened = isset( $meta['ishyometa_ishyoboy_header_sidebar_on'] ) ? $meta['ishyometa_ishyoboy_header_sidebar_on'][0] : '';
            }else{
                $opened = IshYoMetaBox::get('ishyoboy_header_sidebar_on', true, $post_id  );
            }

            if ('1' == $opened){
                return true;
            }
            else{
                return false;
            }

        } else {
            return false;
        }

    }
    else{
        // Default theme options
       return (isset($ish_options['header_sidebar_on']) && '1' == $ish_options['header_sidebar_on'] ) ? true : false;

    }
}
}

if ( ! function_exists( 'ishyoboy_use_expandable_header' ) ) {
    function ishyoboy_use_expandable_header(){
    global $ish_options, $ish_woo_id, $id_404;

    if ( is_404() ){
        $post_id = $id_404;
    }
    elseif ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }
    else{
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    $local = '';

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $local = isset( $meta['ishyometa_ishyoboy_use_header_sidebar'] ) ? $meta['ishyometa_ishyoboy_use_header_sidebar'][0] : '';
    }elseif(null != $post_id){
        $local = IshYoMetaBox::get('ishyoboy_use_header_sidebar', true, $post_id );
    }
    else{
        if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
            $local = '';
        }else{
            $local = IshYoMetaBox::get('ishyoboy_use_header_sidebar' );
        }
    }

    if ('' != $local){
        if ( '1' == $local ){
            // Use expandable
            if (is_home()){
                $sidebar_set = ( isset($meta['ishyometa_ishyoboy_header_sidebar']) && is_active_sidebar($meta['ishyometa_ishyoboy_header_sidebar'][0]) ) ? true : false;
            }else{
                $sidebar = IshYoMetaBox::get('ishyoboy_header_sidebar', true, $post_id );
                $sidebar_set = is_active_sidebar($sidebar);
            }

            return $sidebar_set;

        } else {
            return false;
        }

    }
    else{
        // Default theme options
        return (isset($ish_options['expandable_header']) && '1' == $ish_options['expandable_header'] && isset($ish_options['header_sidebar']) && is_active_sidebar($ish_options['header_sidebar']) ) ? true : false;

    }
}
}

if ( ! function_exists( 'ishyoboy_use_header_bar' ) ) {
    function ishyoboy_use_header_bar(){
    global $ish_options;
    return ( isset($ish_options['use_header_bar']) && '1' == $ish_options['use_header_bar'] ) ? true : false;
}
}

if ( ! function_exists( 'ishyoboy_get_expandable_header' ) ) {
    function ishyoboy_get_expandable_header(){
    global $ish_options, $ish_woo_id, $id_404;

    if ( is_404() ){
        $post_id = $id_404;
    }
    elseif ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }
    else{
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    $local = '';

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $local = isset( $meta['ishyometa_ishyoboy_use_header_sidebar'] ) ? $meta['ishyometa_ishyoboy_use_header_sidebar'][0] : '';
    }elseif(null != $post_id){
        $local = IshYoMetaBox::get('ishyoboy_use_header_sidebar', true, $post_id );
    }
    else{
        if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
            $local = '';
        }else{
            $local = IshYoMetaBox::get('ishyoboy_use_header_sidebar' );
        }
    }

    if ('' != $local){
        if ( '1' == $local ){
            // Use expandable
            if (is_home()){
                $sidebar_set = ( isset($meta['ishyometa_ishyoboy_header_sidebar'])) ? $meta['ishyometa_ishyoboy_header_sidebar'][0] : '';
            }else{
                $sidebar_set = IshYoMetaBox::get('ishyoboy_header_sidebar', true, $post_id );
            }

            return $sidebar_set;

        } else {
            return '';
        }

    }
    else{
        // Default theme options
        return (isset($ish_options['expandable_header']) && '1' == $ish_options['expandable_header'] && isset($ish_options['header_sidebar']) && is_active_sidebar($ish_options['header_sidebar']) ) ? $ish_options['header_sidebar'] : '';

    }
}
}

if ( ! function_exists( 'ishyoboy_use_footer_sidebar' ) ) {
    function ishyoboy_use_footer_sidebar(){
    global $ish_options, $ish_woo_id, $id_404;

    if ( is_404() ){
        $post_id = $id_404;
    }
    else if ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }
    else{
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }
    $local = '';

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $local = isset( $meta['ishyometa_ishyoboy_use_footer_widget_area'] ) ? $meta['ishyometa_ishyoboy_use_footer_widget_area'][0] : '';
    }elseif(null != $post_id){
        $local = IshYoMetaBox::get('ishyoboy_use_footer_widget_area', true, $post_id );
    }else{
        if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
            $local = '';
        }else{
            $local = IshYoMetaBox::get('ishyoboy_use_footer_widget_area');
        }
    }

    if ('' != $local){
        if ( '1' == $local ){
            // Use expandable
            if (is_home()){
                $sidebar_set = ( isset($meta['ishyometa_ishyoboy_footer_sidebar']) && is_active_sidebar($meta['ishyometa_ishyoboy_footer_sidebar'][0]) ) ? true : false;
            }else{
                $sidebar = IshYoMetaBox::get('ishyoboy_footer_sidebar', true, $post_id );
                $sidebar_set = is_active_sidebar($sidebar);
            }

            return $sidebar_set;

        } else {
            return false;
        }

    }
    else{
        // Default theme options
        return (isset($ish_options['footer_widget_area']) && '1' == $ish_options['footer_widget_area'] && isset($ish_options['footer_sidebar']) && is_active_sidebar($ish_options['footer_sidebar']) ) ? true : false;

    }
}
}

if ( ! function_exists( 'ishyoboy_get_footer_sidebar' ) ) {
    function ishyoboy_get_footer_sidebar(){
    global $ish_options, $ish_woo_id, $id_404;

    if ( is_404() ){
        $post_id = $id_404;
    }
    elseif ( isset($ish_woo_id) ) {
        $post_id = $ish_woo_id;
    }
    else{
        $post_id = ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ) ? null : ( ish_get_the_ID() );
    }

    $local = '';

    if (is_home()){
        $meta = get_post_meta( get_option( 'page_for_posts' ) );
        $local = isset( $meta['ishyometa_ishyoboy_use_footer_widget_area'] ) ? $meta['ishyometa_ishyoboy_use_footer_widget_area'][0] : '';
    }elseif(null != $post_id){
        $local = IshYoMetaBox::get('ishyoboy_use_footer_widget_area', true, $post_id );
    }else{
        if ( is_tax() || is_search() || is_archive() || is_category() || is_tag() ){
            $local = '';
        }else{
            $local = IshYoMetaBox::get('ishyoboy_use_footer_widget_area');
        }
    }

    if ('' != $local){
        if ( '1' == $local ){
            // Use expandable
            if (is_home()){
                $sidebar_set = ( isset($meta['ishyometa_ishyoboy_footer_sidebar'])) ? $meta['ishyometa_ishyoboy_footer_sidebar'][0] : '';
            }else{
                $sidebar_set = IshYoMetaBox::get('ishyoboy_footer_sidebar', true, $post_id );
            }

            return $sidebar_set;

        } else {
            return '';
        }

    }
    else{
        // Default theme options
        return (isset($ish_options['footer_widget_area']) && '1' == $ish_options['footer_widget_area'] && isset($ish_options['footer_sidebar']) && is_active_sidebar($ish_options['footer_sidebar']) ) ? $ish_options['footer_sidebar'] : '';

    }
}
}

if ( ! function_exists( 'ishyoboy_get_legals_sidebar' ) ) {
    function ishyoboy_get_legals_sidebar(){
    global $ish_options;

    // Default theme options
    return (isset($ish_options['footer_legals_area']) && '1' == $ish_options['footer_legals_area'] && isset($ish_options['footer_legals']) && is_active_sidebar($ish_options['footer_legals']) ) ? $ish_options['footer_legals'] : '';

}
}

if ( ! function_exists( 'ishyoboy_use_legals_sidebar' ) ) {
    function ishyoboy_use_legals_sidebar(){
    global $ish_options;

    // Default theme options
    return (isset($ish_options['footer_legals_area']) && '1' == $ish_options['footer_legals_area'] ) ? true : false;

}
}

if ( ! function_exists( 'ishyoboy_array_find' ) ) {
    function ishyoboy_array_find($needle, $haystack)
{
    foreach ($haystack as $key => $item)
    {
        if (stripos($item, $needle) !== FALSE)
        {
            return $key;
            break;
        }
    }

    return 0;
}
}

if ( ! function_exists( 'ishyoboy_search_excerpt_highlight' ) ) {
    function ishyoboy_search_excerpt_highlight($excerpt) {
    $keys = implode('|', explode(' ', get_search_query()));
    $new_excerpt = preg_replace('/(' . $keys .')/iu', '<mark>\0</mark>', $excerpt);
    return $new_excerpt;
}
}

if ( ! function_exists( 'ishyoboy_custom_excerpt' ) ) {
    function ishyoboy_custom_excerpt($custom_content, $limit, $search = null) {
    $content = preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $custom_content);  # strip shortcodes, keep shortcode content
    $content = wp_strip_all_tags($content, true);
    $content = preg_replace('/\[.+\]/','', $content);

    if ( isset($search)){
        $content = explode(' ', $content);
        $index = ishyoboy_array_find($search, $content);
        $start = ( ($index - $limit / 2) < 0 ) ? 0 : $index - $limit / 2;
        $content = array_slice($content, $start, $limit);
    } else{
        $content = explode(' ', $content, $limit);
    }

    if ( count($content) >= $limit ) {
        array_pop($content);
        $content = implode( ' ', $content ) . '...';
    } else {
        $content = implode( ' ', $content );
    }
    //$content = preg_replace('/\[.+\]/','', $content);
    if ( isset($search)){
        $content = apply_filters('the_content', $content);
    }
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = str_replace("&nbsp;", ' ', $content);
    //$content = str_ireplace($search, '<mark>' . $search . '</mark>' , $content);
    //$content = ishyoboy_search_excerpt_highlight($content);
    /**/
    return $content;
}
}

if ( ! function_exists( 'ishyoboy_colors_to_hex' ) ) {
	function ishyoboy_colors_to_hex($input){
		/*global $current_colors;
		$output = $input;

		$output = str_replace('color1', $current_colors['color1'], $output);
		$output = str_replace('color2', $current_colors['color2'], $output);
		$output = str_replace('color3', $current_colors['color3'], $output);
		$output = str_replace('color4', $current_colors['color4'], $output);*/

		global $ish_options;
		$output = $input;

		for ($i = 4; $i >= 1; $i--) {
			$output = str_replace('color' . $i, $ish_options['color' . $i], $output);
		}

		return $output;
	}
}

if ( ! function_exists( 'ishyoboy_show_addthis' ) ) {
    function ishyoboy_show_addthis(){
        global $ish_options;

        if ( isset($ish_options['use_addthis_share']) && '1' == $ish_options['use_addthis_share'] && isset($ish_options['addthis_share']) && '' != $ish_options['addthis_share'] ){
            echo  '<div class="share_box share_box_fixed">' . $ish_options['addthis_share'] . '</div>';
        }
    }
}

if ( ! function_exists( 'ishyoboy_blogpost_prev_next' ) ) {
    function ishyoboy_blogpost_prev_next($separator = ' ', $prev_label = PREV_DEFAULT, $next_label = NEXT_DEFAULT ){
    echo '<div class="single_post_navigation">';
    $nav_next = get_permalink( get_adjacent_post( false, '', false ) );
    $nav_prev = get_permalink( get_adjacent_post( false, '', true ) );
    if ( get_permalink() != $nav_next ){
        echo '<div class="blog-next-link"><a class="ish-button-small" href="' . esc_attr($nav_next) . '">' . $next_label . '</a></div>';
    }

    echo $separator;

    if ( get_permalink() != $nav_prev ){
        echo '<div class="blog-prev-link"><a class="ish-button-small" href="' . esc_attr($nav_prev) . '">' . $prev_label . '</a></div>';
    }
    echo '</div>';
}
}

if ( ! function_exists( 'ish_get_the_ID' ) ) {
    function ish_get_the_ID(){

    if ( is_home() ){
        $pst = get_post( get_option( 'page_for_posts' ) );
        if ( 'page' != get_option('show_on_front') ){
            $pst = null;
        }
        return (!empty($pst)) ? ( $pst->ID ) : null;
    }

    $pst = get_post();
    return (!empty($pst)) ? ( $pst->ID ) : null;

}
}

if (!function_exists('has_shortcode')){
    function has_shortcode( $content, $tag ) {
        if ( shortcode_exists( $tag ) ) {
            $matches = array();
            preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );
            if ( empty( $matches ) )
                return false;

            foreach ( $matches as $shortcode ) {
                if ( $tag === $shortcode[2] )
                    return true;
            }
        }
        return false;
    }
}

if (!function_exists('shortcode_exists')){
    function shortcode_exists( $tag ) {
        global $shortcode_tags;
        return array_key_exists( $tag, $shortcode_tags );
    }
}

add_action( 'of_options_before_save_only_save', 'ishyoboy_theme_change_check' );

if ( ! function_exists( 'ishyoboy_theme_change_check' ) ) {
    function ishyoboy_theme_change_check($data){
    global $ish_options;

    if ( isset( $ish_options['skin'] ) && $ish_options['skin'] != $data['skin'] ){
        // SKIN Change

        $alt_stylesheet_path = LAYOUT_PATH;

        if ( is_dir($alt_stylesheet_path) )
        {
            $skin = $alt_stylesheet_path . $data['skin'];

            if ( file_exists( $skin ) ) {
                require_once( $skin );

                if ( isset($skin_data) ) {

                    foreach ( $skin_data as $key => $val){
                        if ( is_array($val) ){

                            foreach ( $val as $val_key => $val_val){

                                $new_key = $key . '_' . $val_key;

                            //echo 'Changing "' . $new_key .'" from [' . $data[$new_key] . '] to [' . $val_val . ' ]' . "\n";
                            $data[$new_key] = $val_val;

                            }

                        }
                        else{
                            //echo 'Changing "' . $key .'" from [' . $data[$key] . '] to [' . $val . ' ]' . "\n";
                            $data[$key] = $val;
                        }

                    }
                }
            }

        }
    }
    else{
        // NO Change
    }

    //ishyoboy_generate_options_css( $data );
    return $data;
}
}

add_action( 'of_options_before_save', 'ishyoboy_filter_theme_change_check' );

if ( ! function_exists( 'ishyoboy_filter_theme_change_check' ) ) {
    function ishyoboy_filter_theme_change_check($data){
    ishyoboy_generate_options_css( $data );
    return $data;
}
}

if ( ! function_exists( 'ishyoboy_generate_options_css' ) ) {
    function ishyoboy_generate_options_css( $newdata, $key = GENERATEDCSS, $prefix = ISH_PREFIX) {

    $ver = get_option( $key );
    $ver = ( $ver ) ? (int)$ver : 1;
    $ver++;
    update_option( $key , $ver);

    $uploads = wp_upload_dir();
    $css_dir = get_template_directory() . '/assets/wp/themes/'; // Shorten code, save 1 call

    $newdata = apply_filters( 'of_options_before_generate_options_css', $newdata );
    /** Save on different directory if on multisite **/
    /*
    if( is_multisite() ) {
        $aq_uploads_dir = trailingslashit( $uploads['basedir'] );
    } else {
        $aq_uploads_dir = $css_dir;
    }
    /**/
    $ish_uploads_dir = trailingslashit( $uploads['basedir'] ) . 'minicorp_css';

    /** Capture CSS output **/
    ob_start();
    require( locate_template( 'assets/wp/themes/default_colors.php' ) );
    $css = ob_get_clean();

    /** Write to options.css file **/
    WP_Filesystem();
    global $wp_filesystem;
    wp_mkdir_p( $ish_uploads_dir );
    if ( !$wp_filesystem->put_contents( $ish_uploads_dir . '/main-options' . $prefix . '.css', $css, 0644) ) {
        return true;
    }

}
}

if ( ! function_exists( 'ishyoboy_generate_theme_skins' ) ) {
    function ishyoboy_generate_theme_skins( $newdata, $skin_name) {

        $uploads = wp_upload_dir();
        $css_dir = get_template_directory() . '/assets/wp/themes/'; // Shorten code, save 1 call

        $ish_uploads_dir = trailingslashit( $uploads['basedir'] ) . 'minicorp_css';

        /** Capture CSS output **/
        ob_start();
        require( locate_template( 'assets/wp/themes/default_colors.php' ) );
        $css = ob_get_clean();

        /** Write to options.css file **/
        WP_Filesystem();
        global $wp_filesystem;
        wp_mkdir_p( $ish_uploads_dir );
        if ( !$wp_filesystem->put_contents( $ish_uploads_dir . '/minicorp_skin_' . strtolower($skin_name) . '.css', $css, 0644) ) {
            return true;
        }

    }
}

if ( ! function_exists( 'ishyoboy_get_favicon' ) ) {
    function ishyoboy_get_favicon( $size = null ){
    global $ish_options;
    $return = '';

    if ( isset( $ish_options['custom_favicon_144'] ) && ( '' != $ish_options['custom_favicon_144']) ){
        $return .= '<link rel="apple-touch-icon" href="' . $ish_options['custom_favicon_144'] . '">' . "\n";
    }

    if ( isset( $ish_options['custom_favicon_114'] ) && ( '' != $ish_options['custom_favicon_114']) ){
        $return .= '<link rel="apple-touch-icon" href="' . $ish_options['custom_favicon_114'] . '">' . "\n";
    }

    if ( isset( $ish_options['custom_favicon_72'] ) && ( '' != $ish_options['custom_favicon_72']) ){
        $return .= '<link rel="apple-touch-icon" href="' . $ish_options['custom_favicon_72'] . '">' . "\n";
    }

    if ( isset( $ish_options['custom_favicon_16'] ) && ( '' != $ish_options['custom_favicon_16']) ){
        $return .= '<link rel="shortcut icon" href="' . $ish_options['custom_favicon_16'] . '">' . "\n";
    }

    return $return;
}
}

if ( ! function_exists( 'ishyoboy_set_javascritp_paths' ) ) {
    function ishyoboy_set_javascritp_paths(){
        echo "\n\n<script type='text/javascript'>\n";
        echo "/* <![CDATA[*/\n";
        echo "var ishyoboy_globals = {\n \tIYB_FRAMEWORK_URI: '".IYB_FRAMEWORK_URI."', \n \tIYB_TEMPLATE_URI: '".IYB_TEMPLATE_URI."'\n \t}; \n";
        echo "/* ]]> */ \n ";
        echo "</script>\n\n";
    }
}


if ( ! function_exists( 'ishyoboy_set_javascritp_globals' ) ) {
    function ishyoboy_set_javascritp_globals(){
        global $ish_options;
        echo "\n\n<script type='text/javascript'>\n";
        echo "/* <![CDATA[*/\n";
        echo "var ishyoboy_fe_globals = {\n \tIYB_RESPONSIVE: " . ( ( !isset( $ish_options['use_responsive_layout'] ) || '1' == $ish_options['use_responsive_layout'] ) ? 'true' : 'false'  ) . ",\n \tIYB_BREAKINGPOINT: " . ( ( isset( $ish_options['responsive_layout_breakingpoint'] ) && '' != $ish_options['responsive_layout_breakingpoint'] ) ? $ish_options['responsive_layout_breakingpoint'] : IYB_BREAKINGPOINT  ) . "\n \t}; \n";
        echo "/* ]]> */ \n ";
        echo "</script>\n\n";
    }
}


// Do not highlight Blog page in main menu when on search results page.
if ( ! function_exists( 'ishyoboy_noCurrentNavInSearch' ) ) {
    function ishyoboy_noCurrentNavInSearch( $content ) {
        if ( is_search() || is_404() ) $content = preg_replace( '/ current_page[_a-z]*([\" ])/', '\1', $content );
        return $content;
    }
}
add_filter( 'wp_nav_menu', 'ishyoboy_noCurrentNavInSearch' );


if ( !function_exists('ishyoboy_is_sticky_nav_on') ) {
    function ishyoboy_is_sticky_nav_on(){

        global $ish_options;
        return ( isset( $ish_options['sticky_nav'] ) && '1' == $ish_options['sticky_nav'] );

    }
}

if ( !function_exists('ishyoboy_is_retina_logo') ) {
    function ishyoboy_is_retina_logo(){

        global $ish_options;
        return ( isset( $ish_options['logo_retina_image'] ) && '' != $ish_options['logo_retina_image'] );

    }
}

if ( !function_exists('ishyoboy_is_logo') ) {
    function ishyoboy_is_logo(){

        global $ish_options;
        return ( isset( $ish_options['logo_image'] ) && '' != $ish_options['logo_image'] );

    }
}


if ( !function_exists('ishyoboy_use_logo') ) {
    function ishyoboy_use_logo(){

        global $ish_options;
        return ( isset($ish_options['logo_as_image']) && '1' == $ish_options['logo_as_image']);

    }
}

if ( !function_exists('ishyoboy_is_sticky_nav_logo_on') ) {
    function ishyoboy_is_sticky_nav_logo_on(){

        global $ish_options;
        return ( isset( $ish_options['sticky_nav_logo'] ) && '1' == $ish_options['sticky_nav_logo'] );

    }
}

if ( !function_exists('ishyoboy_is_sticky_nav_tagline_on') ) {
    function ishyoboy_is_sticky_nav_tagline_on(){

        global $ish_options;
        return ( isset( $ish_options['sticky_nav_tagline'] ) && '1' == $ish_options['sticky_nav_tagline'] );

    }
}

if ( !function_exists('ishyoboy_is_sticky_nav_responsive_on') ) {
    function ishyoboy_is_sticky_nav_responsive_on(){

        global $ish_options;
        return ( isset( $ish_options['sticky_nav_responsive'] ) && '1' == $ish_options['sticky_nav_responsive'] );

    }
}


if ( !function_exists('the_post_thumbnail_caption') ) {
    function the_post_thumbnail_caption(){

        if ( $thumb = get_post_thumbnail_id() && isset( $thumb ) )
            echo '<div class="wp-caption"><p class="wp-caption-text">' . get_post( $thumb )->post_excerpt . '</p></div>';

    }
}


if ( !function_exists('get_the_post_thumbnail_caption') ) {
    function get_the_post_thumbnail_caption(){

        if ( $thumb = get_post_thumbnail_id() && isset( $thumb ) )
            return get_post( $thumb )->post_excerpt;

        return null;
    }
}

if ( ! function_exists( 'ishyoboy_get_unparsed_tweets' ) ) {
    function ishyoboy_get_unparsed_tweets($count = 20, $username = false, $options = false) {

        global $ish_options;

        /*
        $config['key'] = get_option('tdf_consumer_key');
        $config['secret'] = get_option('tdf_consumer_secret');
        $config['token'] = get_option('tdf_access_token');
        $config['token_secret'] = get_option('tdf_access_token_secret');
        $config['screenname'] = get_option('tdf_user_timeline');
        */

        $config['key'] = $ish_options['twitter_widget_consumer_key'];
        $config['secret'] = $ish_options['twitter_widget_consumer_secret'];
        $config['token'] = $ish_options['twitter_widget_access_token'];
        $config['token_secret'] = $ish_options['twitter_widget_access_token_secret'];
        $config['screenname'] = '';

        if ( isset( $_GET['username'] ) && !empty( $_GET['username'] )){
            $username = $_GET['username'];
        }
        if ( isset( $_GET['count'] ) && !empty( $_GET['count'] )){
            $count = $_GET['count'];
        }

        if (class_exists('IshStormTwitter')) {
            $obj = new IshStormTwitter($config);
            $res = $obj->getTweets($count, $username, $options);
            //update_option('tdf_last_error',$obj->st_last_error);
            //return $res;

            echo json_encode($res);
        }

        die();

    }
}
if ( ! function_exists( 'ishyoboy_activate_fancybox_on_blog_single' ) ) {
    function ishyoboy_activate_fancybox_on_blog_single() {

        if ( is_singular() && !is_singular( 'product' ) ){
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    var thumbnails = jQuery("a:has(img)").not(".nolightbox").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr('href')) });

                    if ( thumbnails.length > 0){
                        thumbnails.addClass( 'openfancybox-image' ).attr( 'rel', 'fancybox-post-image-<?php the_ID() ?>');
                    }
                });
            </script>
            <?php
        }

    }
}
add_action( 'wp_head', 'ishyoboy_activate_fancybox_on_blog_single' );

