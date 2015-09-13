<?php

$config = array(
    
    'automaticMode' => array(
        'type' => 'radios',
        'label' => __('Enable automatic mode?'), 
        'description' => __('When enabled, will include Plyrs required code automaticaly to the page (JS, CSS, SVG).'),
        // 'notes' => __(''), 
        'options' => array(
            1 => __('Yes'),
            0 => __('No'),
        ),
        'value' => 1
    ),
    
    // 'useCdn' => array(
    //     'type' => 'radios',
    //     'label' => __('Use Plyr CDN?'), 
    //     'description' => __('When enabled, will download the resources from official Plyr CDN.'),
    //     // 'notes' => __('The hello message will only be shown to users with edit access to the page.'), 
    //     'options' => array(
    //         1 => __('Yes'),
    //         0 => __('No'),
    //     ),
    //     'value' => 1
    // ),
);