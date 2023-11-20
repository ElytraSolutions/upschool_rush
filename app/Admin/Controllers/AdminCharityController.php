<?php

namespace App\Admin\Controllers;

use App\Models\Charity;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class AdminCharityController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Charity controller';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Charity());
        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', 'Name');
        $grid->column('slug', 'slug');
        $grid->column('website', 'Website');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Charity::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', 'Name');
        $show->field('slug', 'slug');
        $show->field('image', 'Image`');
        $show->field('website', 'Website');
        $show->field('facebook', 'Facebook');
        $show->field('instagram', 'Instagram');
        $show->field('linkedin', 'Linkedin');
        $show->field('description', 'Description');
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
        $form = new Form(new Charity());

        $form->display('id', __('ID'));
        $form->text('name', 'Name');
        $form->image('image', 'Image')->move('charityImages');
        $form->image('thumbnail', 'Thumbnail')->move('charityThumbnails');
        $form->url('website', 'Website');
        $form->url('facebook', 'Facebook');
        $form->url('instagram', 'Instagram');
        $form->url('linkedin', 'Linkedin');
        $form->ckeditor('description', 'Description');
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
