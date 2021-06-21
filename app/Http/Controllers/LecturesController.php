<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;


//class
use App\Lecture;
use Validator;
use Auth;

class LecturesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    //ダッシュボード表示
    public function index() {
        $lectures = Lecture::orderBy('created_at', 'asc')->get();
        return view('lectures', [
            'lectures' => $lectures
        ]);
    }

    //新規登録

    //更新画面
    public function edit(Lecture $lectures) {
        return view('lecturesedit', [
            'lecture' => $lectures
        ]);
    }


    //更新
    public function update(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',

        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $lectures = Lecture::find($request->id);
        $lectures->title   = $request->title;
        $lectures->comment = $request->comment;
        $lectures->term    = $request->term;
        $lectures->semester= $request->semester;
        $lectures->save();
        return redirect('/');
    }

    //登録
    public function store(Request $request) {
        //バリデーション
        $validator = Validator::make($request->all(), [

        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
                return redirect('/')
                    ->withInput()
                    ->withErrors($validator);
        }
        //Eloquentモデル（登録処理）
        $lectures = new Lecture;
        $lectures->title = $request->title;
        $lectures->comment = $request->comment;
        $lectures->term = $request->term;
        $lectures->semester = $request->semester;
        $lectures->save();
        return redirect('/');
    }

    //削除処理
    public function destroy(Lecture $Lecture) {
        $Lecture->delete();
        return redirect('/');
    }

}
