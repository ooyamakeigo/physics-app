
@extends('layouts.app')
@section('content')
<div class="row container">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('lectures/update') }}" method="POST">

        <div class="form-group">
           <label for="title">授業名</label>
           <input type="text" name="title" class="form-control" value="{{$lecture->title}}">
        </div>

        <div class="form-group">
            <label for="teacher">教授名</label>
            <input type="text" name="teacher" class="form-control" value="{{$lecture->teacher}}">
        </div>

        <div class="form-group">
            <label for="week">曜日</label>
            <select name="week" class="form-control">
                @foreach($week_days as $t )
                    <option value={{$t}}>{{$t}}曜日</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="timed">時限</label>
            <select name="timed" class="form-control">
                @for ($i = 1; $i < 6 ; $i++)
                    <option value={{$i}} >{{$i}}時限目</option>
                @endfor
            </select>
        </div>

        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">登録する</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                戻る
            </a>
        </div>

         <input type="hidden" name="id" value="{{$lecture->id}}">
         @csrf

    </form>
    </div>
</div>
@endsection
