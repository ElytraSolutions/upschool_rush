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

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('name', __('Name'));
        $grid->column('intro', __('Intro'));
        $grid->column('description', __('Description'));
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
        $form->text('intro', __('Intro'));
        $form->textarea('description', __('Description'));
        $form->text('location', __('Location'));
        $form->text('genre', __('Genre'));
        $form->image('image', __('Image'));
        $form->image('thumbnail', __('Thumbnail'));
        $form->table('sustainability_details', __('Sustainability details'), function ($form) {
            $form->file('Image');
            $form->number('Priority');
        });
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }
}
