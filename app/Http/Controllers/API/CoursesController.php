<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function onSelectFour()
    {
        $result = Courses::limit(4)->get();
        return response()->json($result);
    }
    public function onSelectAll()
    {
        $result = Courses::all();
        return response()->json($result);
    }
    public function onSelectDetails($slug){
        $result = Courses::where([
            'slug' => $slug
            ])->first();
        return response()->json($result);
    }
}
