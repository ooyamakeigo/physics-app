<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLecturePost;
use App\Http\Requests\UpdateLecturePost;
use Illuminate\Validation\Rule;
use App\Lecture;
use Validator;
use Auth;

class LecturesController extends Controller
{
    public $week_days = ['月', '火', '水', '木', '金'];
    public $week_day = [
        '月' => 10,
        '火' => 20,
        '水' => 30,
        '木' => 40,
        '金'=> 50
    ];


    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $lectures = Lecture::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
        $shows = false;

        return view('lectures', [
            'lectures' => $lectures,
            'show' => $shows,
            'week_days' => $this->week_days
        ]);
    }

    public function show(Lecture $shows) {
        $lectures = Lecture::where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
        return view('lectures', [
            'lectures' => $lectures,
            'show' => $shows,
            'week_days' => $this->week_days
        ]);
    }

    public function edit($lecture_id) {
        $lectures = Lecture::where('user_id',Auth::user()->id)->find($lecture_id);
        return view('lecturesedit', [
            'lecture' => $lectures,
            'week_days' => $this->week_days
        ]);
    }


    public function update(StoreLecturePost $request) {
        $lectures = Lecture::where('user_id',Auth::user()->id)->find($request->id);
        $lectures->user_id  = Auth::user()->id;
        $lectures->title   = $request->title;
        $lectures->teacher = $request->teacher;
        $lectures->timed   = $request->timed;
        $lectures->week    = $request->week;
        $lectures->table_place = $lectures->timed + $this->week_day[$request->week];
        $lectures->save();
        return redirect('/');
    }


    public function store(StoreLecturePost $request) {
        $lectures = new Lecture;
        $lectures->user_id  = Auth::user()->id;
        $lectures->title = $request->title;
        $lectures->teacher = $request->teacher;
        $lectures->timed = $request->timed;
        $lectures->week = $request->week;
        $lectures->table_place = $lectures->timed + $this->week_day[$request->week];
        $lectures->save();
        return redirect('/');

    }

    public function destroy(Lecture $Lecture) {
        $Lecture->delete();
        return redirect('/');
    }

}
