@props(['comment', 'user', 'changes'])

<div class="comment-card mb-2">
    <span>{{ $comment->body }}
        <span class="fw-bold text-muted">-
            {{ $comment->created_at->diffForHumans() }}
            <a style="padding-left: 0.4rem;" class="fw-normal text-indigo-700"
                href="/profile/{{ $user->first()->username }}">
                {{ $user->first()->username }} </a>
            @if ($comment->edited == 1)
                <span class="fw-normal"><i> (edited)</i></span>
            @endif
            @if ($user->first()->id != auth()->user()->id)
                @include('like', ['model' => $comment])
            @endif
            @if ($changes == 1)
                @can('delete', $comment)
                    <form id="delete-comment-form-{{ $comment->id }}" class="d-inline float-right ml-3"
                        action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="float: right;">
                        @method('DELETE')
                        @csrf
                        <button form="delete-comment-form-{{ $comment->id }}" type="submit"><i
                                class="fa-solid fa-trash-can comment-trash"></i></button>
                    </form>
                @endcan
                @can('update', $comment)
                    <button onclick="revealEditComment({{ $comment->id }})" class="ml-3 float-right"><i
                            class="fa-solid fa-pencil comment-edit"></i></button>
                @endcan
            @endif
        </span>
    </span>
</div>
@if ($changes == 1)
    @can('update', $comment)
        <div class="edit-comment-card mb-2">
            <form id="edit-comment-form-{{ $comment->id }}" class=""
                action="{{ route('comments.update', $comment->id) }}" method="POST" style="display: none;">
                @method('PATCH')
                @csrf
                <span class="d-flex flex-row justify-content-center text-muted">
                    <input form="edit-comment-form-{{ $comment->id }}" name="body"
                        class="comment-text-area bg-white mr-2" placeholder="Edit your comment...">
                    <button form="edit-comment-form-{{ $comment->id }}" type="submit"><i
                            class="fa-solid fa-comment-dots comment-send"></i></button>
                </span>
            </form>
        </div>
    @endcan
@endif
