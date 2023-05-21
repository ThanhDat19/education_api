<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Lesson;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class LessonController extends Controller
{

    public function index(Courses $course)
    {
        $lessons = Lesson::where('course_id', $course->id)->paginate(10);
        return view('admin.lessons.list', [
            'title' => 'Danh Sách Bài Học',
            'lessons' => $lessons,
            'course' => $course
        ]);
    }

    public function create(Courses $course)
    {
        return view('admin.lessons.add', [
            'title' => 'Thêm Bài Học Vào Khóa Học ' . $course->title,
            'course' => $course
        ]);
    }

    public function store(Request $request, Courses $course)
    {
        Lesson::create([
            "course_id" => $course->id,
            "title" => $request->input('title'),
            "video_url" => $request->input('video_url'),
            "short_text" => $request->input('short_text'),
            "full_text" => $request->input('full_text'),
            "position" => $request->input('position'),
            "free_lesson" => $request->input('free_lesson')
        ]);

        try {

            Session::flash('success', 'Thêm Bài học mới thành công');
        } catch (Exception $error) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->route('course.lesson', ['course'=> $course->id]);
    }


    public function show(Lesson $lesson)
    {
        return view('admin.lessons.edit', [
            'title' => 'Chỉnh Sửa Bài Học '. $lesson->title,
            'lesson' => $lesson
        ]);
    }

    public function update(Request $request, Lesson $lesson, Courses $course)
    {

        $lesson->fill([
            "course_id" => $course->id,
            "title" => $request->input('title'),
            "video_url" => $request->input('video_url'),
            "short_text" => $request->input('short_text'),
            "full_text" => $request->input('full_text'),
            "position" => $request->input('position'),
            "free_lesson" => $request->input('free_lesson')
        ]);
        $lesson->save();
        try {
            Session::flash('success', 'Cập nhật bài học thành công');
        } catch (\Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
        }
        return redirect()->route('course.lesson', ['course'=> $course->id]);
    }
    public function delete(Request $request)
    {
        try {
            $result = false;
            $course = Lesson::where('id', $request->input('id'))->first();

            if ($course) {
                $course->delete();
                $result = true;
            }

            if ($result) {
                return response()->json([
                    'error' => false,
                    'message' => 'Xóa Bài học thành công'
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
