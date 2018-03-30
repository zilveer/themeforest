<?php

/**
 * @author JaW Templates <http://www.jawtemplates.com>
 * @copyright (c) 2013, CCB, spol. s r.o.
 * @version 1.0
 * @todo check permition for dynamic file 
 */



/**
 * Stara verze nez jsme prepsal ratingManager, rikali jste ze to zaintegrujete
 * sami. Dal jsem sem celou moji tridu na tvorbu metaboxu, tak vam to nejspis
 * nemusi sedet.
 * 
 * Jinak vypisovani multi-ratingu je jako 2d pole:
 * 
 * <input type="rating-[jmeno ratingu v theme options][ name/id/score/voted]
 * 
 * 
 * 
 * 
 *
 */
class writepanelsManager {

    /**
     * @var writepanelsManager
     */
    private static $_instance = null;

    /**
     * @var fwWritepanelsDataPrinter
     */
    private $_metaboxPrinter = null;

    /**
     * @var fwWritepanelsDataStore
     */
    private $_postData = null;

    private function _fillPostData() {
        $data = new fwWritepanelsDataStore();

        $data->metaboxStart('Ratings Settings');
        //$data->addOption('multitext', 'fw_post_actionpanel_left', 'Action Bar - Text Left', 'Enter your desired text. Leave blank to use settings from higher tiers like Global, Site Settings, etc.', null);
        // Title of Rating
        $data->addOption('text', 'fw_rating_title', 'Rating Title', 'This is a label text of your ratings box. Fill in the field with your version.'.' ', null);


        $data->addOption('check', 'fw_rating_position', 'Show Rating', 'Tick the option if you want to show rating.'.' ', null);

        // Ratings field
        $data->addOption('rating', 'fw_rating', 'Rating Criteria', 'Add and name your (administrators) rating criteria. The first value is your own rating (insert a number from 0 to 1 with a decimal point), the second one is number of ratings. Users ratings values are filled automatically.'.' '. jwUtils::getHelp("rat_criteria"), null);

        $data->addOption(
                'check', 'fw_rating_show_desc', 'Show Rating Description', 'Tick the option if you want to show your description in the ratings box (to be filled in the following field).'.' ', null);
        $data->addOption(
                'textarea', 'fw_rating_desc', 'Rating Description', 'Fill in the field with text which you want to be displayed in the ratings box in case the option above is ticked.'.' ', null);

        $data->addOption(
                'check', 'fw_rating_overal', 'Overall Rating', 'Tick the option to show an overall rating.'.' ', null);
        /* v GoodStore nepouzivame
        * 
        $data->addOption(
                'select', 'fw_rating_overal_type', 'Overall Rating Type', 'Choose the overall rating type you prefer.'.' '. jwUtils::getHelp("rat_overall_type"), null, array(
            array(
                "id" => "stars",
                "name" => "Stars"
            ),
            array(
                "id" => "percent",
                "name" => "Percent"
            )
                )
        );*/

        $data->addOption('check', 'fw_rating_user_edit', 'Enable User Rating', 'Tick the option if you want to allow users to rate a post.'.' ', null);
        
        $data->addOption('check', 'fw_rating_user_count', 'Include User Rating in Total Ratings', 'Tick the option if user&acute;s rating has to be included in total ratings.', null);

        
        
        $data->metaboxEnd();

        $this->_postData = $data;
    }

    private function __construct() {
        $this->_setHooks();
    }

    private function _setHooks() {
        add_action('add_meta_boxes', array($this, 'addMetaBox'));
        add_action('save_post', array($this, 'saveCustomBox'));
    }

    public function addMetaBox() {
        wp_enqueue_style(time() + 555, get_template_directory_uri() . '/framework/lib/rating/metaboxOptionsStore/post_style.css');
        wp_enqueue_script(time() + 555, get_template_directory_uri() . '/framework/lib/rating/metaboxOptionsStore/script.js');

        $data = $this->_getPostData();
        $dmb = $data->data_metabox;
        foreach ($dmb as $id => $metabox) {

            foreach ($metabox as $name => $data2) {
                $pagetemplate = $data->getMetaboxPagetemplate($name);

                add_meta_box('fw_page_settings_' . $pagetemplate, $name, array($this, 'printMetaBox'), 'post', 'normal', 'low', array('name' => $name)); //, $context, $priority, $callback_args );
            }
        }
    }

