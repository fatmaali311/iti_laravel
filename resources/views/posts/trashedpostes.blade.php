<x-layout>

    <!-- Table Component -->
    <div class="mt-6 rounded-lg border border-gray-200">
        <div class="overflow-x-auto rounded-t-lg">
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="text-left">
                    <tr>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">#</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Title</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Posted By</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Created At</th>
                        <th class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">Actions</th>
                    </tr>
                </thead>
        {{-- {{ dd($posts) }} --}}

                <tbody class="divide-y divide-gray-200">
                @foreach ($posts as $post)

                    <tr>
                        <td class="px-4 py-2 font-medium whitespace-nowrap text-gray-900">{{ $post->id }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{$post->title}}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->user?->name }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700">{{ $post->created_at->format('Y-m-d') }}</td>
                        <td class="px-4 py-2 whitespace-nowrap text-gray-700 space-x-2">
                            <form action="{{ route('posts.restore', $post->id) }}"  method="POST" class="inline-block">

                                @csrf
                                @method('PATCH')
                                <x-button type="primary" >restore</x-button>

                            </form>
                            <form action="{{ route('posts.forcedelete', $post->id) }}" onsubmit=" return confirm('Are you sure you want to delete')" method="POST" class="inline-block">

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


                </li>
            </ol>
        </div>
        <div class="flex justify-end">
            <a href="{{route("posts.index")}}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Back to All Posts
            </a>
        </div>
    </div>

</x-layout>
