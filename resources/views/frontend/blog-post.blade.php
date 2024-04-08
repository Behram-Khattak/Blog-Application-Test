<x-guest-layout>
    <style>
        *{
        boxShadow: "none !important",
       }

        #tags-input {
            display: inline-block;
        }

        #tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            border: 1px solid #ccc;
            padding: 0.25rem;
            border-radius: 0.25rem;
        }

        .tag {
            background-color: #f2f2f2;
            padding: 0.25rem 0.5rem;
            border-radius: 0.50rem;
            display: inline-flex;
            align-items: center;
        }

        .tag-text {
            margin-right: 0.25rem;
        }

        .tag-close {
            cursor: pointer;
            font-weight: bold;
            color: #999;
            font-size: 0.8rem;
        }

        #tags-suggestions {
            max-height: 8rem;
            overflow-y: auto;
        }

    </style>
    <div class="content max-w-screen-xl mx-auto px-4">

        <!-- blog post edit Modal toggle -->
        @auth
            @if (auth()->user()->id === $posts->user_id && auth()->user()->role === 'user')
                <div class="flex items-center gap-4 pb-6">
                    <button data-modal-target="static-modal"
                        data-modal-toggle="static-modal"
                        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 text-center" type="button">
                            Edit
                    </button>

                    <a href="{{ route('frontend.blog-my-post.delete', $posts->id) }}"
                        class="block text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 text-center" type="button">
                        Delete
                    </a>
                </div>
            @endif
        @endauth

        {{-- alerts --}}
        @if (session('deleted'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                {{ session('deleted') }}
            </div>
            @elseif (session('created'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                {{ session('created') }}
            </div>
            @elseif (session('updated'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100" role="alert">
                {{ session('updated') }}
            </div>

            <x-errors />
        @endif

        <!-- Edit Main modal -->
        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-screen-xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-gray-50 rounded-lg shadow">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Edit Post
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        {{-- @foreach ($post as $data) --}}
                            <form action="{{ route('frontend.blog-my-post.update', $posts->id) }}"
                                method="POST"
                                enctype="multipart/form-data"
                                class="w-full">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="title" class="font-bold text-3xl capitalize">title</label><br>
                                    <input type="text" id="title" name="title" value="{{ $posts->title }}" class="bg-transparent border-0 border-b-2 w-full focus:ring-0 pt-4" required placeholder="write here...">
                                </div>
                                <div class="sm:grid sm:grid-cols-2 space-y-16 sm:space-y-0 gap-8 my-16">
                                    <div class="mb-3">
                                        <label for="category" class="font-bold text-3xl capitalize">category</label><br>
                                        <select id="category" name="category" required class="border-0 bg-transparent border-b-2 w-full focus:ring-0 pt-4">
                                            <option selected value="{{ $posts->category->id }}">{{ $posts->category->name }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="relative">
                                        <label for="tags" class="font-bold text-3xl capitalize">Tags</label>

                                            <input type="text" id="tags-input" placeholder="Enter tags" class="bg-transparent border-0 border-b-2 w-full focus:ring-0 pt-4">
                                            <div id="tags-suggestions" class="mt-2 bg-white border border-gray-300 rounded-lg shadow-md hidden">
                                            </div>

                                        <div id="tags-container" class="mt-2">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 pb-16 w-[24.5rem] sm:w-full">
                                    <label for="editor" class="font-bold text-3xl capitalize">description</label><br>
                                    <textarea id="editor" name="description" class="border-0 border-b-2 w-full focus:ring-0 pt-4" rows="5" cols="5" required placeholder="write here...">
                                    {!! $posts->description !!}
                                    </textarea>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="thumbnail" class="font-bold text-3xl capitalize">thumbnail</label><br>
                                        <input type="file" id="thumbnail" accept="image/jpeg, image/png" name="thumbnail" class="border-0 border-b-2 border-black w-full focus:ring-0 pt-4">
                                    </div>
                                </div>

                                <div class="mt-16">
                                    <button type="submit"
                                            class="capitalize text-md font-bold border-2 border-black hover:bg-black hover:text-white p-4 w-full">
                                        Edit
                                    </button>
                                </div>
                            </form>
                        {{-- @endforeach --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- blog post details --}}
        {{-- @foreach ($post as $data) --}}
            <div class="blog-post">
                <div class="blog-post-author flex items-center justify-center gap-4">
                    <span class="text-sm font-bold text-gray-500">Author:</span>
                    <h2 class="font-bold text-xl capitalize">{{ $posts->user->name }}</h2>
                </div>

                <div class="post-content my-8 max-w-screen-lg mx-auto">
                    <div class="post-title font-extrabold text-4xl capitalize text-center">
                        <h1>{{ $posts->title }}</h1>
                    </div>
                    <div class="category text-center pt-8">
                        <a href="{{ route('frontend.blog-category-post', $posts->category_id) }}">
                            <span class="category font-bold capitalize bg-gray-200 p-2 rounded-full hover:underline">
                                {{ $posts->category->name }}
                            </span>
                        </a>
                    </div>
                    <div class="post-thumbnail py-16 grid place-items-center">
                        <img class="rounded-t-lg"
                            src="{{ asset('storage/thumbnails/'.$posts->thumbnail) }}"
                            alt="thumbnail" />
                    </div>
                    <div class="post-description">
                        <div class="text-justify">
                            {!! $posts->description !!}
                        </div>
                    </div>
                    {{-- tags --}}
                    <div class="tags-section mt-10 grid place-items-center">
                        <div class="flex items-center gap-4">
                            <h3 class="font-bold text-sm text-gray-500">Tags:</h3>
                            <div class="tags flex gap-4">
                                @foreach ($posts->tags as $tags)
                                    <a href="{{ route('frontend.blog-tag-post', $tags->id) }}"
                                        class="capitalize hover:underline bg-gray-200 py-1 px-2 rounded-full">
                                            {{ $tags->name }}
                                        </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- @endforeach --}}
    </div>

    <x-slot:scripts>
        <script type="text/javascript">
            const tagsInput = document.getElementById('tags-input');
            const tagsSuggestions = document.getElementById('tags-suggestions');
            const tagsContainer = document.getElementById('tags-container');

            function showTagsSuggestions(matchedTags) {
                const suggestionsHTML = matchedTags.map(tag => `<div class="p-2 cursor-pointer hover:bg-gray-100">${tag}</div>`).join('');
                tagsSuggestions.innerHTML = suggestionsHTML;
                tagsSuggestions.classList.remove('hidden');
            }

            // function hideTagsSuggestions() {
            //     tagsSuggestions.innerHTML = '';
            //     tagsSuggestions.classList.add('hidden');
            // }

            // tagsInput.addEventListener('input', () => {
            //     const inputValue = tagsInput.value.toLowerCase().trim();
            //     const matchedTags = predefinedTags.filter(tag => tag.includes(inputValue));

            //     if (matchedTags.length > 0) {
            //         showTagsSuggestions(matchedTags);
            //     } else {
            //         hideTagsSuggestions();
            //     }
            // });

            // tagsInput.addEventListener('focus', () => {
            //     if (predefinedTags.length > 0) {
            //         showTagsSuggestions(predefinedTags);
            //     }
            // });

            // document.addEventListener('click', event => {
            //     if (!tagsInput.contains(event.target) && !tagsSuggestions.contains(event.target)) {
            //         hideTagsSuggestions();
            //     }
            // });

            // tagsSuggestions.addEventListener('click', event => {
            //     if (event.target.tagName === 'DIV') {
            //         const selectedTag = event.target.textContent;
            //         if (!tagsContainer.querySelector(`[data-tag="${selectedTag}"]`)) {
            //             addTag(selectedTag);
            //         }
            //         tagsInput.value = '';
            //         hideTagsSuggestions();
            //     }
            // });

            tagsInput.addEventListener('keydown', event => {
                if (event.key === 'Enter' && tagsInput.value.trim() !== '') {
                    addTag(tagsInput.value.trim());
                    tagsInput.value = '';
                    event.preventDefault();
                }
            });

            tagsContainer.addEventListener('click', event => {
                if (event.target.classList.contains('tag-close')) {
                    const tagToRemove = event.target.getAttribute('data-tag');
                    const tagElement = event.target.parentElement;
                    tagsContainer.removeChild(tagElement);
                }
            });

            function addTag(tagText) {
                const tagElement = document.createElement('div');
                tagElement.className = 'tag';
                tagElement.innerHTML = `
                    <span class="tag-text">${tagText}</span>
                    <input type="text" id="tags" value="${tagText}" name="tags[]" class="hidden">
                    <span class="tag-close" data-tag="${tagText}">x</span>
                `;
                tagsContainer.appendChild(tagElement);
            }

            // implementing ckeditor to the textarea post description
            ClassicEditor
            .create( document.querySelector('#editor') )
            .catch( error => {
                console.error( error );
            } );

        </script>
    </x-slot:scripts>
</x-guest-layout>
