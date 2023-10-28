<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form\CascadingSelect;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonSection;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;
use OpenAdmin\Admin\Form\NestedForm;

class AdminLessonSectionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson Sections';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LessonSection());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('lessons.name', __('Lesson'));
        $grid->column('priority', __('Priority'));
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
        $show = new Show(LessonSection::findOrFail($id));

        // $grid = new Grid(new LessonSection());

        $show->column('id', __('Id'));
        $show->column('name', __('Name'));
        $show->column('slug', __('Slug'));
        $show->column('lessons.name', __('Lesson'));
        $show->column('lessons.chapters.courses.name', __('Course'));
        $show->column('text', __('Text'));
        $show->column('priority', __('Priority'));
        $show->column('active', __('Active'))->display(function ($active) {
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
        $form = new Form(new LessonSection());

        $form->text('name', __('Name'));
        $form->customSelect('course_id', __('Courses'))->options(Course::all()->pluck('name', 'id'))->load('chapter_id', '/admin/api/chapters/byCourseId');
        $form->customSelect('chapter_id', __('Chapters'))->load('lesson_id', '/admin/api/lessons/byChapterId');
        $form->customSelect('lesson_id', __('Lessons'));
        $form->textarea('text', __('Text'));
        $form->textarea('teachers_note', __('Teachers Notes'));
        $form->number('priority', __('Priority'))->default(1);
        $form->switch('active', __('Active'))->default(1);

        // $form->hasMany('lessonSectionContents', function (NestedForm $nestedForm) {
        //     $nestedForm->text('name', __('Name'));
        //     $nestedForm->select('type', __('Type'))->options([
        //         'image' => 'Image',
        //         'video' => 'Video',
        //         'flipbook' => 'Flipbook',
        //     ])->default('video')->when('=', 'image', function (Form $form) {
        //         $form->select('source', __('Source'))->options([
        //             'local' => 'Local',
        //             'url' => 'URL',
        //         ])->default('local')->when('=', 'local', function (Form $form) {
        //             $form->file('content', __('Content File'));
        //         })->when('=', 'url', function (Form $form) {
        //             $form->text('content', __('Content URL'));
        //         });
        //     });
        // })->when('=', 'video', function (Form $form) {
        //     $form->select('source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->default('local')->when('=', 'local', function (Form $form) {
        //         $form->file('content', __('Content File'));
        //     })->when('=', 'url', function (Form $form) {
        //         $form->text('content', __('Content URL'));
        //     });
        // })->when('=', 'flipbook', function (Form $form) {
        //     $form->select('source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->default('local')->when('=', 'local', function (Form $form) {
        //         $form->file('content', __('Content File'));
        //     })->when('=', 'url', function (Form $form) {
        //         $form->text('content', __('Content URL'));
        //     });
        // });
        // })->mode('tab');

        $form->saving(function (Form $form) {
            $form->ignore('course_id');
            $form->ignore('chapter_id');
            $form->ignore('lessonSectionContents');
        });
        $form->submitted(function (Form $form) {
            $form->ignore('course_id');
            $form->ignore('chapter_id');
            $form->ignore('lessonSectionContents');
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
