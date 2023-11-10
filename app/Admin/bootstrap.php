<?php

use App\Admin\Extensions\Form\CustomFile;
use App\Admin\Extensions\Form\CustomHasMany;
use App\Admin\Extensions\Form\CustomImage;
use App\Admin\Extensions\Form\HTMLEditor;
use App\Admin\Extensions\Form\Select;
use OpenAdmin\Admin\Form;

/**
 * Open-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * OpenAdmin\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * OpenAdmin\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Form::extend('htmleditor', HTMLEditor::class);
Form::extend('customSelect', Select::class);
Form::extend('customHasMany', CustomHasMany::class);
Form::extend('customFile', CustomFile::class);
Form::extend('customImage', CustomImage::class);
Form::forget(['map']);
