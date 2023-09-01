<?php

namespace App\Admin\Controllers;

use App\Models\RichContent;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RichContentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'RichContent';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RichContent());

        $grid->column('id', __('Id'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->column('html', __('Html'));
        $grid->column('css', __('Css'));
        $grid->column('js', __('Js'));
        $grid->column('project_data', __('Project data'));

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
        $show = new Show(RichContent::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));
        $show->field('html', __('Html'));
        $show->field('css', __('Css'));
        $show->field('js', __('Js'));
        $show->field('project_data', __('Project data'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RichContent());

        $form->textarea('html', __('Html'));
        $form->textarea('css', __('Css'));
        $form->textarea('js', __('Js'));
        $form->textarea('project_data', __('Project data'));

        return $form;
    }

    public function store()
    {
        return RichContent::create([
            'id' => request()->uuid ?? Str::uuid(),
            'html' => request()->html ?? '',
            'css' => request()->css ?? '',
            'js' => request()->js ?? '',
            'project_data' => request()['project_data'] ?? '',
        ]);
    }
}
