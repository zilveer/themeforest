<?php
/**
 * Created by duongle
 * Date: 2/7/14
 * Time: 3:40 PM
 **/

class AWESeo extends AweFramework
{

    const SEO_OPTIONS = 'AWE-SEO-Options';
    public $archive_support="awe-archive-supports";
    public $seo_options = array(
        'homepage'      =>  array(
//            'html5'         =>  1,
            'title'         =>  '',
            'tagline'       =>  1,
            'meta-desc'     =>  '',
            'keywords'      =>  '',
            'noindex'       =>  0,
            'nofollow'      =>  0,
            'noarchive'     =>  0
        ),
        'title'         =>  array(
            'site-name'     =>  0,
            'location'      =>  'right',
            'separator'     =>  "|",
            'page'          =>0,
        ),
        'head'          =>  array(
            'canonical-redirect'    =>      0,
            'remove-generator'      =>      1,
            'remove-wlwmanifest'    =>      1,
            'remove-rsd'            =>      0,
            'remove-feed'           =>      0,
            'remove-index-rel'      =>      1,
            'remove-feed-extra'     =>      0,
            'remove-noindex'        =>      0,
            'remove-shortlink'      =>      1,
        ),
        'robots'        =>  array(
            'noindex'       =>  array(
                'category'          =>  1,
                'tag'               =>  1,
                'author'            =>  1,
                'date'              =>  1,
                'search'            =>  1,
            ),
            'noarchive'     =>  array(
                'entire'            =>  0,
                'category'          =>  0,
                'tag'               =>  0,
                'author'            =>  0,
                'date'              =>  0,
                'search'            =>  0,
            ),
            'noodp'        =>  1,
            'noydir'        =>  1,
        ),
        'archives'      =>  array(
            'canonical'         =>  1,
            'headline'          =>  1,
            'introduction'      =>  1,
            'dl-category'       =>  1,
            'dl-tag'            =>  1,
            'dl-author'         =>  1,
            'dl-taxonomy'       =>  1,
        ),
        'sitemap'       =>  array(
            'enable'        =>  1,
        ),
        'google-authorship' =>  '',
        'site-very'     =>  array(
            'google'        =>  '',
            'bing'          =>  '',
        )

    );
    public $theme_layout_options;
    public function __construct(){
        $this->theme_layout_options = apply_filters('awe_layout_options',array('LM','MR','LMR','MRR','None'));

        add_action('admin_menu',            array($this,'register_seo_menu' ));
        //refresh options
        $this->seo_refresh_options();

        add_action('admin_notices',         array($this,'display_global_messages'),                     9999);

        // add seo metabox into post/page
        add_action( 'admin_menu',           array($this,'add_singular_seo_box'),                                 9);

        // save singular seo metabox
        add_action( 'save_post',            array($this,'awe_singular_seo_save'),                                1,2);

        // add archive & seo options to each taxonomy edit screen
        add_action( 'admin_init',           array($this,'add_options_taxonomy'));

        // add seo options to archive custom post type
        add_action('admin_menu' ,           array($this,'add_seo_menu_archive_cpt'));
        // add seo options to user

        // display custom headline & introduction
        add_filter( 'default_intro',       array($this,'seo_intro'));
        //Change title
        add_filter( 'wp_title',             array($this,'seo_title'),                       10, 3 );

        // keywords meta
        add_filter( 'default_keywords',     array($this,'seo_keywords'));

        //description meta
        add_filter( 'default_description',  array($this,'seo_description') );

        // add robots meta
        add_action('awe_robots_meta',       array($this,'robots_meta'));

        // rel="publisher" link tag
        add_action( 'wp_head',              array($this,'rel_publisher'),                                10);

        // Custom canonical link tag
        if($this->seo_options['head']['canonical-redirect']==0)
        add_action( 'wp_head',              array($this,'custom_rel_canonical'),                          9);
        // remove head attributes
        if($this->seo_options['head']['remove-generator']==1)
            remove_action('wp_head', 'wp_generator');

        if($this->seo_options['head']['canonical-redirect']==1)
            remove_action( 'wp_head', 'rel_canonical' );

        if($this->seo_options['head']['remove-wlwmanifest']==1)
            remove_action('wp_head', 'wlwmanifest_link');

        if($this->seo_options['head']['remove-rsd']==1)
            remove_action('wp_head', 'rsd_link');

        if($this->seo_options['head']['remove-feed']==1)
            remove_action('wp_head', 'feed_links', 2);

        if($this->seo_options['head']['remove-index-rel']==1)
            remove_action('wp_head', 'index_rel_link');

        if($this->seo_options['head']['remove-feed-extra']==1)
            remove_action('wp_head', 'feed_links_extra', 3);

        if($this->seo_options['head']['remove-noindex']==1)
            remove_action('wp_head', 'noindex');

        if($this->seo_options['head']['remove-shortlink'])
            remove_action( 'wp_head', 'wp_shortlink_wp_head');

    }

