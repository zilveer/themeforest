<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 2/27/15
 * Time: 3:22 PM
 */
add_action("wp_ajax_nopriv_zorka_gallery_load_more", "zorka_gallery_load_more");
add_action("wp_ajax_zorka_gallery_load_more", "zorka_gallery_load_more");
function zorka_gallery_load_more()
{

    $item = $_REQUEST["item"];
    $column = $_REQUEST["column"];
    $load_more = $_REQUEST["load_more"];
    $load_more_style = $_REQUEST['load_more_style'];
    $current_page = $_REQUEST["current_page"];
    $short_code = sprintf('[zorka_gallery column="%s" item="%s" load_more="%s" current_page="%s" load_more_style="%s"]', $column, $item, $load_more, $current_page,$load_more_style);
    echo do_shortcode($short_code);
    die();
}

add_action("wp_ajax_nopriv_zorka_classes_search", "zorka_classes_search");
add_action("wp_ajax_zorka_classes_search", "zorka_classes_search");
function zorka_classes_search()
{
    function zorka_search_classes_filter($where, &$wp_query)
    {
        global $wpdb;
        if ($keyword = $wp_query->get('search_prod_title')) {
            $where .= ' AND ((' . $wpdb->posts . '.post_title LIKE \'%' . $wpdb->esc_like($keyword) . '%\'';
            $where .= ' OR ' . $wpdb->posts . '.post_excerpt LIKE \'%' . $wpdb->esc_like($keyword) . '%\'))';
        }
        return $where;
    }

    $keyword = $_REQUEST["keyword"];
    if ($keyword) {
        $search_query = array(
            'search_prod_title' => $keyword,
            'order' => 'DESC',
            'orderby' => 'date',
            'post_status' => 'publish',
            'post_type' => array('zorka_classes'),
            'nopaging' => false,
        );
        add_filter('posts_where', 'zorka_search_classes_filter', 10, 2);
        $search = new WP_Query($search_query);
        remove_filter('posts_where', 'zorka_search_classes_filter', 10, 2);

        $html = '';
        $item_col = 'classes-col-3';
        if (function_exists('dynamic_sidebar') && is_active_sidebar('archive-classes-left-sidebar')) {
            $item_col = 'classes-col-4';
        }
        $html_item = '<div class="classes-item ' . esc_attr($item_col) . '">
                                    <div class="thumbnail-wrap">
                                        %1$s
                                    </div>
                                    <div class="content-wrap">
                                        <h6><a href="%2$s" title="%3$s">%3$s</a></h6>
                                        <div class="excerpt">%4$s</div>
                                    </div>
                                </div>';
        if ($search && $search->post_count > 0) {
            while ($search->have_posts()) : $search->the_post();
                $img = '';
                if (has_post_thumbnail()) {
                    $img = get_the_post_thumbnail(get_the_ID(), 'thumbnail-350x350');
                }
                $html .= sprintf($html_item, $img, get_permalink(), get_the_title(), get_the_excerpt());
            endwhile;
            wp_reset_postdata();

        } else
            $html = '<div class="no-post">' . esc_html__("No classes found",'zorka') . '</div>';
        echo wp_kses_post($html);
    }
    die();

}



