<?php



/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', '_custom_theme_options', 1 );


/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function _custom_theme_options() {

  global $layers;
  /**
   * Get a copy of the saved settings array.
   */
  $saved_settings = get_option( 'option_tree_settings', array() );

  $current_sliders = get_option( 'cp_sliders');

// Iterate over the sliders
  if($current_sliders) {
    foreach($current_sliders as $key => $item) {
      $cpsliders[] = array(
        'label' => $item->name,
        'value' => $item->slug
        );
    }
  } else {
    $cpsliders[] = array(
      'label' => 'No Sliders Found',
      'value' => ''
      );
  }
  /**
   * Create a custom settings array that we pass to
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array(
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
          )
        ),
      'sidebar'       => '<p>Sidebar content goes here!</p>'
      ),
    'sections'        => array(
      array(
        'title'       => 'Slider',
        'id'          => 'slider'
        ),
      array(
        'title'       => 'Header',
        'id'          => 'header'
        ),
      array(
        'title'       => 'General',
        'id'          => 'general_default'
        ),

      array(
        'title'       => 'Blog options',
        'id'          => 'blog'
        ),
      array(
        'title'       => 'Recipe options',
        'id'          => 'recipe'
        ),

      array(
        'id'          => 'typography',
        'title'       => 'Typography'
        ),
   /*   array(
        'id'          => 'twitter',
        'title'       => 'Twitter OAuth'
        ),*/
      array(
        'id'          => 'sidebars',
        'title'       => 'Sidebars'
        ),
/*      array(
        'id'          => 'update',
        'title'       => 'Update'
        )*/
      ),
    'settings'        => array(
      array(
        'label'       => 'Enable slider',
        'id'          => 'pp_slider_on',
        'type'        => 'on_off',
        'desc'        => 'Show slider on homepage',
        'std'         => 'off',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider'
        ),
      array(
        'label'       => 'Select slider',
        'id'          => 'pp_slider_select',
        'type'        => 'select',
        'desc'        => 'Select slider',
        'choices'     => $cpsliders,
        'std'         => 'true',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'slider'
        ),


      array(
        'label'       => 'Upload logo',
        'id'          => 'pp_logo_upload',
        'type'        => 'upload',
        'desc'        => 'For best effect logo image should be transparent png, logo from live preview has 114x24px but you can use bigger, you will probably need to adjust some margins using options below ',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header'
        ),

      array(
        'label'       => 'Logo top margin',
        'id'          => 'pp_logo_top_margin',
        'type'        => 'measurement',
        'desc'        => 'Set top margin for logo image',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header'
        ),

      array(
        'label'       => 'Logo bottom margin',
        'id'          => 'pp_logo_bottom_margin',
        'type'        => 'measurement',
        'desc'        => 'Set bottom margin for logo image',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header'
        ),

      array(
        'label'       => 'Menu top margin',
        'id'          => 'pp_menu_top_margin',
        'type'        => 'measurement',
        'desc'        => 'Use it if you want to center menu according to logo height',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header'
        ),

      array(
        'label'       => 'Favicon ',
        'id'          => 'pp_favicon_upload',
        'type'        => 'upload',
        'desc'        => 'Upload favicon here (16x16)',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'header'
        ),

      array(
        'label'       => 'Flexslider slideshow speed (in milliseconds)',
        'id'          => 'pp_flex_slideshowspeed',
        'type'        => 'numeric-slider',
        'min_max_step'=> '1000,20000,500',
        'desc'        => 'This setting is global, it will affect all sliders. Be sure to put here only number!.',
        'std'         => '7000',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
        ),
      array(
        'label'       => 'Flexslider animation speed (in milliseconds)',
        'id'          => 'pp_flex_animationspeed',
        'type'        => 'numeric-slider',
        'min_max_step'=> '100,2000,100',
        'desc'        => 'This setting is global, it will affect all sliders. Be sure to put here only number!.',
        'std'         => '600',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
        ),
      array(
        'label'       => 'Flexslider animation type',
        'id'          => 'pp_flex_animationtype',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
          array(
            'label'       => 'Fade',
            'value'       => 'fade'
            ),
          array(
            'label'       => 'Slide',
            'value'       => 'slide'
            )
          ),
        'std'         => 'fade',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'portfolio'
        ),

      array(
        'label'       => 'Copyrights text',
        'id'          => 'pp_copyrights',
        'type'        => 'text',
        'desc'        => 'Text in footer',
        'std'         => '&copy; Theme by <a href="http://themeforest.net/user/purethemes/portfolio?ref=purethemes">Purethemes.net</a>. All Rights Reserved.',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
        ),
      array(
        'label'       => 'Comments on pages',
        'id'          => 'pp_page_comments_on',
        'type'        => 'on_off',
        'desc'        => 'Disable/enable comments form on all pages',
        'std'         => 'on',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'general_default'
        ),

      array(
        'label'       => 'Disable Social scripts in page',
        'id'          => 'pp_scripts_status',
        'type'        => 'checkbox',
        'desc'        => 'Theme adds some Facebook and pinterest scripts for the CookingPress Social Widget, however, if you want to use any other plugin that uses Facebook or Pinterest, it may cause conflict. In that case, you can disable it here',
        'choices'     => array(
          array (
            'label'       => 'Facebook',
            'value'       => 'fb'
            ),
          array (
            'label'       => 'Pinterest',
            'value'       => 'pin'
            ),
          ),
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => '',
      'section'     => 'general_default'
      ),

      array(
        'label'       => 'Blog layout',
        'id'          => 'pp_blog_layout',
        'type'        => 'radio-image',
        'desc'        => 'Choose sidebar side on blog.',
        'std'         => 'left-sidebar',
        'rows'        => '',
        'post_type'   => '',
        'choices'     => array(
          array(
            'value'   => 'left-sidebar',
            'label'   => 'Left Sidebar',
            'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
            ),
          array(
            'value'   => 'right-sidebar',
            'label'   => 'Right Sidebar',
            'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
            )
          ),
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog'
        ),
      array(
        'label'       => 'Blog posts style',
        'id'          => 'pp_blog_style',
        'type'        => 'select',
        'desc'        => '',
        'choices'     => array(
          array(
            'label'       => 'Thumbnails Grid',
            'value'       => 'grid'
            ),
          array(
            'label'       => 'excerpt one column list',
            'value'       => 'excerpt'
            ),
          array(
            'label'       => 'Full posts list',
            'value'       => 'full'
            )
          ),
        'std'         => 'grid',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog'
        ),
      array(
        'label'       => 'Post meta informations on single post view',
        'id'          => 'pp_meta_single',
        'type'        => 'checkbox',
        'desc'        => 'Set which elements of posts meta data you want to display.',
        'choices'     => array(
          array (
            'label'       => 'Comments',
            'value'       => 'com'
            ),
          array (
            'label'       => 'Author',
            'value'       => 'author'
            ),
          array (
            'label'       => 'Time needed',
            'value'       => 'time'
            ),
          array (
            'label'       => 'Servings',
            'value'       => 'servings'
            ),
          array (
            'label'       => 'Recipe difficulty level',
            'value'       => 'level'
            ),
          array (
            'label'       => 'Allergens',
            'value'       => 'allergens'
            ),
          array (
            'label'       => 'Date',
            'value'       => 'date'
            ),
          array (
            'label'       => 'Tags',
            'value'       => 'tags'
            ),
          array (
            'label'       => 'Categories',
            'value'       => 'cat'
            ),

          ),
      'std'         => '',
      'rows'        => '',
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => '',
      'section'     => 'blog'
      ),

      array(
        'label'       => 'Post meta informations on blog and archive pages',
        'id'          => 'pp_meta_blog',
        'type'        => 'checkbox',
        'desc'        => 'Set which elements of posts meta data you want to display.',
        'choices'     => array(
          array (
            'label'       => 'Comments',
            'value'       => 'com'
            ),
          array (
            'label'       => 'Author',
            'value'       => 'author'
            ),
          array (
            'label'       => 'Time needed',
            'value'       => 'time'
            ),
          array (
            'label'       => 'Servings',
            'value'       => 'servings'
            ),
          array (
            'label'       => 'Recipe difficulty level',
            'value'       => 'level'
            ),
          array (
            'label'       => 'Allergens',
            'value'       => 'allergens'
            ),


          array (
            'label'       => 'Date',
            'value'       => 'date'
            ),
          array (
            'label'       => 'Tags',
            'value'       => 'tags'
            ),
          array (
            'label'       => 'Categories',
            'value'       => 'cat'
            )
          ),
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'blog'
        ),

      array(
        'label'       => 'Recipe search form elements',
        'id'          => 'pp_search_elements',
        'type'        => 'checkbox',
        'desc'        => 'Choose which elements to show on advanced search form.',
        'choices'     => array(
          array (
            'label'       => 'Category',
            'value'       => 'category'
            ),
          array (
            'label'       => 'Level',
            'value'       => 'level'
            ),
          array (
            'label'       => 'Serving',
            'value'       => 'serving'
            ),
          array (
            'label'       => 'Time needed',
            'value'       => 'timeneeded'
            ),
          array (
            'label'       => 'Allergens',
            'value'       => 'allergens'
            )
          ),
        'std'         => array( 1,1,1,1,1),
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'recipe'
        ),

      array(
        'id'          => 'add_recipe_content',
        'label'       => 'Content textarea in Recipe Submit form',
        'desc'        => '',
        'std'         => 'off',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_category',
        'label'       => 'Category select in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_summary',
        'label'       => 'Summary textarea in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_addinfo',
        'label'       => 'Additional informations in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_nutritionfacts',
        'label'       => 'Nutrition facts in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_serving',
        'label'       => 'Serving select in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_timeneeded',
        'label'       => 'Time needed select in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_allergens',
        'label'       => 'Allergens select in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_level',
        'label'       => 'Level select in Recipe Submit form',
        'desc'        => '',
        'std'         => 'on',
        'type'        => 'on_off',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_success',
        'label'       => 'Success message in Recipe Submit form',
        'desc'        => '',
        'std'         => 'Thank you for adding recipe! We will submit it after review!',
        'type'        => 'textarea',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_ingredient',
        'label'       => 'Ingredient error message in Recipe Submit form',
        'desc'        => '',
        'std'         => 'I\'m sure there should be at least one ingredient :) !',
        'type'        => 'textarea',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'id'          => 'add_recipe_instructions',
        'label'       => 'Instructions error in Recipe Submit form',
        'desc'        => '',
        'std'         => 'No instructions? How am I supposed to do this? :)',
        'type'        => 'textarea',
        'section'     => 'recipe',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),



      array(
        'id'          => 'sidebars_text',
        'label'       => 'About sidebars',
        'desc'        => 'All sidebars that you create here will appear both in the Appearance > Widgets, and then you can choose them for specific pages or posts.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'sidebars',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'label'       => 'Create Sidebars',
        'id'          => 'incr_sidebars',
        'type'        => 'list-item',
        'desc'        => 'Choose a unique title for each sidebar',
        'section'     => 'sidebars',
        'settings'    => array(
          array(
            'label'       => 'ID',
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => 'Write a lowercase single world as ID (it can\'t start with a number!), without any spaces',
            'std'         => '',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'class'       => ''
            )
          )
        ),
      array(
        'id'          => 'pp_custom_css',
        'label'       => 'Custom CSS',
        'desc'        => 'To prevent problems with theme update, write here any custom css (or use child themes)',
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'general_default',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),

