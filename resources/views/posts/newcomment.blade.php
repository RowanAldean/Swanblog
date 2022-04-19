<div id="new-comment-{{ $post->id }}" style="display: none;">
    <hr class="mb-4 mt-2" style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);">
    <form id="new-comment-form-{{ $post->id }}" action={{ route('comments.store') }} method="POST">
        @csrf
        <input id="postid" type="hidden" name="post_id" form="new-comment-form-{{ $post->id }}"
            value="{{ $post->id }}">
        <div class="row justify-content-middle align-items-center mb-2">
            <div class="col">
                <span class="d-flex flex-row justify-content-center">
                    <textarea id="body" form="new-comment-form-{{ $post->id }}" rows="1" name="body"
                        class="comment-text-area h-45 mr-2 placeholder:text-slate-500" placeholder="Add a comment..."
                        oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                    <button type="button"
                        onclick="newComment(document.getElementById('postid').value,document.getElementById('body').value)"
                        form="new-comment-form-{{ $post->id }}">
                        <i class="fa-solid fa-comment fa-lg" style="color:rgb(67 56 202);"></i>
                    </button>
                </span>
            </div>

        </div>
        {{-- <input type="hidden" name="likeable_type" :value="{{ json_encode(get_class($model)) }}" class="d-none"
        x-model="formData.likeable_type"> --}}
        {{-- <input type="hidden" name="id" :value="{{ $model->id }}" class="d-none" x-model="formData.id"> --}}
    </form>
</div>
