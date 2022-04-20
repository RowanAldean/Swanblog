<x-app-layout>
    <div class="profile-card container card">
        <div class="row justify-content-center">
            <div class="row col-3 justify-content-center profile-image-container">
                @can('update', $user->profile)
                    {{-- Allow the image overlay to edit --}}
                    <button onclick="selectProfilePicture()" class="row align-items-center justify-content-center">
                        <img src="{{ asset($user->profile->getProfileImage()) }}"
                            class="can-update row rounded-circle w-100">
                        <i class="row fa-solid fa-upload fa-xl"></i>
                    </button>
                    <form id="profile-pic-form" enctype="multipart/form-data"
                        action="{{ route('profile.update', auth()->user()) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <x-fileupload form="profile-pic-form" name="profile-image" id='profile-image' hidden
                            onchange="form.submit()" :value="old('profile-image')"></x-fileupload>
                    </form>
                @endcan
                @cannot('update', $user->profile)
                    <img src="{{ asset($user->profile->getProfileImage()) }}"
                        class="row justify-content-center rounded-circle w-100">
                    <i class="row fa-solid fa-upload fa-xl"></i>
                @endcannot
                {{-- display their profile image here --}}
                <div class="row justify-content-center">
                    <hr class="my-2" style="height: 2px; border-radius: 5rem; color: rgba(0,0,0,0.3);">
                </div>
            </div>
        </div>
        <div class="row justify-content-center profile-info-name">
            <div class="col-auto">
                <h6 class="fw-bold text-black">{{ $user->name }}</h6>
            </div>
        </div>
        <div class="row justify-content-center profile-info-username">
            <div class="col-auto">
                <h6 id="username" class="text-indigo-700">{{ urldecode('%40') . $user->username }}</h6>
            </div>
        </div>
        <div class="row justify-content-center profile-info-username">
            <div class="col-auto">
                <h6 class="text-muted">
                    @if (is_null($user->profile->website))
                        <form id="profile-website-form" action="{{ route('profile.update', auth()->user()) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <input name="website" placeholder="type & hit enter!">
                        </form>
                    @else
                        {{ $user->profile->website }}
                    @endif
                </h6>
            </div>
        </div>
        <div class="row justify-content-center profile-info-bio my-3">
            <div class="col-auto">
                @if (is_null($user->profile->bio))
                    <form id="profile-bio-form" onload="triggerBioForm()" name="profile-bio-form"
                        action="{{ route('profile.update', auth()->user()) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input name="bio" placeholder="type & hit enter!">
                    </form>
                @else
                    {{ $user->profile->bio }}
                @endif
            </div>
        </div>
        <div class="row justify-content-start most-recent-post px-5">
            @if ($user->posts->count() > 0)
                <div class="col-auto mb-2">
                    <h3 class="fw-bold text-indigo-700 text-2xl" style="font-size: 1.2rem">here's my most recent post...
                    </h3>
                </div>

                <x-post :post="$user->posts->sortBy('created_at', 0, true)->first()"></x-post>
                @if ($user->posts->count() > 1)
                    <h3 class="text-indigo-700 text-2xl mb-2" style="font-size: 1.2rem"><button
                            onclick="showMorePosts()">click to see
                            more</button></h3>
                    <div id="profile-more" style="display: none;">
                        @foreach ($user->posts->sortBy('created_at', 0, true) as $post)
                            <x-post :post=$post></x-post>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>

    <script>
        function selectProfilePicture() {
            document.getElementById('profile-image').click();
        }

        function showMorePosts() {
            postsContainer = document.getElementById('profile-more');
            if (postsContainer.style.display != 'none') {
                postsContainer.style.display = 'none';
            } else {
                postsContainer.style.display = 'block';
            }
        }
    </script>
</x-app-layout>
