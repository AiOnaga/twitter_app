<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <form action="{{ route('search.index') }}" method="GET">
                    <input type="text" name="keyword" value="{{ $keyword }}">
                    <input type="submit" value="検索">
                </form>

                @if ($keyword)
                <h2>投稿の検索結果</h2>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        @foreach ($posts as $post)
                            <div class="p-6 text-gray-900">
                                @foreach ($post->photos as $photo)
                                    <img class="object-fit w-20" src="{{ asset($photo->image) }}" alt="">
                                @endforeach
                                <a href="{{ route('user.show', ['userId' => $post->user->id]) }}">
                                    <p>{{ $post->user->name }}</p>
                                    <p>{{ $post->caption }}</p>
                                    <p>{{ $post->created_at }}</p>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    <h2>ユーザーの検索結果</h2>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                      @foreach ($users as $user)
                          <div class="p-6 text-gray-900">
                              <a href="{{ route('user.show', ['userId' => $user->id]) }}">
                                  <img class="object-fit w-20" src="{{ asset($user->image) }}" alt="">
                                  <p>{{ $user->name }}</p>
                              </a>
                          </div>
                      @endforeach
                  </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
