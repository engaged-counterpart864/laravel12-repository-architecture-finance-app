<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\BaseRequest;

/**
 * Delete File Request
 * 
 * Handles validation for file deletion requests from S3 storage.
 * Validates the file URL to ensure it's a valid S3 URL before deletion.
 * 
 * @package App\Http\Requests\Common
 * @version 1.0.0
 * 
 * @OA\Schema(
 *     schema="DeleteFileRequest",
 *     type="object",
 *     required={"file_url"},
 *     @OA\Property(
 *         property="file_url",
 *         type="string",
 *         format="uri",
 *         description="The complete URL of the file to delete from S3 storage",
 *         example="https://bucket.s3.amazonaws.com/uploads/image.jpg"
 *     )
 * )
 */
class DeleteFileRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file_url' => [
                'required',
                'string',
                'url',
                'regex:/^https:\/\/.*\.s3\..*\.amazonaws\.com\/.*$/', // Validate S3 URL format
            ],
        ];
    }
}
