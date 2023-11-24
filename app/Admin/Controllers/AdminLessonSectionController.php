<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonSection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;
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

        $grid->filter(function ($filter) {
            $filter->like('name', 'name');
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('lessons.chapter.course.name', __('Course'));
        $grid->column('lessons.chapter.name', __('Chapter'));
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

        $form->customSelect('course_id', __('Courses'))->options(Course::all()->pluck('name', 'id'))->load('chapter_id', '/admin/api/chapters/byCourseId');
        $form->customSelect('chapter_id', __('Chapters'))->load('lesson_id', '/admin/api/lessons/byChapterId');
        $form->customSelect('lesson_id', __('Lessons'));
        $form->text('name', __('Name'));
        $form->textarea('teachers_note', __('Teachers Notes'));
        $form->editor2('text', __('Text'));
        $form->number('priority', __('Priority'))->default(1);
        $form->switch('active', __('Active'))->default(1);

        $form->hasMany('lessonSectionContents', 'Lesson Section Contents', function (NestedForm $form) {
            $form->select('type', 'Type')->options([
                'image' => 'Image',
                'video' => 'Video',
                'flipbook' => 'Flipbook',
            ]);
            $form->select('name', __('Name'))->options(['Youtube' => 'Youtube', 'Vimeo' => 'Vimeo']);
            $form->image('image_content', __('Image Content'));
            $form->url('video_content', __('Video Content'));
            $form->file('flipbook_content', __('Flipbook Content'))->uniqueName()->move('unprocesed-flipbooks');
        })->mode('tab');

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

    public function byLessonId(Request $request)
    {
        $lesson_id = $request->get('query');
        $lesson = Lesson::find($lesson_id);
        if (!$lesson) {
            return response()->json(['message' => 'Could not find lesson'], 404);
        }
        $lessonSections = LessonSection::where('lesson_id', $lesson_id)->get(['id', DB::raw('name as text')]);
        return (new Response($lessonSections))->header('Content-Type', 'application/json');
    }
}
