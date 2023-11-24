<?php

namespace App\Admin\Controllers;

use App\Models\CourseCategory;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;

class AdminCourseCategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'CourseCategory';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CourseCategory());

        $grid->filter(function ($filter) {
            $filter->like('name', 'name');
        });

        // $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'))->sortable();

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
        $show = new Show(CourseCategory::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('description', __('Description'));
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
        $form = new Form(new CourseCategory());

        $form->text('name', __('Name'));
        $form->textarea('description', __('Description'));

        return $form;
    }

    protected function courseCategories(Request $request)
    {
        $q = $request->get('q');

        return CourseCategory::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }
}
