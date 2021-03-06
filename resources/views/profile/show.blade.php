<x-app>
    <header class="mb-6 relative">
        <div class="relative">
            <img
                src="/images/default-profile-banner.jpg"
                alt=""
                class="mb-2"
            >

            <img
                src="{{ $user->avatar }}"
                alt=""
                class="rounded-full mr-2 absolute bottom-0 transform -translate-x-1/2 translate-y-1/2"
                width="150"
                style="left: 50%;"
            >
        </div>

        <div class="flex justify-between items-center mb-6">
            <div class="max-width: 270px">
                <h2 class="font-bold text-2xl mb-0">{{ $user->name }}</h2>
                <p class="text-sm">Joined {{ $user->created_at->diffForHumans() }}</p>
            </div>

            <div class="flex">
                @auth
                    @can ('edit', $user)
                        <a
                            href="{{ $user->path('edit') }}"
                            class="rounded-full border border-gray-300 py-2 px-4 text-black text-xs mr-2"
                        >
                            Edit Profile
                        </a>
                    @endcan

                    <x-follow-button :user="$user"></x-follow-button>
                @else
                    <a
                        href="{{ route('login') }}"
                        class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs mr-2"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="bg-gray-500 rounded-full shadow py-2 px-4 text-white text-xs"
                    >
                        Register
                    </a>
                @endauth
            </div>
        </div>

        <p class="text-xs">
            Dark clouds will gather 'round me. Foggy mountain top that skillet good and greasy, scratching out dough, rambling rye whiskey out in the kitchen that skillet good and greasy, the sooner I will marry hot corn dark clouds will gather 'round me and I ain't comin' back jug, hopalong, troublin' mind.
        </p>

    </header>

    @include('_timeline', [
        'tweets' => $tweets
    ])
</x-app>