    public function register_seo_menu(){
        add_submenu_page( 'AWE-Framework', 'SEO Settings', 'SEO', 'manage_options', 'AWE-SEO', array($this,'seo_settings') );
//        add_menu_page( 'AWE SEO', 'AWE SEO', 'manage_options', 'awe-menu-seo', array($this,'dashboard_settings'), '' );
//        add_submenu_page( 'awe-menu-seo', 'Dashboard', 'Dashboard', 'manage_options', 'awe-menu-seo', array($this,'dashboard_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Posts Optimization', 'Posts Optimization', 'manage_options', 'awe-menu-posts', array($this,'posts_optimization_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Titles & Metas', 'Titles & Metas', 'manage_options', 'awe-seo-title-metas', array($this,'title_metas_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Social Stats', 'Social Stats', 'manage_options', 'awe-seo-social', array($this,'social_settings') );
//        add_submenu_page( 'awe-menu-seo', 'XML Sitemap', 'XML Sitemap', 'manage_options', 'awe-seo-xml', array($this,'xml_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Link Builder', 'Link Builder', 'manage_options', 'awe-seo-link', array($this,'link_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Backlink Builder', 'Backlink Builder', 'manage_options', 'awe-seo-backlink', array($this,'backlink_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Google Analytics', 'Google Analytics', 'manage_options', 'awe-seo-ganalytic', array($this,'google_analytic_settings') );
//        add_submenu_page( 'awe-menu-seo', 'Monitor 404 Errors', 'Monitor 404 Errors', 'manage_options', 'awe-seo-404', array($this,'monitor_404_settings') );
//        add_submenu_page( 'awe-menu-seo', 'RSS', 'RSS', 'manage_options', 'awe-seo-rss', array($this,'rss_settings') );
    }

    public function seo_refresh_options()
    {
        if(isset($_POST['reset-seo'])) {
            delete_option(self::SEO_OPTIONS);
            $this->add_message('success','Reset OK!');
        }
        if(isset($_POST['save-seo']))
        {
            //homepage
            $settings['homepage'] = (isset($_POST['seo']['homepage']))? $_POST['seo']['homepage'] :array();
            $noncheckbox = array_diff_key($this->seo_options['homepage'], $settings['homepage']);
            $not_checkbox = array('title','meta-desc','keywords');
            foreach ($noncheckbox as $i => $v) {
                if(in_array($i,$not_checkbox)) $noncheckbox[$i]='';
                else $noncheckbox[$i] = 0;
            }
            $settings['homepage'] = array_merge($settings['homepage'], $noncheckbox);

            //title
            $settings['title'] = (isset($_POST['seo']['title']))? $_POST['seo']['title'] :array();
            $noncheckbox = array_diff_key($this->seo_options['title'], $settings['title']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = 0;
            }
            $settings['title'] = array_merge($settings['title'], $noncheckbox);

            //head
            $settings['head'] = (isset($_POST['seo']['head']))? $_POST['seo']['head'] :array();
            $noncheckbox = array_diff_key($this->seo_options['head'], $settings['head']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = 0;
            }
            $settings['head'] = array_merge($settings['head'], $noncheckbox);

            //robots
            $settings['robots']['noindex'] = (isset($_POST['seo']['robots']['noindex']))? $_POST['seo']['robots']['noindex'] :array();
            $noncheckbox = array_diff_key($this->seo_options['robots']['noindex'], $settings['robots']['noindex']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = 0;
            }
            $settings['robots']['noindex'] = array_merge($settings['robots']['noindex'], $noncheckbox);

            $settings['robots']['noarchive'] = (isset($_POST['seo']['robots']['noarchive']))? $_POST['seo']['robots']['noarchive'] :array();
            $noncheckbox = array_diff_key($this->seo_options['robots']['noarchive'], $settings['robots']['noarchive']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = 0;
            }
            $settings['robots']['noarchive'] = array_merge($settings['robots']['noarchive'], $noncheckbox);

            $settings['robots']['noodp'] = (isset($_POST['seo']['robots']['noodp']))? $_POST['seo']['robots']['noodp']:0;
            $settings['robots']['noydir'] = (isset($_POST['seo']['robots']['noydir']))? $_POST['seo']['robots']['noydir']:0;

            //archives
            $settings['archives'] = (isset($_POST['seo']['archives']))? $_POST['seo']['archives'] :array();
            $noncheckbox = array_diff_key($this->seo_options['archives'], $settings['archives']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = 0;
            }
            $settings['archives'] = array_merge($settings['archives'], $noncheckbox);

            //sitemaps
            $settings['sitemap'] = (isset($_POST['seo']['sitemap']))? $_POST['seo']['sitemap'] :array();
            $noncheckbox = array_diff_key($this->seo_options['sitemap'], $settings['sitemap']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = 0;
            }
            $settings['sitemap'] = array_merge($settings['sitemap'], $noncheckbox);

            //site-verification
            $settings['site-very'] = (isset($_POST['seo']['site-very']))? $_POST['seo']['site-very'] :array();
            $noncheckbox = array_diff_key($this->seo_options['site-very'], $settings['site-very']);
            foreach ($noncheckbox as $i => $v) {
                $noncheckbox[$i] = '';
            }
            $settings['site-very'] = array_merge($settings['site-very'], $noncheckbox);

            //google authorship
            $settings['google-authorship'] = (isset($_POST['seo']['google-authorship']))? $_POST['seo']['google-authorship']:'';

            $options = $settings;
            update_option(self::SEO_OPTIONS,$settings);

            $this->add_message('success','Save Ok');

        }else
            $options = get_option(self::SEO_OPTIONS);
        if(is_array($options))
            $this->seo_options = array_merge($this->seo_options,$options);


    }

    public function seo_settings()
    {
        include_once('seo_tpl.php');

    }


