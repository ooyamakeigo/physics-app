<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLecturePost;
use Illuminate\Validation\Rule;
use App\Lecture;
use Validator;
use Auth;

class LecturesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $lectures = Lecture::orderBy('created_at', 'asc')->get();
        return view('lectures', [
            'lectures' => $lectures
        ]);
    }

    public function show(Lecture $shows) {
        $lectures = Lecture::orderBy('created_at', 'asc')->get();
        return view('lecturesshow', [
            'lectures' => $lectures,
            'show' => $shows
        ]);
    }

    public function edit(Lecture $lectures) {
        return view('lecturesedit', [
            'lecture' => $lectures
        ]);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|max:255',
            'table_place' => 'required|unique:posts',
        ]);

        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        $week_day = [
            '月' => 10,
            '火' => 20,
            '水' => 30,
            '木' => 40,
            '金'=> 50
        ];

        $lectures = Lecture::find($request->id);
        $lectures->title   = $request->title;
        $lectures->comment = $request->comment;
        $lectures->timed   = $request->timed;
        $lectures->week    = $request->week;
        $lectures->table_place = $lectures->timed + $week_day[$request->week];
        $lectures->save();
        return redirect('/');
    }


    public function store(StoreLecturePost $request) {
        $week_day = [
            '月' => 10,
            '火' => 20,
            '水' => 30,
            '木' => 40,
            '金'=> 50
        ];

        $lectures = new Lecture;
        $lectures->title = $request->title;
        $lectures->comment = $request->comment;
        $lectures->timed = $request->timed;
        $lectures->week = $request->week;
        $lectures->table_place = $lectures->timed + $week_day[$request->week];
        $lectures->save();
        return redirect('/');

    }

    public function destroy(Lecture $Lecture) {
        $Lecture->delete();
        return redirect('/');
    }

}
