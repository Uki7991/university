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

        return $this->returnView($url, 'news');
    }

    public function returnView($url, $type)
    {
        $dom = new Dom();
        $dom->load($url);
        $postsDom = $dom->find('.post_div');
        $prev = $dom->find('div.nav-previous > a');
        $next = $dom->find('div.nav-next > a');
        $countPosts = $dom->find('#post_count_t')->value;
        $posts = [];
        for ($i = 0; $i < count($postsDom); $i++) {
            $post = new Post();
            $post->title = $postsDom[$i]->find('h2.entry-title > a')[0]->text;
            $post->link = $postsDom[$i]->find('h2.entry-title > a')[0]->href;
            $post->excerpt = $postsDom[$i]->find('p')[0] ? $postsDom[$i]->find('p')[0]->text : '';
            $post->date = $postsDom[$i]->find('.entry-meta > b')[0] ? $postsDom[$i]->find('.entry-meta > b')[0]->text : '';
            $post->image = $postsDom[$i]->find('img.wp-post-image')[0] ? $postsDom[$i]->find('img.wp-post-image')[0]->src : '';
            $post->type = $type;
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

        return $this->returnView($url, 'announcments');
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
