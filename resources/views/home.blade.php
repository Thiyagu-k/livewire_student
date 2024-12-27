@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div>
                <div class="card">
                    <div class="card-header">
                        <h1>This is Dashboard of thi student details </h1>
                        <div class="card-body">
                            <h2>user name : {{ Auth::user()->name }}</h2>
                            <h2>user email : {{ Auth::user()->email }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
