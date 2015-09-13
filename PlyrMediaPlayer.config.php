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
    
    'useCdn' => array(
        'type' => 'radios',
        'label' => __('Use Plyr CDN?'), 
        'description' => __('When enabled, will download the resources from official Plyr CDN.'),
        'notes' => __('Will use path fields below as fallback, if given.'), 
        'options' => array(
            1 => __('Yes'),
            0 => __('No'),
        ),
        'value' => 1
    ),

    'cssPath' => array(
        'type' => 'text',
        'label' => __('Path to CSS file'), 
        // 'notes' => __('Example: '), 
        'value' => ''
    ),

    'jsPath' => array(
        'type' => 'text',
        'label' => __('Path to JS library file'), 
        // 'notes' => __('Example: '), 
        'value' => ''
    ),

    'svgPath' => array(
        'type' => 'text',
        'label' => __('Path to SVG sprite file'), 
        // 'notes' => __('Example: '), 
        'value' => ''
    ),
);