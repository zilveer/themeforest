<?php
namespace Handyman\Core;


/**
 * Class Environment_Checker
 * @package Handyman\Core
 */
class Environment_Checker
{

    public static $single = null;


    /**
     * @var array
     */
    protected $_conditions = array();


    /**
     * @var array
     */
    protected $results = array();


    /**
     * @var bool
     */
    public $passed = true;



    public function __construct($conditions = array())
    {

        self::$single =& $this;

        /**
         * Set conditions that should be sutisfied!
         */
        $this->setConditions($conditions);


        /**
         *  Runs checks after the theme is activated. If any of tests failed switch to the old theme
         */
        add_action('after_switch_theme', array($this, 'checkCoreRequirementsOnActivation'), 10, 2);


        /**
         * Remove Parent's Theme Setup
         */
        add_action('after_setup_theme', array($this, 'unhook_parent_on_activation'), 1);
    }


    /**
     * Removes parent setup function on theme activation
     */
    public function unhook_parent_on_activation()
    {
        if(!$this->check() && isset($_GET['activated']) && is_admin()){
            remove_action('after_setup_theme', 'layers_setup', 10);
        }

        if(isset($this->results['layers']) && !$this->results['layers']){
            add_action('admin_notices', array($this, 'oldLayersNotice'));
        }
    }



    /**
     * @return bool
     */
    public function check()
    {
        foreach($this->_conditions as $test => $data){

            switch($test){
                case 'php':
                    if(version_compare(phpversion(), $data, '<')){
                        $this->passed = false;
                        $this->results['php'] = false;
                    }
                    break;
                case 'wp':
                    global $wp_version;
                    if(version_compare($wp_version, $data, '<')){
                        $this->passed = false;
                        $this->results['wp'] = false;
                    }
                    break;
                case 'layers':

                    if(defined('LAYERS_VERSION') && version_compare(LAYERS_VERSION, $data, '<')){
                        $this->passed = false;
                        $this->results['layers'] = false;
                    }
                    break;
                case 'mbstring':

                    if(!\extension_loaded('mbstring')){
                        $this->passed = false;
                        $this->results['mbstring'] = false;
                    }
                    break;
            }
        }
        return $this->passed;
    }



    /**
     * Test all constraints
     *
     * @return bool
     */
    public function checkCoreRequirementsOnActivation($old_theme_name, $old_theme)
    {
        if(!$this->check()){

            add_action('admin_notices', array($this, 'theme_deactivated_notice'));

            foreach(array_keys($this->results) as $r){
                if($r == 'php'){
                    add_action('admin_notices', array($this, 'oldPhpNotice'));
                }elseif($r == 'wp'){
                    add_action('admin_notices', array($this, 'oldWpNotice'));
                }elseif($r == 'layers'){
                    add_action('admin_notices', array($this, 'oldLayersNotice'));
                }elseif($r == 'mbstring'){
                    add_action('admin_notices', array($this, 'mbMissingNotice'));
                }
            }

            /**
             * System does not meet minimum theme requirements. Switch to the previous theme
             */
            switch_theme($old_theme->stylesheet);
            return false;
        }
    }



    /**
     * These requirements are checked every this during the theme loading process
     *
     * @return bool
     */
    public function checkCoreRequirements()
    {
        if(!$this->check()){

            foreach(array_keys($this->results) as $r){
                if($r == 'php'){
                    add_action('admin_notices', array($this, 'oldPhpNotice'));
                }elseif($r == 'wp'){
                    add_action('admin_notices', array($this, 'oldWpNotice'));
                }elseif($r == 'layers'){
                    add_action('admin_notices', array($this, 'oldLayersNotice'));
                }elseif($r == 'mbstring'){
                    add_action('admin_notices', array($this, 'mbMissingNotice'));
                }
            }
        }
        return $this->passed();
    }



    /**
     * @param $conditions
     */
    public function setConditions($conditions)
    {
        $this->_conditions = $conditions;
    }



    public function theme_deactivated_notice(){
        ?>
        <div class="updated error" style="padding:20px; font-size: 16px;">
            <?php echo TL_THEMENAME; ?> has been deactivated.
        </div>
        <?php
    }



    public function oldWpNotice()
    {
        global $wp_version;
        ?>
        <div class="updated error" style="padding:20px; font-size: 16px;">
            <?php echo TL_THEMENAME; ?> requires <strong>Wordpress v<?php echo $this->_conditions['wp']; ?></strong>.
            Actual version is: <strong>Wordpress v<?php echo esc_html($wp_version); ?></strong>. Please <a href="<?php echo admin_url('update-core.php')?>">upgrade you wordpress</a> in order to run the theme.</strong>
        </div>
    <?php
    }



    public function oldPhpNotice()
    {?>
        <div class="updated error" style="padding:20px; font-size: 16px;">
            <?php echo TL_THEMENAME; ?> requires <strong>PHP v<?php echo esc_attr($this->_conditions['php'])?></strong><br/>
            Current PHP version is: <strong>PHP<?php echo phpversion(); ?></strong>. Please upgrade your PHP.
        </div>
    <?php
    }



    public function mbMissingNotice()
    {?>
        <div class="updated error" style="padding:20px; font-size: 16px;">
            <?php echo TL_THEMENAME; ?> requires following PHP extension "<b>mbstring</b>". Please install it in order run the theme.
        </div>
    <?php
    }



    public function oldLayersNotice()
    {?>
        <div class="updated error" style="padding:20px; font-size: 16px;">
            In order to run "Handyman Theme" you have to update Layers Parent Theme. The <?php echo esc_html(TL_THEMENAME)?> requires Layers v<?php echo esc_html($this->_conditions['layers']); ?> or newer.
        </div>
    <?php
    }



    public function passed(){
        return $this->passed;
    }
}