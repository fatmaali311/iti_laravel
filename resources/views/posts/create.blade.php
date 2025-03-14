<x-layout :title="'Create Post'">
    <div class="max-w-3xl mx-auto">
        {{-- @if ($errors->any())
            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Create New Post</h2>
            </div>

            <div class="px-6 py-4">
                <form method="POST" action="/posts" enctype="multipart/form-data">
                    @csrf
                    <!-- Title Input -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                        <input name="title" type="text" id="title"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border">
                        @error('title')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description Textarea -->
                    <div class="mb-4">
                        <label for="description"
                            class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border"></textarea>
                        @error('description')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Post Creator Select -->
                    <div class="mb-6">
                        <label for="creator" class="block text-sm font-medium text-gray-700 mb-1">Post Creator</label>
                        <select name="user_id" id="creator"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 py-2 px-3 border bg-white">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="tags">Tags (comma separated):</label>
                        <input type="text" name="tags" class="form-control"
                            placeholder="Laravel, PHP, Web Development">
                    </div>
                    <!-- upload image -->
                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">upload image</label>
                        <input type="file" name="image" id="image" />
                        @error('image')
                            <div class="text-sm text-red-600 bg-red-100 border border-red-400 p-2 rounded-md">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 hover:cursor-pointer">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
