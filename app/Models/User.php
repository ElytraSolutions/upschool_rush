<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'first_name',
        'last_name',
        'country',
        'date_of_birth',
        'user_type_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'date_of_birth' => 'date',
        'is_admin' => 'boolean',
    ];

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function isTeacher(): bool
    {
        $teacherId = UserType::where('name', 'School Teacher')->first()->id;
        return $this->user_type_id === $teacherId;
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * Get avatar attribute.
     *
     * @param string $avatar
     *
     * @return string
     */
    public function getAvatarAttribute($avatar)
    {
        if (url()->isValidUrl($avatar)) {
            return $avatar;
        }

        $disk = config('admin.upload.disk');

        if ($avatar && array_key_exists($disk, config('filesystems.disks'))) {
            return Storage::disk(config('admin.upload.disk'))->url($avatar);
        }

        $default = config('admin.default_avatar') ?: '/vendor/open-admin/open-admin/gfx/user.svg';

        return admin_asset($default);
    }

    /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $pivotTable = config('admin.database.role_users_table');

        $relatedModel = config('admin.database.roles_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'role_id');
    }

    /**
     * A User has and belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        $pivotTable = config('admin.database.user_permissions_table');

        $relatedModel = config('admin.database.permissions_model');

        return $this->belongsToMany($relatedModel, $pivotTable, 'user_id', 'permission_id');
    }

    /**
     * A user has many courses.
     *
     * @return BelongsToMany
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_enrollments');
    }

    /**
     * A user has many course completions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function courseCompletions()
    {
        return DB::table('courses')
            ->selectRaw('courses.id, courses.name, courses.slug, courses.image, course.thumbnail')
            ->join('course_enrollments', 'course_enrollments.course_id', '=', 'courses.id')
            ->leftJoin('chapters', 'chapters.course_id', '=', 'courses.id')
            ->leftJoin('lessons', 'lessons.chapter_id', '=', 'chapters.id')
            ->leftJoin('lesson_completions', 'lesson_completions.lesson_id', '=', 'lessons.id')
            ->groupBy('courses.id', 'courses.name', 'courses.slug', 'courses.image', 'course.thumbnail')
            ->havingRaw('count(lessons.id) = count(lesson_completions.id)')
            ->get();
    }

    /**
     * Get last chapter completed by user for a specific course
     */
    public function lastCompletedLesson(Course $course)
    {
        $result = DB::table('courses')
            ->selectRaw('lessons.id, lessons.name, lessons.slug, lessons.chapter_id, lesson_completions.created_at')
            ->leftJoin('chapters', 'chapters.course_id', '=', 'courses.id')
            ->leftJoin('lessons', 'lessons.chapter_id', '=', 'chapters.id')
            ->join('lesson_completions', 'lesson_completions.lesson_id', '=', 'lessons.id')
            ->orderByRaw('chapters.priority DESC, lessons.priority DESC')
            ->where('courses.id', $course->getAttribute('id'))
            ->where('lesson_completions.user_id', $this->getAttribute('id'))
            ->first();
        return $result;
    }
}
