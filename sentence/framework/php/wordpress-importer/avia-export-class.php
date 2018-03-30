<?php  if ( ! defined('AVIA_FW')) exit('No direct script access allowed');
/**
 * This file holds the class that creates the options export file for the wordpress importer
 *
 *
 * @author		Christian "Kriesi" Budschedl
 * @copyright	Copyright (c) Christian Budschedl
 * @link		http://kriesi.at
 * @link		http://aviathemes.com
 * @since		Version 1.1
 * @package 	AviaFramework
 */

/**
 *
 */
if( !class_exists( 'avia_wp_export' ) )
{
	class avia_wp_export 
	{
		function avia_wp_export($avia_superobject)
		{
			if(!isset($_GET['avia_export'])) return;
		
			$this->avia_superobject = $avia_superobject;
			$this->subpages = $avia_superobject->subpages;
			$this->options  = $avia_superobject->options;
			$this->db_prefix = $avia_superobject->option_prefix;
			
			add_action('admin_init',array(&$this, 'initiate'),200);
		}
		
		function initiate()
		{

			//get the first subkey of the saved options array
			foreach($this->subpages as $subpage_key => $subpage)
			{
				$export[$subpage_key] = $this->export_array_generator($this->avia_superobject->option_page_data, $this->options[$subpage_key], $subpage);
			}
			
			//export of options
			$export = base64_encode(serialize($export));

            if(isset($_GET['avia_generate_config_file']))
            {
                $this->generate_export_file($export);
            }
			
			//export of dynamic pages
			$export_dynamic_pages = get_option($this->db_prefix.'_dynamic_pages');
			if($export_dynamic_pages) $export_dynamic_pages = base64_encode(serialize($export_dynamic_pages));
			
			//export of dynamic elements
			$export_dynamic_elements = get_option($this->db_prefix.'_dynamic_elements');
			if($export_dynamic_elements) $export_dynamic_elements = base64_encode(serialize($export_dynamic_elements));

			echo '<pre>&#60?php '."\n\n";
			echo '/*this is a base64 encoded option set for the default dummy data. If you choose to import the dummy.xml file with the help of the framework importer this options will also be imported*/'."\n\n";
			echo '$options = "';
			print_r($export);
			echo '";</pre>'."\n\n";
			
			echo '<pre>'."\n";
			echo '$dynamic_pages = "';
			print_r($export_dynamic_pages);
			echo '";</pre>';
			
			echo '<pre>'."\n";
			echo '$dynamic_elements = "';
			print_r($export_dynamic_elements);
			echo '";</pre>';

			exit();
		}


        function generate_export_file($export_data)
        {
            $today = getdate();
            $today_str = $today['year'].'-'.$today['mon'].'-'.$today['mday'];
            $export_file = THEMENAME.'-theme-settings-'.$today_str.'.txt';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=" . urlencode($export_file));
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header("Pragma: no-cache");
            header("Expires: 0");

            print $export_data;
            die();
        }
		
		
		
		function export_array_generator($elements, $options, $subpage, $grouped = false)
		{	

			$export = array();
			//iterate over all option page elements
			foreach($elements as $element)
			{
				if((in_array($element['slug'], $subpage) || $grouped) && isset($element['id']) && isset($options[$element['id']]))
				{
					if($element['type'] != 'group')
					{
						if(isset($element['subtype']) && !is_array($element['subtype']))
						{
							//pass id-value and subtype
							$taxonomy = false;
							if(isset($element['taxonomy'])) $taxonomy = $element['taxonomy'];
							
							$value = avia_backend_get_post_page_cat_name_by_id($options[$element['id']] , $element['subtype'], $taxonomy);
						}
						else
						{
							
							$value = $options[$element['id']];
						}
						
						if(isset($value))
						{
							$element['std'] = $value;
							$export[$element['id']] = $element;
						}
					}
					else
					{
						$iterations = count($options[$element['id']]);
						$export[$element['id']] = $element;
						for($i = 0; $i < $iterations; $i++)
						{
							$export[$element['id']]['std'][$i] = $this->export_array_generator($element['subelements'], $options[$element['id']][$i], $subpage, true);
						}
					}
				}
			}
			
			return $export;
			
		}
		
		

		
	}
}


