<x-app-layout>
    <x-post :post=$post></x-post>
    {{-- More Posts --}}
    @if ($posts->count() > 0)

        <div class="row mb-4">
            <hr style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);">
        </div>

        <div class="more">
            <h4 class="text-muted fs-5 mb-3">More posts from
                <a href="/profile/{{ $post->user->username }}" class="text-indigo-700 text-decoration-none">
                    <strong> {{ $post->user->name }}</strong>
                </a>
            </h4>

            <div class="row">
                @foreach ($posts as $morepost)
                    <x-post :post=$morepost></x-post>
                @endforeach
            </div>
        </div>
    @endif
</x-app-layout>
