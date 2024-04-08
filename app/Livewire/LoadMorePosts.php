<?php

namespace App\Livewire;

use App\Models\Posts;
use Livewire\Component;

class LoadMorePosts extends Component
{
    public $num_of_posts = 10;

    public function loadMore()
    {
        $this->num_of_posts += 5;
    }

    public function render()
    {
        $post = new Posts();

        $posts = $post->take($this->num_of_posts)->get();

        $rest_posts = $post->count() - $posts->count();

        return view('livewire.load-more-posts', compact('posts', 'rest_posts'));
    }
}
