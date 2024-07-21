<?php

use Illuminate\Support\Facades\Route;
use App\Http\Helpers\ResponseJson;

Route::get('/', function () {
    return ResponseJson::success([], 'Up and running');
});
