@extends('layouts.app')
@section('content')


    <div class="contents">
        <div class="card-body">
            @include('common.errors')

            @if ($errors->has('message'))
                <div class="alert alert-danger">
                    {{$errors->first('message')}}
                </div>
            @endif

            <form action="{{ url('lectures') }}" method="POST" class="form-horizontal">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="title" class="col-sm-3 control-label">授業名</label>
                        <input type="text" name="title" class="form-control"　value="{{ old('title') }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="teacher" class="col-sm-3 control-label">教授名</label>
                        <input type="text" name="teacher" class="form-control" value="{{ old('teacher') }}">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="week" class="col-sm-3 control-label">曜日</label>
                        <select name="week" class="form-control">
                            @foreach($week_days as $t )
                                <option value={{$t}}>{{$t}}曜日</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="timed" class="col-sm-3 control-label">時限目</label>
                        <select name="timed" class="form-control">
                            @for ($i = 1; $i < 6 ; $i++)
                                <option value={{$i}} >{{$i}}時限目</option>
                            @endfor
                        </select>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-primary">
                            登録
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="main-contents">


            <div class="left-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="space entitle lesson-number"></th>
                            @foreach($week_days as $t )
                                <th class="space entitle">{{$t}}</th>
                            @endforeach

                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 6 ; $i++)
                            <tr>
                                <th class="space entitle lesson-number">{{ $i }}</th>
                                    @for ($j = 1; $j < 6 ; $j++)
                                        <?php $k = true; ?>
                                        @foreach ($lectures as $lecture)
                                            @if ($lecture->table_place == $j * 10 + $i)
                                                <td class="space subtitle lecture">
                                                    <form action="{{ url('lecturesshow/'.$lecture->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="table-btn">
                                                            {{$lecture->title}}
                                                        </button>
                                                    </form>
                                                </td>

                                                <?php $k = false; ?>
                                            @endif
                                        @endforeach
                                        @if ($k)
                                            <td class="space subtitle no-lecture">無記入</td>
                                        @endif
                                    @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            @if ($show)
                <div class="right-container">
                    <div class="element">
                        <p class="show-label">授業名</p>
                        <h1 class="show-bigItem">{{$show->title}}</h1>
                    </div>
                    <div class="element">
                        <p class="show-label">教授名</p>
                        <p class="show-item">{{$show->teacher}}</p>
                    </div>
                    <div class="btn-space">
                        <form class="show-form" action="{{ url('lecturesedit/'.$show->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                更新
                            </button>
                        </form>

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">削除</button>
                    </div>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">投稿の削除</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">本当に削除してもよろしいですか？</div>
                            <div class="modal-footer">
                            <form action="{{ url('lecture/'.$show->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="right-container">
                    登録した授業をクリックすると詳細を表示することができます。
                </div>

            @endif
        </div>
    </div>






@endsection


