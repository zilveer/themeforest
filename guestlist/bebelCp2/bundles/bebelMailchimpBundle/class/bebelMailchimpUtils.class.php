<?php


class BebelMailchimpUtils extends BebelUtils
{

    public static function createListforList($lists, $selected = false)
    {
        if(empty($lists))
        {
            return false;
        }
        
        $ret = '';
        
        foreach($lists['data'] as $key => $value)
        {
            $selected = ($selected && $selected == $value['id']) ? ' selected="selected" ' : '';
            $ret .= '<option '.$selected.' value="'.$value['id'].'">'.$value['name'].'</option>';
        }
        
        return $ret;
    }
    
}