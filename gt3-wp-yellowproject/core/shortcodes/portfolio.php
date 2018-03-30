<?php

class portfolio_shortcode
{
    public function register_shortcode($shortcodeName)
    {
        if (!function_exists("shortcode_portfolio")) {
            function shortcode_portfolio($atts, $content = null)
            {
                global $gt3_pbconfig;
                extract(shortcode_atts(array(
                    'heading_size' => $gt3_pbconfig['default_heading_in_module'],
                    'heading_color' => '',
                    'heading_text' => '',
                    'items_on_start' => '4',
                    'items_per_click' => '4',
                    'view_type' => '1 column',
                    'category' => 'all',
                    'ajax' => 'on',
                    'filter' => 'on',
                ), $atts));

                if ($items_on_start < 1) {
                    $items_on_start = 4;
                }
                if ($items_per_click < 1) {
                    $items_per_click = 4;
                }

                #heading
                if (strlen($heading_color) > 0) {
                    $custom_color = "color:#{$heading_color};";
                }
                if (strlen($heading_text) > 0) {
                    echo "<div class='bg_title'><" . $heading_size . " style='" . $custom_color . "' class='headInModule'>{$heading_text}</" . $heading_size . "></div>";
                }

                switch ($view_type) {
                    case "1 column":
                        $view_type_class = "columns1";
                        BREAK;
                    case "2 columns":
                        $view_type_class = "columns2";
                        BREAK;
                    case "3 columns":
                        $view_type_class = "columns3";
                        BREAK;
                    case "4 columns":
                        $view_type_class = "columns4";
                        BREAK;
                }


############################################################################################
###################################### AJAX OFF ############################################
############################################################################################
                if ($ajax == "off") {

                    #Filter
                    if (($category == "all" || $category == "") && $filter == "on") {
                        echo '
                    <div class="filter_block">
                        <div class="filter_navigation" >
                            <ul class="splitter" id="options">
                                <li>';
                        showPortCategoryWithoutAjax();
                        echo '      </li>
                            </ul>
                        </div>
                    </div>
                    ';
                    }

                    echo '<div class="portfolio_block without_ajax image-grid ' . $view_type_class . '" id="list">';

                    global $wp_query_in_shortcodes;

                    $wp_query_in_shortcodes = new WP_Query();
                    global $paged;
                    $args = array(
                        'post_type' => 'port',
                        'order' => 'DESC',
                        'paged' => $paged,
                        'posts_per_page' => $items_on_start,
                    );

                    if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
                        $category = $_GET['slug'];
                    }

                    if (strlen($category) > 0 && $category !== "all") {
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'portcat',
                                'field' => 'slug',
                                'terms' => $category
                            )
                        );
                    }
                    $wp_query_in_shortcodes->query($args);

                    $i = 1;

                    while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();

                        $pf = get_post_format();
                        if (empty($pf)) $pf = "text";
                        $pfIcon = get_pf_icon($pf);
                        $gt3_pagebuilder = get_theme_pagebuilder(get_the_ID());

                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'single-post-thumbnail');
                        if (strlen($featured_image[0]) < 1) {
                            $featured_image[0] = IMGURL . "/core/your_image_goes_here.jpg";
                        }

                        if (isset($gt3_pagebuilder['settings']['external_link']) && strlen($gt3_pagebuilder['settings']['external_link']) > 0) {
                            $linkToTheWork = $gt3_pagebuilder['settings']['external_link'];
                            $target = "target='_blank'";
                        } else {
                            $linkToTheWork = get_permalink();
                            $target = "";
                        }

                        if (isset($gt3_pagebuilder['settings']['time_spent']) && strlen($gt3_pagebuilder['settings']['time_spent']) > 0) {
                            $time_spent_value = $gt3_pagebuilder['settings']['time_spent'];
                            $time_spent_html = '<div class="portfolio_descr_time">' . ((get_theme_option("translator_status") == "enable") ? get_text("translator_time_spent") : __('Time spent', 'theme_localization')) . ': <span>' . $time_spent_value . '</span></div>';
                        } else {
                            $time_spent_value = '';
                            $time_spent_html = '';
                        }

