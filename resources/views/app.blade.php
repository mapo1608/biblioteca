<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
       @include('layouts.head')
    </head>
    <body >
        @include('layouts.header')

        <main id="main-container">
            <div class="container mt-3">
                <div class="row">
                    @yield('title')
                </div>
            </div>

            @if(session()->get('err') != null)
                <div class="row my-2">
                    <div class="col-12 bg-danger">
                        {{ session()->get('err') }}
                    </div>
                </div>
            @endif

            <div class="container-fluid p-0">
                @yield('content')
            </div>
        </main>
        
       @section('footer')
            @include('layouts.footer')
        @show

        @include('layouts.js')

    </body>
</html>
