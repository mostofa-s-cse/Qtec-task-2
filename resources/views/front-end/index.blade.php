@extends('front-end.layouts.master')
@section('title','Task 1')
@section('content')

<div class="container">
        @if (Auth::check())
            <h4 class="mb-5 mt-5 text-center">Wellcome {{ Auth::user()->name }}</h4>
        @else
            <div><h4 class="mb-5 mt-5 text-center">Wellcome</h4></div>
        @endif
</div>

    <!-- <input type="submit" class="btn btn-primary" value="Submit" onclick="saveForm()"> -->

    @endsection