                        if (!isset($echoallterm)) {
                            $echoallterm = '';
                        }
                        $new_term_list = get_the_terms(get_the_id(), "portcat");
                        if (is_array($new_term_list)) {
                            foreach ($new_term_list as $term) {
                                $tempname = strtr($term->name, array(
                                    ' ' => '-',
                                ));
                                $echoallterm .= strtolower($tempname) . " ";
                                $echoterm = $term->name;
                            }
                        }


                        #Portfolio 1
                        if ($view_type == "1 column") {

                            echo '
                        <div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element row-fluid">

                            <div class="filter_img span6">
                                <a ' . $target . ' href="' . $linkToTheWork . '" class="ico_link"><img src="' . aq_resize($featured_image[0], 570, 400, true, true, true) . '" alt="' . get_the_title() . '" width="570" height="400"></a>
                                <span class="post_type post_type_' . $pf . '"></span>
                            </div>

                            <div class="span6 portfolio_dscr">
                                <h4><a ' . $target . ' href="' . $linkToTheWork . '">' . get_the_title() . '</a></h4>
                                ' . do_shortcode(get_the_content(((get_theme_option("translator_status") == "enable") ? get_text("read_more_link") : __('Read more...', 'theme_localization')))) . '
                            </div>
                        </div>
                        ';

                        }
                        #END Portfolio 1


                        #Portfolio 2
                        if ($view_type == "2 columns") {

                            echo '
                        <div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element">
                            <div class="filter_img">
                                <a ' . $target . ' href="' . $linkToTheWork . '">
                                    <img src="' . aq_resize($featured_image[0], 570, 400, true, true, true) . '" alt="' . get_the_title() . '" width="570" height="400">
                                    <span class="post_type post_type_' . $pf . '"></span>
                                    <div class="portfolio_dscr">
                                        <div class="wrap_padding">
                                            ' . get_the_title() . '
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        ';

                        }
                        #END Portfolio 2


                        #Portfolio 3
                        if ($view_type == "3 columns") {

                            echo '
                        <div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element">
                            <div class="filter_img">
                                <a ' . $target . ' href="' . $linkToTheWork . '">
                                    <img src="' . aq_resize($featured_image[0], 370, 260, true, true, true) . '" alt="' . get_the_title() . '" width="370" height="260">
                                    <span class="post_type post_type_' . $pf . '"></span>
                                    <div class="portfolio_dscr">
                                        <div class="wrap_padding">
                                            ' . get_the_title() . '
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        ';

                        }
                        #END Portfolio 3


                        #Portfolio 4
                        if ($view_type == "4 columns") {

                            echo '
                        <div data-category="' . $echoallterm . '" class="' . $echoallterm . ' element">
                            <div class="filter_img">
                                <a ' . $target . ' href="' . $linkToTheWork . '">
                                <img src="' . aq_resize($featured_image[0], 270, 189, true, true, true) . '" alt="' . get_the_title() . '" width="270" height="189">
                                <span class="post_type post_type_' . $pf . '"></span>
                                <div class="portfolio_dscr">
                                    <div class="wrap_padding">
                                        ' . get_the_title() . '
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                        ';

                        }
                        #END Portfolio 4

                        $i++;
                        unset($echoallterm, $pf);
                    endwhile;

                    echo "
    <script>
    function item_update() {
     jQuery('.image-grid').find('.portfolio_item').each(function(){
      jQuery(this).height(jQuery(this).find('img').height());
      jQuery(this).find('.gallery_descr').css('top' , (((jQuery(this).height()-jQuery(this).find('.gallery_descr').height())/2))+59+'px');
     });
    }

    jQuery(window).load(function(){
     setTimeout('item_update()',1000);
    });
    </script>
    ";

                    echo '<div class="clear"></div></div>';

                    get_pagination(10, "show_in_shortcodes");

                    wp_reset_query();


                }
