# Plyr Media Player for ProcessWire

## ! This module is "work in progress" v0.1 alpha !

This module adds the [Plyr HTML5 Media Player](https://plyr.io/) to ProcessWire

## Current Capabilities

After installation, the module currently has only one config option: automaticMode enable/disable.
If enabled, the module hooks after page rendering and automatically adds the stylesheet to HTML head. Also adds an AJAX call to fetch the SVG sprite and the Plyr javascript library right before the ending body-tag.
Also while in automatic mode, that extra markup will only be rendered, if a template made a render request for a Plyr player.

### Get module

    $plyr = $modules->get("MarkupPlyrMediaPlayer");

### Add a video player to your template

    echo $plyr->renderVideoPlayer($poster, $mp4, $webm, $captions);

The ```$captions```-Array contains details of the caption tracks:

    $captions = $caption = array();
    
    $caption['label']   # Something like "English captions"
    $caption['src']     # http://...movie_captions_en.vtt
    $caption['srclang'] # en|de|ru|...
    $caption['default'] # true|false
    
    array_push($captions, $caption);

### Add an audio player to your template

    echo $plyr->renderAudioPlayer($mp3Path, $oggPath); 

### Add the YouTube-wrapper to your template

    echo $plyr->renderYoutubePlayer($videoId); 

## Manual mode

If automatic mode is disabled, you have to render these parts manualy in your page template. This method will not check if a player was requested.

In the HTML head:

    <html>
        <head>
            ...
            <?php echo $plyr->renderHtmlHead();  // Basicly just a <link rel="stylesheet" href="..."> ?>
        </head>
    ...

And in the footer somewhere before the closing body-tag:

            ...
            echo $plyr->renderHtmlFooter; // AJAX call for SVG and JS library inclusion
        </body>
    </html>


## Where is this going?

Before getting a v1.0.0 stable release, this module should be capable of following features:

- Reliable automatic mode
- Load resources from CDN or local files
- Brings specific Inputfields for video, audio and youtube for the backend and frontend markup rendering
- Every Plyr javascript setting can be handled via module configuration