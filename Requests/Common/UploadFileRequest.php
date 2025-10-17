<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\File;

/**
 * Upload File Request
 * 
 * Handles validation for file upload requests including image files
 * with proper size limits and file type restrictions.
 * 
 * @package App\Http\Requests\Common
 * @version 1.0.0
 * 
 * @OA\Schema(
 *     schema="UploadFileRequest",
 *     type="object",
 *     required={"file"},
 *     @OA\Property(
 *         property="file",
 *         type="string",
 *         format="binary",
 *         description="The file to upload. Supported formats: jpg, jpeg, png, gif, webp, svg. Maximum size: 10MB",
 *         example="image.jpg"
 *     ),
 *     @OA\Property(
 *         property="folder",
 *         type="string",
 *         maxLength=255,
 *         description="Optional folder path where the file should be stored. Only alphanumeric characters, forward slash, dash, and underscore are allowed.",
 *         example="uploads/images/profile"
 *     ),
 *     @OA\Property(
 *         property="file_name",
 *         type="string",
 *         maxLength=255,
 *         description="Optional custom name for the uploaded file. If not provided, original filename will be used.",
 *         example="profile-picture-123"
 *     ),
 *     @OA\Property(
 *         property="override",
 *         type="boolean",
 *         description="Whether to override existing file if it already exists.",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="create_thumbnail",
 *         type="boolean",
 *         description="Whether to create a thumbnail version of the uploaded image.",
 *         example=true
 *     )
 * )
 */
class UploadFileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                File::types(['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])
                    ->max(10 * 1024),
            ],
            'folder' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Z0-9\/\-_]+$/', // Only allow alphanumeric, forward slash, dash, and underscore
            ],
            'file_name' => [
                'required',
                'string',
                'max:255',
            ],
            'override' => [
                'sometimes',
                'boolean',
            ],
            'create_thumbnail' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    public function prepareForValidation(): void
    {
        $this->merge([
            'folder' => $this->input('folder', 'uploads'),
            'file_name' => $this->input('file_name', null),
            'override' => filter_var($this->input('override', false), FILTER_VALIDATE_BOOLEAN),
            'create_thumbnail' => filter_var($this->input('create_thumbnail', false), FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
