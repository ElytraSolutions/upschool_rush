<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
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

        $grid->filter(function ($filter) {
            $filter->like('name', 'name');
        });

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'))->sortable();
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

        $form->tab('Lesson Data', function (Form $form) {
            $form->select('course_id', __('Courses'))->options(Course::all()->pluck('name', 'id'))->load('chapter_id', '/admin/api/chapters/byCourseId');
            $form->select('chapter_id', __('Chapters'));
            $form->text('name', __('Name'));
            $form->number('priority', __('Priority'))->default(1);
            $form->switch('active', __('Active'))->default(1);
        });

        // $form->tab('Lesson Contents', function (Form $form) {
        //     $form->hasMany('lessonSections', __('Sections'), function (Form\NestedForm $nestedForm) {
        //         $nestedForm->text('name', __('Name'));
        //         $nestedForm->textarea('text', __('Text'));
        //         $nestedForm->number('priority', __('Priority'))->default(1);
        //         $nestedForm->switch('active', __('Active'))->default(1);
        //     });
        // });

        $form->saving(function (Form $form) {
            $form->ignore('course_id');
        });
        $form->submitted(function (Form $form) {
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

    public function byChapterId(Request $request)
    {
        $chapter_id = $request->get('query');
        $lessons = Lesson::where('chapter_id', $chapter_id)->get(['id', DB::raw('name as text')]);
        // dd($lessons);
        return (new Response($lessons))->header('Content-Type', 'application/json');
    }

    public function byCourseId(Request $request)
    {
        $course_id = $request->get('query');
        $lessons = DB::table('lessons')
            ->join('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->where('chapters.course_id', '=', $course_id)
            ->select(DB::raw('lessons.id as id'), DB::raw('lessons.name as text'))
            ->get();
        // dd($lessons);
        return (new Response($lessons))->header('Content-Type', 'application/json');
    }
}
