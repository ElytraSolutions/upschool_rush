<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('intro', __('Intro'));
        $grid->column('starredText', __('StarredText'));
        $grid->column('image', __('Image'));
        $grid->column('theme', __('Theme'));
        $grid->column('description', __('Description'));
        $grid->column('active', __('Active'));
        $grid->column('course_category_id', __('Course category id'));
        $grid->column('tagline', __('Tagline'));
        $grid->column('thubmnail', __('Thubmnail'));

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
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('intro', __('Intro'));
        $show->field('starredText', __('StarredText'));
        $show->field('image', __('Image'));
        $show->field('theme', __('Theme'));
        $show->field('description', __('Description'));
        $show->field('active', __('Active'));
        $show->field('course_category_id', __('Course category id'));
        $show->field('tagline', __('Tagline'));
        $show->field('thubmnail', __('Thubmnail'));

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
        $form->text('slug', __('Slug'));
        $form->text('intro', __('Intro'));
        $form->text('starredText', __('StarredText'));
        $form->image('image', __('Image'));
        $form->text('theme', __('Theme'))->default('#F0FFF0');
        $form->textarea('description', __('Description'));
        $form->switch('active', __('Active'))->default(1);
        $form->number('course_category_id', __('Course category id'));
        $form->text('tagline', __('Tagline'));
        $form->text('thubmnail', __('Thubmnail'));

        return $form;
    }
}
