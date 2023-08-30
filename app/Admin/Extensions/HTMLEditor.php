<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class HTMLEditor extends Field
{
    public static $js = [
        "https://unpkg.com/grapesjs/dist/grapes.min.js",
        "https://unpkg.com/grapesjs-blocks-basic",
        "https://unpkg.com/grapesjs-plugin-forms",
        "https://unpkg.com/grapesjs-preset-webpage",
        "https://unpkg.com/grapesjs-style-gradient",
        "https://unpkg.com/grapesjs-style-bg",
        "https://unpkg.com/grapesjs-tooltip",
        "https://unpkg.com/grapesjs-tabs",

    ];

    public static $css = [
        "https://unpkg.com/grapesjs/dist/css/grapes.min.css",
    ];
    protected $view = 'gjs';

    public function __construct($column = '', $arguments = [])
    {
        parent::__construct($column, $arguments);
        if(count($arguments) > 1) {
            $customData = $arguments[1];
            $this->addVariables(['customData' => $customData]);
        } else {
            $this->addVariables(['customData' => null]);
        }
    }
}
