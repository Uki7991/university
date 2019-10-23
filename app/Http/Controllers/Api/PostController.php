<?php

namespace App\Http\Controllers\Api;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PHPHtmlParser\Dom;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $url = 'http://ed.kyrg.info/category/news-events';
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
        $countPosts = $dom->find('#post_count_t')->value;
        $posts = [];
            for ($i = 0; $i < count($h2); $i++) {
                $post = new Post();
                $post->title = $h2[$i]->text;
                $post->link = $h2[$i]->href;
                $post->excerpt = $excerpt[$i]? $excerpt[$i]->text : '';
                $posts[] = $post;
            }
        return response()->json([
            'posts' => $posts,
            'prev' => isset($prev[0]) ? $prev[0]->href : null,
            'next' => isset($next[0]) ? $next[0]->href : null,
            'countPosts' => $countPosts,
        ]);
    }

    public function show(Request $request)
    {
        $dom = new Dom();
        $dom->load($request->link);
        $h1 = $dom->find('h1.entry-title');
        $contentHtml = $dom->find('div.entry-content > p');
        $content = '';
        foreach ($contentHtml as $item) {
            $content .= $item->outerHtml;
            $content .= ' ';
        }
        $title = $h1[0]->text;
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        return response()->json([
            'post' => $post,
        ]);
    }

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
        $countPosts = $dom->find('#post_count_t')->value;
        $posts = [];
            for ($i = 0; $i < count($h2); $i++) {
                $post = new Post();
                $post->title = $h2[$i]->text;
                $post->link = $h2[$i]->href;
                $post->excerpt = $excerpt[$i] ? $excerpt[$i]->text : '';
                $posts[] = $post;
            }
        return response()->json([
            'posts' => $posts,
            'prev' => isset($prev[0]) ? $prev[0]->href : null,
            'next' => isset($next[0]) ? $next[0]->href : null,
            'countPosts' => $countPosts,
        ]);
    }

    public function show2(Request $request)
    {
        $dom = new Dom();
        $dom->load($request->link);
        $h1 = $dom->find('h1.entry-title');
        $contentHtml = $dom->find('div.entry-content > p');
        $content = '';
        foreach ($contentHtml as $item) {
            $content .= $item->outerHtml;
            $content .= ' ';
        }
        $title = $h1[0]->text;
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        return response()->json([
            'post' => $post,
        ]);
    }
}
