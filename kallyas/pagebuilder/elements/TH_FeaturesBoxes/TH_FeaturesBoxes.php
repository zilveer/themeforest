<?php if(! defined('ABSPATH')){ return; }
/*
 Name: Features Boxes
 Description: Create and display a Features Boxes element
 Class: TH_FeaturesBoxes
 Category: content
 Level: 3
 Legacy: true
*/
/**
 * Class TH_FeaturesBoxes
 *
 * Create and display a Features Boxes element
 *
 * @package  Kallyas
 * @category Page Builder
 * @author   Team Hogash
 * @since    3.8.0
 */
class TH_FeaturesBoxes extends ZnElements
{
    public static function getName(){
        return __( "Features Boxes", 'zn_framework' );
    }

    /**
     * This method is used to display the output of the element.
     * @return void
     */
    function element()
    {

        $GLOBALS['options'] = array(
            'featuresBoxes' => $this->data['options']
        );
        include( 'inc/ui.inc.php' );
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
            "id"             => "features_single",
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
                    "name"        => __( "Feature icon", 'zn_framework' ),
                    "description" => __( "Please choose an icon for this feature box.
                                            Please note that for best design , your icon should be 20x20 in size.", 'zn_framework' ),
                    "id"          => "fb_single_icon",
                    "std"         => "",
                    "type"        => "media"
                )
            )
        );
        return  array (
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
                array (
                    "name"        => __( "Secondary title", 'zn_framework' ),
                    "description" => __( "Enter a secondary title for your Features Element.
                                        Please note that this description will only appear if you choose to use the style 2.", 'zn_framework' ),
                    "id"          => "fb_stitle",
                    "std"         => "",
                    "type"        => "text",
                ),
                array (
                    "name"        => __( "Description ", 'zn_framework' ),
                    "description" => __( "Enter a description for your Features Element.
                                        Please note that this description will only appear if you choose to use the style 2.", 'zn_framework' ),
                    "id"          => "fb_desc",
                    "std"         => "",
                    "type"        => "visual_editor",
                    'class'       => 'zn_full',
                ),
                array (
                    "name"        => __( "Features Box Style", 'zn_framework' ),
                    "description" => __( "Please select the style you want to use.", 'zn_framework' ),
                    "id"          => "fb_style",
                    "std"         => "style1",
                    "options"     => array (
                        'style1' => __( 'Style 1', 'zn_framework' ),
                        'style2' => __( 'Style 2', 'zn_framework' ),
                        'style3' => __( 'Style 3', 'zn_framework' ),
                    ),
                    "type"        => "select",
                ),
                array (
                    "name"        => __( "Features Box Columns", 'zn_framework' ),
                    "description" => __( "Please select the desired number of columns to use.", 'zn_framework' ),
                    "id"          => "fb_columns",
                    "std"         => "col-lg-6",
                    "options"     => array (
                        'col-lg-12' => __( '1 Column', 'zn_framework' ),
                        'col-lg-6' => __( '2 Columns', 'zn_framework' ),
                        'col-lg-4' => __( '3 Columns', 'zn_framework' ),
                        'col-lg-3' => __( '4 Columns', 'zn_framework' ),
                    ),
                    "type"        => "select",
                ),
                $extra_options,
        );
    }
}