    public function printMetaBox($post, $args) {
        $metaboxName = $args['args']['name'];
        $metaboxData = $this->_getPostData()->getMetaboxData($metaboxName);


        $this->_getMetaboxPrinter()->setData($metaboxData, $post->ID);
        $this->_getMetaboxPrinter()->printData();
    }

    public function saveCustomBox() {

        if ((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || !isset($_POST['fw_metabox_indicator']))
            return;

        global $post_id;
        $data = $this->_getPostData();


        foreach ($data->data_clean as $one_option) {
            $this->_saveOption($one_option, $post_id);
            /* 	
              if( !isset($_POST[ $one_option['id'] ]) && $one_option['type'] != 'check')
              continue;


              $value = $_POST[ $one_option['id'] ];

              if( $one_option['type'] == 'check' ) {

              if( $value == 'on' )
              $value = 1;
              else
              $value = 0;
              }

              if( $one_option['type'] == 'multitext' && !empty($_POST[$one_option['id']]) ) {

              delete_post_meta( $post_id, $one_option['id'] );
              foreach( $_POST[ $one_option['id'] ] as $id => $value ) {
              add_post_meta( $post_id, $one_option['id'], $value );
              }
              } else {
              update_post_meta( $post_id, $one_option['id'], $value );
              } */
        }
    }

    private function _saveOption($oneOption, $postId) {



        switch ($oneOption['type']) {
            case 'check':
                $this->_saveOptionCheck($oneOption, $postId);
                break;

            case 'multitext':
                $this->_saveOptionMultitext($oneOption, $postId);
                break;

            case 'rating':
                $this->_saveOptionRating($oneOption, $postId);
                break;

            case 'textarea':
                $this->_saveOptionTextarea($oneOption, $postId);
                break;

            default:
                $this->_saveOptionDefault($oneOption, $postId);
                break;
        }
    }

    private function _nameToId($name) {
        return preg_replace('/[^a-zA-Z0-9-]/', '', $name);
    }

    private function _saveOptionRating($oneOption, $postId) {

        delete_post_meta($postId, $oneOption['id']);
        $rm = ratingManager::getInstance();

        if (isset($_POST[$oneOption['id']])) {
            foreach ($_POST[$oneOption['id']] as $id => $value) {

                $name = $value['name'];
                $id = $this->_nameToId($name);
                $value['id'] = $id;
                $rating = new oneRating();
                $rating->id = $value['id'];
                $rating->name = $value['name'];
                $rating->score = $value['score'];
                $rating->voted = $value['voted'];

                if (isset($value['type'])) {
                    $rating->type = $value['type'];
                } else {
                    $rating->type = 'stars';
                }

                if (isset($value['useredit'])) {
                    $rating->useredit = $value['useredit'];
                } else {
                    $rating->useredit = '0';
                }
                $rm->setOneRating($postId, $rating);
                //add_post_meta( $postId, $oneOption['id'], $value );
            }
        }
    }

    private function _saveOptionDefault($oneOption, $postId) {
        $value = $_POST[$oneOption['id']];
        update_post_meta($postId, $oneOption['id'], $value);
    }

    private function _saveOptionMultitext() {
        
    }

    private function _saveOptionTextarea($oneOption, $postId) {
        if (isset($_POST[$oneOption['id']]))
            $value = $_POST[$oneOption['id']];
        update_post_meta($postId, $oneOption['id'], $value);
    }

    private function _saveOptionCheck($oneOption, $postId) {
        if (isset($_POST[$oneOption['id']]))
            $value = $_POST[$oneOption['id']];
        else
            $value = false;

        if ($value == 'on')
            $value = 1;
        else
            $value = 0;

        update_post_meta($postId, $oneOption['id'], $value);
    }

    /**
     * @return writepanelsManager
     */
    public static function getInstance() {
        if (self::$_instance == null) {
            self::$_instance = new writepanelsManager();
        }

        return self::$_instance;
    }

    /**
     * @return fwWritepanelsDataStore
     */
    private function _getPostData() {
        if ($this->_postData == null) {
            $this->_fillPostData();
        }

        return $this->_postData;
    }

    /**
     * @return fwWritepanelsDataPrinter
     */
    private function _getMetaboxPrinter() {
        if ($this->_metaboxPrinter == null) {
            $this->_metaboxPrinter = new fwWritepanelsDataPrinter();
        }

        return $this->_metaboxPrinter;
    }

}

writepanelsManager::getInstance();