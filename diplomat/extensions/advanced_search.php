<?php

class TMM_Advanced_Search {
    
    public static function advanced_search() {

        global $wpdb;
        $maxresults = trim(TMM::get_option('max_results'));
        $maxresults = (!empty($maxresults) && is_int($maxresults)) ? $maxresults : 1000;
        $searchData = array(
            'wpml_compatibility' => '1',
            'selected-orderby' => 'post_date DESC',
            'maxresults' => $maxresults,
            'selected-customfields' => array('thememakers_layout_constructor')
        );
        $post_types = "";
        $types = array();
        $post_statuses = "";
        $term_query = "";

        $parts = array();
        $relevance_parts = array();
        
        $pageposts = array();
        
        $s = $_REQUEST['s'];    
        
        if (!empty($s)){

        /* ------------------------- Statuses ---------------------------- */
        
        $statuses = array('publish');

        $words = implode('|', $statuses);
        $post_statuses = "(lower($wpdb->posts.post_status) REGEXP '$words')";
       
        /* ---------------------------- Types -------------------------- */
        
        $get_types = get_post_types(array(), 'object');        
        foreach ($get_types as $type){
            if (TMM::get_option('search_'.$type->name)){
                $types[] = $type->name; 
            }
        }
        if (count($types)<1){
            return '';
        }else{
            $words = implode('|', $types);
            $post_types = "($wpdb->posts.post_type REGEXP '$words')";
        }
        
        /* ----------------------- Title  --------------------------- */
        
        if (TMM::get_option('search_title')){
            $words = $s;
            $parts[] = "(lower($wpdb->posts.post_title) REGEXP '$words')";
            $relevance_parts[] = "(case when
                (lower($wpdb->posts.post_title) REGEXP '$words')
                 then 10 else 0 end)";
            $relevance_parts[] = "(case when
                (lower($wpdb->posts.post_title) REGEXP '$s')
                 then 10 else 0 end)";
        }          

        /* ---------------------- Content -------------------------- */
        
