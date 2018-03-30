<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * YIT Type: Cat
 * 
 * @since 1.0.0
 */
class YIT_Type_Cat {

	/**
	 * Load and print the correspondent field type.
	 * 
	 * @param @field
	 * @return string
	 */
	public static function display( $value, $dep ) {

		$cats = get_categories('orderby=name&use_desc_for_title=1&hierarchical=1&style=0&hide_empty=0');
    						             
        $class = $descr = $ext = '';
        $cols = 1;      
    	
		if ( isset( $value['cols'] ) && $value['cols'] ) {
			$heads = false;
            if ( isset( $value['heads'] ) ) {
				$heads = true;    
            }

			$cols = $value['cols'];
            $class = ' small';
        }
        
        $checked_items = yit_get_option( $value['id'] );

		ob_start(); ?>
			<div id="<?php echo $value['id_container'] ?>" <?php if($dep): ?>data-field="<?php echo $dep['field'] ?>" data-dep="<?php echo $dep['dep'] ?>" data-value="<?php echo $dep['value'] ?>" <?php endif ?>class="yit_options rm_option rm_input rm_multi_checkbox">
                <label for="<?php echo $value['id'] ?>"><?php echo $value['name'] ?><?php if($cols > 1): ?><small><?php echo $value['desc'] ?></small><?php endif ?></label>
                
				<?php for($i=1;$i<=$cols;$i++) : $ext = ($cols > 1) ? "$i" : '' ?>  
                <ul id="<?php echo( $value['id'] . $ext ); ?>" class="list-sortable<?php echo $class ?>">  
        				
                        <?php		                                
                
    			        if($heads) echo '<li class="head">'.$value['heads'][$i-1].'</li>';
                        
                        $c = 0;
        				foreach($cats as $cat) { $checked = isset( $checked_items[$i] ) ? $checked_items[$i] : array(); ?>
                        
                        	<li>
			                	<label class="radio-inline">
									<input type="checkbox" name="<?php yit_field_name( $value['id'] ); ?>[<?php echo $i ?>][]" value="<?php echo $cat->cat_ID; ?>" <?php checked( in_array( $cat->cat_ID, $checked ), true ); ?> id="<?php echo( $value['id'] ); ?>-<?php echo $c . $ext ?>" />&nbsp;
									<?php echo $cat->cat_name; ?>
			                	</label>
                            </li>
                        <?php $c++;	}  ?>
                        </ul>
					
				<?php endfor ?>
                
                <?php if($cols == 1): ?><small><?php echo $value['desc'] ?></small><?php endif ?>
                <div class="clear"></div>
            </div>
        <?php
		return ob_get_clean();
	}
}