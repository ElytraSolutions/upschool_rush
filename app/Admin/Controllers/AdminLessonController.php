<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminLessonController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lesson());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('chapter.name', __('Chapter'));
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
        $show = new Show(Lesson::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('chapter.name', __('Chapter'));
        $show->field('intro', __('Intro'));
        $show->field('content', __('Content'));
        $show->field('active', __('Active'))->display(function ($active) {
            return ($active == 1) ? 'Yes' : 'No';
        });
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
        $form = new Form(new Lesson());

        $form->text('name', __('Name'));
        $form->select('chapter_id', __('Chapter'))->options(function ($id) {
            $chapter = Chapter::find($id);

            if ($chapter) {
                return [$chapter->id => $chapter->name];
            }
        })->ajax('/admin/api/chapters');
        $form->text('intro', __('Intro'));
        $form->textarea('content', __('Content'));
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }
}
