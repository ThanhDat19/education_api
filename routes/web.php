<?php

use Illuminate\Foundation\Application;
use Inertia\Inertia;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\YouTubeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
#Upload
Route::post('upload/services', [UploadController::class, 'store']);
#Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
#Course
Route::get('/admin/course/add', [CourseController::class, 'create']);
Route::post('/admin/course/add', [CourseController::class, 'store']);
Route::get('/admin/course/list', [CourseController::class, 'index']);
Route::get('/admin/course/edit/{course}', [CourseController::class, 'show']);
Route::post('/admin/course/edit/{course}', [CourseController::class, 'update']);
Route::delete('/admin/course/destroy', [CourseController::class, 'delete']);
#Course Category
Route::get('/admin/course-category/add', [CourseCategoryController::class, 'create']);
Route::post('/admin/course-category/add', [CourseCategoryController::class, 'store']);
Route::get('/admin/course-category/list', [CourseCategoryController::class, 'index']);
Route::get('/admin/course-category/edit/{category}', [CourseCategoryController::class, 'show']);
Route::post('/admin/course-category/edit/{category}', [CourseCategoryController::class, 'update']);
Route::delete('/admin/course-category/destroy', [CourseCategoryController::class, 'delete']);
#Lesson
Route::get('/admin/lesson/add/{course}', [LessonController::class, 'create']);
Route::post('/admin/lesson/add/{course}', [LessonController::class, 'store']);
Route::get('/admin/lesson/list/{course}', [LessonController::class, 'index'])->name('course.lesson');
Route::get('/admin/lesson/edit/{lesson}/{course}', [LessonController::class, 'show']);
Route::post('/admin/lesson/edit/{lesson}/{course}', [LessonController::class, 'update']);
Route::delete('/admin/lesson/destroy', [LessonController::class, 'delete']);
#Test
Route::get('/admin/tests/add', [TestController::class, 'create']);
Route::post('/admin/tests/add', [TestController::class, 'store']);
Route::get('/admin/tests/list', [TestController::class, 'index']);
Route::get('/admin/tests/edit/{test}', [TestController::class, 'show']);
Route::post('/admin/tests/edit/{test}', [TestController::class, 'update']);
Route::delete('/admin/tests/destroy', [TestController::class, 'delete']);
Route::post('/admin/tests/get-lesson-of-course',[TestController::class, 'getLessonOfCourse'])->name('get.lessons');
#Question
Route::get('/admin/questions/add', [QuestionController::class, 'create']);
Route::post('/admin/questions/add', [QuestionController::class, 'store']);
Route::get('/admin/questions/list', [QuestionController::class, 'index']);
Route::get('/admin/questions/edit/{question}', [QuestionController::class, 'show']);
Route::put('/admin/questions/edit/{question}', [QuestionController::class, 'update']);
Route::delete('/admin/questions/destroy', [QuestionController::class, 'delete']);
#Option
Route::get('/admin/options/add/{question}', [OptionController::class, 'create']);
Route::post('/admin/options/add/{question}', [OptionController::class, 'store']);
Route::get('/admin/options/list/{question}', [OptionController::class, 'index'])->name('question.options');
Route::get('/admin/options/edit/{option}/{question}', [OptionController::class, 'show']);
Route::put('/admin/options/edit/{option}/{question}', [OptionController::class, 'update']);
Route::delete('/admin/options/destroy', [OptionController::class, 'delete']);
#Youtube
Route::get('/youtube-duration', [YouTubeController::class, 'getVideoDuration']);
