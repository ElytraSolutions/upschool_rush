<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use App\Models\CourseCategory;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

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

        $form->text('name', __('Name'));
        $form->select('course_category_id', __('Course Category'))->options(function ($id) {
            $courseCategory = CourseCategory::find($id);

            if ($courseCategory) {
                return [$courseCategory->id => $courseCategory->name];
            }
        })->ajax('/admin/api/courseCategories');
        $form->text('intro', __('Intro'));
        $form->htmleditor('contentBtn', __('Description'));
        $form->text('tagline', __('Tagline'));
        $form->text('starredText', __('StarredText'));
        $form->text('theme', __('Theme'))->default('#F0FFF0');
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
