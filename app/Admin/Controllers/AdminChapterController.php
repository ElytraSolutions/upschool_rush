<?php

namespace App\Admin\Controllers;

use App\Models\Chapter;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;
use OpenAdmin\Admin\Facades\Admin;

class AdminChapterController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Chapter';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Chapter());

        $grid->filter(function ($filter) {
            $filter->like('name', 'name');
        });

        $grid->model()->whereIn('id', function (\Illuminate\Database\Query\Builder $query) {
            $isAdministrator = Admin::user()->isAdministrator();
            $roles = Admin::user()->roles->pluck('slug');
            if ($isAdministrator) {
                $query->select('id')->from('chapters');
            } else if ($roles->contains('author')) {
                $query->select('id')->from('chapters')->whereIn('course_id', function (\Illuminate\Database\Query\Builder $query) {
                    $query->select('course_id as id')->from('course_author')->where('user_id', Admin::user()->id);
                });
            } else {
                dd($roles);
            }
            return $query;
        });

        // $grid->column('id', __('Id'))->sortable();
        $grid->column('name', __('Name'))->sortable();
        $grid->column('course.name', __('Course'));
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
        $show = new Show(Chapter::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('course.name', __('Course'));
        $show->field('priority', __('Priority'));
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
        $form = new Form(new Chapter());

        $courses = [];
        if (Admin::user()->isAdministrator()) {
            $courses = Course::all()->pluck('name', 'id');
        } else if (Admin::user()->roles->pluck('slug')->contains('author')) {
            $courses = Course::whereIn('id', function (\Illuminate\Database\Query\Builder $query) {
                $query->select('course_id as id')->from('course_author')->where('user_id', Admin::user()->id);
            })->pluck('name', 'id');
        } else {
            dd(Admin::user()->roles->pluck('slug'));
        }

        $form->text('name', __('Name'));
        $form->select('course_id', __('Course'))->options($courses);
        $form->number('priority', __('Priority'));
        $form->switch('active', __('Active'))->default(1);

        return $form;
    }

    public function chapters(Request $request)
    {
        $q = $request->get('q');
        return Chapter::where('name', 'like', "%$q%")->paginate(null, ['id', 'name as text']);
    }

    public function byCourseId(Request $request)
    {
        $course_id = $request->get('query');
        $lessons = Chapter::where('course_id', $course_id)->get(['id', DB::raw('name as text')]);
        return $lessons;
    }
}
