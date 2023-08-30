<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Field\HTMLEditor;
use Illuminate\Http\Request;
use URL;

class AdminLessonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lesson());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('chapter.name', __('Chapter'));
        $grid->column('active', __('Active'))->display(function ($active) {
            return ($active == 1) ? 'Yes' : 'No';
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Lesson::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('chapter.name', __('Chapter'));
        $show->field('intro', __('Intro'));
        $show->field('content', __('Content'));
        $show->field('active', __('Active'))->display(function ($active) {
            return ($active == 1) ? 'Yes' : 'No';
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form($lessonId = null)
    {
        $form = new Form(new Lesson());
        $form->extend('htmlEditor', HTMLEditor::class);

        $currentURL = URL::current();
        $exploded = explode('/lessons/', $currentURL);
        if(str_ends_with($exploded[1], '/edit')) {
            $currentLessonId = explode('/edit', $exploded[1])[0];
            $currentLesson = Lesson::find($currentLessonId)->create;
        } else {
            $currentLesson = null;
        }


        $form->text('name', __('Name'));
        $form->select('chapter_id', __('Chapters'))->options(function ($id) {
            $chapter = Chapter::find($id);

            if ($chapter) {
                return [$chapter->id => $chapter->name];
            }
        })->ajax('/admin/api/chapters');
        $form->text('intro', __('Intro'));
        $form->htmleditor('contentBtn', __('Content'), $currentLesson);
        $form->hidden('html');
        $form->hidden('css');
        $form->hidden('js');
        $form->hidden('content_json', __('Content JSON'));
        $form->switch('active', __('Active'))->default(1);
        $form->submitted(function (Form $form) {
            $form->ignore('contentBtn');
        });

        return $form;
    }

    public function tempLesson(Request $request)
    {
        $validated = $request->validate([
            'html' => 'required',
            'css' => 'required',
            'js' => 'required',
            'content_json' => 'required',
        ]);
        $lesson = Lesson::create([
            'html' => $validated['html'],
            'css' => $validated['css'],
            'js' => $validated['js'],
            'content_json' => $validated['content_json'],
            'active' => false,
        ]);
        return ['lessonId' => $lesson->id];
    }
}
