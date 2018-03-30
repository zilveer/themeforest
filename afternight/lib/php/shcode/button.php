
<?php
    class button{
        

        public function __construct( ){
        	
        	/*Note!  if you add new values in this arrays, don't forget to do the same in /lib/shcode.php */
			$sizes      = array( 'small' , 'medium' , 'large');
            $colors      = array( 'blue' , 'gray' , 'green', 'orange' , 'black', 'brown', 'pink', 'red');
  			$style		= array('comment','download','print','delete','tick','info','demo','warning');
            
			$result  = '<table cellspacing="0" cellpadding="0" class="sh_code_tbl"> ';
            $result .= '<tr>';
            $result .= '<td class="label_td fl_r">';
            $result .= '<label>Select the Color:</label>';
            $result .= '</td>';
            $result .= '<td>';
            
            $result .= '<select id="btn_color" class="select_medium">';
            for($i=0;$i < count($colors); $i++){
            	$result .= '<option value="'.$colors[$i].'">'.$colors[$i].'</option>';
            }
            $result .= '</select>';
            $result .= '</td>';
            $result .= '<td ROWSPAN=6 valign=top style="padding-left:30px;">';
            $result .= '<b>Button Preview</b>';
            $result .= '<div id="preview_area">';
            $result .= '<a id="style_off" class="cosmolink" href="#"><button id="" name="" type="button" class="cosmobutton blue small"><span><span id="btn_name">Button</span></span></button></a>';
            $result .= '<a id="style_on" style="display:none" href="#" class="cosmolink"><button class="cosmobutton gray comment" type="button" name="" id=""><span><span id="style_off_name"><span class="cosmo-ico">&nbsp;</span>Button</span></span></button></a>';
            $result .= '</div>';
            $result .= '</td>';
            
            $result .= '</tr>';
            $result .= '<tr>';
            $result .= '<td class="label_td fl_r">';
            $result .= '<label>Button Size:</label>';
            $result .= '</td>';
            $result .= '<td>';
            $result .= '<select id="btn_size" class="select_medium">';
            for($i=0;$i < count($sizes); $i++){
            	$result .= '<option value="'.$sizes[$i].'">'.$sizes[$i].'</option>';
            }
            $result .= '</select>';
            
            $result .= '</td>';
            $result .= '</tr>';
            
            $result .= '<tr>';
            $result .= '<td class="label_td fl_r">';
            $result .= '<label>Button Style:</label>';
            $result .= '</td>';
            $result .= '<td>';
            $result .= '<select id="btn_style" class="select_medium">';
            $result .= '<option value="none">none(Default) </option>';
            for($i=0;$i < count($style); $i++){
            	$result .= '<option value="'.$style[$i].'">'.$style[$i].'</option>';
            }
            $result .= '</select> <br/><span class="hint">If style is selected then Button size <br/> and Button color options are disabled</span>' ;
            
            $result .= '</td>';
            $result .= '</tr>';
            
            $result .= '<tr>';
            $result .= '<td>';
            $result .= '<label class="label_td fl_r">Button Link Location:</label>';
            $result .= '</td>';
            $result .= '<td>';
            $result .= '<input type="text" id="button-location">';
            $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
            $result .= '<td class="label_td fl_r">';
            $result .= '<label>Button Title:</label>';
            $result .= '</td>';
            $result .= '<td>';
            $result .= '<input type="text" id="button-caption" onkeyup="javascript:AddCaption();">';
            $result .= '</td>';
            $result .= '</tr>';
            $result .= '<tr>';
            $result .= '<td class="label_td fl_r">';
            $result .= '<label for="new_window">Open in new window:</label>';
            $result .= '</td>';
            $result .= '<td>';
            $result .= '<input type="checkbox" id="new_window" >';
            $result .= '</td>';
            $result .= '</tr>';
            
            
            
            $result .= '</table>';

           
            /* inputs class */
            $result .= '<div class="button-inputs">';
            $result .= '<p><a class="button" onclick="resetButtons();" href="javascript:void(0);">Reset</a><input class="button-primary" style="margin-left:10px;" type="button" value="Add Button" accesskey="b" onclick="javascript:AddButton();"></p>';
            $result .= '</div>';
            
            

            echo $result;
        }
        
    }

    new button();
?>