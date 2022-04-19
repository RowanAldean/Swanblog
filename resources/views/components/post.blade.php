@props(['post'])

<div class="show-post card mb-4">
    {{-- Profile banner --}}
    <div class="profile-head container">
        <div class="row justify-content-start align-items-center rounded-full">
            <div class="col-11">
                <button type="button" onclick="window.location='{{ route('profile.index', $post->user) }}'"
                    class="row profile-pill justify-content-start align-items-center mb-2"
                    href={{ route('profile.index', $post->user) }}>
                    <div class="flex align-items-center">
                        <a class="d-inline" href="/profile/{{ $post->user->username }}">
                            <img src="{{ asset($post->user->profile->getProfileImage()) }}"
                                class="img-fluid rounded-circle w-8">
                        </a>
                        {{-- </div> --}}
                        {{-- <div class="col-auto"> --}}
                        <p class="d-inline text-white my-0 ml-3 hover:text-white text-decoration-none">
                            {{ $post->user->username }}
                        </p>
                    </div>
                </button>

            </div>
            <div class="col-1">
                @include('like', ['model' => $post])
            </div>
        </div>
    </div>
    {{-- Main Content --}}
    <div class="container mb-2">
        {{-- Add an image if it exists --}}
        @if ($post->image)
            <div class="photo">
                has an image
                <img class="card-img" src="{{ asset("uploads/{$post->image}") }}">
            </div>
        @endif
        {{-- The caption --}}
        <div class="caption flex justify-between">
            <p class="card-text">{{ $post->caption }}</p>
        </div>
    </div>
    {{-- The timestamp --}}
    <div class="post-footer container">
        <div class="row justify-content-between align-items-center">
            <div class="col-auto">
                <div class="text-muted">{{ $post->created_at->diffForHumans() }}</div>
            </div>
            @can('delete', $post)
                <form class="d-inline col-auto" action="{{ route('post.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="text-red-500">delete post <i class="fa-solid fa-trash-can"
                            style="color: red"></i></button>

                </form>
            @endcan
        </div>
    </div>
    <hr class="my-2" style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);">

    {{-- Comment section --}}
    <div class="post-comments container">
        <div class="row justify-content-start align-items-center">
            <div class="col-auto">
                <div class="text-muted fw-bold">Comments:</div>
                @if ($post->comments()->count() > 0)
                    {{-- Teaser comment --}}
                    <x-comment :comment="$post
                        ->comments()
                        ->latest()
                        ->first()" :user="$post
                        ->comments()
                        ->latest()
                        ->first()
                        ->user()" :changes=false>
                    </x-comment>
                    @if ($post->comments()->count() > 1)
                        <button class="text-indigo-700 text-lg">see more...</button>
                    @endif
                @endif
            </div>
        </div>
        <div class="new-comment-section row  align-items-center mt-4">
            <div class="col">
                @if ($post->comments()->count() > 0)
                    @foreach ($post->comments->sortBy('created_at', 0, true) as $comment)
                        <x-comment :comment="$comment" :user="$comment->user()" :changes=true></x-comment>
                    @endforeach
                @endif
                @include('posts.newcomment', ['post' => $post])
            </div>
        </div>
    </div>
</div>
