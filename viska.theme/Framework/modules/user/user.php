<?php
/**
 * Created by JetBrains PhpStorm.
 * User: duongle
 * Date: 3/22/14
 * Time: 4:45 PM
 * To change this template use File | Settings | File Templates.
 */

Class AWEUserPro extends AweFramework
{

    public $user_options = array();
    public $theme_layout_options;
    public function __construct()
    {
        $this->theme_layout_options = apply_filters('awe_layout_options',array('LM','MR','LMR','MRR','None'));
        //register admin menu
//        add_action('admin_menu',                        array($this,'register_user_profile_menu' ));
        //register global notice
        add_action('admin_notices',                         array(&$this, 'display_global_messages'),                9999);

        //add social field to user contact
        add_filter( 'user_contactmethods',                  array($this, 'social_field'));
        //add rel="author" link tag
        add_action( 'wp_head',                              array($this, 'rel_author'),                      9);
        //hook in the additional user profile fields
        add_action( 'admin_init',                           array($this, 'add_fields'));
        //save user meta data
        add_action( 'personal_options_update',              array($this,'save_user_meta') );
        add_action( 'edit_user_profile_update',             array($this,'save_user_meta') );

    }


    public function register_user_profile_menu(){
        add_submenu_page( 'AWE-Framework', 'User Profile Settings', 'User Profile', 'manage_options', 'AWE-UserPro', array($this,'user_profile_settings') );

    }



    /**
     * Add social fields to user
     * @param array $contactmethods Array of contact methods
     *
     * @return array
     */
    public function social_field( array $contactmethods ) {

        $contactmethods['googleplus']   = __( 'Google Plus', self::LANG );
        $contactmethods['facebook']     = __( 'Facebook', self::LANG );
        $contactmethods['twitter']      = __( 'Twitter', self::LANG );
        $contactmethods['linkedin']     = __( 'Linkedin', self::LANG );
        $contactmethods['github']       = __( 'Github', self::LANG );
        $contactmethods['tumblr']       = __( 'Tumblr', self::LANG );
        $contactmethods['youtube']      = __( 'Youtube', self::LANG );
        $contactmethods['vimeo']        = __( 'Vimeo', self::LANG );
        return $contactmethods;

    }

    /**
     * Echo custom rel="author' link tag
     *
     * @global WP_Post $post Post object
     * @retun null
     */
    public function rel_author() {

        global $post;

        if ( is_singular() && post_type_supports( $post->post_type, 'awe-rel-author' ) && isset( $post->post_author ) && $gplus_url = get_user_option( 'googleplus', $post->post_author ) ) {
            printf( '<link rel="author" href="%s" />' . "\n", esc_url( $gplus_url ) );
            return;
        }

        if ( is_author() && get_query_var( 'author' ) && $gplus_url = get_user_option( 'googleplus', get_query_var( 'author' ) ) ) {
            printf( '<link rel="author" href="%s" />' . "\n", esc_url( $gplus_url ) );
            return;
        }

    }


    /**
     * Hook in the additional user profile fields
     */
    public function add_fields()
    {
        add_action( 'show_user_profile',    array($this,'archive_fields') );
        add_action( 'edit_user_profile',    array($this,'archive_fields') );
        add_action( 'show_user_profile',    array($this,'seo_fields') );
        add_action( 'edit_user_profile',    array($this,'seo_fields') );
        add_action( 'show_user_profile',    array($this,'layout_fields') );
        add_action( 'edit_user_profile',    array($this,'layout_fields') );
    }

    /**
     * Add archive options to user edit screen
     * @param $user
     *
     * @return bool
     */
    public function archive_fields($user)
    {
        if ( ! current_user_can( 'edit_users', $user->ID ) )
            return false;
        ?>
        <h2><?php _e( 'Author Archive Settings', self::LANG ); ?></h2>
        <p><span class="description"><?php _e( 'Apply to this author\'s archive pages.', self::LANG ); ?></span></p>
        <table class="form-table">
            <tr>
                <th scope="row" valign="top"><label for="headline"><?php _e( 'Archive Headline', self::LANG ); ?></label></th>
                <td>
                    <input name="awe-meta-data[headline]" id="headline" type="text" value="<?php echo esc_attr( get_the_author_meta( 'headline', $user->ID ) ); ?>" class="regular-text" /><br />
                </td>
            </tr>

            <tr>
                <th scope="row" valign="top"><label for="intro_text"><?php _e( 'Description Text', self::LANG ); ?></label></th>
                <td>
                    <textarea name="awe-meta-data[intro_text]" id="intro_text" rows="5" cols="30"><?php echo esc_textarea( get_the_author_meta( 'intro_text', $user->ID ) ); ?></textarea><br />
                </td>
            </tr>
        </table>
        <?php

    }

    /**
     * Add seo options to user edit screen
     * @param $user
     *
     * @return bool
     */
    public function seo_fields($user)
    {
        if ( ! current_user_can( 'edit_users', $user->ID ) )
            return false;
        ?>
        <h2><?php _e( 'SEO Settings',self::LANG ); ?></h2>
        <table class="form-table">
            <tr>
                <th scope="row" valign="top"><label for="meta-title"><?php _e( 'Document Title', self::LANG ); ?></label></th>
                <td>
                    <input name="awe-meta-data[meta_title]" id="meta-title" type="text" value="<?php echo esc_attr( get_the_author_meta( 'meta_title', $user->ID ) ); ?>" class="regular-text" />
                </td>
            </tr>

            <tr>
                <th scope="row" valign="top"><label for="meta-description"><?php _e( 'Meta Description', self::LANG ); ?></label></th>
                <td>
                    <textarea name="awe-meta-data[meta_description]" id="meta-description" rows="5" cols="30"><?php echo esc_textarea( get_the_author_meta( 'meta_description', $user->ID ) ); ?></textarea>
                </td>
            </tr>

            <tr>
                <th scope="row" valign="top"><label for="meta-keywords"><?php _e( 'Meta Keywords', self::LANG ); ?></label></th>
                <td>
                    <input name="awe-meta-data[meta_keywords]" id="meta-keywords" type="text" value="<?php echo esc_attr( get_the_author_meta( 'meta_keywords', $user->ID ) ); ?>" class="regular-text" /><br />
                    <span class="description"><?php _e( 'Comma separated list', self::LANG ); ?></span>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top"><?php _e( 'Robots Meta', self::LANG ); ?></th>
                <td>
                    <label for="meta-noindex">
                        <input name="awe-meta-data[noindex]" id="meta-noindex" type="checkbox" value="1" <?php checked( get_the_author_meta( 'noindex', $user->ID ) ); ?> />
                        <?php _e( "Apply <code>&lt;noindex&gt;</code> to this archive?", self::LANG ); ?>
                    </label><br />

                    <label for="meta-nofollow"><input name="awe-meta-data[nofollow]" id="meta-nofollow" type="checkbox" value="1" <?php checked( get_the_author_meta( 'nofollow', $user->ID ) ); ?> />
                        <?php _e( "Apply <code>&lt;noindex&gt;</code> to this archive?", self::LANG ); ?>
                    </label><br />

                    <label for="meta-noarchive"><input name="awe-meta-data[noarchive]" id="meta-noarchive" type="checkbox" value="1" <?php checked( get_the_author_meta( 'noarchive', $user->ID ) ); ?> />
                        <?php _e( "Apply <code>&lt;noarchive&gt;</code> to this archive?'",  self::LANG ); ?>
                    </label>
                </td>
            </tr>

        </table>
        <?php
    }

    /**
     * Add layout option to user edit screen
     * @param WP_User $user Object
     *
     * @return bool
     */
    public function layout_fields($user)
    {
        if ( ! current_user_can( 'edit_users', $user->ID ) )
            return false;

        $layout = get_the_author_meta( 'layout', $user->ID );
        $layout = $layout ? $layout : 'default';
        ?>
        <h2><?php _e( 'Author Layout Settings', self::LANG ); ?></h2>
        <table class="form-table">
            <tr class="form-field">
                <th scope="row"><?php _e('Choose Layout',self::LANG);?></th>
                <td>
                    <p>
                        <input type="radio" <?php checked($layout,"default");?> value="default" id="awe-meta-default-layout" class="awe-meta-default-layout">
                        <label for="awe-meta-default-layout" class="default"><?php _e('Default Layout set in Theme Settings',self::LANG);?></label>
                    <p>
                    <div class="md-layout-choose">
                        <ul class="clearfix">
                            <?php foreach($this->theme_layout_options as $l):;?>
                                <li data-name="<?php echo $l;?>" <?php if($l==$layout):?>class="chosen"<?php endif;?>><a href="#"><img src="<?php echo AWE_ROOT_URL;?>asset/images/layout/<?php echo $l;?>.png" alt=""></a></li>

                            <?php endforeach;?>

                            <input type="hidden" value="<?php $layout;?>" name="awe-meta-data[layout]" >
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
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


    /**
     * Update user meta
     * @param int $user_id User ID
     */
    public function save_user_meta($user_id)
    {
        if ( ! current_user_can( 'edit_users', $user_id ) )
            return;

        if ( ! isset( $_POST['awe-meta-data'] ) || ! is_array( $_POST['awe-meta-data'] ) )
            return;

        $meta = wp_parse_args($_POST['awe-meta-data'],
            array(
                'headline'                   => '',
                'intro_text'                 => '',
                'meta_title'                 => '',
                'meta_description'           => '',
                'meta_keywords'              => '',
                'noindex'                    => 0,
                'nofollow'                   => 0,
                'noarchive'                  => 0,
                'layout'                     => 'default',
            )
        );
        foreach ( $meta as $key => $value )
            update_user_meta( $user_id, $key, $value );
    }



}