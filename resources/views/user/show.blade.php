<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex flex-wrap justify-between">
          <div class="w-3/4">
            <img class="object-fit w-9" src="{{ $user->image }}" alt="プロフィール画像">
            <h2>{{ $user->name }}</h2>
            <div class="flex">
              {{-- <p>{{ $user->loadCount('followings')->followings_count}}フォロー中</p> --}}
              <p>{{ $user->followings->count() }}フォロー中</p>
              {{-- <p>{{ $user->loadCount('followers')->followers_count }}フォロワー</p> --}}
              <p>{{ $user->followers->count() }}フォロワー</p>
            </div>
          </div>

          <div class="bg-blue-500">
            {{-- @if($user->id !== Auth::id()) --}}
            @if($user->id !== $me->id)
              @if ($isFollowing)
              <form action="{{ route('user.unfollow', ['userId'=>$user->id]) }}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value="フォロー解除する">
              </form>
              @else
              <form action="{{ route('user.follow', ['userId'=>$user->id]) }}" method="POST">
                @csrf
                <input type="submit" value="フォローする">
              </form>
              @endif
            @endif
          </div>
        </div>
        

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ( $tweets as $tweet)
            <div class="p-6">
                  <img class="object-fit w-20" src="{{ $user->image }}" alt="">
                  <a href="{{ route('user.tweet.show' , ['userId'=> $user->id ,'postId'=> $tweet->id])}}">
                    <p class="font-extrabold">{{ $user->name }}</p>
                    <p class="text-gray-900">{{ $tweet->caption }}</p>
                  </a>
            </div>
            @endforeach
          </div>
      </div>
  </div>
</x-app-layout>
