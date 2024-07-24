@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="columns estatistic-list">
            <div class="column box-area" >
                <div class="columns">
                    <div class="column has-text-centered header-pg">
                        <h1 class="main-text">Wecome</h1>
                        <h1 class="main-text">You have access to Areas</h1>
                    </div>
                </div>

                <div class="columns">
                    <div class="column has-text-centered">
                        <ul class="list-areas">
                            @foreach($access_areas as $list)
                                <li><a href="{{ $list['url'] }}" target="_blank" >
                                        <h3>{{ $list['title'] }}</h3>
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
