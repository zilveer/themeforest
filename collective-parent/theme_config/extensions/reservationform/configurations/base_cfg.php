<?php
$cfg['input_types']=array(
    'text' => array(
        'name'=>__('Text line', 'tfuse'),
        'type'=>'text',
        'value'=>'',
        'id'=>TF_THEME_PREFIX."_%%name%%",
        'options'=>false,
        'properties'=>array(
            'style'=>'width:85%',
            'class'=>'inputtext'
        )
    ),
    'textarea' => array(
        'name'=>__('Text area', 'tfuse'),
        'type'=>'textarea',
        'value'=>'',
        'id'=>TF_THEME_PREFIX."_%%name%%",
        'options'=>false,
        'properties'=>array(
            'style'=>'width:91%',
            'class'=>'textarea'
        )
    ),

    'radio' => array(
        'name'=>__('Radio buttons', 'tfuse'),
        'type'=>'radio',
        'value'=>'',
        'id'=>TF_THEME_PREFIX."_%%name%%",
        'options'=>true
    ),
    'checkbox' => array(
        'name'=>__('Checkbox', 'tfuse'),
        'type'=>'checkbox',
        'value'=>'',
        'id'=>TF_THEME_PREFIX."_%%name%%",
        'options'=>false
    ),
    'select' => array(
        'name'=>__('Select Box', 'tfuse'),
        'type'=>'select',
        'value'=>'',
        'id'=>TF_THEME_PREFIX."_%%name%%",
        'properties'=>array(
            'class'=>'select_styled'
        ),
        'options'=>true
    ),
    'email' => array(
        'name'=>__('Email', 'tfuse'),
        'type'=>'text',
        'value'=>'',
        'id'=>TF_THEME_PREFIX."_%%name%%",
        'options'=>false,
        'properties'=>array(
            'style'=>'width:85%',
            'class'=>'inputtext'
        )
    ),
    'captcha' => array(
        'name'=>__('Captcha', 'tfuse'),
        'type'=>'captcha',
        'value'=>'',
        'id'=>"captcha",
        'options'=>false,
        'file_name'=>'captcha_gen.php',
        'properties'=>array(
            'style'=>'width:85%'
        )
    )
);
$cfg['labels']=array(
            'type'=>'tfuse_cf_label',
    array(
        'id'=>'rf_type',
        'html'=>'<label >Type</label>',
        'type'=>'raw'
    ),
            array(
                'id'=>'rf_label',
                'html'=>'<label >Label</label>',
                'type'=>'raw'
            ),

            array(
                'id'=>'rf_width',
                'html'=>'<label >Width (%)</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_required',
                'html'=>'<label >Required</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_newline',
                'html'=>'<label >New Line</label>',
                'type'=>'raw'
            ),
            array(
                'id'=>'rf_shortcode',
                'html'=>'<label >Shortcode</label>',
                'type'=>'raw'
            ),
        );