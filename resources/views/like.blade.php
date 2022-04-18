<form action={{ route('like') }} method="POST" x-data="{
    formData: {
        likeable_type: {{ json_encode(get_class($model)) }},
        id: {{ json_encode($model->id) }}
    },
    liked: {{ json_encode($model->checkLiked()) }},
    numberLikes: {{ $model->likes()->count() }},
    ...submitData,
}" @submit.prevent="submitData">
    <input type="hidden" name="likeable_type" :value="{{ json_encode(get_class($model)) }}" class="d-none"
        x-model="formData.likeable_type">
    <input type="hidden" name="id" :value="{{ $model->id }}" class="d-none" x-model="formData.id">
    <div class="row justify-content-start align-items-center">
        <div class="col-auto flex">
            <button id="like-button" class="mr-2">
                <i class="fa-solid fa-heart" onload="setColors(this, {{ json_encode($model->checkLiked()) }})"
                    :class=" {'text-red-500': liked, 'text-muted' :!liked}"></i>
            </button>
            <p x-text="numberLikes">{{ $model->likes()->count() }}</p>
        </div>
    </div>
</form>
