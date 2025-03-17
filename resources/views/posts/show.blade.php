<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Show Post</title>

   @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="bg-gray-50">
   <!-- Navigation -->
   <nav class="bg-white shadow">
       <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
           <div class="flex justify-between h-16">
               <div class="flex">
                   <div class="flex-shrink-0 flex items-center">
                       <a class="text-lg font-semibold text-gray-900" href="{{ route('posts.index') }}">ITI Blog Post</a>
                   </div>
                   <div class="ml-6 flex items-center space-x-4">
                       <a class="px-3 py-2 text-sm font-medium text-gray-900 border-b-2 border-blue-500" href="#">All Posts</a>
                   </div>
               </div>
               <div class="flex items-center">
                   <button type="button" class="md:hidden flex items-center justify-center p-2 rounded-md text-gray-400">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                       </svg>
                   </button>
               </div>
           </div>
       </div>
   </nav>

   <!-- Container -->
   <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
       <div class="max-w-3xl mx-auto space-y-6">
           <!-- Post Info Card -->
           <div class="bg-white rounded border border-gray-200">
               <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                   <h2 class="text-base font-medium text-gray-700">Post Info</h2>
               </div>
               <div class="px-4 py-4">
                   <div class="mb-2">
                       <h3 class="text-lg font-medium text-gray-800">Title :- <span class="font-normal">{{$post->title}}</span></h3>
                   </div>
                   <div>
                       <h3 class="text-lg font-medium text-gray-800">Description :-</h3>
                       <p class="text-gray-600">{{$post->description}}</p>
                   </div>
               </div>
           </div>


           <!-- Post Creator Info Card -->
           <div class="bg-white rounded border border-gray-200">
               <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                   <h2 class="text-base font-medium text-gray-700">Post Creator Info</h2>
               </div>
               <div class="px-4 py-4">
                   <div class="mb-2">
                       <h3 class="text-lg font-medium text-gray-800">Name :- <span class="font-normal">{{$post->user?->name}}</span></h3>
                   </div>
                   <div class="mb-2">
                       <h3 class="text-lg font-medium text-gray-800">Email :- <span class="font-normal">{{$post->user?->email}}</span></h3>
                   </div>
                   <div>
                    <h3 class="text-lg font-medium text-gray-800">Image :- <img src="{{ asset('storage/posts/' . $post->image) }}" alt="Post Image"
                        class="w-48 h-auto rounded-md"></h3>
                   </div>
                   <div>
                       <h3 class="text-lg font-medium text-gray-800">Created At :- <span class="font-normal">{{$post->created_at->format('l jS \o\f F Y h:i:s A')}}</span></h3>
                   </div>
                   <div class="mt-3">
                    {{-- {{ dd($post->tags) }} --}}

                    <strong>Tags:</strong>
                    @foreach ($post->tags as $tag)
                    <a href="#" class="inline-block px-3 py-1 bg-blue-500 text-white text-sm rounded-full mr-2 hover:bg-blue-600">
                        {{ $tag->name }}
                    </a>
                @endforeach



                </div>

               </div>
           </div>


            <!-- Post comments Info Card -->
            <div class="bg-white rounded border border-gray-200">
                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                    <h2 class="text-base font-medium text-gray-700">Comments</h2>
                </div>
                <form action="{{ route('comments.store', $post->id) }}" method="POST">
                    @csrf
                    <textarea name="body" required autofocus placeholder="Write your comment here..." class=" p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                     <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                      <x-button type="primary">Add</x-button>

                     </div>

                </form>


                <div class="px-4 py-6 bg-gray-50 border-b border-gray-200">
                <h3 class="text-base font-medium text-gray-700">All Comments:</h3>
                @foreach($post->comments as $comment)
                    <p>{{ $comment->body }}</p>
                @endforeach
                </div>
            </div>


           <!-- Back Button -->
           <div class="flex justify-end">
               <a href="{{route("posts.index")}}" class="px-4 py-2 bg-gray-600 text-white font-medium rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                   Back to All Posts
               </a>
           </div>
       </div>
   </div>
</body>
</html>
