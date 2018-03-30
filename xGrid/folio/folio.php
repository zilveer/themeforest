<?php

function bd_extra_scripts_styles(){

    wp_register_script( 'jquery.extra', get_template_directory_uri() . '/js/extra-options.js', array( 'jquery' ), false, true);
    wp_enqueue_script( 'jquery.extra' );

}
add_action( 'wp_enqueue_scripts', 'bd_extra_scripts_styles' );

/*
 * Portfolio
 */
add_action('init', 'bd_portfolio_init');
function bd_portfolio_init(){
    register_post_type(
        'wportfolio',
        array(
            'labels'            => array(
                'name'          => 'Portfolio',
                'singular_name' => 'Portfolio'
            ),
            'public'            => true,
            'has_archive'       => '404',
            'rewrite'           => array('slug' => 'portfolio'),
            'supports'          => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'),
            'can_export'        => true,
        )
    );
    register_taxonomy('portfolio_category', 'wportfolio', array('hierarchical' => true, 'label' => 'Categories', 'query_var' => true, 'rewrite' => true));
    register_taxonomy('portfolio_skills', 'wportfolio', array('hierarchical' => true, 'label' => 'Skills', 'query_var' => true, 'rewrite' => true));
    register_taxonomy('portfolio_tags', 'wportfolio', array('hierarchical' => false, 'label' => 'Tags', 'query_var' => true, 'rewrite' => true));
}

/*
 * Related Portfolio
 */
function get_related_projects($post_id)
{
    $query = new WP_Query();
    $args = '';
    $item_cats = get_the_terms($post_id, 'portfolio_category');
    if($item_cats)
    {
        foreach($item_cats as $item_cat)
        {
            $item_array[] = $item_cat->term_id;
        }
    }

    $folio_related_nu = bdayh_get_option( 'folio_related_nu' ) ? bdayh_get_option( 'folio_related_nu' ) : 4;
    $args = wp_parse_args($args, array(
        'showposts'             => $folio_related_nu,
        'post__not_in'          => array($post_id),
        'ignore_sticky_posts'   => 0,
        'post_type'             => 'wportfolio',
        'tax_query'             => array(
            array(
                'taxonomy'      => 'portfolio_category',
                'field'         => 'id',
                'terms'         => $item_array
            )
        )
    ));
    $query = new WP_Query($args);
    return $query;
}

/**
 *  New Metaboxes
 */
class bd_metaboxes
{
    public function __construct()
    {
        global $bd_data;
        $this->data = $bd_data;

        add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
        add_action('save_post', array($this, 'save_meta_boxes'));
        add_action('admin_enqueue_scripts', array($this, 'admin_script_loader'));
    }

