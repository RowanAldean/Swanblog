<script src="{{ asset('js/likes.js') }}"></script>
@foreach ($posts as $post)
    <x-post :post=$post></x-post>
@endforeach
