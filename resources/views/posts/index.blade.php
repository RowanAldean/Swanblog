<script src="{{ asset('js/likes.js') }}"></script>
@foreach ($posts as $post)
    <div class="card mb-4">
        {{-- Profile banner --}}
        <div class="profile-head container">
            <div class="row justify-content-start align-items-center rounded-full">
                <div class="col-auto">
                    <div class="row profile-pill mb-2">
                        <div class="col-auto">
                            <a class="w-8 h-8" href="/profile/{{ $post->user->username }}">
                                <img src="{{ asset($post->user->profile->getProfileImage()) }}"
                                    class="img-fluid rounded-circle">
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="/profile/{{ $post->user->username }}"
                                class="text-white my-0 ml-3 text-dark text-decoration-none">
                                {{ $post->user->name }}
                            </a>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <hr style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);">
                    </div>
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
                @can('delete', $post)
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <li class="btn btn-danger list-group-item">
                            <button class="btn" type="submit"><i class="fa-solid fa-trash-can"
                                    style="color: red"></i></button>
                        </li>
                    </form>
                @endcan
            </div>
        </div>
        {{-- The timestamp --}}
        <div class="post-footer container">
            <div class="row justify-content-start align-items-center">
                <div class="col-auto">
                    <div class="text-muted">{{ $post->created_at->diffForHumans() }}</div>
                </div>
            </div>
        </div>
        {{-- Comment section --}}
        <div class="post-comments container">
            <div class="row justify-content-start align-items-center">
                <div class="col-auto">
                    <div class="text-muted fw-bold">Comments:</div>
                    <div class="teaser-comment comment-card">
                        <span>{{ $post->comments()->latest()->first()->body }}
                            <span class="fw-bold text-muted">-
                                {{ $post->comments()->latest()->first()->created_at->diffForHumans() }}</span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="new-comment-section row  align-items-center mt-4">
                <div class="col-10">
                    @include('posts.comment', ['post' => $post])
                </div>
                <div class="col-1">
                    @include('like', ['model' => $post])
                </div>
            </div>
        </div>
    </div>
@endforeach
