# Plyr Media Player for ProcessWire

## ! This module is "work in progress" v0.2 alpha !

This module adds the [Plyr HTML5 Media Player](https://plyr.io/) to ProcessWire.

Plyr is basically a wrapper for the natural media interface in modern browsers. It adds the ability for easy styling via CSS and a sprite, while being fully responsive. Also Plyr gives you full controll over the player with its great javascript interface.
 
MarkupPlyrMediaPlayer incorporates Plyr into the ProcessWire CMS. 

## Current capabilities

After installation, you will notice some module configuration options. These are:
 - Automatic Mode
   If enabled, this option will automaticaly add all needed resources into your pages output.
 - Use CDN
   Use the official Plyr CDN (Content Delivery Network) for resources?

The following resource options are only required if you don't wish to use the CDN:

 - Path to CSS file
   (Path to your CSS file, required to style the players.)
 - Path to Plyr library
   (Path to the Plyr javascript library, required for the functionality.)
 - Path to SVG sprite
   (Path to your SVG sprite image file, required to style the players.)

## Automatic mode

If automatic mode is enabled, the module hooks after the page rendering and automatically adds the stylesheet to HTML head. Also adds an AJAX call to fetch the SVG sprite and the Plyr javascript library right before the ending body-tag.
Also, while in automatic mode, that extra markup will only be rendered if a template made a render request for a Plyr player. So there will be no unnecessary load on your site.

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

If automatic mode is disabled, you have to render these parts manualy in your page template. Important: This method will not check if a player was requested.

In the HTML head:

    <html>
        <head>
            ...
            <?php echo $plyr->renderHeadLink();  // Basicly just a <link rel="stylesheet" href="..."> ?>
        </head>
    ...

And in the footer somewhere before the closing body-tag:

            ...
            echo $plyr->renderScripts(); // AJAX call for SVG and JS library inclusion
        </body>
    </html>


## Where is this going?

Before getting a v1.0.0 stable release, this module should be capable of following features:

- [done] Load resources from CDN or local files
- Reliable automatic mode with fallback to local
- Brings specific Inputfields for video, audio and youtube for the backend and frontend markup rendering
- Every Plyr javascript setting can be handled via module configuration