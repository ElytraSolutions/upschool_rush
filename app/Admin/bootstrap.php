<?php

use App\Admin\Extensions\Form\CustomFile;
use App\Admin\Extensions\Form\CustomHasMany;
use App\Admin\Extensions\Form\CustomImage;
use App\Admin\Extensions\Form\HTMLEditor;
use App\Admin\Extensions\Form\Select;
use OpenAdmin\Admin\CKEditor\Editor;
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

class Editor2 extends Editor
{
    public function setupImageBrowse()
    {
        $this->options['filebrowserBrowseUrl'] = '/file-manager/ckeditor';
        $this->options['filebrowserImageBrowseUrl'] = '/file-manager/ckeditor';
        // $this->options['filebrowserBrowseUrl'] = '/admin/media/images?select=true&close=true&fn=window.opener.' . $this->id . '_selectFile';
        // $this->options['filebrowserImageBrowseUrl'] = '/admin/media/images?select=true&close=true&fn=window.opener.' . $this->id . '_selectFile';
    }
}

Form::extend('htmleditor', HTMLEditor::class);
Form::extend('customSelect', Select::class);
Form::extend('customHasMany', CustomHasMany::class);
Form::extend('customFile', CustomFile::class);
Form::extend('customImage', CustomImage::class);
Form::extend('editor2', Editor2::class);
Form::forget(['map']);
