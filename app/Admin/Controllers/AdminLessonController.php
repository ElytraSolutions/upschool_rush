<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use App\Admin\Field\HTMLEditor;
use Illuminate\Http\Request;

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
        $grid->column('chapter.course.name', __('Course'));
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
        $show->column('chapter.course.name', __('Course'));
        $show->field('chapter.name', __('Chapter'));
        $show->field('priority', __('Priority'));
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
        // $form->extend('htmlEditor', HTMLEditor::class);

        // preg_match('/lessons\/([^\/]*)\/edit$/', URL::current(), $matches);
        // $id = Str::orderedUuid()->toString();
        // $lessonId = null;
        // if(count($matches) == 2) {
        //     $lessonId = $matches[1];
        // }
        // if($lessonId != null) {
        //     $lesson = Lesson::find($lessonId);
        //     if ($lesson->content) {
        //         $id = $lesson->content;
        //     }
        // } else if (request()->has('richContentId')) {
        //     $id = request()->input('richContentId');
        // }

        // $form->hidden('content', __('Content'))->default($id);
        $form->text('name', __('Name'));
        $form->select('course_id', __('Courses'))->options(Course::all()->pluck('name', 'id'));
        $form->select('chapter_id', __('Chapters'))->options(Chapter::where('course_id', $form->course_id)->pluck('name', 'id'));
        $form->number('priority', __('Priority'))->default(1);
        $form->switch('active', __('Active'))->default(1);

        $form->saving(function (Form $form) {
            $form->ignore('course_id');
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
