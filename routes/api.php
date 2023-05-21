<?php

use App\Http\Controllers\API\CoursesController;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Chart Route
Route::get('/chart-data', [ChartController::class, 'onAllSelect']);
//Client Route
Route::get('/client-review', [ClientReviewController::class, 'onAllSelect']);
//Contact Form Route
Route::post('/contact-send', [ContactController::class, 'onContactSend']);
//Course Route
Route::get('/course-home', [CoursesController::class, 'onSelectFour']);
Route::get('/course-all', [CoursesController::class, 'onSelectAll']);
Route::get('/course-details/{slug}', [CoursesController::class, 'onSelectDetails']);
//Footer Route
Route::get('/footer-data', [FooterController::class, 'onSelectAll']);
//Information Route
Route::get('/information', [InformationController::class, 'onSelectAll']);
//Services Route
Route::get('/services', [ServiceController::class, 'ServiceView']);
//Project Route
Route::get('/project-home', [ProjectController::class, 'onSelectThree']);
Route::get('/project-all', [ProjectController::class, 'onSelectAll']);
Route::post('/project-details', [ProjectController::class, 'onSelectDetails']);
//Home Route
Route::get('/home/title', [HomePageController::class, 'onSelectTitle']);
Route::get('/home/video', [HomePageController::class, 'onSelectVideo']);
Route::get('/home/total', [HomePageController::class, 'onSelectTotal']);
Route::get('/home/technical', [HomePageController::class, 'onSelectTech']);
//Lesson Route
Route::get('/course-details/{slug}/learn', [LessonController::class, 'getListLessonOfCourse']);

//Test Route
Route::get('/tests/{lesson}', [TestController::class, 'getTest']);
