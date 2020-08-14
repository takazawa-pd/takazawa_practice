@extends('layout')

@section('content')
    <div class="container mt-2">
        <div class="border p-4">

            <div class="mb-4 text-right">
                <a class="btn btn-primary" href="{{ route('posts.edit',['post' => $post]) }}">
                    編集する
                </a>
                <form
                    style="display:inline-block;"
                    method="post"
                    action="{{ route('posts.destroy',['post' => $post]) }}"
                >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">削除する</button>
                </form>
            </div>

            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>
            
            <p class="mb-4">
                {{ nl2br($post->body) }}
            </p>

            <section>
                <h2 class="h5 mb-4">
                    コメント
                </h2>
                
                <form class="mb-4" method="post" action="{{ route('comments.store') }}">
                    <div class="form-group">
                        <label for="body">
                            本文
                        </label>
                        <textarea
                            id="body"
                            name="body"
                            class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}"
                            rows="4"
                        >
                            {{ old('body') }}
                        </textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                {{ $errors->first('body') }}
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <button class="btn btn-primary">
                            コメントする
                        </button>
                    <div>
                </form>

                @forelse($post->comments as $comment)
                    <div class="border-top mb-4">
                        <time class="text-secondary">
                            {{ $comment->created_at->format('Y.m.d H:i') }}
                        </time>
                        <p class="mt-2">
                            {{ nl2br($comment->body) }}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>

        </div>
    </div>
@endsection