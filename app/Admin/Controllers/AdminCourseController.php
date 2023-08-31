<?php

namespace App\Admin\Controllers;

use \App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
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
        $show->field('description', __('Description'));
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
        // dd(Form::$availableFields['htmleditor1']);

        $form->hidden('uuid')->default(Str::orderedUuid());
        $form->text('name', __('Name'));
        $form->select('course_category_id', __('Course Category'))->options(CourseCategory::all()->pluck('name', 'id'));
        $form->text('intro', __('Intro'));
        $form->htmleditor1('contentBtn', __('Description'), ['form' => $form]);
        $form->text('tagline', __('Tagline'));
        $form->text('starredText', __('StarredText'));
        $form->color('theme', __('Theme'))->default('#F0FFF0');
        $form->image('image', __('Image'));
        $form->image('thubmnail', __('Thubmnail'));
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }

    public function courses(Request $request)
    {
        $q = $request->get('q');
        return Course::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