    /**
     * SEO title
     */
    public function seo_title($title, $sep, $seplocation)
    {
        global $wp_query;
        $sep = " | ";
        $seplocation = "right";
        if ( is_feed() )
            return trim( $title );

        $sep = (!empty($this->seo_options['title']['separator']))?$this->seo_options['title']['separator']:" | ";
        $seplocation = (!empty($this->seo_options['title']['location']))?$this->seo_options['title']['location']:"right";

        // is home page
        if(is_front_page())
        {
            $title = (!empty($this->seo_options['homepage']['title'])) ? $this->seo_options['homepage']['title'] : get_bloginfo( 'name' );

            $title = ($this->seo_options['homepage']['tagline']==1)? $title . " $sep " . get_bloginfo( 'description' ) : $title;
        }
        if(is_category())
        {
            $term  = $wp_query->get_queried_object();
            $title = ! empty( $term->meta_data['title'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta_data['title'] ) ) : $title;
        }
        if(is_tag())
        {
            $term  = $wp_query->get_queried_object();
            $title = ! empty( $term->meta_data['title'] ) ? $term->meta_data['title'] : $title;
        }
        if ( is_tax() ) {
            $term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $title = ! empty( $term->meta_data['title'] ) ? wp_kses_stripslashes( wp_kses_decode_entities( $term->meta_data['title'] ) ) : $title;
        }

        if ( is_author() ) {
            $user_title = get_the_author_meta( 'meta_title', (int) get_query_var( 'author' ) );
            $title      = $user_title ? $user_title : $title;
        }


        if(is_singular())
        {
            if($this->get_custom_fields('singular_title'))
                $title = $this->get_custom_fields('singular_title');
        }


        if(is_post_type_archive() && $option=$this->get_cpt_archive_support())
        {
            $title = (!empty($option['title'])) ? $option['title'] : $title;
        }


        if ( $this->seo_options['title']['page']==1)
        {
            global $paged, $page;
            if ($paged >= 2 || $page >= 2) {
            $title = "$title $sep " . sprintf(__('Page %s', 'bootstrapwp'), max($paged, $page));
            }
        }

        if ( $this->seo_options['title']['site-name']==0 || is_front_page() )
            return esc_html( trim( $title ) );
        $title = 'right' === $seplocation ? $title . " $sep " . get_bloginfo( 'name' ) : get_bloginfo( 'name' ) . " $sep " . $title;


        return esc_html( trim( $title ) );
    }

    /**
     * Keywords meta
     */
    public function seo_keywords($output)
    {
        $keywords='';
        if ( is_front_page() )
            $keywords = $this->seo_options['homepage']['keywords'];

        if ( is_singular() ) {
            if ( $this->get_custom_fields( 'singular_keywords' ) )
                $keywords = $this->get_custom_fields( 'singular_keywords' );
        }

        if(is_post_type_archive() && $option=$this->get_cpt_archive_support())
        {
            $keywords = (!empty($option['keywords'])) ? $option['keywords'] : $keywords;
        }

        if ( $keywords )
            return sprintf("<meta name=\"keywords\" content=\"%s\" />", $keywords) . "\n";
        else
            return $output;
    }

    /**
     * Description meta
     */
    public function seo_description($output)
    {
        $description = '';
        if ( is_front_page() )
            $description = $this->seo_options['homepage']['meta-desc'] ? $this->seo_options['homepage']['meta-desc'] : get_bloginfo( 'description' );

        if ( is_singular() ) {
            if ( $this->get_custom_fields( 'singular_desc' ) )
                $description = $this->get_custom_fields( 'singular_desc' );
        }

        if(is_post_type_archive() && $option=$this->get_cpt_archive_support())
        {
            $description = (!empty($option['description'])) ? $option['description'] : $description;
        }

        if ( $description )
            return '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
        else
            return $output;
    }

    public function custom_rel_canonical()
    {
        //* Remove WP canonical
        remove_action('wp_head',    'rel_canonical');
        global $wp_query;
        $canonical = '';

        if ( is_front_page() )
            $canonical = trailingslashit( home_url() );

        if ( is_singular() ) {
            if ( ! $id = $wp_query->get_queried_object_id() )
                return;

            $cf = $this->get_custom_fields( 'singular_canonical' );

            $canonical = $cf ? $cf : get_permalink( $id );
        }
        if ( is_category() || is_tag() || is_tax() ) {
            if ( ! $id = $wp_query->get_queried_object_id() )
                return;

            $taxonomy = $wp_query->queried_object->taxonomy;

            $canonical = ($this->seo_options['archives']['canonical']==1) ? get_term_link( (int) $id, $taxonomy ) : 0;
        }

        if ( is_author() ) {
            if ( ! $id = $wp_query->get_queried_object_id() )
                return;

            $canonical = ($this->seo_options['archives']['canonical']==1) ? get_author_posts_url( $id ) : 0;
        }
        if(is_post_type_archive())
        {
            global $post;
            if(isset($post->post_type)){
                $canonical = ($this->seo_options['archives']['canonical']==1) ?get_post_type_archive_link( $post->post_type ) : 0;
            }

        }
        if ( $canonical ){
            $output = '<link rel="canonical" href="'.esc_url( apply_filters( 'custom_rel_canonical', $canonical ) ).'" />' . "\n";
            printf( $output );
        }

    }
    /**
     * Echo custom rel="publisher" link tag
     */
    public function rel_publisher()
    {
        if ( is_front_page() && $publisher_url = $this->seo_options['google-authorship'] )
            echo '<link rel="publisher" href="'.esc_url($publisher_url).'" />'."\n";
    }

