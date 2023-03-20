<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white">
                  <img class="object-fit w-20" src="{{ $tweet->user->image }}" alt="">
                  {{-- <a href="{{ route('user.tweet.show') , ['userId'=> $user->id ,'postId'=> $tweet->id]}}"> --}}
                    <p class="font-extrabold">{{ $tweet->user->name }}</p>
                    <p class="text-gray-900">{{ $tweet->caption }}</p>
                  {{-- </a> --}}
            </div>

            <form action="{{ route('user.store.comment',['userId'=> $userId, 'postId'=> $tweet->id]) }}" method="POST">
              @csrf
              <input type="text" name="comment">
              <input type="submit" value="返信">

            </form>

            @foreach ( $tweet->comments as $comment)
            <div class="p-6 mb-10">
                <a href=" {{ route('user.show', ['userId'=> $comment->user->id]) }}">
                  <img class="object-fit w-20" src="{{ $comment->user->image }}" alt="">
                </a>
                  <p class="font-extrabold">{{ $comment->user->name }}</p>
                  <p class="font-extrabold">{{ $comment->comment }}</p>
                  <hr>
            </div>
          @endforeach
          </div>
      </div>
  </div>
</x-app-layout>