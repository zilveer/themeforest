<?php
if(count($ct_options) == 1 || count($ct_options) == 0){
    of_options();
    $fox = array();
    
    foreach($of_options as $key=>$val){
        if(isset($val['std'])) {
            $fox[$val['id']] = $val['std'];
        }
    }

    if(isset($fox['of_backup'])) {
        unset($fox['of_backup']);
    } elseif(isset($fox['theme_update'])) {
        unset($fox['theme_update']);
    }
    update_option(OPTIONS, $fox);
    ct_generate_options_css($fox);
}
?>