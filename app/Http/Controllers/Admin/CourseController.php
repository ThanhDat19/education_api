<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Courses;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Courses::paginate(10);
        return view('admin.course.list', [
            'title' => 'Danh Sách Khóa Học',
            'courses' => $courses
        ]);
    }

    public function create()
    {
        $courseCategories = CourseCategory::all();
        return view('admin.course.add', [
            'title' => 'Thêm Khóa Học',
            'categories' => $courseCategories
        ]);
    }

    public function store(Request $request)
    {

        $timestamp = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->timestamp;
        $datetime = DateTime::createFromFormat('U', $timestamp);
        Courses::create([
            "instructor" => Auth::user()->id,
            "course_category_id" => $request->input('course_category_id'),
            "title" => $request->input('title'),
            "slug" => Str::slug($request->input('title'), '-'),
            "description" => $request->input('description'),
            "price" => $request->input('price'),
            "course_image" => $request->input('image'),
            "start_date" => $datetime->format('Y-m-d H:i:s'),
            "published" => $request->input('published'),
        ]);
        try {

            Session::flash('success', 'Thêm khóa học mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }

        return redirect()->back();
    }


    public function show(Courses $course)
    {
        $courseCategories = CourseCategory::all();
        return view('admin.course.edit', [
            'title' => 'Chỉnh Sửa Khóa Học ' . $course->title,
            'course' => $course,
            'categories' => $courseCategories
        ]);
    }

    public function update(Request $request, Courses $course)
    {
        $timestamp = Carbon::createFromFormat('d-m-Y', $request->input('start_date'))->timestamp;
        $datetime = DateTime::createFromFormat('U', $timestamp);
        $course->fill([
            "instructor" => Auth::user()->id,
            "course_category_id" => $request->input('course_category_id'),
            "title" => $request->input('title'),
            "slug" => Str::slug($request->input('title'), '-'),
            "description" => $request->input('description'),
            "price" => $request->input('price'),
            "course_image" => $request->input('image'),
            "start_date" => $datetime->format('Y-m-d H:i:s'),
            "published" => $request->input('published'),
        ]);
        $course->save();
        try {

            Session::flash('success', 'Cập nhật khóa học thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }

        return redirect()->back();
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $course = Courses::where('id', $request->input('id'))->first();

            if ($course) {
                $course->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa khóa học thành công'
                ]);
            }
        } catch (\Exception $error) {
            return response()->json([
                'error' => true,
                'message' => 'Đã có lỗi xảy ra'
            ]);
        }
    }
}
