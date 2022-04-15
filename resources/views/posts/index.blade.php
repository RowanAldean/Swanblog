@foreach ($posts as $post)
    <div class="card">
        @if ($post->image != null)
            <div class="photo">
                <img class="card-img" src="{{ asset("storage/$post->image") }}">
            </div>
        @endif
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
@endforeach
