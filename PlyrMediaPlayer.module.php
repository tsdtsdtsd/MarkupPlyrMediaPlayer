<?php

/**
 * Plyr HTML5 Media Player module for ProcessWire
 *
 * ProcessWire 2.5+ 
 * Copyright (C) 2015 by Orkan Alat 
 * Licensed under GNU/GPL v2, see LICENSE.TXT
 * 
 * http://www.processwire.com
 * https://github.com/tsdtsdtsd/PlyrMediaPlayer
 * https://plyr.io/
 */
class PlyrMediaPlayer extends WireData implements Module 
{

    /**
     * Keeps track if a player was requested in this loop
     * @var boolean
     */
    protected $_playerRequested = false;

    /**
     * Returns module info array
     *
     * @todo  Check posibilities (e.g. requirement definitions)
     * @return array
     */
    public static function getModuleInfo() 
    {
        return array(

            'title' => 'Plyr Media Player', 
            'version' => '0.1.0', 
            'summary' => 'This module adds the Plyr HTML5 Media Player (https://plyr.io/) to ProcessWire',
            'href' => 'https://github.com/tsdtsdtsd/PlyrMediaPlayer',
            'singular' => true, 
            'autoload' => true,
            'icon' => 'youtube-play'
        );
    }

    public function init() 
    {
        $this->addHook('Page::plyr', $this, '_plyr'); 
    }

    public function ready() 
    {
        if($this->page->template == 'admin') return;

        $config = wire('modules')->getModuleConfigData($this);
        if(!$config['automaticMode']) return;

        $this->addHookAfter('Page::render', $this, '_addPlyrToOutput'); 
    }

    protected function _addPlyrToOutput($event) 
    {
        if(!$this->_playerRequested) return;

        // $page = $event->object; 
        // $config = wire('modules')->getModuleConfigData($this);
        $outputHead = $this->renderHtmlHead();
        $outputFooter= $this->renderHtmlFooter();

        $event->return = str_replace("</head>", $outputHead . '</head>', $event->return); 
        $event->return = str_replace("</body>", $outputFooter . '</body>', $event->return); 
    }

    protected function _plyr($event) 
    {
        $event->return = $this;
    }

    /**
     * Returns rendered HTML of a video player
     *
     * @todo   Refactor to use ProcessWire template rendering
     * @param  array  $options The player options
     * @return string
     */
    public function renderVideoPlayer($options = array())
    {
        $this->_playerRequested = true;
        
        return '<div class="player">
                    <video poster="' . $options['poster'] . '" controls crossorigin>
                        <!-- Video files -->
                        <source src="' . $options['mp4'] . '" type="video/mp4">
                        <source src="' . $options['webm'] . '" type="video/webm">

                        <!-- Text track file 
                        <track kind="captions" label="" src="" srclang="" default>-->

                        <!-- Fallback for browsers that don\'t support the <video> element -->
                        <a href="' . $options['mp4'] . '">Download</a>
                    </video>
                </div>';
    }

    /**
     * Returns rendered HTML of an audio player
     *
     * @todo   Refactor to use ProcessWire template rendering
     * @param  string  $mp3Path     Path to mp3 file
     * @param  string  $oggPath     Path to ogg file (optional)
     * @return string
     */
    public function renderAudioPlayer($mp3Path, $oggPath = null)
    {
        $this->_playerRequested = true;

        // https://cdn.selz.com/plyr/1.0/logistics-96-sample.mp3
        // https://cdn.selz.com/plyr/1.0/logistics-96-sample.ogg
        $rendered = '<div class="player">
                        <audio controls>
                            <!-- Audio files -->
                            <source src="' . $mp3Path . '" type="audio/mp3">';

        $rendered .= !empty($oggPath) ? '<source src="' . $oggPath . '" type="audio/ogg">' : '';

        $rendered .= '
                            <!-- Fallback for browsers that don\'t support the <audio> element -->
                            <a href="' . $mp3Path . '">Download</a>
                        </audio>
                    </div>';

        return $rendered;
    }

    /**
     * Returns rendered HTML of a youtube player
     *
     * @todo   Refactor to use ProcessWire template rendering
     * @param  string  $videoId     The YouTube video ID
     * @return string
     */
    public function renderYoutubePlayer($videoId)
    {
        $this->_playerRequested = true;
        
        // L1h9xxCU20g
        return '<div class="player">
                    <div data-video-id="' . $videoId . '" data-type="youtube"></div>
                </div>';
    }

    /**
     * Returns code which is required in the HTML head
     *
     * Contains CSS stylesheet
     * 
     * @return string
     */
    public function renderHtmlHead()
    {
        return '<link rel="stylesheet" href="https://cdn.plyr.io/1.3.5/plyr.css">';
    }

    /**
     * Returns code which is required in the HTML Footer
     *
     * Contains AJAX request for the SVG image
     * Contains Plyr library include
     * Contains call to plyr.setup()
     * 
     * @return string
     */
    public function renderHtmlFooter()
    {
        return '<script>
                (function(d, p){
                    var a = new XMLHttpRequest(),
                        b = d.body;
                    a.open("GET", p, true);
                    a.send();
                    a.onload = function(){
                        var c = d.createElement("div");
                        c.style.display = "none";
                        c.innerHTML = a.responseText;
                        b.insertBefore(c, b.childNodes[0]);
                    }
                })(document, "https://cdn.plyr.io/1.3.5/sprite.svg");
                </script>

                <script src="https://cdn.plyr.io/1.3.5/plyr.js"></script>
                <script>plyr.setup();</script>';
    }

    public function ___install() 
    {
    }

    public function ___uninstall() 
    {
    }
    
}