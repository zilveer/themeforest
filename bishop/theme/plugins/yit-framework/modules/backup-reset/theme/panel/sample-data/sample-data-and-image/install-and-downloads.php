<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Sample Data > Download sample image > Sample Image
 *
 * @package Yithemes
 * @author  Antonio La Rocca <antonio.larocca@yithemes.it>
 * @author  Andrea Grillo    <andrea.grillo@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */

$skins_list = class_exists ( 'YIT_Skins' ) ? YIT_Registry::get_instance()->skins->get_skins_list() : false;
$has_skins  = ! empty( $skins_list ) ? true : false;

return array(

    /* Sample Data > Download sample image > Sample Image and Backgrounds */

    array(
        'type'         => 'sampledata',
        'title'        => __( 'Install Sample Data', 'yit' ),
        'desc'         => __( '<strong>Warning: You must import the sample data file before customizing your theme.</strong>
                               <br/><br/>
                               If you customize your theme, and later import a sample data file, all current contents entered in your site will be overwritten
                               to the default settings of the file you are uploading! Please proceed with the utmost care, <strong>after exporting all current data!</strong>
                               <br/><br/>
                               <strong>Note:</strong> If you get errors, please be sure that your server can use the PHP function set_time_limit() before opening a ticket in our support platform.', 'yit' ),
        'button_label' => __( 'Import Data', 'yit' ),
        'default_data' => $has_skins ? $skins_list['default']['data'] : YIT_DEFAULT_DUMMY_DATA,
        'action'       => 'install-sampledata',
        'has_skins'    => $has_skins,
        'options'      => $skins_list,
        'sample_data'  => true
    ),

    array(
        'type'       => 'link',
        'title'      => __( 'Download Sample Images', 'yit' ),
        'desc'       => __( '<p>Sample images must be used in combination with sample data.</p>
                   <p>Once you\'ve downloaded the zip file, you simply need the following steps to import the images:</p>
                   <ol>
                   <li>Extract the zip package in your computer.</li>
                   <li>Upload it into the wp-content folder via FTP.</li>
                   </ol>
                   Some images will not be available because they are <strong>protected by copyright</strong>, as explained in the 11th paragraph of our <a href="http://yithemes.com/terms-and-conditions/" target="_blank">Terms & Conditions</a>.
                   ', 'yit' ),
        'link_name'  => __( 'Download Sample Images', 'yit' ),
        'link_href'  => YIT_DEFAULT_DUMMY_DATA_IMAGES,
        'link_class' => 'multi_link',
        'multi'      => $has_skins,
        'options'    => $skins_list,
    ),

    /* Sample Data > Download sample image > Custom Background and Backgrounds */
    array(
        'type'      => 'link',
        'title'     => __( 'Download Custom Background', 'yit' ),
        'desc'      => __( '<p>Here you are some free backgrounds you can use in your site.
                            To use the custom backgrounds, you can manually upload them from:
                            Theme-Name &#8594; Theme Options &#8594; Typography and Color &#8594; General &#8594; Background and Colors</p>', 'yit' ),
        'link_name' => __( 'Download Background Images', 'yit' ),
        'link_href' => YIT_CUSTOM_BACKGROUNDS
    )

);