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

        <div class="write-title">
            <h2 class="text-center text-4xl font-extrabold capitalize">write what you want to...</h2><br>
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
            @endif

            <x-errors />
        </div>

        <div class="content grid place-items-center my-16 write-blog-post">
            <form action="{{ route('frontend.blog-post-write.post-blog') }}"
                method="POST"
                enctype="multipart/form-data"
                class="w-full">
                @csrf

                <div class="mb-3">
                    <label for="title" class="font-bold text-3xl capitalize">title</label><br>
                    <input type="text" id="title" name="title" value="Lorem ipsum dolor sit amet consectetur, adipiscing elit quisque imperdiet." class="border-0 border-b-2 w-full focus:ring-0 pt-4" required placeholder="write here...">
                </div>
                <div class="sm:grid sm:grid-cols-2 space-y-16 sm:space-y-0 gap-8 my-16">
                    <div class="mb-3">
                        <label for="category" class="font-bold text-3xl capitalize">category</label><br>
                        <select id="category" name="category" required class="border-0 border-b-2 w-full focus:ring-0 pt-4">
                            <option selected disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative">
                        <label for="tags" class="font-bold text-3xl capitalize">Tags</label>

                            <input type="text" id="tags-input" placeholder="Enter tags" class="border-0 border-b-2 w-full focus:ring-0 pt-4">
                            <div id="tags-suggestions" class="mt-2 bg-white border border-gray-300 rounded-lg shadow-md hidden">
                            </div>

                        <div id="tags-container" class="mt-2">
                        </div>
                    </div>
                </div>
                <div class="mb-3 pb-16 w-[24.5rem] sm:w-full">
                    <label for="editor" class="font-bold text-3xl capitalize">description</label><br>
                    <textarea id="editor" name="description" class="border-0 border-b-2 w-full focus:ring-0 pt-4" rows="5" cols="5" required placeholder="write here...">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia ipsam ut cupiditate, tempore error modi nihil impedit fugiat. Repellat, nisi qui. Molestias nemo iste praesentium dolor quasi labore, aut atque totam velit, quod aliquam vel! Vero odio distinctio consequatur perferendis, architecto quidem ullam. Hic maxime expedita rerum dignissimos non aliquid. Libero aperiam eum, itaque dolor ex ut assumenda sequi ullam provident iure eius officia consectetur quo eos, sit quidem repellendus nihil? Ipsa quas quam, aliquid error, cum illo eius harum laboriosam similique nam numquam blanditiis. Neque minima rerum iure a, quibusdam ab dolor molestiae voluptatum voluptatibus qui blanditiis vero facere.
                    </textarea>
                </div>

                <div class="mb-3">
                    <div class="mb-3">
                        <label for="thumbnail" class="font-bold text-3xl capitalize">thumbnail</label><br>
                        <input type="file" id="thumbnail" accept="image/jpeg, image/png" required name="thumbnail" class="border-0 border-b-2 border-black w-full focus:ring-0 pt-4">
                    </div>
                </div>

                <div class="mt-16">
                    <button type="submit"
                            class="capitalize text-md font-bold border-2 border-black hover:bg-black hover:text-white p-4 w-full">
                        add
                    </button>
                </div>
            </form>
        </div>

    </div>

    <x-slot:scripts>
        <script>
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
