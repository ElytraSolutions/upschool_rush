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

        // $grid->column('id', __('Description id'));
        $grid->column('course.name', __('Course'))->sortable();

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
        $show->field('course_id', __('Course id'));
        $show->field('title', __('Title'));
        $show->field('subtitle', __('Subtitle'));
        $show->field('description', __('Description'));
        $show->field('testimonials', __('Testimonials'));
        $show->field('objectives', __('Objectives'));
        $show->field('steps', __('Steps'));
        $show->field('faq', __('Faq'));
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
        $form = new Form(new CourseDescription());

        $form->select('course_id', __('Course'))->options(Course::all()->pluck('name', 'id'));
        $form->text('title', __('Title'))->default('About this course');
        $form->text('subtitle', __('Subtitle'));
        $form->table('sustainability_details', __('Sustainability details'), function ($form) {
            $form->select('Goal')->options([
                '/sustainabilityGoals/goal1.png' => 'No Poverty',
                '/sustainabilityGoals/goal2.png' => 'Zero Hunger',
                '/sustainabilityGoals/goal3.png' => 'Good Health and Well-being',
                '/sustainabilityGoals/goal4.png' => 'Quality Education',
                '/sustainabilityGoals/goal5.png' => 'Gender Equality',
                '/sustainabilityGoals/goal6.png' => 'Clean Water and Sanitation',
                '/sustainabilityGoals/goal7.png' => 'Affordable and Clean Energy',
                '/sustainabilityGoals/goal8.png' => 'Decent Work and Economic Growth',
                '/sustainabilityGoals/goal9.png' => 'Industry, Innovation and Infrastructure',
                '/sustainabilityGoals/goal10.png' => 'Reduced Inequality',
                '/sustainabilityGoals/goal11.png' => 'Sustainable Cities and Communities',
                '/sustainabilityGoals/goal12.png' => 'Responsible Consumption and Production',
                '/sustainabilityGoals/goal13.png' => 'Climate Action',
                '/sustainabilityGoals/goal14.png' => 'Life Below Water',
                '/sustainabilityGoals/goal15.png' => 'Life on Land',
                '/sustainabilityGoals/goal16.png' => 'Peace and Justice Strong Institutions',
                '/sustainabilityGoals/goal17.png' => 'Partnerships to achieve the Goal',
            ]);
        });
        $form->editor2('description', __('Description'));
        $form->editor2('testimonials', __('Testimonials'));
        $form->editor2('objectives', __('Objectives'));
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
