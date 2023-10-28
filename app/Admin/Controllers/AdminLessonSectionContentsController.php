<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form\CascadingSelect;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonSection;
use App\Models\LessonSectionContent;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;
use OpenAdmin\Admin\Form\NestedForm;

class AdminLessonSectionContentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson Section Content';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LessonSectionContent());

        $grid->column('id', __('Id'));
        $grid->column('lessonSection.name', __('Lesson Section'));
        $grid->column('type', __('Type'));
        $grid->column('content', __('Content'));
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
        $show->column('lesson_section.name', __('Lesson Section'));
        $show->column('priority', __('Priority'));
        $show->column('type', __('Type'));
        $show->column('content', __('Content'));
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
        $form = new Form(new LessonSectionContent());

        $form->customSelect('course_id', __('Courses'))->options(Course::all()->pluck('name', 'id'))->load('chapter_id', '/admin/api/chapters/byCourseId');
        $form->customSelect('chapter_id', __('Chapters'))->load('lesson_id', '/admin/api/lessons/byChapterId');
        $form->customSelect('lesson_id', __('Lessons'));
        $form->customSelect('lesson_section_id', __('Lesson Sections'))->options(LessonSection::all()->pluck('name', 'id'));
        $form->select('type', 'Type')->options([
            'image' => 'Image',
            'video' => 'Video',
            'flipbook' => 'Flipbook',
        ]);
        $form->select('source', __('Source'))->options([
            'local' => 'Local',
            'url' => 'URL',
        ]);
        $form->file('content', __('Content File'));
        // ->when('=', 'image', function (Form $form) {
        //     $form->select('source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->default('local')->when('=', 'local', function (Form $form) {
        //         $form->file('content', __('Content File'));
        //     })->when('=', 'url', function (Form $form) {
        //         $form->url('content', __('Content URL'));
        //     });
        // })->when('=', 'video', function (Form $form) {
        //     $form->select('name', __('Name'))->options(['Youtube' => 'Youtube', 'Vimeo' => 'Vimeo']);
        //     $form->select('source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->default('local')->when('=', 'local', function (Form $form) {
        //         $form->image('content', __('Content File'));
        //     })->when('=', 'url', function (Form $form) {
        //         $form->url('content', __('Content URL'));
        //     });
        // })->when('=', 'flipbook', function (Form $form) {
        //     $form->select('source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->default('local')->when('=', 'local', function (Form $form) {
        //         $form->file('content', __('Content File'));
        //     })->when('=', 'url', function (Form $form) {
        //         $form->url('content', __('Content URL'));
        //     });
        // });
        $form->number('priority', __('Priority'))->default(1);
        $form->switch('active', __('Active'))->default(1);


        $form->saving(function (Form $form) {
            $form->ignore(['course_id', 'chapter_id', 'lesson_id']);
        });
        $form->submitted(function (Form $form) {
            $form->ignore(['course_id', 'chapter_id', 'lesson_id']);
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
