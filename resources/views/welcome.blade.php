<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        <link href="{{ asset('build/assets/app-67dcdfd2.css') }}" rel="stylesheet">
        <link href="{{ asset('js/toster/build/toastr.min.css') }}" rel="stylesheet">
        {{-- @vite(['resources/css/app.css' , 'resources/js/app.js']) --}}
    <title>Live Chat</title>

</head>

<body>
    <div class="app">
        <div class="card">
            <div class="card-body row">
                <div class="col-md-10 text-center">
                    <h3>Chat App</h3>
                </div>
                <div class="col-md-2 d-flex justify-content-end"> <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="row h-100 pt-4">
            <div class="col-sm-6 offset-sm-3">
                <div class="card box-primary direct-chat direct-chat-primary" style="height: calc(80vh - 100px);">
                    <div class="card-header">
                        <h2>{{ auth()->user()->name }}</h2>
                    </div>
                    <input type="hidden" class="form-control" name="username" id="username"
                        value="{{ auth()->user()->name }}">
                    <div class="card-body" style="overflow: auto;">
                        <div class="direct-chat-messages" id="messages">
                            @forelse ($messages as $chat)
                            <p @if($chat->username == auth()->user()->name)class="d-flex
                                justify-content-end"@endif><strong>{{ $chat->username }}: </strong> {{ $chat->message }}
                            </p>
                            @empty
                            <p id="emptyMessage">No message history!</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="card-footer">
                        <form action="#" method="post" id="message_form">
                            <div class="input-group">
                                <input type="text" name="message" id="message" placeholder="Type Message ..."
                                    class="form-control">
                                <span class="input-group-btn">
                                    <button type="submit" id="send_message"
                                        class="btn btn-primary btn-flat" style="color: white; back">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/pushjs/push.min.js') }}"></script>
    <script src="{{ asset('js/pushjs/serviceWorker.min.js') }}"></script>
    <script src="{{ asset('js/toster/build/toastr.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
    </script>
    <script src="{{ asset('build\assets\app-869ff48b.js') }}"></script>
</body>

</html>
