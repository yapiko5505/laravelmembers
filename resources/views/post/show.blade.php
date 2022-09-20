<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            投稿の個別表示
        </h2>

        <x-message :message="session('message')" />

    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <div class="px-10 mt-4">

                <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500">
                    <div class="mt-4">
                        <div class="flex">
                            <div class="rounded-full w-12 h-12">
                                <!-- アバター表示 -->
                                <img src="{{asset('storage/avater/'.($post->user->avator??'user_default.jpg'))}}">
                            </div>
                    <h1 class="text-lg text-gray-700 font-semibold hover:underline cursor-pointer">
                                {{ $post->title }}
                            </h1>
                            <hr class="w-full">
                    </div>
                    <div class="flex justify-end mt-4">
                        @can('update', $post)
                        <a href="{{route('post.edit', $post)}}"><button class="mt-4">編集</button></a>
                        @endcan
                        @can('delete', $post)
                        <form method="post" action="{{route('post.destroy', $post)}}">
                            @csrf
                            @method('delete')
                            <button class="mt-4" onClick="return confirm('本当に削除しますか？');">削除</button>
                        </form>
                        @endcan
                    </div>
                    {{-- div 追加部分 --}}
                    <div>
                        <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
                        @if($post->image)
                            <div>
                                (画像ファイル：{{$post->image}})
                            </div>
                            <img src="{{ asset('storage/images/'.$post->image)}}" class="mx-auto" style="height:300px;">
                        @endif
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p> {{ $post->user->name??'削除されたユーザー'}} • {{$post->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                {{-- /div 追加部分 --}}
                </div>
                        <p class="mt-4 text-gray-600 py-4">{{$post->body}}</p>
                        @if($post->image)
                            <div>
                                (画像ファイル : {{$post->image}})
                            </div>
                            <img src="{{ asset('strage/images/'.$post->image)}}" class="mx-auto" style="height:300px";>
                        @endif
                        <div class="text-sm font-semibold flex flex-row-reverse">
                            <p> {{ $post->user->name??'削除されたユーザー' }} • {{$post->created_at->diffForHumans()}}</p>
                        </div>
                    </div>
                    {{-- コメント表示 --}}
                    @foreach($post->comments as $comment)
                        <div class="bg-white w-full  rounded-2xl px-10 py-8 shadow-lg hover:shadow-2xl transition duration-500 mt-8">
                            {{$comment->body}}
                            <div class="text-sm font-semibold flex flex-row-reverse">
                                <!-- クラスを変更 -->
                                <p class="float-left pt-4">{{ $comment->user->name??'削除されたユーザー' }}・{{$comment->created_at->diffForHumans()}}</p>
                                <!-- アバター追加 -->
                                <span class="rounded-full w-12 h-12">
                                    <img src="{{asset('storage/avatar/'.($comment->user->avatar??'user_defalut.jpg'))}}">
                                </span>
                

                            </div>
                        </div>
                    @endforeach
                    {{-- 追加部分 --}}
                    <div class="mt-4 mb-12">
                        <form method="post" action="{{route('comment.store')}}">
                            @csrf
                            <input type="hidden" name='post_id' value="{{$post->id}}">
                            <textarea name="body" class="bg-white w-full  rounded-2xl px-4 mt-4 py-4 shadow-lg hover:shadow-2xl transition duration-500" id="body" cols="30" rows="3" placeholder="コメントを入力してください">{{old('body')}}</textarea>
                            <button class="mt-4">コメントする</button>
                        </form>
                    </div>
                    {{-- 追加部分終わり --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>