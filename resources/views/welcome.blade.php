<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Test Books App</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}
            .relative{position:relative}
            .fixed{position:fixed}
            .top-0{top:0}
            .right-0{right:0}
            .flex{display:flex}
            .justify-center{justify-content:center}
            .justify-between{justify-content:space-between}
            .items-center{align-items:center}
            .hidden{display:none}
            .min-h-screen{min-height:100vh}
            .max-w-7xl{max-width:80rem}
            .w-full{width:100%}
            .mx-auto{margin-left:auto;margin-right:auto}
            .mt-4{margin-top:1rem}
            .mt-8{margin-top:2rem}
            .ml-4{margin-left:1rem}
            .mb-0{margin-bottom:0}
            .p-4{padding:1rem}
            .p-6{padding:1.5rem}
            .px-4{padding-left:1rem;padding-right:1rem}
            .px-6{padding-left:1.5rem;padding-right:1.5rem}
            .py-2{padding-top:.5rem;padding-bottom:.5rem}
            .py-4{padding-top:1rem;padding-bottom:1rem}
            .text-center{text-align:center}
            .text-xs{font-size:.75rem;line-height:1rem}
            .text-sm{font-size:.875rem;line-height:1.25rem}
            .text-base{font-size:1rem;line-height:1.5rem}
            .text-lg{font-size:1.125rem;line-height:1.75rem}
            .text-xl{font-size:1.25rem;line-height:1.75rem}
            .font-semibold{font-weight:600}
            .text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}
            .text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}
            .text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}
            .text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}
            .text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}
            .text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}
            .text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}
            .underline{text-decoration:underline}
            .bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}
            .bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}
            .border{border-width:1px}
            .border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}
            .rounded{border-radius:.25rem}
            .rounded-lg{border-radius:.5rem}
            .shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}
            .antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex justify-center items-center min-h-screen bg-gray-100 py-4">
            @if (Route::has('login'))
                <div class="fixed top-0 right-0 px-6 py-4">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl w-full">
                <h1 class="mt-4 mb-0 text-center text-xl font-semibold text-gray-700">Test Books App</h1>

                <div class="mt-8">
                    <iframe src="{{ route('l5-swagger.default.api') }}"
                        width="100%" height="600" class="block"></iframe>
                </div>

                <div class="flex justify-between mt-4">
                    <div class="text-sm text-gray-500">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                    </div>

                    <div class="text-sm text-gray-500">
                        PHP v{{ PHP_VERSION }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
