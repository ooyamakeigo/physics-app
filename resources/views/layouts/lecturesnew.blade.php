@extends('layouts.app')
@section('content')

<!-- バリデーションエラー表示 -->
@include('common.errors')

<!-- 登録フォーム -->
<form action="{{url('lectures')}}" method="POST" class="form-horizontal">
    @csrf
    <!-- 授業名 -->
    <div class="form-group">
        <div class="col-sm-6"></div>
        <input type="text" name="item_name" class="form-control">
    </div>


</form>


@endsection
