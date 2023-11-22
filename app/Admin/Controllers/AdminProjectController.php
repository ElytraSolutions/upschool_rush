<?php

namespace App\Admin\Controllers;

use App\Models\Project;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class AdminProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Project';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Project());

        $grid->filter(function ($filter) {
            $filter->like('name', 'name');
        });

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('intro', __('Intro'));
        $grid->column('active', __('Active'));

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
        $show = new Show(Project::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('active', __('Active'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Project());

        $form->text('name', __('Name'));
        $form->select('charity_id', __('Charity'))->options(\App\Models\Charity::all()->pluck('name', 'id'));
        $form->editor2('intro', __('Intro'));
        $form->editor2('description', __('Description'));
        $form->text('location', __('Location'));
        $form->text('genre', __('Genre'));
        $form->image('image', __('Image'));
        $form->image('thumbnail', __('Thumbnail'));
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
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }
}
