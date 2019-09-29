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
        $url = 'http://ed.kyrg.info/category/news-events/';
        if ($request->page) {
            $url = $request->page;
        } else {
            $url = 'http://ed.kyrg.info/category/news-events/';
        }
        $dom = new Dom();
        $dom->load($url);
        $h2 = $dom->find('h2.entry-title > a');
        $excerpt = $dom->find('div#contentColumn > p');
        $prev = $dom->find('div.nav-previous > a');
        $next = $dom->find('div.nav-next > a');
        $posts = [];
            for ($i = 0; $i < count($h2); $i++) {
                $post = new Post();
                $post->title = $h2[$i]->text;
                $post->link = $h2[$i]->href;
                $post->excerpt = $excerpt[$i] ? $excerpt[$i]->text : '';
                $posts[] = $post;
            }
        return view('home', [
            'posts' => $posts,
            'prev' => isset($prev[0]) ? $prev[0]->href : null,
            'next' => isset($next[0]) ? $next[0]->href : null,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index2(Request $request)
    {
        $url = 'http://ed.kyrg.info/category/announcements/';
        if ($request->page) {
            $url = $request->page;
        } else {
            $url = 'http://ed.kyrg.info/category/announcements/';
        }
        $dom = new Dom();
        $dom->load($url);
        $h2 = $dom->find('h2.entry-title > a');
        $excerpt = $dom->find('div#contentColumn > p');
        $prev = $dom->find('div.nav-previous > a');
        $next = $dom->find('div.nav-next > a');
        $posts = [];
            for ($i = 0; $i < count($h2); $i++) {
                $post = new Post();
                $post->title = $h2[$i]->text;
                $post->link = $h2[$i]->href;
                $post->excerpt = $excerpt[$i] ? $excerpt[$i]->text : '';
                $posts[] = $post;
            }
        return view('home', [
            'posts' => $posts,
            'prev' => isset($prev[0]) ? $prev[0]->href : null,
            'next' => isset($next[0]) ? $next[0]->href : null,
        ]);
    }
}
