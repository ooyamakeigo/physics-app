
@extends('layouts.app')
@section('content')
<div class="row container">
    <div class="col-md-12">
    @include('common.errors')
    <form action="{{ url('lectures/update') }}" method="POST">

        <!-- title -->
        <div class="form-group">
           <label for="title">Title</label>
           <input type="text" name="title" class="form-control" value="{{$lecture->title}}">
        </div>
        <!--/ title -->

        <!-- comment -->
        <div class="form-group">
            <label for="comment">Comment</label>
            <input type="text" name="comment" class="form-control" value="{{$lecture->comment}}">
        </div>
        <!--/ comment -->

        <!-- semester -->
        <div class="form-group">
            <label for="semester">semester</label>
            <input type="text" name="semester" class="form-control" value="{{$lecture->semester}}">
        </div>
        <!--/ semester -->

        <!-- term -->
        <div class="form-group">
            <label for="term">term</label>
            <input type="text" name="term" class="form-control" value="{{$lecture->term}}"/>
        </div>
        <!--/ term -->

        <!-- Saveボタン/Backボタン -->
        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">Save</button>
            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
        <!--/ Saveボタン/Backボタン -->

         <!-- id値を送信 -->
         <input type="hidden" name="id" value="{{$lecture->id}}">
         <!--/ id値を送信 -->

         <!-- CSRF -->
         @csrf
         <!--/ CSRF -->

    </form>
    </div>
</div>
@endsection
