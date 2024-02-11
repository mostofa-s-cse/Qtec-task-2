@extends('back-end.layouts.master')
@section('title','Create ShortenUrl')
@section('content-header')
    <div class="row mb-2 px-2">
        <div class="col-sm-6">
            <h1 class="m-0">Create ShortenUrl</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">ShortenUrl</li>
            </ol>
        </div><!-- /.col -->
    </div>
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create ShortenUrl</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('shortenurl.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">
                                <input type="hidden" value="{{Auth::user()->id}}" id="organization_id" name="organization_id">
                                <div class="form-group">
                                    <label for="long_url">Enter Your Long Url</label>
                                    <div class="input-group">
                                        <textarea rows="" cols="" class="form-control" id="long_url" name="long_url"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-default float-right">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#side-shortenurl").addClass('active');
        });

    </script>
@endsection
