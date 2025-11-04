<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;

Route::group(['middleware' => ['auth', 'user.type:0']], function () {
   Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

});
?>
