<?php
/**
 * Project of Megadrupal.com
 * Author: duongle
 * Date: 4/23/14
 * Time: 2:24 PM
 */

/**
 * Register livepreview into query var
 * @param $public_query_vars
 *
 * @return array
 */
function portfolio_livepreview( $public_query_vars ) {
    $public_query_vars[] = 'livepreview';
    return $public_query_vars;
}
add_filter( 'query_vars', 'portfolio_livepreview' );

/**
 * Loading live preview portfolio project template when has livepreview query var
 * @param $template
 *
 * @return string
 */
function portfolio_live_preview_template($template) {
    if (get_query_var("livepreview")) {
        return get_template_directory() . '/single-project.php';
    }
    else {
        return $template;
    }
}
add_filter('single_template', 'portfolio_live_preview_template');

/**
 * Display share box below post content
 */
function display_share_box()
{
    $show = apply_filters('display_share_box',true);
    if($show){
        global $post;
        ?>
        <!-- Share Box -->
        <div class="share-options">
            <h6><?php _e('Share:', LANGUAGE); ?></h6>
            <ul>
                <li>
                    <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>"><i class="fa fa-facebook"></i></a>
                </li>
                <li>
                    <a href="http://twitthis.com/twit?url=<?php the_permalink(); ?>"><i class="fa fa-twitter"></i></a>
                </li>
                <li>
                    <a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><i class="fa fa-linkedin"></i></a>
                </li>
                <li>
                    <a href="http://www.tumblr.com/share/link?url=<?php echo urlencode(get_permalink()); ?>&amp;name=<?php echo urlencode($post->post_title); ?>&amp;description=<?php echo urlencode(get_the_excerpt()); ?>"><i class="fa fa-tumblr-square"></i></a>
                </li>
                <li>
                    <a href="http://google.com/bookmarks/mark?op=edit&amp;bkmk=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>"><i class="fa fa-google-plus"></i></a>
                </li>
                <li>
                    <a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"><i class="fa fa-envelope"></i></a>
                </li>
            </ul>
        </div>
        <!-- End / Share Box -->
        <?php
    }
}

function display_author_box()
{
    $show = apply_filters('display_author_box',true);
    if($show){
        ?>
        <!-- Author Box -->
        <div class="post-author">
            <div class="author-inner">
                <!-- Author avatar -->
                <figure class="author-avatar">
                <?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
                </figure>
                <div class="author-detail">
                    <!-- Author Name -->
                    <div class="author-name">
                        <?php _e('About ', LANGUAGE); ?><?php the_author_posts_link(); ?>
                    </div>
                    <!-- Author Description -->
                    <p class="author-desc">
                        <?php the_author_meta("description"); ?>
                    </p>
                    <!-- Author Social -->
                    <ul class="author-social">
                        <?php
                        global $post;
                        $sl=array(
                            'googleplus'    =>  "google-plus",
                            'facebook'      =>  "facebook",
                            'twitter'       =>  "twitter",
                            'linkedin'      =>  "linkedin",
                            'github'        =>  'github',
                            'tumblr'        =>  'tumblr',
                            'youtube'       =>  'youtube',
                            'vimeo'         =>  'vimeo-square'
                        );
                        if(isset($post->post_author))
                            foreach($sl as $type=>$class)
                                if($url  = get_user_option( $type, $post->post_author )):
                                    ?>
                                    <li><a href="<?php echo $url;?>"><i class="<?php echo $class;?>"></i></a></li>
                                    <?php endif;?>
                    </ul>
                </div>
            </div>
        </div>
    <!-- End / Author Box -->
        <?php
    }
}

function display_comment_box()
{
    $show = apply_filters('display_comment_box',true);
    if($show){
        wp_reset_query();
        comments_template();
    }

}

function display_meta_box($args=false)
{
    $show = apply_filters('display_meta_box',true);
    if($show){
        global $authordata;
        if ( is_object( $authordata ) )
            $author = sprintf(
                '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
                esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
                esc_attr( sprintf( __( 'Posts by %s',LANGUAGE ), get_the_author() ) ),
                get_the_author()
            );
        else $author = get_the_author();
        ?>
        <div class="metabox">
            <ul>
                <li>
                    <?php _e('Posted by',LANGUAGE);?>
                    <a href="<?php echo esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) );?>"><?php echo get_the_author();?></a>
                </li>
                <li>
                    <?php $tags = get_the_tag_list(false,', ',false);?>
                    <?php if($tags) echo "Tags: ".$tags; else echo "No Tags";?>
                </li>
                <li>
                    <?php $cats = get_the_category_list(', ');?>
                    <?php if($cats) echo "Categories: ".$cats; else echo "No Categories";?>
                </li>
                <li>
                    <a href="#"><?php echo get_comments_number();?> Comments</a>
                </li>
            </ul>
        </div>
        <?php
    }

}



function display_related_box($num=5)
{
    $show = apply_filters('display_related_box',true);
    if($show)
    {
        global $post;
        $related = get_related_posts($post->ID,$num);
?>
        <?php if($related->have_posts()): ?>
        <!-- Relate Content -->
        <div class="related-content">
            <h2><?php _e('Related Posts', LANGUAGE); ?></h2>
            <ul class="article-list">
            <?php while($related->have_posts()): $related->the_post(); ?>
                <li class="article-list-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; ?>
            </ul>
        </div>

        <!-- End / Relate Content -->
        <?php endif;?>
<?php
    }
}

function get_related_posts($post_id,$num) {

    $query = new WP_Query();

    $args = '';

    $args = wp_parse_args($args, array(
        'showposts'             => $num,
        'post__not_in'          => array($post_id),
        'ignore_sticky_posts'   => 0,
        'category__in'          => wp_get_post_categories($post_id),
    ));

    $query = new WP_Query($args);

    return $query;
}


add_filter( 'the_content', 'awe_filter_iframe_content_homepage',999 );

function awe_filter_iframe_content_homepage($content){

    $new_content = SetHeightWidthVideo($content);
    return $new_content;
}


function SetHeightWidthVideo($markup,$w='',$h='') { //to make it wmode = transparent

    $markup = str_replace('<iframe ','<span class="awe-embed-video"><iframe ',$markup);
    $markup = str_replace('</iframe>','</iframe></span>',$markup);
    $markup = str_replace('<embed ','<span class="awe-embed-video"><embed ',$markup);
    $markup = str_replace('</embed>','</embed></span>',$markup);

    $patterns = array();
    $replacements = array();
    if( !empty($w) )
    {
        $patterns[] = '/width="([0-9]+)"/';
        $patterns[] = '/width:([0-9]+)/';

        $replacements[] = 'width="'.$w.'"';
        $replacements[] = 'width:'.$w;
    }

    if( !empty($h) )
    {
        $patterns[] = '/height="([0-9]+)"/';
        $patterns[] = '/height:([0-9]+)/';

        $replacements[] = 'height="'.$h.'"';
        $replacements[] = 'height:'.$h;
    }



    $patterns[] = '/src="http:\/\/www\.youtube\.com\/embed\/[a-zA-Z0-9._-]"/';
    $replacements[] = 'src="http://www.youtube.com/embed/${1}?wmode=transparent"';

    return preg_replace($patterns, $replacements, $markup);
}


?>