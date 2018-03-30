<?php

include_once('post-meta.php');

class PageMeta extends PostMeta
{
    private $metaKeys = array(
        'sidebar'=> array('sidebar')
    );

    private $pageFeatures = array(
        'default' => array('sidebar'),
		'template-home.php' => array(),
		'template-page.php' => array('sidebar')
    );

	public function __construct() 
	{
		parent::__construct('page');
	}

    function DeleteSettings($arr, $post_id)
    {
        foreach($arr as $key => $val)
        {
            $inputType = 'simple';

            if(gettype($val) == 'string')
            {
                $metaKey = $val;
            }
            else//Array
            {
                $metaKey   = $key;
                $inputType = $val['type'];
            }

            $metaValue    = get_post_meta( $post_id, $metaKey, true );
            $prevIsEmpty  = gettype($metaValue) == 'string' ? $metaValue == '' : count($metaValue) < 1;

            if ( !$prevIsEmpty )
            {
                delete_post_meta( $post_id, $metaKey, $metaValue );

                //Delete the attachment too
                if($inputType == 'upload')
                    $this->DeleteAttachment($metaValue);
            }
        }
    }

    function PreSave($post_id, $post) 
    {
        //Delete values that are set for other page templates (if any)

        $template = $_POST['page_template'];
        $features = $this->pageFeatures[$template];

        foreach($this->metaKeys as $key => $val)
        {
            if(in_array($key, $features))
                continue;

            //Delete the entire keys from DB if exists
            $this->DeleteSettings($val, $post_id);
        }
    }
	
	function GetMetaKeys()
	{
		$template = $_POST['page_template'];
        $features = $this->pageFeatures[$template];
        $result = array();

        foreach($features as $feature)
        {
            $result = array_merge($result, $this->metaKeys[$feature]);
        }

        return $result;
	}

	
	function px_register_scripts()
	{
		wp_enqueue_script('hoverIntent');
		wp_enqueue_script('jquery-easing', THEME_JS_URI  .'/jquery.easing.1.3.js', array('jquery'), '1.3.0');
		
		wp_enqueue_style('nouislider', THEME_ADMIN_URI . '/css/nouislider.css', false, '2.1.4', 'screen' );
		wp_enqueue_script('nouislider', THEME_ADMIN_URI  .'/scripts/jquery.nouislider.min.js', array('jquery'), '2.1.4');
		
		wp_enqueue_style('colorpicker0', THEME_ADMIN_URI . '/css/colorpicker.css', false, '1.0.0', 'screen' );
		wp_enqueue_script('colorpicker0', THEME_ADMIN_URI  .'/scripts/colorpicker.js', array('jquery'), '1.0.0');
		
		wp_enqueue_style('chosen', THEME_ADMIN_URI . '/css/chosen.css', false, '1.0.0', 'screen' );
		wp_enqueue_script('chosen', THEME_ADMIN_URI  .'/scripts/chosen.jquery.min.js', array('jquery'), '1.0.0');
		
		wp_enqueue_style('theme-admin', THEME_ADMIN_URI . '/css/style.css', false, THEME_VERSION, 'screen' );
		wp_enqueue_script('theme-admin', THEME_ADMIN_URI  .'/scripts/admin.js', array('jquery'), THEME_VERSION);
		//Page template meta handler
		wp_enqueue_script('page-meta', THEME_ADMIN_URI  .'/scripts/page-meta.js', array('jquery'), THEME_VERSION);
	}
	
	//Add the Meta Box
	function AddMetabox() {
		add_meta_box(
			'custom_meta_box', // $id
			__('Page Options', TEXTDOMAIN), // $title 
			array(&$this, 'ShowMetabox'), // $callback
			'page', // $page
			'normal', // $context
			'high'); // $priority
	}
}

new PageMeta();