
<!-- resources/views/books.blade.php -->
@extends('layouts.app')
@section('content')

    <!-- Bootstrapの定形コード… -->
    <div class="card-body">
        <div class="card-title">
            時間割確認表
        </div>

        <!-- バリデーションエラーの表示に使用-->
        @include('common.errors')
        <!-- バリデーションエラーの表示に使用-->

        <!-- 本登録フォーム -->
        <form action="{{ url('lectures') }}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title" class="col-sm-3 control-label">タイトル</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    <label for="comment" class="col-sm-3 control-label">コメント</label>
                    <input type="text" name="comment" class="form-control">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="timed" class="col-sm-3 control-label">時限目</label>
                    <input type="text" name="timed" class="form-control">
                </div>

                    <div class="form-group col-md-6">
                        <label for="week" class="col-sm-3 control-label">曜日</label>
                        <select name="week" class="form-control">
                            <option value="月">月曜日</option>
                            <option value="火">火曜日</option>
                            <option value="水">水曜日</option>
                            <option value="木">木曜日</option>
                            <option value="金">金曜日</option>
                        </select>


                </div>
            </div>

            <!-- 本 登録ボタン -->
            <div class="form-row">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                    Save
                    </button>
                </div>
            </div>
        </form>
    </div>
    <!-- Book: 既に登録されてる本のリスト -->


    <!-- テーブル -->
    <div class="center">
        <table class="">
            <thead>
                <tr>
                    <th class="entitle">時限</th>
                    <th >月</th>

                    <th>火</th>
                    <th>水</th>
                    <th>木</th>
                    <th>金</th>
                </tr>
            </thead>

            



            <tbody>
                @for ($i = 1; $i < 6 ; $i++)
                    <tr>
                        <th class="entitle">{{ $i }}</th>
                            @for ($j = 1; $j < 6 ; $j++)
                                <?php $k = true; ?>
                                @foreach ($lectures as $lecture)
                                    @if ($lecture->table_place == $j * 10 + $i)
                                        <td>{{$lecture->title}}</td>
                                        <?php $k = false; ?>
                                    @endif
                                @endforeach
                                @if ($k)
                                    <td>無記入</td>
                                @endif
                            @endfor
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>



        <!-- Book: 既に登録されてる本のリスト -->
     <!-- 現在の本 -->
     @if (count($lectures) > 0)
        <div class="card-body">
            <div class="card-body">
                <table class="table table-striped task-table">
                    <!-- テーブルヘッダ -->
                    <thead>
                        <th>本一覧</th>
                        <th>&nbsp;</th>
                    </thead>
                    <!-- テーブル本体 -->
                    <tbody>
                        @foreach ($lectures as $lecture)
                            <tr>
                                <!-- 本タイトル -->
                                <td class="table-text">
                                    <div>{{ $lecture->title }}</div>
                                </td>

                                <!-- 本: 更新ボタン -->
                                <td>

                                    <form action="{{ url('lecturesedit/'.$lecture->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary">
                                            更新
                                        </button>
                                    </form>
                                </td>

                                <!-- 本: 削除ボタン -->
                                <td>
                                    <form action="{{ url('lecture/'.$lecture->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger">
                                            削除
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif



@endsection
