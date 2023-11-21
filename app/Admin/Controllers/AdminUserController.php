<?php

namespace App\Admin\Controllers;

use App\Models\User;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class AdminUserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->filter(function ($filter) {
            $filter->like('email', 'Email');
            $filter->like('first_name', 'First Name');
            $filter->like('last_name', 'Last Name');
        });

        $grid->column('id', __('Id'));
        $grid->column('email', __('Email'));
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('country', __('Country'));
        $grid->column('type.name', __('User type'));
        $grid->column('is_admin', __('Is admin'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('country', __('Country'));
        $show->field('date_of_birth', __('Date of birth'));
        $show->field('user_type_id', __('User type id'));
        $show->field('is_admin', __('Is admin'));
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
        $form = new Form(new User());

        $form->email('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('Password'));
        $form->text('remember_token', __('Remember token'));
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->text('country', __('Country'));
        $form->date('date_of_birth', __('Date of birth'))->default(date('Y-m-d'));
        $form->number('user_type_id', __('User type id'));
        $form->switch('is_admin', __('Is admin'));

        return $form;
    }
}
