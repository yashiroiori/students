<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lesson_id = null;
        $students_lesson = [];
        if($request->has('lesson_id') && $request->get('lesson_id') > 0){
            $lesson = Lesson::find($request->get('lesson_id'));
            if($lesson){
                $lesson_id = $request->get('lesson_id');
                $students_lesson = $lesson->student()->pluck('id')->toArray();
            }
        }
        return inertia('StudentLesson/Index',[
            'lessons' => Lesson::orderBy('name')->get()->map(function($lesson){
                return [
                    'value' => $lesson->id,
                    'text' => $lesson->name,
                ];
            }),
            'students' => Student::orderBy('name')->get(),
            'students_lesson' => $students_lesson,
            'lesson_id' => (int)$lesson_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return DB::transaction(function()use($request){
            if($request->has('lesson_id')){
                $lesson = Lesson::find($request->get('lesson_id'));
                if($request->has('students') && count($request->get('students')) > 0){
                    $lesson->student()->sync($request->get('students'));
                }else{
                    $lesson->student()->sync([]);
                }
            }
            return redirect()->back();
        });
    }
}
