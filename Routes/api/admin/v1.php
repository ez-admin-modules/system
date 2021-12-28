<?php

use EzAdmin\Modules\System\Http\Controllers\Api\Admin\V1\ConfigController;
use EzAdmin\Modules\System\Http\Controllers\Api\Admin\V1\UploadController;

Route::prefix('system')->name('system.')->group(function () {
    // 上传
    Route::prefix('upload')->name('upload.')->group(function () {
        Route::post('image', [UploadController::class, 'image']);
    });
    // 配置
    Route::get('configs', [ConfigController::class, 'index']);
    Route::post('configs', [ConfigController::class, 'store']);
    Route::get('configs/{config}', [ConfigController::class, 'show']);
    Route::put('configs/{config}', [ConfigController::class, 'update']);
    Route::delete('configs/{config}', [ConfigController::class, 'destroy']);
});
