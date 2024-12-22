<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body>
    <main class="flex w-full h-full shadow-lg rounded-3xl">
        <section class="flex flex-col pt-3 w-full bg-gray-50 h-full overflow-y-scroll">
            <ul class="mt-6">
                @foreach (Auth::user()->notif()->orderByDesc('id')->get() as $notif)
                    <li class="py-5 border-b px-3 transition ">
                        <a href="#" class="flex justify-between items-center">
                            <h3 class="text-lg font-semibold">{{ $notif->title }}</h3>
                            <p class="text-md text-gray-400">{{$notif->created_at->diffForHumans()}}</p>
                        </a>
                        <div class="text-md italic text-gray-400">{{ $notif->message }}</div>
                    </li>
                @endforeach
            </ul>
        </section>
    </main>
</body>
</html>
