<?php

namespace App\Admin\Controllers;

use App\Admin\Extensions\Form\CascadingSelect;
use App\Jobs\ProcessFlipbookJob;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\FlipBookJobStatus;
use App\Models\Lesson;
use App\Models\LessonSection;
use App\Models\LessonSectionContent;
use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use OpenAdmin\Admin\Form\NestedForm;
use OpenAdmin\Admin\Facades\Admin;

class AdminLessonSectionContentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Lesson Section Content';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LessonSectionContent());

        $grid->model()->whereIn('lesson_section_id', function (\Illuminate\Database\Query\Builder $query) {
            $isAdministrator = Admin::user()->isAdministrator();
            $roles = Admin::user()->roles->pluck('slug');
            if ($isAdministrator) {
                $query->select('id')->from('lesson_section_contents');
            } else if ($roles->contains('author')) {
                $query->select('id')->from('lesson_section_contents')->whereIn('lesson_section_id', function (\Illuminate\Database\Query\Builder $query) {
                    $query->select('id')->from('lesson_sections')->whereIn('lesson_id', function (\Illuminate\Database\Query\Builder $query) {
                        $query->select('id')->from('lessons')->whereIn('chapter_id', function (\Illuminate\Database\Query\Builder $query) {
                            $query->select('id')->from('chapters')->whereIn('course_id', function (\Illuminate\Database\Query\Builder $query) {
                                $query->select('course_id as id')->from('course_author')->where('user_id', Admin::user()->id);
                            });
                        });
                    });
                });
            } else {
                dd($roles);
            }
            return $query;
        });

        $grid->column('lessonSection', __('Lesson Section'))->display(function ($lessonSection) {
            return $this->lessonSection->name || $this->lessonSection->id;
        });
        $grid->column('lesson', __('Lesson Name'))->display(function () {
            if ($this->lessonSection !== null && $this->lessonSection->lessons != null) {
                return $this->lessonSection->lessons->name;
            }
        });
        $grid->column('chapter', __('Chapter Name'))->display(function () {
            if ($this->lessonSection !== null && $this->lessonSection->lessons != null && $this->lessonSection->lessons->chapter != null) {
                return $this->lessonSection->lessons->chapter->name;
            }
        });
        $grid->column('course', __('Course Name'))->display(function () {
            if ($this->lessonSection !== null && $this->lessonSection->lessons != null && $this->lessonSection->lessons->chapter != null && $this->lessonSection->lessons->chapter->course != null) {
                return $this->lessonSection->lessons->chapter->course->name;
            }
        });
        $grid->column('type', __('Type'));
        $grid->column('priority', __('Priority'));
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
        $show = new Show(LessonSection::findOrFail($id));

        // $grid = new Grid(new LessonSection());

        $show->column('id', __('Id'));
        $show->column('lesson_section.name', __('Lesson Section'));
        $show->column('priority', __('Priority'));
        $show->column('type', __('Type'));
        $show->column('active', __('Active'))->display(function ($active) {
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
    protected function form($lessonId = null)
    {
        $form = new Form(new LessonSectionContent());

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

        $form->customSelect('course_id', __('Courses'))->options($courses)->load('chapter_id', '/admin/api/chapters/byCourseId');
        $form->customSelect('chapter_id', __('Chapters'))->load('lesson_id', '/admin/api/lessons/byChapterId');
        $form->customSelect('lesson_id', __('Lessons'))->load('lesson_section_id', '/admin/api/lesson-sections/byLessonId');
        $form->customSelect('lesson_section_id', __('Lesson Sections'));
        $form->select('type', 'Type')->options([
            'image' => 'Image',
            'video' => 'Video',
            'flipbook' => 'Flipbook',
        ]);
        $form->select('name', __('Name'))->options(['Youtube' => 'Youtube', 'Vimeo' => 'Vimeo']);
        $form->image('image_content', __('Image Content'));
        $form->url('video_content', __('Video Content'));
        $form->file('flipbook_content', __('Flipbook Content'))->uniqueName()->move('unprocesed-flipbooks');
        // ->when('image', function (Form $form) {
        //     $form->select('image_source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->when('local', function (Form $form) {
        //         $form->image('local_image', __('Content File'));
        //     })->when('url', function (Form $form) {
        //         $form->url('image_url', __('Content URL'));
        //     });
        // })->when('flipbook', function (Form $form) {
        //     $form->select('flipbook_source', __('Source'))->options([
        //         'local' => 'Local',
        //         'url' => 'URL',
        //     ])->when('local', function (Form $form) {
        //         $form->file('local_flipbook', __('Content File'));
        //     })->when('url', function (Form $form) {
        //         $form->url('url_flipbook', __('Content URL'));
        //     });
        // })->when('video', function (Form $form) {
        //     $form->select('name', __('Name'))->options(['Youtube' => 'Youtube', 'Vimeo' => 'Vimeo']);
        //     $form->url('video_url', __('Content URL'));
        // });
        // $form->file('content', __('Content'));

        $form->number('priority', __('Priority'))->default(1);
        $form->switch('active', __('Active'))->default(1);

        $form->saving(function (Form $form) {
            // if ($form->type == 'image') {
            //     if ($form->image_source == 'local') {
            //         $form->content = clone $form->local_image;
            //     } else if ($form->image_source == 'url') {
            //         $form->content = $form->image_url;
            //     }
            // } else if ($form->type == 'flipbook') {
            //     if ($form->flipbook_source == 'local') {
            //         $form->content = $form->local_flipbook;
            //     } else if ($form->flipbook_source == 'url') {
            //         $form->content = $form->url_flipbook;
            //     }
            // } else if ($form->type == 'video') {
            //     $form->content = $form->video_url;
            // }
            // dd($form);
            // $form->ignore(['course_id', 'chapter_id', 'lesson_id', 'image_source', 'local_image', 'image_url', 'flipbook_source', 'local_flipbook', 'url_flipbook1', 'video_url',]);
        });
        $form->submitted(function (Form $form) {
            // if ($form->type == 'image') {
            //     if ($form->image_source == 'local') {
            //         $form->content = clone $form->local_image;
            //     } else if ($form->image_source == 'url') {
            //         $form->content = $form->image_url;
            //     }
            // } else if ($form->type == 'flipbook') {
            //     if ($form->flipbook_source == 'local') {
            //         $form->content = $form->local_flipbook;
            //     } else if ($form->flipbook_source == 'url') {
            //         $form->content = $form->url_flipbook;
            //     }
            // } else if ($form->type == 'video') {
            //     $form->content = $form->video_url;
            // }
            $form->ignore(['course_id', 'chapter_id', 'lesson_id']);
            // $form->ignore(['course_id', 'chapter_id', 'lesson_id', 'image_source', 'local_image', 'image_url', 'flipbook_source', 'local_flipbook', 'url_flipbook', 'video_url',]);
        });

        $form->saved(function (Form $form) {
            $model = $form->model();
            if ($model->type === 'flipbook') {
                $sourceFile = $model->flipbook_content;
                if (!$sourceFile || !Storage::exists($sourceFile)) {
                    return;
                }
                $outputFolder = 'flipbooks/' . $model->id;
                $flipbookJob = FlipBookJobStatus::create([
                    'uploaded_by' => auth()->user()->id,
                    'source_file' => $sourceFile,
                    'destination_folder' => $outputFolder,
                    'status' => 'pending',
                ]);
                ProcessFlipbookJob::dispatch($flipbookJob);
                $model->flipbook_content = $outputFolder;
                $model->save();
                Log::info(json_encode([
                    'id' => $model->id,
                    'sourceFile' => $sourceFile,
                    'outputFolder' => $outputFolder,
                ]));
            }
        });

        return $form;
    }

    public function tempLesson(Request $request)
    {
        $validated = $request->validate([
            'html' => 'required',
            'css' => 'required',
            'js' => 'required',
            'content_json' => 'required',
        ]);
        $lesson = Lesson::create([
            'html' => $validated['html'],
            'css' => $validated['css'],
            'js' => $validated['js'],
            'content_json' => $validated['content_json'],
            'active' => false,
        ]);
        return ['lessonId' => $lesson->id];
    }
}