    /**
     * Add meta box for post/page
     */
    public function add_singular_seo_box()
    {

        foreach((array) get_post_types(array('public'=>true)) as $type){
            if(post_type_supports($type,'awe-seo')){
                add_meta_box('awe_singular_seo_box',__('SEO Settings',self::LANG),array($this,'awe_singular_seo_box_html'),$type,'normal','high');
                add_filter( "postbox_classes_{$type}_awe_singular_seo_box", array($this,'add_my_meta_box_classes') );
            }

        }
    }

    public function add_my_meta_box_classes( $classes=array() ) {
        /* In order to ensure we don't duplicate classes, we should
            check to make sure it's not already in the array */
        if( !in_array( 'awe-settings', $classes ) )
            $classes[] = 'awe-settings';

        return $classes;
    }

    /**
     * Generate html seo box meta for post/page on add/edit screen
     */
    public function awe_singular_seo_box_html()
    {
        wp_nonce_field( 'awe_seo_save', 'awe_seo_nonce' );
        ?>
        <p><label for="awe_title"><b><?php _e('Custom Title',self::LANG);?></b></label></p>
        <p><input type="text" maxlength="150" value="<?php echo $this->get_custom_fields('singular_title');?>" class="large-text" id="awe_title" name="awe_seo[singular_title]"></p>

        <p><label for="awe_desc"><b><?php _e('Custom Meta Description',self::LANG);?></b></label></p>
        <p><textarea cols="4" rows="4" id="awe_desc" name="awe_seo[singular_desc]" class="widefat"><?php echo $this->get_custom_fields('singular_desc');?></textarea></p>

        <p><label for="awe_keywords"><b><?php _e('Custom Meta Keywords',self::LANG);?></b> <?php _e('(Separate key with commas)',self::LANG);?></label></p>
        <p><input type="text" value="<?php echo $this->get_custom_fields('singular_keywords');?>" class="large-text" id="awe_keywords" name="awe_seo[singular_keywords]"></p>

        <p><label for="awe_canonical"><b><?php _e('Custom Canonical URL',self::LANG);?></b></label></p>
        <p><input type="text" value="<?php echo $this->get_custom_fields('singular_canonical');?>" class="large-text" id="awe_canonical" name="awe_seo[singular_canonical]"></p>

        <p><label for="awe_redirect"><b><?php _e('Custom Redirect URL',self::LANG);?></b></label></p>
        <p><input type="text" value="<?php echo $this->get_custom_fields('singular_redirect');?>" class="large-text" id="awe_redirect" name="awe_seo[singular_redirect]"></p>
        <br>
        <p><label><b><?php _e('Robots Meta Settings',self::LANG);?></b></label></p>
        <p>
            <label for="awe_noindex"><input type="checkbox" value="1" id="awe_noindex" name="awe_seo[singular_noindex]" <?php checked($this->get_custom_fields('singular_noindex'),1);?>>
                <?php _e('Apply <code>noindex</code> to this post/page',self::LANG);?></label><br>

            <label for="awe_nofollow"><input type="checkbox" value="1" id="awe_nofollow" name="awe_seo[singular_nofollow]" <?php checked($this->get_custom_fields('singular_nofollow'),1);?>>
                <?php _e('Apply <code>nofollow</code> to this post/page',self::LANG);?></label><br>

            <label for="awe_noarchive"><input type="checkbox" value="1" id="awe_noarchive" name="awe_seo[singular_noarchive]" <?php checked($this->get_custom_fields('singular_noarchive'),1);?>>
                <?php _e('Apply <code>noarchive</code> to this post/page',self::LANG);?></label>
        </p>
        <?php
    }

    /**
     * Save seo meta data for post/page
     * @param $post_id
     * @param $post
     */
    public function awe_singular_seo_save($post_id, $post)
    {
        if(!isset($_POST['awe_seo']))
            return;
        $data = wp_parse_args( $_POST['awe_seo'], array(
            'singular_title'         => '',
            'singular_desc'   => '',
            'singular_keywords'      => '',
            'singular_canonical' => '',
            'singular_redirect'               => '',
            'singular_noindex'       => 0,
            'singular_nofollow'      => 0,
            'singular_noarchive'     => 0,
        ) );
        foreach ( (array) $data as $key => $value ) {
            if ( in_array( $key, array( 'singular_title', 'singular_desc', 'singular_keywords' ) ) )
                $data[ $key ] = strip_tags( $value );
        }

        $this->save_custom_fields( $data, 'awe_seo_save', 'awe_seo_nonce', $post );
    }


    /**
     * Add the archive & seo options to each custom taxonomy edit screen
     */
    public function add_options_taxonomy()
    {
        foreach ( get_taxonomies( array( 'show_ui' => true ) ) as $tax_name ){
            add_action( $tax_name . '_edit_form', array($this,'archive_options_taxonomy_html'), 10, 2 );
            add_action( $tax_name . '_edit_form', array($this,'seo_options_taxonomy_html'), 10, 2 );
        }

    }

    /**
     * Generate html archive options
     * Add Headline & Introduction for taxonomy
     * @param Object $tag   term object
     * @param string $taxonomy Name of taxonomy
     */
    public function archive_options_taxonomy_html($tag, $taxonomy)
    {
        $tax = get_taxonomy( $taxonomy );
        ?>
        <div id="archive_taxonomy" class="awe-settings">
        <h2><?php echo esc_html( $tax->labels->singular_name ) . ' ' . __( 'Archive Settings', self::LANG ); ?></h2>
            <table class="form-table">
                <tr class="form-field">
                    <th scope="row"><label for="meta-headline"><?php _e('Headline',self::LANG);?></label></th>
                    <td><input name="awe-meta-data[headline]" id="meta-headline" type="text" value="<?php echo esc_attr( $tag->meta_data['headline'] ); ?>" size="40" />
                        <p class="description"><?php _e('Leave empty if you do not want to display a headline.',self::LANG);?></p>
                    </td>
                </tr>
                <tr class="form-field">
                    <th scope="row"><label for="meta-intro-text"><?php _e('Intro Text',self::LANG);?></label></th>
                    <td>
                        <textarea name="awe-meta-data[intro-text]" id="meta-intro-text" rows="5" cols="50" class="large-text"><?php echo esc_textarea( $tag->meta_data['intro-text'] ); ?></textarea>
                        <p class="description"><?php _e('Leave empty if you do not want to display any intro text.',self::LANG);?></p>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }


