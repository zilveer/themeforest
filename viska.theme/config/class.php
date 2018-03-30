<?php
add_filter( 'body_class',  'custom_body_class' );



function custom_body_class(array $classes)
{
    if(!is_home())
        $classes[]="blog";
    return $classes;

}
function layout_class($type)
{
    $layout = default_layout();
    $classes = array(
        'left'  =>  '',
        'main'  =>  'col-md-8',
        'right' =>  'col-md-3',
        'right1' =>  'col-md-3',
        'right2' =>  '',
    );
    switch($layout)
    {
        case 'None':
            $classes = array(
                'left'  =>  '',
                'main'  =>  'col-md-12',
                'right' =>  '',
                'right1' =>  '',
                'right2' =>  ''
            );
            break;
        case 'LM':
            $classes = array(
                'left'  =>  'col-md-3',
                'main'  =>  'col-md-8',
                'right' =>  '',
                'right1' =>  '',
                'right2' =>  '',
            );
            break;
        case 'MR':
            $classes = array(
                'left'  =>  '',
                'main'  =>  'col-md-8',
                'right' =>  'col-md-3',
                'right1' =>  'col-md-3',
                'right2' =>  '',
            );
            break;
        case 'LMR':
            $classes = array(
                'left'  =>  'col-md-2',
                'main'  =>  'col-md-8',
                'right' =>  'col-md-2',
                'right1' =>  'col-md-2',
                'right2' =>  '',
            );
            break;
        case 'MRR':
            $classes = array(
                'left'  =>  '',
                'main'  =>  'col-md-8',
                'right' =>  'col-md-2',
                'right1' =>  'col-md-2',
                'right2' =>  'col-md-2'
            );
            break;

    }
    return $classes[$type];
}
