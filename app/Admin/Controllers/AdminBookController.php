<?php

namespace App\Admin\Controllers;

use App\Models\Book;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;

class AdminBookController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Book';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Book());

        $grid->filter(function ($filter) {
            $filter->like('title', 'title');
        });


        $grid->column('id', __('Id'))->sortable();
        $grid->column('title', __('Title'))->sortable();
        $grid->column('first_name', __('First name'));
        $grid->column('last_name', __('Last name'));
        $grid->column('is_featured', __('Featured'));
        $grid->column('is_best_seller', __('Best Seller'));
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
        $show = new Show(Book::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('description', __('Description'));
        $show->field('teacher_email', __('Teacher email'));
        $show->field('first_name', __('First name'));
        $show->field('last_name', __('Last name'));
        $show->field('school_name', __('School name'));
        $show->field('country', __('Country'));
        $show->field('age', __('Age'));
        $show->field('path', __('Path'));
        $show->field('canva_link', __('Canva link'));
        $show->field('thumbnail', __('Thumbnail'));
        $show->field('is_featured', __('Featured'));
        $show->field('is_best_seller', __('Best Seller'));
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
        $form = new Form(new Book());

        $form->text('title', __('Title'));
        $form->textarea('description', __('Description'));
        $form->text('teacher_email', __('Teacher email'));
        $form->text('first_name', __('First name'));
        $form->text('last_name', __('Last name'));
        $form->text('school_name', __('School name'));
        $form->text('country', __('Country'));
        $form->number('age', __('Age'));
        $form->select('source', __('Source'))->options(['upload' => 'Upload File', 'canva' => 'Canva']);
        $form->text('path', __('Path'));
        $form->text('canva_link', __('Canva link'));
        $form->image('thumbnail', __('Thumbnail'));
        $form->radio('is_featured', __('Featured'))->options(['YES' => 'YES', 'NO' => 'NO'])->default('NO');
        $form->radio('is_best_seller', __('Best Seller'))->options(['YES' => 'YES', 'NO' => 'NO'])->default('NO');;
        $form->switch('active', __('Active'));

        return $form;
    }
}