    /**
     * Generate html seo options
     * Custom title, description, keywords and robots meta seo fields
     * @param Object $tag   term object
     * @param string $taxonomy Name of taxonomy
     */

    public function seo_options_taxonomy_html($tag, $taxonomy)
    {
        $tax = get_taxonomy( $taxonomy );
       ?>
        <div id="seo_taxonomy" class="awe-settings">
        <h2><?php echo esc_html( $tax->labels->singular_name ) . ' ' . __( 'SEO Settings', self::LANG ); ?></h2>
        <table class="form-table">
            <tbody>
            <tr class="form-field">
                <th scope="row"><label for="meta-title"><?php _e('Title',self::LANG);?></label></th>
                <td><input name="awe-meta-data[title]" id="meta-title" type="text" value="<?php echo esc_attr( $tag->meta_data['title'] ); ?>" size="40" />
                    <p class="description"><?php _e('For Google, this length is usually between 50-60 characters, or 512 pixels wide',self::LANG);?></p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><label for="meta-description"><?php _e('Description',self::LANG);?></label></th>
                <td>
                    <textarea name="awe-meta-data[description]" id="meta-description" rows="5" cols="50" class="large-text"><?php echo esc_textarea( $tag->meta_data['description'] ); ?></textarea>
                    <p class="description"><?php _e('Meta descriptions can be any length, but search engines generally truncate snippets longer than 160 characters. It is best to keep meta descriptions between 150 and 160 characters.',self::LANG);?></p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><label for="meta-keywords"><?php _e('Keywords',self::LANG);?></label></th>
                <td><input name="awe-meta-data[keywords]" id="meta-keywords" type="text" value="<?php echo esc_attr( $tag->meta_data['keywords'] ); ?>" size="40"  />
                    <p class="description"><?php _e('Leave empty if you do not want to display any intro text.',self::LANG);?></p></td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><?php _e( 'Robots Meta', self::LANG ); ?></th>
                <td>
                    <label for="meta-noindex">
                        <input name="awe-meta-data[noindex]" id="meta-noindex" type="checkbox" value="1" <?php checked( $tag->meta_data['noindex'] ); ?> />
                        <?php _e( "Apply <code>&lt;noindex&gt;</code> to this archive?", self::LANG ); ?>
                    </label><br />

                    <label for="meta-nofollow"><input name="awe-meta-data[nofollow]" id="meta-nofollow" type="checkbox" value="1" <?php checked( $tag->meta_data['nofollow'] ); ?> />
                        <?php _e( "Apply <code>&lt;noindex&gt;</code> to this archive?", self::LANG ); ?>
                    </label><br />

                    <label for="meta-noarchive"><input name="awe-meta-data[noarchive]" id="meta-noarchive" type="checkbox" value="1" <?php checked( $tag->meta_data['noarchive'] ); ?> />
                        <?php _e( "Apply <code>&lt;noarchive&gt;</code> to this archive?'",  self::LANG ); ?>
                    </label>
                </td>
            </tr>
            <tbody>
        </table>
        </div>
        <?php

    }


    public function seo_intro($header)
    {
        global $wp_query;
        if ( get_query_var( 'paged' ) >= 2 )
        {
            $header['headline']='';
            $header['intro']='';
            return $header;
        }
        $headline = $header['headline'];
        $intro_text = $header['intro'];
        if(is_category())
        {
            if($this->seo_options['archives']['dl-category']==0)
                return $header;
            $term  = $wp_query->get_queried_object();

            $headline = ($this->seo_options['archives']['headline']==1)?$term->name:$headline;
            $headline = ! empty( $term->meta_data['headline'] ) ? $term->meta_data['headline'] : $headline;

            $intro_text = ($this->seo_options['archives']['introduction']==1)?$term->description:$intro_text;
            $intro_text = ! empty( $term->meta_data['intro-text'] ) ? $term->meta_data['intro-text'] : $intro_text;
        }
        if(is_tag()){
            if($this->seo_options['archives']['dl-tag']==0)
                return $header;
            $term  = $wp_query->get_queried_object();

            $headline = ($this->seo_options['archives']['headline']==1)?$term->name:$headline;
            $headline = ! empty( $term->meta_data['headline'] ) ? $term->meta_data['headline'] : $headline;

            $intro_text = ($this->seo_options['archives']['introduction']==1)?$term->description:$intro_text;
            $intro_text = ! empty( $term->meta_data['intro-text'] ) ? $term->meta_data['intro-text'] : $intro_text;
        }
        if ( is_tax() ) {
            if($this->seo_options['archives']['dl-taxonomy']==0)
                return $header;
            $term  = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $headline = ($this->seo_options['archives']['headline']==1)?$term->name:$headline;
            $headline = ! empty( $term->meta_data['headline'] ) ? $term->meta_data['headline'] : $headline;
            $intro_text = ($this->seo_options['archives']['introduction']==1)?$term->description:$intro_text;
            $intro_text = ! empty( $term->meta_data['intro-text'] ) ? $term->meta_data['intro-text'] : $intro_text;

        }

        if ( is_post_type_archive() && $option = $this->get_cpt_archive_support() ) {
            $headline = ! empty( $option['headline'] ) ? $option['headline'] : $headline;
            $intro_text = ! empty( $option['intro-text'] ) ? $option['intro-text'] : $intro_text;
        }

        if ( is_author() ) {
            if($this->seo_options['archives']['dl-author']==0)
                return $header;
            $curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
            $google_profile = get_the_author_meta( 'googleplus', $curauth->ID );
            $author = get_the_author_meta('display_name');
            if ( $google_profile )
                $author = '<a href="' . esc_url( $google_profile ) . '" rel="me">' . $author . '</a>';
            $headline = ($this->seo_options['archives']['headline']==1)?$author:$headline;
            $headline = (get_the_author_meta( 'meta_title', (int) get_query_var( 'author' ) ))?get_the_author_meta( 'title', (int) get_query_var( 'author' ) ):$headline;
            $intro_text = ($this->seo_options['archives']['introduction']==1)?get_the_author_meta("description"):$intro_text;
            $intro_text = ( get_the_author_meta( 'meta_description', (int) get_query_var( 'author' ) ) ) ? get_the_author_meta( 'meta_description', (int) get_query_var( 'author' ) ) : $intro_text;

        }
        return array('headline'=>$headline,'intro'=>$intro_text);

    }



