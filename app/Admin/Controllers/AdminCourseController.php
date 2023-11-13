<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use \App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Lesson;
use Database\Seeders\ChapterSeeder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Form\NestedForm;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class AdminCourseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Course';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Course());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
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
        $show = new Show(Course::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('courseCategory.name', __('Course Category'));
        $show->field('intro', __('Intro'));
        $show->field('tagline', __('Tagline'));
        $show->field('starredText', __('StarredText'));
        $show->field('description', __('Description'))->unescape()->as(function ($description) {
            $baseUrl = URL::to('/richContentView/' . $description);
            return '<a href="' . $baseUrl . '" target="_blank">View Description</a>';
        });
        $show->field('image', __('Image'))->image();
        $show->field('thubmnail', __('Thubmnail'));
        $show->field('theme', __('Theme'));
        $show->field('active', __('Active'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Course());

        preg_match('/courses\/([^\/]*)\/edit$/', URL::current(), $matches);
        // $descriptionId = Str::orderedUuid()->toString();

        $courseId = null;
        if (count($matches) == 2) {
            $courseId = $matches[1];
        }
        if ($courseId != null) {
            $course = Course::find($courseId);
            // if ($course->description) {
            //     $descriptionId = $course->description;
            // }
        } else {
            $courseId = 'test';
        }
        // $descriptionId = request()->query('richContentId', $descriptionId);

        // $form->hidden('description', __('Description'))->default($descriptionId);
        $form->text('id', __('Id'))->default($courseId)->readonly();
        $form->text('name', __('Name'));
        $form->text('intro', __('Intro'));
        $form->text('starredText', __('StarredText'));
        $form->color('theme', __('Theme Color'))->default('#F0FFF0');
        $form->image('thumbnail', __('Thumbnail'))->uniqueName()->move('courseThumbnails');
        $form->image('image', __('Image'))->uniqueName()->move('courseImages');
        $form->select('course_category_id', __('Course Category'))->options(CourseCategory::all()->pluck('name', 'id'));
        $form->text('tagline', __('Tagline'));
        // $form->htmleditor('contentBtn', __('Description'), ['form' => $form, 'id' => $descriptionId, 'queryParam' => 'richContentId']);
        $form->switch('active', __('Active'))->default(1);

        // $form->customHasMany('chapters', function (Form\NestedForm $nestedForm) {
        //     $nestedForm->text('name', __('Chapter Name'));
        //     $nestedForm->hidden('priority', __('Priority'));
        // })->mode('table');

        $form->saving(function (Form $form) {
            $form->ignore(['contentBtn']);
            // $chapters = [];
            // $priority = 1;
            // foreach ($form->chapters as $key => $chapter) {
            //     $chapter['priority'] = $priority;
            //     $chapters[$key] = $chapter;
            //     $priority += 5;
            // }
            // $form->chapters = $chapters;
        });

        return $form;
    }

    public function courses(Request $request)
    {
        $q = $request->get('q');
        return Course::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
