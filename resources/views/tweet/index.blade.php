<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Dashboard') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div>
          <form action="{{ route('tweet.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="caption" >
            <input type="file" name="image">
            <input type="submit" value="投稿する">
          </form>
        </div>

          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach ( $tweets as $tweet)
            <div class="p-6 text-gray-900">
              @foreach ( $tweet->photos as $photo)
                <img class="object-fit w-20" src="{{  asset($photo->image) }}" alt="">
              @endforeach
                <a href="{{ route('user.show', ['userId'=> $tweet->user->id]) }}">
                    <p>{{ $tweet->user->name }}</p>
                    <p>{{ $tweet->caption }}</p>
                    <p>{{ $tweet->created_at }}</p>
                </a>
            </div>
            @endforeach
          </div>
      </div>
  </div>
</x-app-layout>
