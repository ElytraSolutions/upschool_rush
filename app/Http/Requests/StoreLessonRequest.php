<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        // Schema::create('lessons', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        //     $table->foreignIdFor(\App\Models\Chapter::class)->constrained();
        //     $table->string('name');
        //     $table->string('slug');
        //     $table->string('intro');
        //     $table->longText('content');
        //     $table->boolean('active')->default(true);
        // });
        return [
            //
            'chapter_id' => ['required', 'exists:chapters,id'],
            'name' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'active' => ['boolean'],
        ];
    }
}