    function admin_script_loader() {
        global $pagenow;
        if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php')) {
            wp_register_script('bd_wp_upload', get_template_directory_uri() .'/js/upload.js');
            wp_enqueue_script('bd_wp_upload');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_enqueue_style('thickbox');
        }
    }

    public function add_meta_boxes()
    {
        $this->add_meta_box('portfolio_options', 'Portfolio Options', 'wportfolio');
    }

    public function add_meta_box($id, $label, $post_type)
    {
        add_meta_box(
            'bd_' . $id,
            $label,
            array($this, $id),
            $post_type
        );
    }

    public function save_meta_boxes($post_id)
    {
        if(defined( 'DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        foreach($_POST as $key => $value) {
            if(strstr($key, 'new_bd_')) {
                update_post_meta($post_id, $key, $value);
            }
        }
    }

    public function portfolio_options()
    {
        $this->select(
            'wportfolio_post_type',
            'Post Type',
            array( '' => 'None', 'post_image' => 'Posts Featured Image', 'post_slider' => 'Posts Slideshow', 'post_video' => 'Posts Video' )
        );
        $this->select(
            'wportfolio_video_type',
            'Video Type',
            array('' => 'None', 'youtube' => 'Youtube', 'vimeo' => 'Vimeo', 'daily' => 'Dialymotion' )
        );
        $this->text(
            'video_url',
            'Video ID'
        );

        $this->text(
            'address',
            'Address'
        );
        $this->text(
            'phone',
            'Phone'
        );
        $this->text(
            'hos',
            'Hours of Service'
        );
        $this->text(
            'mail',
            'e-mail'
        );
        $this->text(
            'site',
            'Website'
        );

        $this->text(
            'project_url_text',
            'Project URL Text'
        );
        $this->text(
            'project_url',
            'Project URL'
        );
        $this->text(
            'copy_url_text',
            'Copyright URL Text'
        );
        $this->text(
            'copy_url',
            'Copyright URL'
        );
    }

    public function text($id, $label, $desc = '')
    {
        global $post;

        $html = '';
        $html .= '<div class="new_bd_metabox_field">';
        $html .= '<p><label for="new_bd_' . $id . '">';
        $html .= $label;
        $html .= '</label></p>';
        $html .= '<div class="field">';
        $html .= '<input type="text" id="new_bd_' . $id . '" name="new_bd_' . $id . '" value="' . get_post_meta($post->ID, 'new_bd_' . $id, true) . '" />';
        if($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function select($id, $label, $options, $desc = '')
    {
        global $post;

        $html = '';
        $html .= '<div class="new_bd_metabox_field">';
        $html .= '<p><label for="new_bd_' . $id . '">';
        $html .= $label;
        $html .= '</label></p>';
        $html .= '<div class="field">';
        $html .= '<select id="new_bd_' . $id . '" name="new_bd_' . $id . '">';
        foreach($options as $key => $option) {
            if(get_post_meta($post->ID, 'new_bd_' . $id, true) == $key) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }

            $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        if($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function multiple($id, $label, $options, $desc = '')
    {
        global $post;

        $html = '';
        $html .= '<div class="new_bd_metabox_field">';
        $html .= '<p><label for="new_bd_' . $id . '">';
        $html .= $label;
        $html .= '</label></p>';
        $html .= '<div class="field">';
        $html .= '<select multiple="multiple" id="new_bd_' . $id . '" name="new_bd_' . $id . '[]">';
        foreach($options as $key => $option) {
            if(is_array(get_post_meta($post->ID, 'new_bd_' . $id, true)) && in_array($key, get_post_meta($post->ID, 'new_bd_' . $id, true))) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }

            $html .= '<option ' . $selected . 'value="' . $key . '">' . $option . '</option>';
        }
        $html .= '</select>';
        if($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function textarea($id, $label, $desc = '')
    {
        global $post;

        $html = '';
        $html = '';
        $html .= '<div class="new_bd_metabox_field">';
        $html .= '<p><label for="new_bd_' . $id . '">';
        $html .= $label;
        $html .= '</label></p>';
        $html .= '<div class="field">';
        $html .= '<textarea cols="120" rows="10" id="new_bd_' . $id . '" name="new_bd_' . $id . '">' . get_post_meta($post->ID, 'new_bd_' . $id, true) . '</textarea>';
        if($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }

    public function upload($id, $label, $desc = '')
    {
        global $post;

        $html = '';
        $html = '';
        $html .= '<div class="new_bd_metabox_field">';
        $html .= '<p><label for="new_bd_' . $id . '">';
        $html .= $label;
        $html .= '</label></p>';
        $html .= '<div class="field">';
        $html .= '<input name="new_bd_' . $id . '" class="upload_field" id="new_bd_' . $id . '" type="text" value="' . get_post_meta($post->ID, 'new_bd_' . $id, true) . '" />';
        $html .= '<input class="bd_upload_button" type="button" value="Browse" />';
        if($desc) {
            $html .= '<p>' . $desc . '</p>';
        }
        $html .= '</div>';
        $html .= '</div>';

        echo $html;
    }
}
$metaboxes = new bd_metaboxes;

/*
 * Crumbs
 */
if(!function_exists('bd_crumbs')):
    function bd_crumbs() {
        global $data,$post;
        echo '<ul class="breadcrumbs">';

        if ( !is_front_page() ) {
            echo '<li>'.$data['breacrumb_prefix'].' <a href="';
            echo home_url();
            echo '">'.__('Home', 'bd');
            echo "</a></li>";
        }

        $params['link_none'] = '';
        $separator = '';

        if (is_category() && !is_singular('wportfolio')) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>'.$cat_parents.'</li>';
        }

        if(is_singular('wportfolio')) {
            echo get_the_term_list($post->ID, 'portfolio_category', '<li>', '&nbsp;/&nbsp;&nbsp;', '</li>');
            echo '<li>'.get_the_title().'</li>';
        }

        if (is_tax()) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            echo '<li>'.$term->name.'</li>';
        }

        if(is_home()) { echo '<li>'.$data['blog_title'].'</li>'; }
        if(is_page() && !is_front_page()) {
            $parents = array();
            $parent_id = $post->post_parent;
            while ( $parent_id ) :
                $page = get_page( $parent_id );
                if ( $params["link_none"] )
                    $parents[]  = get_the_title( $page->ID );
                else
                    $parents[]  = '<li><a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
                $parent_id  = $page->post_parent;
            endwhile;
            $parents = array_reverse( $parents );
            echo join( '', $parents );
            echo '<li>'.get_the_title().'</li>';
        }
        if(is_single() && !is_singular('wportfolio')) {
            $categories_1 = get_the_category($post->ID);
            if($categories_1):
                foreach($categories_1 as $cat_1):
                    $cat_1_ids[] = $cat_1->term_id;
                endforeach;
                $cat_1_line = implode(',', $cat_1_ids);
            endif;
            $categories = get_categories(array(
                'include' => $cat_1_line,
                'orderby' => 'id'
            ));
            if ( $categories ) :
                foreach ( $categories as $cat ) :
                    $cats[] = '<li><a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
                endforeach;
                echo join( '', $cats );
            endif;
            echo '<li>'.get_the_title().'</li>';
        }
        if(is_tag()){ echo '<li>'."Tag: ".single_tag_title('',FALSE).'</li>'; }
        if(is_404()){ echo '<li>'.__("404 - Page not Found", 'bd').'</li>'; }
        if(is_search()){ echo '<li>'.__("Search", 'bd').'</li>'; }
        if(is_year()){ echo '<li>'.get_the_time('Y').'</li>'; }

        echo "</ul>";
    }
endif;

/* wpagination */
if( !function_exists( 'bd_wpagination' ) )
{
    function bd_wpagination($pages = '', $range = 2)
    {
        $showitems = ($range * 2)+1;
        global $paged;
        if(empty($paged)) $paged = 1;
        if($pages == '')
        {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }

        if(1 != $pages)
        {
            echo "<div class='pagenavi clear'>";
            if($paged > 1) echo "<a class='pagination-prev' href='".get_pagenum_link($paged - 1)."'><span class='page-prev'></span>".__('Previous', 'bd')."</a>";

            for ($i=1; $i <= $pages; $i++)
            {
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
                {
                    echo ($paged == $i)? "<span class='pagenavi-current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
                }
            }

            if ($paged < $pages) echo "<a class='pagination-next' href='".get_pagenum_link($paged + 1)."'>".__('Next', 'bd')."<span class='page-next'></span></a>";
            echo "</div>\n";
        }
    }
}