<?php

namespace EzAdmin\Modules\System\Http\Controllers\Api\Admin\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use EzAdmin\Base\Controller;
use Illuminate\Support\Facades\Storage;
use EzAdmin\Support\Facades\Response;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    /**
     * @param Request $request
     */
    public function image(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:10240'],
        ], [
            'image.required' => '请上传图片',
            'image.image'    => '图片格式不符',
            'image.max'      => '图片大小超过10M',
        ]);

        $file = $request->image;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $admin_id = $request->user()->id;

        $filename = md5(Carbon::now()->getPreciseTimestamp(3)) . '.' . $extension;
        $file_path = 'images/admin/' . $admin_id;

        $path = $file->storeAs($file_path, $filename);
        return Response::success(['path' => Storage::url($path)]);
    }
}
