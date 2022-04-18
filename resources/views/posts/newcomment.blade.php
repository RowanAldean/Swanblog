<form id="new-comment-{{ $post->id }}" action={{ route('comments.store') }} method="POST">
    @csrf
    <input type="hidden" name="post_id" form="new-comment-{{ $post->id }}" value="{{ $post->id }}">
    <div class="row justify-content-middle align-items-center mb-2">
        <div class="col">
            <span class="d-flex flex-row justify-content-center">
                <textarea method="POST" form="new-comment-{{ $post->id }}" rows="1" name="body"
                    class="comment-text-area h-45 mr-2 placeholder:text-slate-500" placeholder="Add a comment..."
                    oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                <button type="submit" form="new-comment-{{ $post->id }}">
                    <i class="fa-solid fa-comment fa-lg" style="color:rgb(67 56 202);"></i>
                </button>
            </span>
        </div>

    </div>
    {{-- <input type="hidden" name="likeable_type" :value="{{ json_encode(get_class($model)) }}" class="d-none"
        x-model="formData.likeable_type"> --}}
    {{-- <input type="hidden" name="id" :value="{{ $model->id }}" class="d-none" x-model="formData.id"> --}}
</form>
@if ($post->comments()->count() > 0)
    <hr class="mt-4 mb-2" style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);">
    @foreach ($post->comments->sortBy('created_at', 0, true) as $comment)
        <x-comment :comment="$comment" :user="$comment->user()"></x-comment>
    @endforeach
@endif