array(
            'id'          => 'pp-fonts',
            'label'       => __( 'Google Fonts', 'cookingpress' ),
            'desc'        => '',
            'std'         => array( 
                array(
                    'family'    => 'Droid+Serif',
                    'variants'  => array( '400', '700', '400itailc', '700itailc' ),
                    'subsets'   => array( 'latin' )
                )
            ),
            'type'        => 'google-fonts',
            'section'     => 'typography',
            'rows'        => '',
            'post_type'   => '',
            'taxonomy'    => '',
            'min_max_step'=> '',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and'
        ),
        array(
          'label'       => 'Body Font',
          'id'          => 'cookingpress_body_font',
          'type'        => 'typography',
          'desc'        => '',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'typography'
          ),
        array(
          'label'       => 'Menu Font',
          'id'          => 'cookingpress_menu_font',
          'type'        => 'typography',
          'desc'        => '',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'typography'
          ),
        array(
          'label'       => 'Logo Font',
          'id'          => 'cookingpress_logo_font',
          'type'        => 'typography',
          'desc'        => '',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'typography'
          ),         
        array(
          'label'       => 'Tagline Font',
          'id'          => 'cookingpress_tagline_font',
          'type'        => 'typography',
          'desc'        => '',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'typography'
          ),     
        array(
          'label'       => 'Headers (h1..h6) Font',
          'id'          => 'cookingpress_headers_font',
          'type'        => 'typography',
          'desc'        => 'Size and related to it settings will be ignored here.',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'typography'
          ),
        array(
          'label'       => 'Slider Headers Font',
          'id'          => 'cookingpress_slider_font',
          'type'        => 'typography',
          'desc'        => '',
          'std'         => '',
          'rows'        => '',
          'post_type'   => '',
          'taxonomy'    => '',
          'class'       => '',
          'section'     => 'typography'
        ),


      array(
        'id'          => 'update_info',
        'label'       => 'About Update',
        'desc'        => 'Fill fields below to get notification about new version of theme. To get your API key go to ThemeForest - your profile -> Settings -> Api Keys and Generate API Key.',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'update',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'label'       => 'Your ThemeForest username',
        'id'          => 'pp_username',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'update'
        ),
      array(
        'label'       => 'Your ThemeForest API key',
        'id'          => 'pp_api_key',
        'type'        => 'text',
        'desc'        => 'To get your API key go to ThemeForest - your profile -> Settings -> Api Keys and Generate API Key.',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'update'
        ),
      array(
        'id'          => 'twitter_info',
        'label'       => 'Twitter OAuth keys',
        'desc'        => 'From March 2013 Twitter requires authentication to access your tweets. Here are fields you need to fill if you want to use Nevia Twitter Widgets. How to do it you can find in documentation and on https://dev.twitter.com .',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'twitter',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
        ),
      array(
        'label'       => 'Twitter Consumer Key',
        'id'          => 'pp_twitter_ck',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'twitter'
        ),
      array(
        'label'       => 'Twitter Consumer Secret',
        'id'          => 'pp_twitter_cs',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'twitter'
        ),
      array(
        'label'       => 'Twitter Access Token',
        'id'          => 'pp_twitter_at',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'twitter'
        ),
      array(
        'label'       => 'Twitter Access Token Secret',
        'id'          => 'pp_twitter_ts',
        'type'        => 'text',
        'desc'        => '',
        'std'         => '',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'twitter'
        ),
      )
);

if (function_exists('icl_get_languages')) {
  $languages = icl_get_languages('skip_missing=0&orderby=code');
  if(!empty($languages)){
    foreach($languages as $l){

     $custom_settings['settings'][]=
     array(
      'label'       => 'Revolution Slider for homepage in '.$l['native_name'].' language',
      'id'          => 'pp_revo_slider'.$l['language_code'],
      'type'        => 'select',
      'desc'        => '',
      'choices'     => $layers,
      'post_type'   => '',
      'taxonomy'    => '',
      'class'       => '',
      'section'     => 'slider'
      );
   }
 }
}
/* settings are not the same update the DB */
if ( $saved_settings !== $custom_settings ) {
  update_option( 'option_tree_settings', $custom_settings );
}

}
