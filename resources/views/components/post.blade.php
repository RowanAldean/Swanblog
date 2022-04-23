@props(['post'])

<div class="show-post card mb-4">
    {{-- Profile banner --}}
    <div class="profile-head container">
        <div class="row justify-content-start align-items-center rounded-full">
            <div class="col-11">
                <button type="button" onclick="window.location='{{ route('profile.index', $post->user->username) }}'"
                    @class([
                        'row',
                        'profile-pill',
                        'justify-content-start',
                        'align-items-center',
                        'mb-2',
                        'twitter-bot' => $post->user->is_bot,
                    ]) href={{ route('profile.index', $post->user->username) }}>
                    <div class="flex align-items-center">
                        <a class="d-inline" href="/profile/{{ $post->user->username }}">
                            <img src="{{ asset($post->user->profile->getProfileImage()) }}"
                                class="img-fluid rounded-circle w-8 h-8">
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
    {{-- The image --}}
    {{-- Add an image if it exists --}}
    @if ($post->image != null)
        <div class="photo container">
            <div class="row justify-content-center">
                <img class="card-img mh-48 mw-48 w-50 h-50" src="{{ asset("storage/$post->image") }}">
            </div>
        </div>
    @endif
    {{-- <hr class="my-2" style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);"> --}}

    {{-- Comment section --}}
    <div class="post-comments-{{ $post->id }} container">
        <div class="row justify-content-start align-items-center">
            <div class="col-auto">
                <div>
                    <p class="fw-bold text-muted">Featured comment:</p>
                    @if ($post->comments()->count() > 0)
                        <span class="flex align-items-center">
                            {{-- Teaser comment --}}
                            <x-comment id="recent-comment-{{ $post->id }}" :comment="$post
                                ->comments()
                                ->latest()
                                ->first()" :user="$post
                                ->comments()
                                ->latest()
                                ->first()
                                ->user()"
                                :changes=false>
                            </x-comment>
                            <button class="text-indigo-700 text-lg mb-2 ml-2"
                                onclick="seeMore({{ $post->id }})">see
                                all...</button>
                        </span>
                    @endif
                </div>
                <button class="text-muted" onclick="revealCommentSectionElem({{ $post->id }}, true)"><i>add
                        comment</i>
                </button>
            </div>
        </div>
        <div id="comment-section-{{ $post->id }}" class="comment-section row  align-items-center mt-2">
            <div class="col">
                <div id="see-more-{{ $post->id }}" style="display: none;">
                    @if ($post->comments()->count() > 0)
                        @foreach ($post->comments->sortBy('created_at', 0, true) as $comment)
                            <x-comment :comment="$comment" :user="$comment->user()" :changes=true></x-comment>
                        @endforeach
                    @endif
                </div>
                @include('posts.newcomment', ['post' => $post])
            </div>
        </div>
    </div>
</div>
