@props(['comment', 'user'])

<div class="teaser-comment comment-card mb-2">
    <span>{{ $comment->body }}
        <span class="fw-bold text-muted">-
            {{ $comment->created_at->diffForHumans() }}
            <a style="padding-right: 0.4rem;" class="fw-normal text-indigo-700"
                href="/profile/{{ $user->first()->username }}">
                {{ $user->first()->username }} </a>
            @can('delete', $comment)
                <form id="delete-comment-form-{{ $comment->id }}" class="d-inline float-right"
                    action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="float: right;">
                    @method('DELETE')
                    @csrf
                    <button form="delete-comment-form-{{ $comment->id }}" type="submit"><i
                            class="fa-solid fa-trash-can comment-trash"></i></button>
                </form>
            @endcan
        </span>
    </span>
</div>