    /**
     * Add Robots meta into header
     */
    public function robots_meta()
    {
        global $wp_query;
        //* Defaults
        $meta = array(
            'noindex'   => '',
            'nofollow'  => '',
            'noarchive' => $this->seo_options['robots']['noarchive']['entire'] ? 'noarchive' : '',
            'noodp'     => $this->seo_options['robots']['noodp'] ? 'noodp' : '',
            'noydir'    => $this->seo_options['robots']['noydir'] ? 'noydir' : '',
        );
        if ( ! get_option( 'blog_public' ) )
            return;
        if(is_front_page())
        {
            $meta['noindex'] = $this->seo_options['homepage']['noindex']?'noindex':$meta['noindex'];
            $meta['nofollow'] = $this->seo_options['homepage']['nofollow']?'nofollow':$meta['nofollow'];
            $meta['noarchive'] = $this->seo_options['homepage']['noarchive']?'noarchive':$meta['noarchive'];
        }
        if(is_category())
        {
            $term = $wp_query->get_queried_object();
            if(isset($term->meta_data)){
                $meta['noindex']   = $term->meta_data['noindex'] ? 'noindex' : $meta['noindex'];
                $meta['nofollow']  = $term->meta_data['nofollow'] ? 'nofollow' : $meta['nofollow'];
                $meta['noarchive'] = $term->meta_data['noarchive'] ? 'noarchive' : $meta['noarchive'];
            }


            $meta['noindex']   = $this->seo_options['robots']['noindex']['category'] ? 'noindex' : $meta['noindex'];
            $meta['noarchive'] = $this->seo_options['robots']['noarchive']['category'] ? 'noarchive' : $meta['noarchive'];

            //* noindex paged archives, if canonical archives is off
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $meta['noindex'] = $paged > 1 && ! $this->seo_options['robots']['archives']['canonical'] ? 'noindex' : $meta['noindex'];
        }
        if ( is_tag() ) {
            $term = $wp_query->get_queried_object();
            if(isset($term->meta_data)){
                $meta['noindex']   = $term->meta_data['noindex'] ? 'noindex' : $meta['noindex'];
                $meta['nofollow']  = $term->meta_data['nofollow'] ? 'nofollow' : $meta['nofollow'];
                $meta['noarchive'] = $term->meta_data['noarchive'] ? 'noarchive' : $meta['noarchive'];
            }
            $meta['noindex']   = $this->seo_options['robots']['noindex']['tag'] ? 'noindex' : $meta['noindex'];
            $meta['noarchive'] = $this->seo_options['robots']['noarchive']['tag'] ? 'noarchive' : $meta['noarchive'];

            //* noindex paged archives, if canonical archives is off
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $meta['noindex'] = $paged > 1 && ! $this->seo_options['robots']['archives']['canonical'] ? 'noindex' : $meta['noindex'];
        }

        if ( is_tax() ) {
            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            if(isset($term->meta_data)){
                $meta['noindex']   = $term->meta_data['noindex'] ? 'noindex' : $meta['noindex'];
                $meta['nofollow']  = $term->meta_data['nofollow'] ? 'nofollow' : $meta['nofollow'];
                $meta['noarchive'] = $term->meta_data['noarchive'] ? 'noarchive' : $meta['noarchive'];
            }
            //* noindex paged archives, if canonical archives is off
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $meta['noindex'] = $paged > 1 && ! $this->seo_options['robots']['archives']['canonical'] ? 'noindex' : $meta['noindex'];
        }

        if ( is_post_type_archive() && $option = $this->get_cpt_archive_support() ) {
            $meta['noindex']   = $option['noindex'] ? 'noindex' : $meta['noindex'];
            $meta['nofollow']  = $option['nofollow'] ? 'nofollow' : $meta['nofollow'];
            $meta['noarchive'] = $option['noarchive'] ? 'noarchive' : $meta['noarchive'];

            //* noindex paged archives, if canonical archives is off
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $meta['noindex'] = $paged > 1 && ! $this->seo_options['robots']['archives']['canonical'] ? 'noindex' : $meta['noindex'];
        }

        if ( is_author() ) {
            $meta['noindex']   = get_the_author_meta( 'noindex', (int) get_query_var( 'author' ) ) ? 'noindex' : $meta['noindex'];
            $meta['nofollow']  = get_the_author_meta( 'nofollow', (int) get_query_var( 'author' ) ) ? 'nofollow' : $meta['nofollow'];
            $meta['noarchive'] = get_the_author_meta( 'noarchive', (int) get_query_var( 'author' ) ) ? 'noarchive' : $meta['noarchive'];

            $meta['noindex']   = $this->seo_options['robots']['noindex']['author'] ? 'noindex' : $meta['noindex'];
            $meta['noarchive'] = $this->seo_options['robots']['noarchive']['author'] ? 'noarchive' : $meta['noarchive'];

            //* noindex paged archives, if canonical archives is off
            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $meta['noindex'] = $paged > 1 && ! $this->seo_options['robots']['archives']['canonical'] ? 'noindex' : $meta['noindex'];
        }

        if ( is_date() ) {
            $meta['noindex']   = $this->seo_options['robots']['noindex']['date'] ? 'noindex' : $meta['noindex'];
            $meta['noarchive'] =  $this->seo_options['robots']['noarchive']['date'] ? 'noarchive' : $meta['noarchive'];
        }

        if ( is_search() ) {
            $meta['noindex']   = $this->seo_options['robots']['noindex']['search'] ? 'noindex' : $meta['noindex'];
            $meta['noarchive'] =  $this->seo_options['robots']['noarchive']['search'] ? 'noarchive' : $meta['noarchive'];
        }

        // single post / page
        if ( is_singular() ) {
            $meta['noindex']   = $this->get_custom_fields( 'singular_noindex' ) ? 'noindex' : $meta['noindex'];
            $meta['nofollow']  = $this->get_custom_fields( 'singular_nofollow' ) ? 'nofollow' : $meta['nofollow'];
            $meta['noarchive'] = $this->get_custom_fields( 'singular_noarchive' ) ? 'noarchive' : $meta['noarchive'];
        }


        $meta = array_filter( $meta );

        if ( $meta )
            printf( '<meta name="robots" content="%s" />' . "\n", implode( ',', $meta ) );
    }