############################################################################################
####################################### AJAX ON ############################################
############################################################################################
                else {

                    wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
                    wp_enqueue_script('js_sorting', get_template_directory_uri() . '/js/sorting.js');

                    #Filter
                    if (($category == "all" || $category == "") && $filter == "on") {
                        echo '
                <div class="filter_block">
                    <div class="filter_navigation" >
                        <ul class="splitter" id="options">
                            <li>';
                        showPortCategoryWithAjax();
                        echo '      </li>
                        </ul>
                    </div>
                </div>
                ';
                    }

                    #START PORTFOLIO
                    echo '<div class="portfolio_block image-grid ' . $view_type_class . '" id="list">';

                    echo '
                </div><!-- .portfolio_block -->
                <div class="clear"><!-- ClearFix --></div>
                <div class="load_more_cont">';
                    echo '<a class="btn_load_more get_portfolio_works_btn shortcode_button btn_small btn_type1" href="#">' . ((get_theme_option("translator_status") == "enable") ? get_text("translator_load_more") : __('Load more works', 'theme_localization')) . '<span></span></a>';
                    echo '
                </div>
            ';
                    ?>
                    <script>

                        /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
                        var html_template = "<?php echo $view_type; ?>";
                        var now_open_works = 0;
                        var first_load = true;
                        /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

                        function get_portfolio_works(this_obj) {
                            if (typeof(this_obj) == "undefined") {
                                data_option_value = "*";
                            }
                            else {
                                var data_option_value = this_obj.attr("data-option-value");
                            }

                            if (first_load == true) {
                                works_per_load = <?php echo $items_on_start; ?>;
                                first_load = false;
                            } else {
                                works_per_load = <?php echo $items_per_click; ?>;
                            }

                            $.ajax({
                                type: "POST",
                                url: mixajaxurl,
                                data: "html_template=" + html_template + "&now_open_works=" + now_open_works + "&action=get_portfolio_works" + "&works_per_load=" + works_per_load + "&category=<?php echo $category; ?>",
                                success: function (result) {

                                    if (result.length < 1) {
                                        $(".load_more_cont").hide("fast");
                                    }

                                    now_open_works = now_open_works + works_per_load;
                                    var $newItems = $(result);
                                    $(".portfolio_block").isotope('insert', $newItems, function () {

                                        $(".portfolio_block").ready(function () {
                                            $(".portfolio_block").isotope('reLayout');
                                            //Portfolio
                                            $('.portfolio_content').each(function () {
                                                $(this).css('margin-top', Math.floor(-1 * ($(this).height() / 2)) + 'px');
                                            });
                                        });
                                        setTimeout('$(".portfolio_block").isotope("reLayout");', 1500);

                                    });
                                    $('a.prettyPhoto').prettyPhoto();
                                }
                            });
                        }

                        $(".get_portfolio_works_btn").click(function () {
                            get_portfolio_works();
                            return false;
                        });

                        /* load at start */
                        $(window).load(function () {
                            get_portfolio_works();
                        });

                    </script>
                    <?php

                    #get_pagination("10", "show_in_shortcodes");

                    wp_reset_query();

                    return "";
                }

            }
        }

        add_shortcode($shortcodeName, 'shortcode_portfolio');
    }
}




#Shortcode name
$shortcodeName = "portfolio";


#Compile UI for admin panel
#Don't change this line
global $compileShortcodeUI;
$compileShortcodeUI .= "<div class='whatInsert whatInsert_" . $shortcodeName . "'>" . $defaultUI . "</div>";

#Your code
$compileShortcodeUI .= "
Type:
<select name='" . $shortcodeName . "_portfolio_type' class='" . $shortcodeName . "_portfolio_type'>
	<option value='type1'>Low</option>
	<option value='type2'>Bold light</option>
	<option value='type3'>Bold colored</option>
	<option value='type4'>Bold dark</option>
</select>

<script>
	function " . $shortcodeName . "_handler() {

		/* YOUR CODE HERE */

		var portfolio_type = jQuery('." . $shortcodeName . "_portfolio_type').val();

		/* END YOUR CODE */

		/* COMPILE SHORTCODE LINE */
		var compileline = '[" . $shortcodeName . " type=\"'+portfolio_type+'\"][/" . $shortcodeName . "]';

		/* DO NOT CHANGE THIS LINE */
		jQuery('.whatInsert_" . $shortcodeName . "').html(compileline);
	}
</script>

";


#Register shortcode & set parameters
$portfolio = new portfolio_shortcode();
$portfolio->register_shortcode($shortcodeName);

#add shortcode to wysiwyg
#$shortcodesUI['portfolio'] = array("name" => $shortcodeName, "handler" => $compileShortcodeUI);

unset($compileShortcodeUI);

?>