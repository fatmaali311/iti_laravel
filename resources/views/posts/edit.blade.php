<x-layout :title="'Edit Post'">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Edit Post</h2>
            </div>
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
            <div class="px-6 py-4">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input name="title" type="text" id="title" value="{{ $post->title }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border">
                        @error('title')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Description Textarea -->
                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"> {{ $post->description }}
                    </textarea>
                        @error('description')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <!-- Post Creator Select -->
                    <div class="mb-4">
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                        <select name="user_id" id="creator"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $post->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="mb-4">
                    <input type="text" name="tags" class="form-control"
                    value="{{ $post->tags->pluck('name')->implode(', ') }}">
                    </div>
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload New
                            Image</label>
                        <input type="file" name="image" id="image"
                            class="w-full border border-gray-300 rounded-md p-2">
                        @error('image')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <!-- Show Old Image -->
                    @if ($post->image)
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 mb-1">Current Image:</p>
                            <img src="{{ asset('storage/posts/' . $post->image) }}" alt="Post Image"
                                class="w-48 h-auto rounded-md">
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hover:cursor-pointer">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
