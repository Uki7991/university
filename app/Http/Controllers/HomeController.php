<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $page = 1;
        if ($request->page) {
            $page = $request->page;
        }
        $url = 'http://ed.kyrg.info/category/news-events/page/'.$page.'/';
        $dom = new Dom();
        $dom->load($url);
        $h2 = $dom->find('h2.entry-title > a');
        $excerpt = $dom->find('div#contentColumn > p');
        $posts = [];
        if (count($h2) == count($excerpt)) {
            for ($i = 0; $i < count($h2); $i++) {
                $post = new Post();
                $post->title = $h2[$i]->text;
                $post->link = $h2[$i]->href;
                $post->excerpt = $excerpt[$i]->text;
                $posts[] = $post;
            }
        }
        return view('home', [
            'posts' => $posts,
        ]);
    }
}
