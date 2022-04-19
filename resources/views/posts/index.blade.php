<script src="{{ asset('js/likes.js') }}"></script>
@foreach ($posts->sortBy('created_at', 0, true) as $post)
    <x-post :post=$post></x-post>
@endforeach
<div class="row d-flex justify-content-center">
    <div class="col-auto space-x-2">{!! $posts->links() !!}</div>
</div>