function zorka_popup_icon()
{
    $icons = array('glass','music','search','envelope-o','heart','star','star-o','user','film','th-large','th','th-list','check','remove','close','times','search-plus','search-minus','power-off','signal','gear','cog','trash-o','home','file-o','clock-o','road','download','arrow-circle-o-down','arrow-circle-o-up','inbox','play-circle-o','rotate-right','repeat','refresh','list-alt','lock','flag','headphones','volume-off','volume-down','volume-up','qrcode','barcode','tag','tags','book','bookmark','print','camera','font','bold','italic','text-height','text-width','align-left','align-center','align-right','align-justify','list','dedent','outdent','indent','video-camera','photo','image','picture-o','pencil','map-marker','adjust','tint','edit','pencil-square-o','share-square-o','check-square-o','arrows','step-backward','fast-backward','backward','play','pause','stop','forward','fast-forward','step-forward','eject','chevron-left','chevron-right','plus-circle','minus-circle','times-circle','check-circle','question-circle','info-circle','crosshairs','times-circle-o','check-circle-o','ban','arrow-left','arrow-right','arrow-up','arrow-down','mail-forward','share','expand','compress','plus','minus','asterisk','exclamation-circle','gift','leaf','fire','eye','eye-slash','warning','exclamation-triangle','plane','calendar','random','comment','magnet','chevron-up','chevron-down','retweet','shopping-cart','folder','folder-open','arrows-v','arrows-h','bar-chart-o','bar-chart','twitter-square','facebook-square','camera-retro','key','gears','cogs','comments','thumbs-o-up','thumbs-o-down','star-half','heart-o','sign-out','linkedin-square','thumb-tack','external-link','sign-in','trophy','github-square','upload','lemon-o','phone','square-o','bookmark-o','phone-square','twitter','facebook-f','facebook','github','unlock','credit-card','rss','hdd-o','bullhorn','bell','certificate','hand-o-right','hand-o-left','hand-o-up','hand-o-down','arrow-circle-left','arrow-circle-right','arrow-circle-up','arrow-circle-down','globe','wrench','tasks','filter','briefcase','arrows-alt','group','users','chain','link','cloud','flask','cut','scissors','copy','files-o','paperclip','save','floppy-o','square','navicon','reorder','bars','list-ul','list-ol','strikethrough','underline','table','magic','truck','pinterest','pinterest-square','google-plus-square','google-plus','money','caret-down','caret-up','caret-left','caret-right','columns','unsorted','sort','sort-down','sort-desc','sort-up','sort-asc','envelope','linkedin','rotate-left','undo','legal','gavel','dashboard','tachometer','comment-o','comments-o','flash','bolt','sitemap','umbrella','paste','clipboard','lightbulb-o','exchange','cloud-download','cloud-upload','user-md','stethoscope','suitcase','bell-o','coffee','cutlery','file-text-o','building-o','hospital-o','ambulance','medkit','fighter-jet','beer','h-square','plus-square','angle-double-left','angle-double-right','angle-double-up','angle-double-down','angle-left','angle-right','angle-up','angle-down','desktop','laptop','tablet','mobile-phone','mobile','circle-o','quote-left','quote-right','spinner','circle','mail-reply','reply','github-alt','folder-o','folder-open-o','smile-o','frown-o','meh-o','gamepad','keyboard-o','flag-o','flag-checkered','terminal','code','mail-reply-all','reply-all','star-half-empty','star-half-full','star-half-o','location-arrow','crop','code-fork','unlink','chain-broken','question','info','exclamation','superscript','subscript','eraser','puzzle-piece','microphone','microphone-slash','shield','calendar-o','fire-extinguisher','rocket','maxcdn','chevron-circle-left','chevron-circle-right','chevron-circle-up','chevron-circle-down','html5','css3','anchor','unlock-alt','bullseye','ellipsis-h','ellipsis-v','rss-square','play-circle','ticket','minus-square','minus-square-o','level-up','level-down','check-square','pencil-square','external-link-square','share-square','compass','toggle-down','caret-square-o-down','toggle-up','caret-square-o-up','toggle-right','caret-square-o-right','euro','eur','gbp','dollar','usd','rupee','inr','cny','rmb','yen','jpy','ruble','rouble','rub','won','krw','bitcoin','btc','file','file-text','sort-alpha-asc','sort-alpha-desc','sort-amount-asc','sort-amount-desc','sort-numeric-asc','sort-numeric-desc','thumbs-up','thumbs-down','youtube-square','youtube','xing','xing-square','youtube-play','dropbox','stack-overflow','instagram','flickr','adn','bitbucket','bitbucket-square','tumblr','tumblr-square','long-arrow-down','long-arrow-up','long-arrow-left','long-arrow-right','apple','windows','android','linux','dribbble','skype','foursquare','trello','female','male','gittip','gratipay','sun-o','moon-o','archive','bug','vk','weibo','renren','pagelines','stack-exchange','arrow-circle-o-right','arrow-circle-o-left','toggle-left','caret-square-o-left','dot-circle-o','wheelchair','vimeo-square','turkish-lira','try','plus-square-o','space-shuttle','slack','envelope-square','wordpress','openid','institution','bank','university','mortar-board','graduation-cap','yahoo','google','reddit','reddit-square','stumbleupon-circle','stumbleupon','delicious','digg','pied-piper','pied-piper-alt','drupal','joomla','language','fax','building','child','paw','spoon','cube','cubes','behance','behance-square','steam','steam-square','recycle','automobile','car','cab','taxi','tree','spotify','deviantart','soundcloud','database','file-pdf-o','file-word-o','file-excel-o','file-powerpoint-o','file-photo-o','file-picture-o','file-image-o','file-zip-o','file-archive-o','file-sound-o','file-audio-o','file-movie-o','file-video-o','file-code-o','vine','codepen','jsfiddle','life-bouy','life-buoy','life-saver','support','life-ring','circle-o-notch','ra','rebel','ge','empire','git-square','git','hacker-news','tencent-weibo','qq','wechat','weixin','send','paper-plane','send-o','paper-plane-o','history','genderless','circle-thin','header','paragraph','sliders','share-alt','share-alt-square','bomb','soccer-ball-o','futbol-o','tty','binoculars','plug','slideshare','twitch','yelp','newspaper-o','wifi','calculator','paypal','google-wallet','cc-visa','cc-mastercard','cc-discover','cc-amex','cc-paypal','cc-stripe','bell-slash','bell-slash-o','trash','copyright','at','eyedropper','paint-brush','birthday-cake','area-chart','pie-chart','line-chart','lastfm','lastfm-square','toggle-off','toggle-on','bicycle','bus','ioxhost','angellist','cc','shekel','sheqel','ils','meanpath','dashcube','forumbee','leanpub','sellsy','shirtsinbulk','simplybuilt','skyatlas','cart-plus','cart-arrow-down','diamond','ship','user-secret','motorcycle','street-view','heartbeat','venus','mars','mercury','transgender','transgender-alt','venus-double','mars-double','venus-mars','mars-stroke','mars-stroke-v','mars-stroke-h','neuter','facebook-official','pinterest-p','whatsapp','server','user-plus','user-times','hotel','bed','viacoin','train','subway','medium');
    $icons_zorka = array('pe-7s-album', 'pe-7s-arc', 'pe-7s-back-2', 'pe-7s-bandaid', 'pe-7s-car', 'pe-7s-diamond', 'pe-7s-door-lock', 'pe-7s-eyedropper', 'pe-7s-female', 'pe-7s-gym', 'pe-7s-hammer', 'pe-7s-headphones', 'pe-7s-helm', 'pe-7s-hourglass', 'pe-7s-leaf', 'pe-7s-magic-wand', 'pe-7s-male', 'pe-7s-map-2', 'pe-7s-next-2', 'pe-7s-paint-bucket', 'pe-7s-pendrive', 'pe-7s-photo', 'pe-7s-piggy', 'pe-7s-plugin', 'pe-7s-refresh-2', 'pe-7s-rocket', 'pe-7s-settings', 'pe-7s-shield', 'pe-7s-smile', 'pe-7s-usb', 'pe-7s-vector', 'pe-7s-wine', 'pe-7s-cloud-upload', 'pe-7s-cash', 'pe-7s-close', 'pe-7s-bluetooth', 'pe-7s-cloud-download', 'pe-7s-way', 'pe-7s-close-circle', 'pe-7s-id', 'pe-7s-angle-up', 'pe-7s-wristwatch', 'pe-7s-angle-up-circle', 'pe-7s-world', 'pe-7s-angle-right', 'pe-7s-volume', 'pe-7s-angle-right-circle', 'pe-7s-users', 'pe-7s-angle-left', 'pe-7s-user-female', 'pe-7s-angle-left-circle', 'pe-7s-up-arrow', 'pe-7s-angle-down', 'pe-7s-switch', 'pe-7s-angle-down-circle', 'pe-7s-scissors', 'pe-7s-wallet', 'pe-7s-safe', 'pe-7s-volume2', 'pe-7s-volume1', 'pe-7s-voicemail', 'pe-7s-video', 'pe-7s-user', 'pe-7s-upload', 'pe-7s-unlock', 'pe-7s-umbrella', 'pe-7s-trash', 'pe-7s-tools', 'pe-7s-timer', 'pe-7s-ticket', 'pe-7s-target', 'pe-7s-sun', 'pe-7s-study', 'pe-7s-stopwatch', 'pe-7s-star', 'pe-7s-speaker', 'pe-7s-signal', 'pe-7s-shuffle', 'pe-7s-shopbag', 'pe-7s-share', 'pe-7s-server', 'pe-7s-search', 'pe-7s-film', 'pe-7s-science', 'pe-7s-disk', 'pe-7s-ribbon', 'pe-7s-repeat', 'pe-7s-refresh', 'pe-7s-add-user', 'pe-7s-refresh-cloud', 'pe-7s-paperclip', 'pe-7s-radio', 'pe-7s-note2', 'pe-7s-print', 'pe-7s-network', 'pe-7s-prev', 'pe-7s-mute', 'pe-7s-power', 'pe-7s-medal', 'pe-7s-portfolio', 'pe-7s-like2', 'pe-7s-plus', 'pe-7s-left-arrow', 'pe-7s-play', 'pe-7s-key', 'pe-7s-plane', 'pe-7s-joy', 'pe-7s-photo-gallery', 'pe-7s-pin', 'pe-7s-phone', 'pe-7s-plug', 'pe-7s-pen', 'pe-7s-right-arrow', 'pe-7s-paper-plane', 'pe-7s-delete-user', 'pe-7s-paint', 'pe-7s-bottom-arrow', 'pe-7s-notebook', 'pe-7s-note', 'pe-7s-next', 'pe-7s-news-paper', 'pe-7s-musiclist', 'pe-7s-music', 'pe-7s-mouse', 'pe-7s-more', 'pe-7s-moon', 'pe-7s-monitor', 'pe-7s-micro', 'pe-7s-menu', 'pe-7s-map', 'pe-7s-map-marker', 'pe-7s-mail', 'pe-7s-mail-open', 'pe-7s-mail-open-file', 'pe-7s-magnet', 'pe-7s-loop', 'pe-7s-look', 'pe-7s-lock', 'pe-7s-lintern', 'pe-7s-link', 'pe-7s-like', 'pe-7s-light', 'pe-7s-less', 'pe-7s-keypad', 'pe-7s-junk', 'pe-7s-info', 'pe-7s-home', 'pe-7s-help2', 'pe-7s-help1', 'pe-7s-graph3', 'pe-7s-graph2', 'pe-7s-graph1', 'pe-7s-graph', 'pe-7s-global', 'pe-7s-gleam', 'pe-7s-glasses', 'pe-7s-gift', 'pe-7s-folder', 'pe-7s-flag', 'pe-7s-filter', 'pe-7s-file', 'pe-7s-expand1', 'pe-7s-exapnd2', 'pe-7s-edit', 'pe-7s-drop', 'pe-7s-drawer', 'pe-7s-download', 'pe-7s-display2', 'pe-7s-display1', 'pe-7s-diskette', 'pe-7s-date', 'pe-7s-cup', 'pe-7s-culture', 'pe-7s-crop', 'pe-7s-credit', 'pe-7s-copy-file', 'pe-7s-config', 'pe-7s-compass', 'pe-7s-comment', 'pe-7s-coffee', 'pe-7s-cloud', 'pe-7s-clock', 'pe-7s-check', 'pe-7s-chat', 'pe-7s-cart', 'pe-7s-camera', 'pe-7s-call', 'pe-7s-calculator', 'pe-7s-browser', 'pe-7s-box2', 'pe-7s-box1', 'pe-7s-bookmarks', 'pe-7s-bicycle', 'pe-7s-bell', 'pe-7s-battery', 'pe-7s-ball', 'pe-7s-back', 'pe-7s-attention', 'pe-7s-anchor', 'pe-7s-albums', 'pe-7s-alarm', 'pe-7s-airplay');
    ob_start();
    ?>
    <div id="g5plus-framework-popup-icon-wrapper">
	    <div class="popup-icon-wrapper">
		    <div class="popup-content">
			    <div class="icon-search">
				    <input placeholder="Search" type="text" id="txtSearch">

				    <div class="preview">
					    <span></span> <a id="iconPreview" href="javascript:;"><i class="fa fa-home"></i></a>
				    </div>
				    <div style="clear: both;"></div>
			    </div>
			    <div class="list-icon">
				    <h3>Font Pe-icon-7-stroke</h3>
				    <ul id="group-1">
					    <?php foreach ($icons_zorka as $icon) {
						    ?>
						    <li><a title="<?php echo esc_attr($icon); ?>" href="javascript:;"><i class="<?php echo esc_attr($icon); ?>"></i></a></li>
						    <?php

					    } ?>
				    </ul>
				    <br>
				    <h3>Font Awesome</h3>
				    <ul id="group-1">
					    <?php foreach ($icons as $icon) {
						    ?>
						    <li><a title="fa fa-<?php echo esc_attr($icon); ?>" href="javascript:;"><i class="fa fa-<?php echo esc_attr($icon); ?>"></i></a></li>
						    <?php

					    } ?>
				    </ul>
			    </div>
		    </div>
		    <div class="popup-bottom">
			    <a id="btnSave" href="javascript:;" class="button button-primary">Insert Icon</a>
		    </div>
	    </div>
    </div>

    <?php
    die(); // this is required to return a proper result
}

