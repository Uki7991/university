<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class PostController extends Controller
{
    public function index()
    {

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
//        dd($content);
        $title = $h1[0]->text;
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        return view('post.show', [
            'post' => $post,
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
//        dd($content);
        $title = $h1[0]->text;
        $post = new Post();
        $post->title = $title;
        $post->content = $content;
        return view('post.show', [
            'post' => $post,
        ]);
    }
}
