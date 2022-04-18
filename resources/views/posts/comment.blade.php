{{-- <button id="new-comment-reveal" class="mt-2 row align-items-center justify-content-start" data-toggle="collapse"
        href="#new-comment-{{ $post->id }}" role="button" aria-expanded="false"
        aria-controls="new-comment-{{ $post->id }}">
        <div class="col-auto flex">
            <p class="mr-2">Add Comment</p>
            <i class="fa-solid fa-comment align-items-center" style="color:rgb(67 56 202);"></i>
        </div>
    </button> --}}
<form id="new-comment-{{ $post->id }}" action={{ route('like') }} method="POST">
    <div class="row justify-content-between align-items-center">
        <div class="col-11">
            <textarea rows="1" class="comment-text-area h-45 mr-2 placeholder:text-slate-500" placeholder="Add a comment..."
                oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
        </div>
        <div class="col-1"><i class="fa-solid fa-comment align-items-center" style="color:rgb(67 56 202);"></i>
        </div>
    </div>
    {{-- <input type="hidden" name="likeable_type" :value="{{ json_encode(get_class($model)) }}" class="d-none"
        x-model="formData.likeable_type"> --}}
    {{-- <input type="hidden" name="id" :value="{{ $model->id }}" class="d-none" x-model="formData.id"> --}}
</form>
