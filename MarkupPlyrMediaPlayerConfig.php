<?php

class MarkupPlyrMediaPlayerConfig extends ModuleConfig
{
    public function getDefaults() 
    {
        return array(
            'automaticMode' => 0,
            'useCdn' => 0,
            // 'forceFallbackFiles' => 0,
            'cssPath' => 'resources/plyr.css',
            'jsPath'  => 'resources/plyr.js',
            'svgPath' => 'resources/sprite.svg',
        );
      }

    public function getInputfields()
    {
        $inputfields = parent::getInputfields();
        $f = wire('modules')->get("InputfieldCheckbox");
        $f->label = "Automatic Mode";
        $f->description = __("If enabled, this option will automaticaly add all needed resources into your pages output.");
        $f->notes = __("The resources will only be loaded, if your page renders a player.");
        $f->attr('name', 'automaticMode');
        $f->attr('autocheck', 1);
        $inputfields->add($f);

        $fieldset = wire('modules')->get("InputfieldFieldset");
        $fieldset->label = "Resources";
        $fieldset->collapsed = Inputfield::collapsedNo;
        $inputfields->add($fieldset);

        $f = wire('modules')->get("InputfieldCheckbox");
        $f->label = "Use CDN";
        $f->description = __("Use the official Plyr CDN (Content Delivery Network) for resources?");
        $f->notes = __("Only in automatic mode: The resources will only be loaded, if your page renders a player.");
        $f->attr('name', 'useCdn');
        $f->attr('autocheck', 1);
        $f->columnWidth = 50;
        $fieldset->add($f);

        // $f = wire('modules')->get("InputfieldCheckbox");
        // $f->attr('name', 'forceFallbackFiles');
        // $f->label = "Fallback to local files";
        // $f->description = __("Always use the local resource files as a fallback location of the CDN.");
        // $f->notes = __("Only in automatic mode: The resources will only be loaded, if your page renders a player.");
        // $f->attr('autocheck', 1);
        // $f->columnWidth = 50;
        // $fieldset->add($f);

        $f = wire('modules')->get('InputfieldText');
        $f->attr('name', 'cssPath');
        $f->label = __('Path to CSS file');
        $f->placeholder = 'resources/plyr.css';
        $f->showIf = 'useCdn=0';
        $f->description = "Path to your CSS file, required to style the players.";
        $f->notes = "Should be relative to 'site/modules/MarkupPlyrMediaPlayer/'.";
        $fieldset->add($f);

        $f = wire('modules')->get('InputfieldText');
        $f->attr('name', 'jsPath');
        $f->label = __('Path to Plyr library');
        $f->placeholder = 'resources/plyr.js';
        $f->showIf = 'useCdn=0';
        $f->description = "Path to the Plyr javascript library, required for the functionality.";
        $f->notes = "Should be relative to 'site/modules/MarkupPlyrMediaPlayer/'.";
        $fieldset->add($f);

        $f = wire('modules')->get('InputfieldText');
        $f->attr('name', 'svgPath');
        $f->label = __('Path to SVG sprite');
        $f->placeholder = 'resources/sprite.svg';
        $f->showIf = 'useCdn=0';
        $f->description = "Path to your SVG sprite image file, required to style the players.";
        $f->notes = "Should be relative to 'site/modules/MarkupPlyrMediaPlayer/'.";
        $fieldset->add($f);

        // $f = wire('modules')->get('InputfieldText');
        // $f->attr('name', 'plyrOptions');
        // $f->label = "Plyr Player Options";
        // $f->description = "For now, JSON-formated string";
        // $inputfields->add($f);

        return $inputfields;
    }
}