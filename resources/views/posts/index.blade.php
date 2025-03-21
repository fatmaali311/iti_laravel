<x-layout>
    <div class="text-center space-x-4 ">


        <a href="{{ route('posts.create') }}" class="mt-4 px-4 py-2 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Create Post
        </a>
        <a href="{{route('posts.trashed')}}" class="mt-4 px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            trashed Posts
        </a>
    </div>

    <!-- Table Component -->
    <div class="mt-6 rounded-lg border border-gray-200">
        <div class="overflow-x-auto rounded-t-lg ">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Slug</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Image</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                    </tr>
                </thead>


                <tbody class="divide-y divide-gray-200">
                @foreach ($posts as $post)

                    <tr>
                        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $post['id'] }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{$post->title}}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{$post->slug}}</td>
                       <td> <img src="{{ asset('storage/posts/' . $post->image) }}" alt="Post Image"
                        class="w-48 h-auto rounded-md"></td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->user?->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                            <a href="{{ route('posts.show', ['post' => $post['id']]) }}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-400 rounded hover:bg-blue-500">View</a>
                            <a href="{{route('posts.edit',['post' => $post['id']])}}" class="inline-block px-4 py-1 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" onsubmit=" return confirm('Are you sure you want to delete')" method="POST" class="inline-block">

                                @csrf
                                @method('DELETE')
                                <x-button type="danger" >Delete</x-button>

                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="flex justify-center  ">
            {{ $posts->links('pagination::tailwind') }}
        </div>

                </li>
            </ol>
        </div>
    </div>
</x-layout>
