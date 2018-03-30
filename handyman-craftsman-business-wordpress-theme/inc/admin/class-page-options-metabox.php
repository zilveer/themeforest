<?php
namespace Handyman\Admin\Metabox;

use Handyman\Core;
use Handyman\Core\Ui;


/**
 * Class AbstractMetaBox
 * @package Roots\Sage\Metaboxes
 */
class Page_Options_Metabox extends Abstract_Metabox
{

    /**
     * Metabox css classes
     *
     * @var
     */
    protected $mb_classes = array();


    /**
     * @param $class
     * @return $this
     */
    public function addClass($class)
    {
        $this->mb_classes[] = $class;
        return $this;
    }


    /**
     * @param $classes
     * @return array
     */
    public function addClassToMetabox($classes)
    {
        $classes[] = 'tl-metabox';
        $x = array_merge($classes, $this->mb_classes);
        return $x;
    }


    /**
     * Overwrites method from parent class
     *
     * @param $args
     */
    public function renderForm($args)
    {
        global $post;
        $fields   = $args['args'];
        $controls = '';

        $ui = \Handyman\Admin\Ui\Ui_Factory::single();

        $ui->setControlWrapper('<div class="layers-form-item tl-control %s">%s</div>');

        foreach($fields as $f){
            $controls .= $ui->render($f, true);
        }

        $controls .= '<div class="clearfix"></div>';
        ?>
        <script type="text/javascript">
            (function($) {
                "use strict";
                jQuery(document).ready(function(){
                    if(jQuery("#page_template").val() == "builder.php" || jQuery("#page_template").val() == 'template-blog.php' || jQuery("#page_template").length == 0){
                        jQuery(".tl-page-option-metabox").hide();
                    }
                    jQuery("#page_template").on("change", function(){
                        if(jQuery(this).val() == "builder.php" || jQuery(this).val() == 'template-blog.php' || jQuery("#page_template").length == 0){
                            jQuery(".tl-page-option-metabox").hide();
                        }else{
                            if(jQuery(".tl-page-option-metabox").css("display") == "none"){
                                jQuery(".tl-page-option-metabox").show();
                            }
                        }
                    });
                });
            })(jQuery);
        </script>
        <?php
        echo $controls;
    }
}