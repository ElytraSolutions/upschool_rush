<?php

namespace App\Admin\Controllers;

use App\Models\Course;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\CourseDescription;

class AdminCourseDescriptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CourseDescription';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CourseDescription());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('subtitle', __('Subtitle'));
        $grid->column('description', __('Description'));
        $grid->column('testimonials', __('Testimonials'));
        $grid->column('objectives', __('Objectives'));
        $grid->column('steps', __('Steps'));
        $grid->column('faq', __('Faq'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('course_id', __('Course id'));

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
        $show = new Show(CourseDescription::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('subtitle', __('Subtitle'));
        $show->field('description', __('Description'));
        $show->field('testimonials', __('Testimonials'));
        $show->field('objectives', __('Objectives'));
        $show->field('steps', __('Steps'));
        $show->field('faq', __('Faq'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('course_id', __('Course id'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CourseDescription());

        $form->select('course_id', __('Course'))->options(Course::all()->pluck('name', 'id'));
        $form->text('title', __('Title'))->default('About this course');
        $form->text('subtitle', __('Subtitle'));
        $form->ckeditor('description', __('Description'));
        $form->ckeditor('testimonials', __('Testimonials'));
        $form->ckeditor('objectives', __('Objectives'));
        $form->table('steps', __('Steps'), function ($table) {
            $table->file('image');
            $table->textarea('data');
        });
        $form->table('faq', __('Faq'), function ($table) {
            $table->text('question');
            $table->textarea('answer');
        });


        return $form;
    }
}
