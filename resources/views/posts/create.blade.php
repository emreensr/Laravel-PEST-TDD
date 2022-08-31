<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

                <x-auth-card>
                    <x-slot name="logo">
                        Create Post
                    </x-slot>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('posts.store') }}">
                    @csrf

                    <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Title')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="title" :value="old('title')" required autofocus />
                        </div>

                        <div>
                            <x-label for="name" :value="__('Body')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="body" :value="old('body')" required autofocus />
                        </div>

                        <div>
                            <x-label for="name" :value="__('Status')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="status" :value="old('status')" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                </x-auth-card>
</x-app-layout>
