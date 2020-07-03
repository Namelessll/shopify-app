@extends('shopify-app::layouts.default')

@section('content')
    <nav class="bg-gray-800">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out" aria-label="Main menu" aria-expanded="false">
                        <!-- Icon when menu is closed. -->
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <!-- Icon when menu is open. -->
                        <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex">
                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Dashboard
                            </a>
                            <a href="#" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">Documentation
                            </a>
                            <a href="#" class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out">FAQ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    @if(empty($error))
        <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div style="display: flex; align-items: center;">
                    <p class="font-bold">Account Connected</p>
                </div>
            </div>
        </div>
    @else
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                <div style="display: flex; align-items: center;">
                    <p class="font-bold">The user has not authorized.</p>
                </div>
            </div>
        </div>
    @endif

    <div class="markdown px-6 xl:px-12 w-full max-w-3xl mx-auto lg:ml-0 lg:mr-auto xl:mx-0" style="margin: 35px 0px; width: 100% !important; max-width: 100%; display: flex; align-items: center;">

        <a target="_blank" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" style="cursor: pointer;" href="{{route('instagramConnectRoute')}}">
            Connect an Instagram Account
        </a>
        <p class="text-gray-700 text-base" style=" margin-left: 25px;">
            {{$error ?? ''}}
        </p>

    </div>

    @if(isset($posts))
    <div class="markdown mb-5 px-6 xl:px-12 w-full max-w-3xl mx-auto lg:ml-0 lg:mr-auto xl:mx-0 xl:w-3/4" style="padding-top: 15px; border-top: 1px solid #e3e3e3; width: 100% !important; max-width: 100%;">
        <div class="col-md-12" style="display: flex; flex-wrap: wrap;">
            @foreach($posts as $post)
                <div class="max-w-sm rounded overflow-hidden shadow-lg" style="height: 350px; width: 100%;">
                    <div style="background: url('{{$post["media_url"]}}'); background-size: cover; height: 350px;"></div>
                    <div class="px-6 py-4" style="display: none;">
                        <div class="font-bold text-xl mb-2">{{$post["username"]}}</div>
                        <p class="text-gray-700 text-base">
                            {{$post["caption"]}}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

@endsection

@section('scripts')
    @parent

    <script type="text/javascript">
        var AppBridge = window['app-bridge'];
        var actions = AppBridge.actions;
        var TitleBar = actions.TitleBar;
        var Button = actions.Button;
        var Redirect = actions.Redirect;
        var titleBarOptions = {
            title: 'Welcome',
        };
        var myTitleBar = TitleBar.create(app, titleBarOptions);
    </script>
@endsection
