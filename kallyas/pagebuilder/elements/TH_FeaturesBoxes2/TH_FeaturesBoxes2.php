<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Features Boxes 2
 Description: Create and display a Features Boxes 2 element
 Class: TH_FeaturesBoxes2
 Category: content
 Level: 3
 Legacy: true
*/
/**
 * Class TH_FeaturesBoxes2
 *
 * Create and display a Features Boxes 2 element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_FeaturesBoxes2 extends ZnElements
{
    public static function getName(){
        return __( "Features Boxes 2", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {
        $options = $this->data['options'];


        echo '<div class="features_boxes_2">';
            echo '<div class="row">';
            if (isset($options['fb_title']) && ! empty ( $options['fb_title'] ) ) {
                echo '<div class="features_boxes_title clearfix">';
                echo '<div class="col-sm-12">';
                echo '<h4 class="zn_features_boxes-title zn_features_boxes-title--ext text-custom"><span class="zn_features_boxes-title-sp">' . $options['fb_title'] . '</span></h4>';
                echo '</div>';
                echo '</div>';
            }
            if(isset($options['features_single2'])) {
                if (!empty ($options['features_single2']) && is_array($options['features_single2'])) {
                    echo '<div class="feature_boxes_list clearfix">';
                    foreach ($options['features_single2'] as $feat) {
                        echo '<div class="col-sm-6 col-lg-3 feature_box style3">';
                        echo '<div class="box">';
                        echo '<h4 class="title text-custom">' . $feat['fb_single_title'] . '</h4>';

                        // Check which icon type was selected
                        if( empty( $feat['fb_single_icon_type'] ) ){
                            echo '<span class="icon ' . $feat['fb_single_icon'] . '"></span>';
                        }
                        else{
                            if( is_array( $feat['fb_single_icon_font'] ) && !empty( $feat['fb_single_icon_font']['unicode'] ) ){
                                echo '<span class="fb_icon_font" '. zn_generate_icon( $feat['fb_single_icon_font'] ) .'></span>';
                            }
                        }

                        echo '<p>' . $feat['fb_single_desc'] . '</p>';
                        echo '</div><!-- end box -->';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
            echo '</div>';
        echo '</div>';
    }

    /**
     * This method is used to retrieve the configurable options of the element.
     * @return array The list of options that compose the element and then passed as the argument for the render() function
     */
    function options()
    {
        $extra_options = array (
            "name"           => __( "Features Boxes", 'zn_framework' ),
            "description"    => __( "Here you can create your desired features boxes.", 'zn_framework' ),
            "id"             => "features_single2",
            "std"            => "",
            "type"           => "group",
            "add_text"       => __( "Feature box", 'zn_framework' ),
            "remove_text"    => __( "Feature box", 'zn_framework' ),
            "group_sortable" => true,
            "element_title" => "fb_single_title",
            "subelements"    => array (
                array (
                    "name"        => __( "Feature title", 'zn_framework' ),
                    "description" => __( "Please enter a title for this feature box.", 'zn_framework' ),
                    "id"          => "fb_single_title",
                    "std"         => "",
                    "type"        => "text"
                ),
                array (
                    "name"        => __( "Feature description", 'zn_framework' ),
                    "description" => __( "Please enter a description for this feature
                                            box.", 'zn_framework' ),
                    "id"          => "fb_single_desc",
                    "std"         => "",
                    "type"        => "textarea"
                ),
                array (
                    "name"        => __( "Icon Type", 'zn_framework' ),
                    "description" => __( "Choose the icon type you want to use.", 'zn_framework' ),
                    "id"          => "fb_single_icon_type",
                    "std"         => "",
                    "options"     => array (
                        '' => __( 'Image icon', 'zn_framework' ),
                        'font_icon' => __( 'Font icon', 'zn_framework' ),
                    ),
                    "type"        => "select",
                ),
                array (
                    "name"        => __( "Select Icon", 'zn_framework' ),
                    "description" => __( "Select an icon to display.", 'zn_framework' ),
                    "id"          => "fb_single_icon_font",
                    "std"         => "",
                    "type"        => "icon_list",
                    'class'       => 'zn_full',
                    "dependency"  => array( 'element' => 'fb_single_icon_type' , 'value'=> array('font_icon') ),
                ),
                array (
                    "name"        => __( "Feature icon", 'zn_framework' ),
                    "description" => __( "Please select the desired icon to use.", 'zn_framework' ),
                    "id"          => "fb_single_icon",
                    "std"         => "ico1",
                    "options"     => array (
                        'ico1' => __( 'Chat', 'zn_framework' ),
                        'ico2' => __( 'Document', 'zn_framework' ),
                        'ico3' => __( 'Paint', 'zn_framework' ),
                        'ico4' => __( 'Code', 'zn_framework' )
                    ),
                    "type"        => "select",
                    'dependency' => array( 'element' => 'fb_single_icon_type', 'value'=>array('') )
                ),
            )
        );
        return array (
                array(
                    "name"        => __( '<strong style="font-size:120%">Warning!</strong>', 'zn_framework' ),
                    "description" => __( 'Since v4.x, <strong>this element is <em>deprecated</em> & <em>unsuported</em></strong>. It\'s not recommended to be used bucause at some point it\'ll be removed (now it\'s kept only for backwards compatibilty).<br> Instead, try to use the element <strong>IconBox</strong>.', 'zn_framework' ),
                    'type'  => 'zn_message',
                    'id'    => 'zn_error_notice',
                    'show_blank'  => 'true',
                    'supports'  => 'warning'
                ),
                array (
                    "name"        => __( "Title", 'zn_framework' ),
                    "description" => __( "Enter a title for your Features element", 'zn_framework' ),
                    "id"          => "fb_title",
                    "std"         => "",
                    "type"        => "text",
                ),
                $extra_options,
        );
    }
}