    /**
     * Check custom post type has archive?
     * yes, check post type support AWE archive_support
     * yes, return option of this
     * else return false
     * @param string $post_type_name
     *
     * @return array|bool|mixed|void
     */
    public function get_cpt_archive_support($post_type_name='')
    {
        if ( ! $post_type_name ) {
            global $wp_query;
            if(!isset($wp_query->query_vars['post_type']))
                return false;
            $post_type_name = $wp_query->query_vars['post_type'];
        }
        $post_type_names = array();
        $cpt_archive_types = $this->get_all_cpt_archive_types();
        foreach ( $cpt_archive_types as $post_type )
//            $post_type_names[$post_type->name] = $post_type->rewrite['slug'];
            $post_type_names[$post_type->name] = $post_type->query_var;

        if( in_array( $post_type_name, array_keys($post_type_names) ) && post_type_supports( $post_type_name, $this->archive_support ))
            return $this->get_options_archive_cpt($post_type_names[$post_type_name]);
        else
            return false;
    }

    /**
     * Add sub menu to Custom post type which has archive and post type support AWE archive
     */
    public function add_seo_menu_archive_cpt()
    {
        $all_post_types= $this->get_all_cpt_archive_types();
        if(is_array($all_post_types))
        foreach($all_post_types as $post_type){
            if(post_type_supports($post_type->name,$this->archive_support)){
//                add_submenu_page( "edit.php?post_type=".$post_type->rewrite['slug'], "SEO Settings", "SEO Settings", "manage_options", "awe-seo-".$post_type->rewrite['slug'], array($this,'seo_options_archive_cpt_html') );
                add_submenu_page( "edit.php?post_type=".$post_type->query_var, "SEO Settings", "SEO Settings", "manage_options", "awe-seo-".$post_type->query_var, array($this,'seo_options_archive_cpt_html') );
            }
        }
    }

    /**
     * Get All custom post types
     * @return array
     */
    public function get_all_cpt_archive_types()
    {
        $args = array(
            'public'       => true,
            'show_ui'      => true,
            'show_in_menu' => true,
            'has_archive'  => true,
            '_builtin'     => false,

        );

        return get_post_types( $args, 'objects' );

    }

    /**
     * Get option data of cpt
     * @param $post_type_slug
     *
     * @return array|mixed|void
     */
    public function get_options_archive_cpt($post_type_slug)
    {
        $default = array(
            'headline'      =>  '',
            'intro-text'    =>  '',
            'title'         =>  '',
            'description'   =>  '',
            'keywords'      =>  '',
            'noindex'       =>  0,
            'nofollow'      =>  0,
            'noarchive'     =>  0,
            'layout'        =>  'default',
        );
        $options = get_option($post_type_slug.'archive_settings')?get_option($post_type_slug.'archive_settings'):array();
        $options = array_merge($default,$options);
        return $options;
    }