add_action('wp_ajax_popup_icon', 'zorka_popup_icon');


/*---------------Product QuickView----------------*/
add_action( 'wp_ajax_nopriv_product_quick_view', 'zorka_product_quick_view_callback' );
add_action( 'wp_ajax_product_quick_view', 'zorka_product_quick_view_callback' );
function zorka_product_quick_view_callback() {
    $product_id = $_REQUEST['id'];
    $args = array(
        'post_type'           => 'product',
        'post__in'            => array($product_id)
    );

    $products = new WP_Query( $args );
    ob_start();
    while ( $products->have_posts() ) : $products->the_post();
        wc_get_template_part('content-product-quick-view');
     endwhile; // end of the loop.
    $output = ob_get_contents();
    ob_end_clean();
    echo  $output;
    die();
}

/*------------Panel Selector-------------------*/
add_action( 'wp_ajax_nopriv_panel_selector', 'zorka_panel_selector_callback' );
add_action( 'wp_ajax_panel_selector', 'zorka_panel_selector_callback' );
function zorka_panel_selector_callback() {
    ob_start();
    ?>
    <div id="panel-style-selector">
        <div class="panel-wrapper">
            <div class="panel-selector-open"><i class="fa fa-cog"></i></div>
            <div class="panel-selector-header"><?php esc_html_e('Style Selector','zorka');?></div>
            <div class="panel-selector-body clearfix">
                <section class="panel-selector-section clearfix">
                    <h3 class="panel-selector-title"><?php esc_html_e('Primary Color','zorka'); ?></h3>
                    <div class="panel-selector-row clearfix">
                        <ul class="panel-primary-color">
                            <li class="active" style="background-color: #c97178" data-color="#c97178"></li>
                            <li style="background-color: #6b58cd" data-color="#6b58cd"></li>
                            <li style="background-color: #f4bf1e" data-color="#f4bf1e"></li>
                            <li style="background-color: #30ABE2" data-color="#30ABE2"></li>
                        </ul>
                    </div>
                </section>

                <section class="panel-selector-section clearfix">
                    <h3 class="panel-selector-title"><?php esc_html_e('Layout','zorka'); ?></h3>
                    <div class="panel-selector-row clearfix">
                        <a data-type="layout" data-value="wide" href="#" class="panel-selector-btn"><?php esc_html_e('Wide','zorka'); ?></a>
                        <a data-type="layout" data-value="boxed" href="#" class="panel-selector-btn"><?php esc_html_e('Boxed','zorka'); ?></a>
                    </div>
                </section>

                <section class="panel-selector-section clearfix">
                    <h3 class="panel-selector-title"><?php esc_html_e('Background','zorka'); ?></h3>
                    <div class="panel-selector-row clearfix">
                        <ul class="panel-primary-background">
                            <li class="pattern-0" data-name="patterns/bg0.png" data-type="pattern" style="background-position: 0px 0px;"></li>
                            <li class="pattern-1" data-name="patterns/bg1.png" data-type="pattern" style="background-position: -45px 0px;"></li>
                            <li class="pattern-2" data-name="patterns/bg2.png" data-type="pattern" style="background-position: -90px 0px;"></li>
                            <li class="pattern-3" data-name="patterns/bg3.png" data-type="pattern" style="background-position: -135px 0px;"></li>
                            <li class="pattern-4" data-name="patterns/bg4.png" data-type="pattern" style="background-position: -180px 0px;"></li>
                            <li class="pattern-5" data-name="patterns/bg5.png" data-type="pattern" style="background-position: -225px 0px;"></li>
                            <li class="pattern-6" data-name="patterns/bg6.png" data-type="pattern" style="background-position: -270px 0px;"></li>
                            <li class="pattern-7" data-name="patterns/bg7.png" data-type="pattern" style="background-position: -315px 0px;"></li>
                        </ul>
                    </div>
                </section>
                <section class="panel-selector-section clearfix">
                    <div class="panel-selector-row clearfix">
                        <a id="panel-selector-reset" href="#" class="panel-selector-btn"><?php esc_html_e('Reset','zorka'); ?></a>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php
    $output = ob_get_contents();
    ob_end_clean();
    echo  $output;
    die();
}

add_action( 'wp_ajax_nopriv_custom_css_selector', 'zorka_custom_css_selector' );
add_action( 'wp_ajax_custom_css_selector', 'zorka_custom_css_selector' );
function zorka_custom_css_selector() {
    require_once ( THEME_DIR . 'lib/inc-generate-less/Less.php');
    $primary_color = $_REQUEST['primary_color'];
    $content_file  = '@primary_color:' . $primary_color . ';';
    $file_full_variable = THEME_DIR . 'assets'. DIRECTORY_SEPARATOR .'css'. DIRECTORY_SEPARATOR .'less'. DIRECTORY_SEPARATOR . 'variable.less';
    $file_color = THEME_DIR . 'assets'. DIRECTORY_SEPARATOR .'css'. DIRECTORY_SEPARATOR .'less'. DIRECTORY_SEPARATOR . 'color.less';

    $options = array( 'compress'=>true );
    $parser = new Less_Parser($options);
    $parser->parse($content_file);
    $parser->parseFile($file_full_variable);
    $parser->parseFile($file_color);
    $css = $parser->getCss();
    echo  $css;
    die();




}
