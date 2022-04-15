<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="py-4">
                <!-- Validation Errors -->
                {{-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> --}}
                <form method="POST" action="{{ route('post.store') }}">
                    @csrf

                    <!-- Post Caption -->
                    <div>
                        <x-label for="caption" :value="__('Post Caption')" />

                        <x-textarea id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')"
                            required autofocus placeholder="What's on your mind?" />
                    </div>

                    <!-- Image (Optional) -->
                    <div class="mt-4">
                        <x-label for="image" :value="__('Image (Optional)')" />

                        <x-fileupload accept="image/png, image/gif, image/jpeg" class="mt-1">
                            {{ __('Upload Image') }}</x-fileupload>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        {{-- TODO: Implement a discard button --}}
                        {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a> --}}

                        <x-button>
                            {{ __('CREATE POST') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
