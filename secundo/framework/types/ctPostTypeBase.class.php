<?php
if (!class_exists('ctPostTypeBase')) {


    require_once CT_THEME_LIB_DIR.'/types/ctTypeBase.class.php';

    /**
     * Post type handler
     * @author hc
     */
    class ctPostTypeBase extends ctTypeBase
    {

        /**
         * Slug option name
         */

        const OPTION_SLUG = 'post_index_slug';

        /**
         * Initializes events
         * @return mixed|void
         */

        public function init()
        {
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
            wp_register_script('ct.post', CT_THEME_ADMIN_ASSETS_URI . '/js/post.js', array('jquery'));
            wp_enqueue_script('ct.post');

            add_meta_box("post-gallery-meta", esc_html__("Gallery format settings", 'ct_theme'), array($this, "postGalleryMeta"), "post", "normal", "high");
            add_meta_box("post-link-meta", esc_html__("Link format settings", 'ct_theme'), array($this, "postLinkMeta"), "post", "normal", "high");
            add_meta_box("post-quote-meta", esc_html__("Quote format settings", 'ct_theme'), array($this, "postQuoteMeta"), "post", "normal", "high");
            add_meta_box("post-video-meta", esc_html__("Video format settings", 'ct_theme'), array($this, "postVideoMeta"), "post", "normal", "high");
            add_meta_box("post-audio-meta", esc_html__("Audio format settings", 'ct_theme'), array($this, "postAudioMeta"), "post", "normal", "high");
            add_action('save_post', array($this, 'saveDetails'));
        }

        /**
         * Gets hook name
         * @return string
         */
        protected function getHookBaseName()
        {
            return 'ct_post';
        }

        /**
         * Returns permalink slug
         * @return string
         */

        protected function getPermalinkSlug()
        {
            // Rewriting Permalink Slug
            $permalink_slug = (function_exists('ct_get_context_option') ? ct_get_context_option('post_index_slug', 'post') : ct_get_option('post_index_slug', 'post'));
            if (empty($permalink_slug)) {
                $permalink_slug = 'post';
            }

            return $permalink_slug;
        }

        /**
         * Draws post gallery format settings
         */

        public function postGalleryMeta()
        {
            global $post;
            $custom = get_post_custom($post->ID);
            $displayMethod = isset($custom['display_method'][0]) ? $custom['display_method'][0] : 'image';
            $revolution_slider = isset($custom['revolution_slider'][0]) ? $custom['revolution_slider'][0] : '';

            if ($supportsRevolutionSlider = function_exists('rev_slider_shortcode')) {
                global $wpdb;
                $slides = $wpdb->get_results($wpdb->prepare("SELECT * FROM %s", GlobalsRevSlider::$table_sliders));
            }
            ?>
            <p>
                <label for="display_method"><?php esc_html_e('Show portfolio item as', 'ct_theme') ?>: </label>
                <select class="ct-toggler" id="display_method" name="display_method">
                    <option data-group=".display" data-toggle="ct-toggable.gallery"
                            value="gallery" <?php echo selected('gallery', $displayMethod) ?>><?php esc_html_e("Gallery", 'ct_theme') ?></option>
                    <?php if ($supportsRevolutionSlider): ?>
                        <option data-group=".display" data-toggle="ct-toggable.revolution-slider"
                                value="revolution-slider" <?php echo selected('revolution-slider', $displayMethod) ?>><?php esc_html_e("Revolution slider gallery", 'ct_theme') ?></option>
                    <?php endif; ?>
                </select>
            </p>
            <p class="howto"><?php esc_html_e("You can use the post images gallery. If the Revolution Slider module is installed, you can also use it to create your custom gallery.", 'ct_theme') ?></p>
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
            <p class="howto ct-toggable revolution-slider display"><?php esc_html_e("Choose your revolution slider gallery", 'ct_theme') ?></p>
        <?php endif; ?>
        <?php
        }

        /**
         * Draws post link format settings
         */

        public function postLinkMeta()
        {
            global $post;
            $custom = get_post_custom($post->ID);
            $link = isset($custom["link"][0]) ? $custom["link"][0] : "";
            ?>
            <p>
                <label for="link"><?php esc_html_e('Link', 'ct_theme') ?>: </label>
                <input type="text" id="link" class="regular-text" name="link" value="<?php echo esc_url($link); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("Input your link. Example: http://www.google.com", 'ct_theme') ?></p>
        <?php
        }

        /**
         * Draws post quote format settings
         */

        public function postQuoteMeta()
        {
            global $post;
            $custom = get_post_custom($post->ID);
            $quote = isset($custom["quote"][0]) ? $custom["quote"][0] : "";
            $quoteAuthor = isset($custom["quoteAuthor"][0]) ? $custom["quoteAuthor"][0] : "";
            ?>
            <p>
                <label for="quote"><?php esc_html_e('Quote', 'ct_theme') ?>: </label>
                <textarea id="quote" class="regular-text" name="quote" cols="100"
                          rows="10"><?php echo esc_html($quote); ?></textarea>
            </p>
            <p class="howto"><?php esc_html_e("Quote content", 'ct_theme') ?></p>

            <p>
                <label for="quoteAuthor"><?php esc_html_e('Author', 'ct_theme') ?>: </label>
                <input id="quoteAuthor" class="regular-text" name="quoteAuthor"
                       value="<?php echo esc_attr($quoteAuthor); ?>">
            </p>
            <p class="howto"><?php esc_html_e("Quote author", 'ct_theme') ?></p>

        <?php
        }

        /**
         * Draws post video format settings
         */

        public function postVideoMeta()
        {
            global $post;
            $custom = get_post_custom($post->ID);
            $videoM4V = isset($custom["videoM4V"][0]) ? $custom["videoM4V"][0] : "";
            $videoOGV = isset($custom["videoOGV"][0]) ? $custom["videoOGV"][0] : "";
            $videoDirect = isset($custom["videoDirect"][0]) ? $custom["videoDirect"][0] : "";
            $videoCode = isset($custom["videoCode"][0]) ? $custom["videoCode"][0] : "";
            ?>
            <p>
                <label for="videoM4V"><?php esc_html_e('M4V File URL', 'ct_theme') ?>: </label>
                <input type="text" id="videoM4V" class="regular-text" name="videoM4V"
                       value="<?php echo esc_url($videoM4V); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("The URL to the .m4v video file", 'ct_theme') ?></p>
            <p>
                <label for="videoOGV"><?php esc_html_e('OGV File URL', 'ct_theme') ?>: </label>
                <input type="text" id="videoOGV" class="regular-text" name="videoOGV"
                       value="<?php echo esc_url($videoOGV); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("The URL to the .ogv video file", 'ct_theme') ?></p>
            <p>
                <label for="videoDirect"><?php esc_html_e('Direct video URL', 'ct_theme') ?>: </label>
                <input type="text" id="videoDirect" class="regular-text" name="videoDirect"
                       value="<?php echo esc_url($videoDirect); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("Direct movie link to embed movie from popular services like Youtube, Vimeo, Dailymotion", 'ct_theme') ?></p>
            <p>
                <label for="videoCode"><?php esc_html_e('Embedded Code', 'ct_theme') ?>: </label>
                <textarea id="videoCode" class="regular-text" name="videoCode" cols="100"
                          rows="10"><?php echo $videoCode; ?></textarea>
            </p>
            <p class="howto"><?php esc_html_e("You can use any custom embed code.", 'ct_theme') ?></p>
        <?php
        }

        /**
         * Draws post video format settings
         */

        public function postAudioMeta()
        {
            global $post;
            $custom = get_post_custom($post->ID);
            $audioMP3 = isset($custom["audioMP3"][0]) ? $custom["audioMP3"][0] : "";
            $audioOGA = isset($custom["audioOGA"][0]) ? $custom["audioOGA"][0] : "";
            $audioPoster = isset($custom["audioPoster"][0]) ? $custom["audioPoster"][0] : "";
            $audioPosterHeight = isset($custom["audioPosterHeight"][0]) ? $custom["audioPosterHeight"][0] : "";
            ?>

            <p>
                <label for="audioMP3"><?php esc_html_e('MP3 File URL', 'ct_theme') ?>: </label>
                <input type="text" id="audioMP3" class="regular-text" name="audioMP3"
                       value="<?php echo esc_url($audioMP3); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("The URL to the .mp3 audio file", 'ct_theme') ?></p>
            <p>
                <label for="audioOGA"><?php esc_html_e('OGA File URL', 'ct_theme') ?>: </label>
                <input type="text" id="audioOGA" class="regular-text" name="audioOGA"
                       value="<?php echo esc_url($audioOGA); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("The URL to the .oga, .ogg audio file", 'ct_theme') ?></p>
            <p>
                <label for="audioPoster"><?php esc_html_e('Poster URL', 'ct_theme') ?>: </label>
                <input type="text" id="audioPoster" class="regular-text" name="audioPoster"
                       value="<?php echo esc_url($audioPoster); ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("The URL to the poster file", 'ct_theme') ?></p>
            <p>
                <label for="audioPosterHeight"><?php esc_html_e('Poster height', 'ct_theme') ?>: </label>
                <input type="text" id="audioPosterHeight" class="regular-text" name="audioPosterHeight"
                       value="<?php echo (int)$audioPosterHeight; ?>"/>
            </p>
            <p class="howto"><?php esc_html_e("The height of the poster", 'ct_theme') ?></p>
        <?php
        }

        public function saveDetails()
        {
            global $post;

            $fields = array('link', 'quote', 'quoteAuthor', 'videoM4V', 'videoOGV', 'videoDirect', 'videoCode', 'audioMP3', 'audioOGA', 'audioPoster', 'audioPosterHeight');
            foreach ($fields as $field) {
                if (isset($_POST[$field])) {
                    update_post_meta($post->ID, $field, $_POST[$field]);
                }
            }
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

        /**
         * Gets display method for portfolio
         * @param array $meta - post meta
         * @return null|string
         */
        public static function getMethodFromMeta($meta)
        {
            $method = isset($meta['display_method']) ? $meta['display_method'][0] : null;
            if (!$method) {
                $method = '';
            }
            return $method ? $method : 'gallery';
        }
    }
}