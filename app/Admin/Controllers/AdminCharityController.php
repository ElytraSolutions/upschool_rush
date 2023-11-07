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

        $show->column('id', __('ID'));
        $show->column('name', 'Name');
        $show->column('slug', 'slug');
        $show->column('image', 'Image`');
        $show->column('website', 'Website');
        $show->column('facebook', 'Facebook');
        $show->column('instagram', 'Instagram');
        $show->column('linkedin', 'Linkedin');
        $show->column('description', 'Description');
        $show->column('created_at', __('Created at'));
        $show->column('updated_at', __('Updated at'));

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
        $form->image('image', 'Image');
        $form->url('website', 'Website');
        $form->url('facebook', 'Facebook');
        $form->url('instagram', 'Instagram');
        $form->url('linkedin', 'Linkedin');
        $form->textarea('description', 'Description');
        $form->display('created_at', __('Created At'));
        $form->display('updated_at', __('Updated At'));

        return $form;
    }
}
