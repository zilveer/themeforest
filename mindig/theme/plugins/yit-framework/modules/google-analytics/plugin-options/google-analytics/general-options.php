<?php

return array(
    'general' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Google Analytics Script', 'yit' ),
                   'desc' => __( 'Here you can write all the code provided by Google Analytics', 'yit' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'general' => array(

            array( 'type' => 'open' ),

            array(
                'id'   => 'google-analytics-key',
                'type' => 'text-button',
                'name' => __( 'Tracking Key', 'yit'),
                'desc' => __( 'Insert here your tracking key e click the Generate button to automatically generate your integration script', 'yit' ),
                'button-name' => __( 'Generate', 'yit' ),
                'button-class' => 'google-analytic-generate',
                'data' => array(
                    'input'    => $this->get_id_field('google-analytics-key'),
                    'textarea' => $this->get_id_field('google-analytics-code'),
                    'basename' => $_SERVER['SERVER_NAME'].site_url('', 'relative')
                )
            ),

            array(
                'id'   => 'google-analytics-code',
                'type' => 'textarea-codemirror',
                'name' => __( 'Google Analytics Custom Code', 'yit' ),
                'desc' => '',
                'std' => ''
            ),

            array( 'type' => 'close' ),
        ),
    )
);