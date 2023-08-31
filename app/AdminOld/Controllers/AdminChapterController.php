<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Illuminate\Http\Request;

class AdminChapterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Chapter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Chapter());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('course.name', __('Course'));
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
        $show = new Show(Chapter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('course.name', __('Course'));
        $show->field('description', __('Description'));
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
        $form = new Form(new Chapter());

        $form->text('name', __('Name'));
        $form->text('description', __('Description'));
        $form->select('course_id', __('Course id'))->options(function ($id) {
            $course = Course::find($id);

            if ($course) {
                return [$course->id => $course->name];
            }
        })->ajax('/admin/api/courses');
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }

    public function chapters(Request $request)
    {
        $q = $request->get('q');
        return Chapter::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
