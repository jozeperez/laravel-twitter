@if (auth()->check() && current_user()->isNot($user))
    <form
        method="POST"
        action="/profile/{{ $user->name }}/follow"
    >
        @csrf

        <button
            type="submit"
            class="bg-blue-500 rounded-full shadow py-2 px-4 text-white text-xs"
        >
            {{ current_user()->following($user) ? 'Unfollow Me' : 'Follow Me' }}
        </button>
    </form>
@else
    <div class="flex">
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
    </div>
@endif