        if (TMM::get_option('search_content')){
            $words = $s;
            $parts[] = "(lower($wpdb->posts.post_content) REGEXP '$words')";
            $relevance_parts[] = "(case when
                (lower($wpdb->posts.post_content) REGEXP '$words')
                 then 7 else 0 end)";
            $relevance_parts[] = "(case when
                (lower($wpdb->posts.post_content) REGEXP '$s')
                 then 7 else 0 end)";
        }
        
        /* ---------------------- Excerpt  -------------------------- */
        
        if (TMM::get_option('search_exerpts')){
            $words = $s;
            $parts[] = "(lower($wpdb->posts.post_excerpt) REGEXP '$words')";
            $relevance_parts[] = "(case when
                (lower($wpdb->posts.post_excerpt) REGEXP '$words')
                 then 7 else 0 end)";
            $relevance_parts[] = "(case when
                (lower($wpdb->posts.post_excerpt) REGEXP '$s')
                 then 7 else 0 end)";
        }
        
        /* ------------------------ Term  --------------------------- */
        
        if (TMM::get_option('search_terms')){
            $words = $s;
            $parts[] = "(lower($wpdb->terms.name) REGEXP '$words')";
            $relevance_parts[] = "(case when
                (lower($wpdb->terms.name) REGEXP '$words')
                 then 5 else 0 end)";
            $relevance_parts[] = "(case when
                (lower($wpdb->terms.name) REGEXP '$s')
                 then 5 else 0 end)";
        }
        
        /* ---------------------- Custom Fields -------------------------- */
        
        if (TMM::get_option('search_layout_constructor')){
            if (isset($searchData['selected-customfields'])) {
                $selected_customfields = $searchData['selected-customfields'];
                if (is_array($selected_customfields) && count($selected_customfields) > 0) {
                    $words = $s;
                    foreach ($selected_customfields as $cfield) {
                        $parts[] = "($wpdb->postmeta.meta_key='$cfield' AND
                                       lower($wpdb->postmeta.meta_value) REGEXP '$words')";
                    }
                }
            }
        }      

        /* ------------------------- Build like -------------------------- */
        
        $like_query = implode(' OR ', $parts);
        if ($like_query == "")
            $like_query = "(1)";
        else {
            $like_query = "($like_query)";
        }
        
        /* ---------------------- Build relevance ------------------------ */
        
        $relevance = implode(' + ', $relevance_parts);
        if ($relevance == "")
            $relevance = "(1)";
        else {
            $relevance = "($relevance)";
        }
        
        /* ------------------------- WPML filter ------------------------- */
        
        $wpml_join = "";
        if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE != '')
            $wpml_join = "RIGHT JOIN " . $wpdb->base_prefix . "icl_translations ON ($wpdb->posts.ID = " . $wpdb->base_prefix . "icl_translations.element_id AND " . $wpdb->base_prefix . "icl_translations.language_code = '" . ICL_LANGUAGE_CODE . "')";
        
        /* --------------------------------------------------------------- */

        $orderby = ((isset($searchData['selected-orderby']) && $searchData['selected-orderby'] != '') ? $searchData['selected-orderby'] : "post_date DESC");
        $querystr = "
                    SELECT 
              $wpdb->posts.post_title as title,
              $wpdb->posts.ID as id,
              $wpdb->posts.post_date as date,               
              $wpdb->posts.post_content as content,
              $wpdb->posts.post_excerpt as excerpt,
              $wpdb->users.user_nicename as author,
              CONCAT('--', GROUP_CONCAT(DISTINCT $wpdb->terms.term_id SEPARATOR '----'), '--') as ttid,
              $wpdb->posts.post_type as post_type,
              $relevance as relevance
                    FROM $wpdb->posts
            LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID
            LEFT JOIN $wpdb->users ON $wpdb->users.ID = $wpdb->posts.post_author
            LEFT JOIN $wpdb->term_relationships ON $wpdb->posts.ID = $wpdb->term_relationships.object_id
            LEFT JOIN $wpdb->term_taxonomy ON $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id
            LEFT JOIN $wpdb->terms ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
            $wpml_join
            WHERE
                    $post_types
                AND $post_statuses
                AND $like_query
               
            GROUP BY
              $wpdb->posts.ID
            $term_query
             ";
        $querystr .= " ORDER BY relevance DESC, " . $wpdb->posts . "." . $orderby . "
            LIMIT " . $searchData['maxresults'];

            $pageposts = $wpdb->get_results($querystr, OBJECT);
        }
        
        $posts = array();
        foreach ($pageposts as $post) {
            $posts[] = get_post($post->id);
        }

        $search_messages = array(
            'no_criteria_matched' => esc_html__("Nothing Found", 'diplomat'),
            'another_search_term' => esc_html__("Please try another search term", 'diplomat'),
            'time_format' => get_option('date_format'),
            // 'all_results_link'    => http_build_query($serch_args),
            'view_all_results' => esc_html__('View all results', 'diplomat')
        );
        if (empty($posts)&&!empty($_REQUEST['action'])) {
            $output = "<div class='ajax_search_entry ajax_not_found'>";
            $output .= "<div class='ajax_search_content'>";
            $output .= "    <h6 class='ajax_search_title'>";
            $output .= $search_messages['no_criteria_matched'];
            $output .= "    </h6>";
            $output .= "    <div class='ajax_search_excerpt'>";
            $output .= $search_messages['another_search_term'];
            $output .= "    </div>";
            $output .= "</div>";
            $output .= "</div>";
            echo $output;            
        }

        if (empty($_REQUEST['action'])) {
            return $posts;
        }

        $output = "";
        $sorted = array();
        $post_type_obj = array();
        foreach ($posts as $post) {
            $sorted[$post->post_type][] = $post;
            if (empty($post_type_obj[$post->post_type])) {
                $post_type_obj[$post->post_type] = get_post_type_object($post->post_type);
            }
        }

        foreach ($sorted as $key => $post_type) {
            if (isset($post_type_obj[$key]->labels->name)) {               
                $output .= "<h5>" . esc_html($post_type_obj[$key]->labels->name) . "</h5>";
            } else {
                $output .= "<hr />";
            }

            foreach ($post_type as $post) {

                $image = get_the_post_thumbnail($post->ID, array(40,40));

                $link = get_permalink($post->ID);

                $post_pod_type = get_post_format($post->ID);

                switch ($post_pod_type) {
                     case 'audio':
                     case 'video':
                     case 'quote':
                     case 'gallery':
                         $icon_class = $post_pod_type . '-icon';
                         break;
                     case 'default':
                         $icon_class = 'picture-icon';
                         $thumb = get_the_post_thumbnail($post->ID);
                            if (empty($thumb)){
                                $icon_class = 'noimage-icon';
                            }
                               
                         break;
                     default:
                         $icon_class = 'noimage-icon';
                }            
                
                $image = $image ? '<div class="entry-media"> <a class="slide-image link-icon" href="' . esc_url($link) . '">' . $image . '</a></div>' : '<div class="entry-media"><a class="post-format-type" href="' . esc_url($link) . '"><span class="post-format ' . esc_attr($icon_class) . '"></span></a></div>';
                
                $output .= "<div class ='post entry'>";
                $output .= $image;
                $output .= "<div class='post-holder'> <h6 class='entry-title'><a href='" . esc_url($link) . "'>";
                $output .= get_the_title($post->ID);
                $output .= " </a></h6>";
                $output .= '<div class="entry-footer"><span class="posted-on"><a class="entry-date" href="'. esc_url(home_url()) .'/'.mysql2date('Y/m', $post->post_date, false) . '"> ' . esc_html(mysql2date(TMM::get_option('date_format'), $post->post_date, false)) . '</a></span></div></div>';
                $output .= "</div>";
            }
        }

        // $output .= "<h6><a class='ajax_search_entry ajax_search_entry_view_all' href='".home_url('?' . $search_messages['all_results_link'] )."'>".$search_messages['view_all_results']."</a></h6>";

        echo $output;
        die();
    }

    public static function ajax_search_navi() {
        $post_ids = $_REQUEST['post_ids'];
        $current_page = $_REQUEST['current_page'];
        $posts_per_page = $_REQUEST['posts_per_page'];
        $posts = explode(',', $post_ids);
        $pages = ceil(count($posts) / $posts_per_page);

        $show_post_metadata = TMM::get_option("blog_listing_show_all_metadata");
        $blog_listing_show_category = TMM::get_option("blog_listing_show_category");
        $blog_listing_show_date = TMM::get_option("blog_listing_show_date");
        $blog_listing_show_author = TMM::get_option("blog_listing_show_author");
        $blog_listing_show_tags = TMM::get_option("blog_listing_show_tags");
        $blog_listing_show_comments = TMM::get_option("blog_listing_show_comments");
        $blog_listing_show_likes = TMM::get_option("blog_listing_show_likes");

        $post_types = array(
            'audio',
            'video',
            'quote',
            'gallery',
        );
        
        ?>

        <div id="post-area">
            
        <?php
        for ($i = ($current_page - 1) * $posts_per_page; $i < ($current_page * $posts_per_page); $i++) {
            if (!empty($posts[$i])){
                $post = get_post($posts[$i]);
                $post_link = get_permalink($posts[$i]);
                $post_pod_type = get_post_format($post->ID);

                if (!in_array($post_pod_type, $post_types)) {
                    $post_pod_type = 'default';
                }

                if (isset($_REQUEST['shortcode_show_metadata'])) {
                    $show_post_metadata = $_REQUEST['shortcode_show_metadata'];
                }
                ?>
                <article id="post-<?php echo $post->ID ?>" <?php (TMM::get_option("blog_listing_effect")&&(TMM::get_option("blog_listing_effect")!='none')) ? post_class("post full-width ". TMM::get_option("blog_listing_effect"), $post->ID) : post_class("post full-width", $post->ID); ?>>

                    <?php
                    $post_type_values = get_post_meta($post->ID, 'post_type_values', true);
                    include(locate_template('article-'.$post_pod_type.'.php')); ?>

                    <?php if ($post_pod_type !== 'quote') { ?>

                        <header class="entry-header">

                            <h2 class="entry-title"><a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php echo esc_html($post->post_title); ?></a></h2>

                        </header>

                        <div class="entry-content">
                            <?php
                            if( strpos( $post->post_content, '<!--more-->' ) ){
                                the_content();
                            } else {
                                if (TMM::get_option("excerpt_symbols_count") !== '0') {
                                    $symbols_count = (TMM::get_option("excerpt_symbols_count") > 0) ? TMM::get_option("excerpt_symbols_count") : '220';
                                    if (empty($post->post_excerpt)) {
                                        $txt = do_shortcode($post->post_content);
                                        $txt = strip_tags($txt);
                                        $txt = do_shortcode(mb_substr($txt, 0, $symbols_count) . " ...");
                                    } else {
                                        $txt = mb_substr($post->post_excerpt, 0, $symbols_count) . " ...";
                                    }
                                    echo '<p>'. esc_html($txt) .'</p>';
                                }
                            }
                            ?>
                        </div>

                    <?php } ?>

                    <footer class="entry-footer">
                        <?php  if ($show_post_metadata !== '0') { ?>

                            <div class="left">
                                <?php  if ($blog_listing_show_category !== '0') { ?>
                                    <span class="cat-links"><?php echo get_the_category_list(', ', '', $post->ID); ?></span>
                                <?php } ?>
                            </div>

                            <div class="right">
                                <?php  if ($blog_listing_show_date !== '0') { ?>
                                    <span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link(get_the_date('d.m.Y', $post->ID))); ?>"><?php echo esc_html(get_the_date(TMM::get_option('date_format'), $post->ID)); ?></a></span>
                                <?php } ?>
                                <?php if ($blog_listing_show_tags !== '0' && get_the_tags($post->ID)) { ?>
                                    <span class="tags-links"><?php echo get_the_term_list( $post->ID, 'post_tag', '', ', ', ''); ?></span>
                                <?php } ?>
                                <?php  if ($blog_listing_show_author !== '0') {
                                    $user_info = get_userdata($post->post_author);
                                    ?>
                                    <span class="byline"><a href="<?php echo esc_url(get_author_posts_url($post->post_author)); ?>"><?php echo esc_html($user_info->display_name); ?></a></span>
                                <?php } ?>
                                <?php  if ($blog_listing_show_comments !== '0') { ?>
                                    <span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)) ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span>
                                <?php } ?>
                                <?php  if ($blog_listing_show_likes !== '0') { ?>
                                    <?php echo TMM_Helper::get_post_like($post->ID); ?>
                                <?php } ?>
                            </div>

                        <?php } ?>
                    </footer>

                </article>

                <?php                
                }
            } 
            ?>
        </div><!--/ .post-area-->

        <div class="pagenavbar">
            <div class="pagenavi advanced_search" data-postsperpage="<?php echo esc_attr($posts_per_page); ?>" data-posts="<?php echo esc_attr($post_ids); ?>">
                <?php
                for ($i = 1; $i <= ($pages); $i++) {
                    if ($current_page == $i) {
                        ?>
                        <span class="page-numbers current"><?php echo esc_html($current_page); ?></span>
                <?php
                    } else {
                ?>
                        <a class="page-numbers" href="#"><?php echo esc_html($i); ?></a>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        
        <?php
        die();
    }
}
