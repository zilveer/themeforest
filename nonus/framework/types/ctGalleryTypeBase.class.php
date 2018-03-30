<?php
if (!class_exists('ctGalleryTypeBase')) {
    require_once CT_THEME_LIB_DIR.'/types/ctTypeBase.class.php';

    /**
     * Gallery type handler
     * @author alex
     */
    class ctGalleryTypeBase extends ctTypeBase
    {

        /**
         * Slug option name
         */

        const OPTION_SLUG = 'gallery_index_slug';

        /**
         * Initializes events
         * @return mixed|void
         */

        public function init()
        {
            add_action('template_redirect', array($this, 'galleryContextFixer'));

            $this->registerType();
            $this->registerTaxonomies();

            /** @var $NHP_Options NHP_Options */
            global $NHP_Options;
            //add options listener for license
            add_action('nhp-opts-options-validate-' . $NHP_Options->args['opt_name'], array($this, 'handleSlugOptionSaved'));
        }

        /**
         * Fixes proper menu state
         */

        public function galleryContextFixer()
        {
            if (get_query_var('post_type') == 'gallery') {
                global $wp_query;
                $wp_query->is_home = false;
            }
            if (get_query_var('taxonomy') == 'gallery_category') {
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
                    'name' => _x('Gallery items', 'post type general name', 'ct_theme'),
                    'singular_name' => _x('Gallery Item', 'post type singular name', 'ct_theme'),
                    'add_new' => _x('Add New', 'gallery', 'ct_theme'),
                    'add_new_item' => esc_html__('Add New Gallery Item', 'ct_theme'),
                    'edit_item' => esc_html__('Edit Gallery Item', 'ct_theme'),
                    'new_item' => esc_html__('New Gallery Item', 'ct_theme'),
                    'view_item' => esc_html__('View Gallery Item', 'ct_theme'),
                    'search_items' => esc_html__('Search Gallery Items', 'ct_theme'),
                    'not_found' => esc_html__('No gallery item found', 'ct_theme'),
                    'not_found_in_trash' => esc_html__('No gallery items found in Trash', 'ct_theme'),
                    'parent_item_colon' => '',
                    'menu_name' => esc_html__('Gallery items', 'ct_theme'),
                ),
                'singular_label' => esc_html__('gallery', 'ct_theme'),
                'public' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                //'menu_position' => 20,
                'capability_type' => 'post',
                'hierarchical' => false,
                'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'page-attributes'),
                'has_archive' => false,
                'rewrite' => array('slug' => $this->getPermalinkSlug(), 'with_front' => true, 'pages' => true, 'feeds' => false),
                'query_var' => false,
                'can_export' => true,
                'show_in_nav_menus' => true,
                'taxonomies' => array('post_tag')
            ));

            register_post_type('gallery', $typeData);
            $this->callHook('post_register_type');
        }

        /**
         * Returns permalink slug
         * @return string
         */

        protected function getPermalinkSlug()
        {
            // Rewriting Permalink Slug
            $permalink_slug = (function_exists('ct_get_context_option') ? ct_get_context_option('gallery_index_slug', 'gallery') : ct_get_option('gallery_index_slug', 'gallery'));
            if (empty($permalink_slug)) {
                $permalink_slug = 'gallery';
            }

            return $permalink_slug;
        }

        /**
         * Gets hook name
         * @return string
         */
        protected function getHookBaseName()
        {
            return 'ct_gallery';
        }

        /**
         * Creates taxonomies
         */

        protected function registerTaxonomies()
        {
            $data = $this->callFilter('pre_register_taxonomies', array(
                'hierarchical' => true,
                'labels' => array(
                    'name' => _x('Gallery Categories', 'taxonomy general name', 'ct_theme'),
                    'singular_name' => _x('Gallery Category', 'taxonomy singular name', 'ct_theme'),
                    'search_items' => esc_html__('Search Categories', 'ct_theme'),
                    'popular_items' => esc_html__('Popular Categories', 'ct_theme'),
                    'all_items' => esc_html__('All Categories', 'ct_theme'),
                    'parent_item' => null,
                    'parent_item_colon' => null,
                    'edit_item' => esc_html__('Edit Gallery Category', 'ct_theme'),
                    'update_item' => esc_html__('Update Gallery Category', 'ct_theme'),
                    'add_new_item' => esc_html__('Add New Gallery Category', 'ct_theme'),
                    'new_item_name' => esc_html__('New Gallery Category Name', 'ct_theme'),
                    'separate_items_with_commas' => esc_html__('Separate Gallery category with commas', 'ct_theme'),
                    'add_or_remove_items' => esc_html__('Add or remove gallery category', 'ct_theme'),
                    'choose_from_most_used' => esc_html__('Choose from the most used gallery category', 'ct_theme'),
                    'menu_name' => esc_html__('Categories', 'ct_theme'),
                ),
                'public' => false,
                'show_in_nav_menus' => false,
                'show_ui' => true,
                'show_tagcloud' => false,
                'query_var' => 'gallery_category',
                'rewrite' => false,

            ));
            register_taxonomy('gallery_category', 'gallery', $data);
            $this->callHook('post_register_taxonomies');
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