<?php
if (!class_exists('ctPortfolioTypeBase')) {
    require_once CT_THEME_LIB_DIR.'/types/ctTypeBase.class.php';

    /**
     * Portfolio type handler
     * @author alex
     */
    class ctPortfolioTypeBase extends ctTypeBase
    {

        /**
         * Slug option name
         */

        const OPTION_SLUG = 'portfolio_index_slug';

        /**
         * Initializes events
         * @return mixed|void
         */

        public function init()
        {
            add_action('template_redirect', array($this, 'portfolioContextFixer'));

            $this->registerType();
            $this->registerTaxonomies();

            add_action("admin_init", array($this, "addMetaBox"));

            /** @var $NHP_Options NHP_Options */
            global $NHP_Options;
            //add options listener for license
            add_action('nhp-opts-options-validate-' . $NHP_Options->args['opt_name'], array($this, 'handleSlugOptionSaved'));
        }

        /**
         * Adds meta box
         */

        public function addMetaBox()
        {
            add_meta_box("portfolio-meta", esc_html__("Portfolio settings", 'ct_theme'), array($this, "portfolioMeta"), "portfolio", "normal", "high");
            add_action('save_post', array($this, 'saveDetails'));
        }

        /**
         * Fixes proper menu state
         */

        public function portfolioContextFixer()
        {
            if (get_query_var('post_type') == 'portfolio') {
                global $wp_query;
                $wp_query->is_home = false;
            }
            if (get_query_var('taxonomy') == 'portfolio_category') {
                global $wp_query;
                $wp_query->is_404 = true;
                $wp_query->is_tax = false;
                $wp_query->is_archive = false;
            }
        }

        /**
         * Register type
         */

        protected function registerType()
        {
            $typeData = $this->callFilter('pre_register_type', array(
                'labels' => array(
                    'name' => _x('Portfolio items', 'post type general name', 'ct_theme'),
                    'singular_name' => _x('Portfolio Item', 'post type singular name', 'ct_theme'),
                    'add_new' => _x('Add New', 'portfolio', 'ct_theme'),
                    'add_new_item' => esc_html__('Add New Portfolio Item', 'ct_theme'),
                    'edit_item' => esc_html__('Edit Portfolio Item', 'ct_theme'),
                    'new_item' => esc_html__('New Portfolio Item', 'ct_theme'),
                    'view_item' => esc_html__('View Portfolio Item', 'ct_theme'),
                    'search_items' => esc_html__('Search Portfolio Items', 'ct_theme'),
                    'not_found' => esc_html__('No portfolio item found', 'ct_theme'),
                    'not_found_in_trash' => esc_html__('No portfolio items found in Trash', 'ct_theme'),
                    'parent_item_colon' => '',
                    'menu_name' => esc_html__('Portfolio items', 'ct_theme'),
                ),
                'singular_label' => esc_html__('portfolio', 'ct_theme'),
                'public' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                //'menu_position' => 20,
                'capability_type' => 'post',
                'hierarchical' => false,
                'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes'),
                'has_archive' => true,
                'rewrite' => array('slug' => $this->getPermalinkSlug(), 'with_front' => true, 'pages' => true, 'feeds' => false),
                'query_var' => false,
                'can_export' => true,
                'show_in_nav_menus' => true,
                'taxonomies' => array('post_tag')
            ));

            register_post_type('portfolio', $typeData);
            $this->callHook('post_register_type');
        }

        /**
         * Returns permalink slug
         * @return string
         */

        protected function getPermalinkSlug()
        {
            // Rewriting Permalink Slug
            $permalink_slug = (function_exists('ct_get_context_option') ? ct_get_context_option('portfolio_index_slug', 'portfolio') : ct_get_option('portfolio_index_slug', 'portfolio'));
            if (empty($permalink_slug)) {
                $permalink_slug = 'portfolio';
            }

            return $permalink_slug;
        }

        /**
         * Gets hook name
         * @return string
         */
        protected function getHookBaseName()
        {
            return 'ct_portfolio';
        }

        /**
         * Creates taxonomies
         */

        protected function registerTaxonomies()
        {
            $data = $this->callFilter('pre_register_taxonomies', array(
                'hierarchical' => true,
                'labels' => array(
                    'name' => _x('Portfolio Categories', 'taxonomy general name', 'ct_theme'),
                    'singular_name' => esc_html_x('Portfolio Category', 'taxonomy singular name', 'ct_theme'),
                    'search_items' => esc_html__('Search Categories', 'ct_theme'),
                    'popular_items' => esc_html__('Popular Categories', 'ct_theme'),
                    'all_items' => esc_html__('All Categories', 'ct_theme'),
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => esc_html__('Edit Portfolio Category', 'ct_theme'),
                    'update_item' => esc_html__('Update Portfolio Category', 'ct_theme'),
                    'add_new_item' => esc_html__('Add New Portfolio Category', 'ct_theme'),
                    'new_item_name' => esc_html__('New Portfolio Category Name', 'ct_theme'),
                    'separate_items_with_commas' => esc_html__('Separate Portfolio category with commas', 'ct_theme'),
                    'add_or_remove_items' => esc_html__('Add or remove portfolio category', 'ct_theme'),
                    'choose_from_most_used' => esc_html__('Choose from the most used portfolio category', 'ct_theme'),
                    'menu_name' => esc_html__('Categories', 'ct_theme'),
                ),
                'public' => false,
                'show_in_nav_menus' => false,
                'show_ui' => true,
                'show_tagcloud' => false,
                'query_var' => 'portfolio_category',
                'rewrite' => false,

            ));
            register_taxonomy('portfolio_category', 'portfolio', $data);
            $this->callHook('post_register_taxonomies');
        }


        /**
         * Draw s portfolio meta
         */

        public function portfolioMeta()
        {
            global $post;
            $custom = get_post_custom($post->ID);
            $client = isset($custom["client"][0]) ? $custom["client"][0] : "";
            $external_url = isset($custom["external_url"][0]) ? $custom["external_url"][0] : "";
            $video = isset($custom["video"][0]) ? $custom["video"][0] : "";
            $displayMethod = isset($custom['display_method'][0]) ? $custom['display_method'][0] : 'image';
            $revolution_slider = isset($custom['revolution_slider'][0]) ? $custom['revolution_slider'][0] : '';

            if ($supportsRevolutionSlider = function_exists('rev_slider_shortcode')) {
                global $wpdb;
                //bugfix #27545bugfix #27545 removed wpdb->prepare which put the table name in parenthesis and broke the query
                $table_sliders = esc_sql(GlobalsRevSlider::$table_sliders);
                $slides = $wpdb->get_results("SELECT * FROM {$table_sliders}");
            }
            ?>
            <p>
                <input id="client" class="regular-text" name="client" value="<?php echo esc_attr($client); ?>"/>
            <p class="howto"><?php esc_html_e("Information about client", 'ct_theme') ?></p>
            <p>
                <label for="url">Url: </label>
                <input id="url" class="regular-text" name="external_url" value="<?php echo esc_url($external_url); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("Link to external site. Leave empty to hide button. It has to start with http://", 'ct_theme') ?></p>
            <p>
                <label for="display_method"><?php esc_html_e('Show portfolio item as', 'ct_theme') ?>: </label>
                <select class="ct-toggler" id="display_method" name="display_method">
                    <option data-group=".display"
                            value="image" <?php echo selected('image', $displayMethod) ?>><?php esc_html_e("Featured image", 'ct_theme') ?></option>
                    <option data-group=".display" data-toggle="ct-toggable.gallery"
                            value="gallery" <?php echo selected('gallery', $displayMethod) ?>><?php esc_html_e("Gallery", 'ct_theme') ?></option>
                    <option data-group=".display" data-toggle="ct-toggable.video"
                            value="video" <?php echo selected('video', $displayMethod) ?>><?php esc_html_e("Video", 'ct_theme') ?></option>
                    <?php if ($supportsRevolutionSlider): ?>
                        <option data-group=".display" data-toggle="ct-toggable.revolution-slider"
                                value="revolution-slider" <?php echo selected('revolution-slider', $displayMethod) ?>><?php esc_html_e("Revolution slider gallery", 'ct_theme') ?></option>
                    <?php endif; ?>
                </select>
            </p>
            <p class="ct-toggable video display">
                <label for="video"><?php esc_html_e('Video url', 'ct_theme') ?>: </label>
                <input id="video" class="regular-text" name="video" value="<?php echo esc_url($video); ?>"/>
            </p>
            <?php if ($supportsRevolutionSlider): ?>
            <p class="ct-toggable revolution-slider display">
                <label for="revolutionSlider"><?php esc_html_e('Revolution slider', 'ct_theme') ?>: </label>

                <select id="revolutionSlider" name="revolution_slider">
                    <?php foreach ($slides as $slide): ?>
                        <option <?php echo selected($slide->alias, $revolution_slider) ?>
                            value="<?php echo esc_attr($slide->alias) ?>"><?php echo esc_html($slide->title) ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
        <?php endif; ?>
        <?php
        }

        public function saveDetails()
        {
            global $post;

            $fields = array('external_url', 'client', 'video', 'display_method', 'revolution_slider');
            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    update_post_meta($post->ID, $field, $_POST[$field]);
                }
            }
        }

        /**
         * Gets display method for portfolio
         * @param array $meta - post meta
         * @return null|string
         */
        public static function getMethodFromMeta($meta)
        {
            $method = isset($meta['display_method']) ? $meta['display_method'][0] : null;
            if (!$method) {
                $method = isset($meta['video'][0]) && trim($meta['video'][0]) ? 'video' : 'image';
            }
            return $method;
        }

        /**
         * Handles rebuild
         */

        public function handleSlugOptionSaved($newValues)
        {
            $currentSlug = $this->getPermalinkSlug();
            //rebuild rewrite if new slug
            if (isset($newValues[self::OPTION_SLUG]) && ($currentSlug != $newValues[self::OPTION_SLUG])) {
                $this->callHook('pre_slug_option_saved', array('current_slug' => $currentSlug, 'new_slug' => $newValues[self::OPTION_SLUG]));

                //clean rewrite to refresh it
                delete_option('rewrite_rules');
            }
        }
    }
}