    /**
     * Generate Option Archive to Custom post type
     */
    public function seo_options_archive_cpt_html()
    {
        $post_type_slug = $_GET['post_type']? $_GET['post_type']:'';

        if(isset($_POST['save_awe_meta_data'])){
            $data = wp_parse_args( $_POST['awe-meta-data'], array(
                'headline'      =>  '',
                'intro-text'    =>  '',
                'title'         =>  '',
                'description'   =>  '',
                'keywords'      =>  '',
                'noindex'       =>  0,
                'nofollow'      =>  0,
                'noarchive'     =>  0,
                'layout'        =>  'default',
            ));

            update_option($post_type_slug.'archive_settings',$data);
        }
        $options = $this->get_options_archive_cpt($post_type_slug);

        ?>
        <div id="seo_cpt" class="awe-settings">
        <form action="" method="POST">
        <h2><?php echo __( 'Archive Settings', self::LANG ); ?></h2>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row"><label for="meta-headline"><?php _e('Headline',self::LANG);?></label></th>
                <td><input name="awe-meta-data[headline]" id="meta-headline" type="text" value="<?php echo esc_attr( $options['headline'] ); ?>" size="40" />
                    <p class="description"><?php _e('Leave empty if you do not want to display a headline.',self::LANG);?></p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><label for="meta-intro-text"><?php _e('Intro Text',self::LANG);?></label></th>
                <td>
                    <textarea name="awe-meta-data[intro-text]" id="meta-intro-text" rows="5" cols="50" class="large-text"><?php echo esc_textarea( $options['intro-text'] ); ?></textarea>
                    <p class="description"><?php _e('Leave empty if you do not want to display any intro text.',self::LANG);?></p>
                </td>
            </tr>
        </table>
        <h2><?php echo __( 'SEO Settings', self::LANG ); ?></h2>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row"><label for="meta-title"><?php _e('Title',self::LANG);?></label></th>
                <td><input name="awe-meta-data[title]" id="meta-title" type="text" value="<?php echo esc_attr( $options['title'] ); ?>" size="40" />
                    <p class="description"><?php _e('For Google, this length is usually between 50-60 characters, or 512 pixels wide',self::LANG);?></p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><label for="meta-description"><?php _e('Description',self::LANG);?></label></th>
                <td>
                    <textarea name="awe-meta-data[description]" id="meta-description" rows="5" cols="50" class="large-text"><?php echo esc_textarea( $options['description'] ); ?></textarea>
                    <p class="description"><?php _e('Meta descriptions can be any length, but search engines generally truncate snippets longer than 160 characters. It is best to keep meta descriptions between 150 and 160 characters.',self::LANG);?></p>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row"><label for="meta-keywords"><?php _e('Keywords',self::LANG);?></label></th>
                <td><input name="awe-meta-data[keywords]" id="meta-keywords" type="text" value="<?php echo esc_attr( $options['keywords'] ); ?>" size="40"  />
                    <p class="description"><?php _e('Leave empty if you do not want to display any intro text.',self::LANG);?></p></td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><?php _e( 'Robots Meta', self::LANG ); ?></th>
                <td>
                    <label for="meta-noindex">
                        <input name="awe-meta-data[noindex]" id="meta-noindex" type="checkbox" value="1" <?php checked( $options['noindex'] ); ?> />
                        <?php _e( "Apply <code>&lt;noindex&gt;</code> to this archive?", self::LANG ); ?>
                    </label><br />

                    <label for="meta-nofollow"><input name="awe-meta-data[nofollow]" id="meta-nofollow" type="checkbox" value="1" <?php checked( $options['nofollow'] ); ?> />
                        <?php _e( "Apply <code>&lt;noindex&gt;</code> to this archive?", self::LANG ); ?>
                    </label><br />

                    <label for="meta-noarchive"><input name="awe-meta-data[noarchive]" id="meta-noarchive" type="checkbox" value="1" <?php checked( $options['noarchive'] ); ?> />
                        <?php _e( "Apply <code>&lt;noarchive&gt;</code> to this archive?'",  self::LANG ); ?>
                    </label>
                </td>
            </tr>
        </table>
            <h2><?php echo __( 'Layout Settings', self::LANG ); ?></h2>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row"><?php _e('Choose Layout',self::LANG);?></th>
                <td>
                    <p>
                        <input type="radio" <?php checked($options['layout'],"default");?> value="default" id="awe-meta-default-layout" class="awe-meta-default-layout">
                        <label for="awe-meta-default-layout" class="default"><?php _e('Default Layout set in Theme Settings',self::LANG);?></label>
                    <p>
                    <div class="md-layout-choose">
                        <ul class="clearfix">

                            <?php foreach($this->theme_layout_options as $layout):;?>
                                <li data-name="<?php echo $layout;?>" <?php if($options['layout']==$layout):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/layout/<?php echo $layout;?>.png" alt=""></a></li>

                            <?php endforeach;?>


                            <input type="hidden" value="<?php echo $options['layout'];?>" name="awe-meta-data[layout]" >
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
            <input type="submit" name="save_awe_meta_data" class="button button-primary">
        </form>
        </div>
        <script>
            (function($){
                $(window).load(function(){
                    $(".md-layout-choose li").on("click",function(e){
                        // e.preventDefault();
                        $(".md-layout-choose li.chosen").removeClass('chosen');
                        $(".awe-meta-default-layout").removeAttr('checked');
                        $(this).addClass('chosen');

                        $(this).parent().find("input[name='awe-meta-data[layout]']").val($(this).attr("data-name"));
                        return false;
                    });
                    $(".awe-meta-default-layout").on("click",function(e){
                        $(".md-layout-choose li.chosen").removeClass('chosen');
                        $("input[name='awe-meta-data[layout]']").val("default");
                    });
                });
            })(jQuery);
        </script>
        <?php
    }



}

?>