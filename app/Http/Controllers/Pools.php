<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Pools extends Controller
{
    public function index()
    {
        return view('pools.list', ['pools' => Pool::withCount('posts')->paginate(20)]);
    }

    public function create()
    {
        return view('pools.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:2',
            'visible' => 'required'
        ]);

        $pool = Pool::create([
            'name' => request('name'),
            'description' => request('description'),
            'user_id' => 1,
            'visible' => request('visible')
        ]);

        return redirect()->back()->with('success', 'The pool <b>'. $pool->name .'</b> has been created.');
    }

    public function addPost(Booru $id)
    {
        return view('pools.add-post', ['post' => $id, 'pools' => Pool::all()]);
    }

    public function storePost($post, Request $request)
    {
        $this->validate($request, [
            'pool' => 'required'
        ]);

        $check = Pooled::where('booru_id', $post)->where('pool_id', request('pool'))->first();

        if ($check != null) {
            return back()->with('error', 'This post already exists in the pool.');
        }

        Pooled::create([
            'booru_id' => $post,
            'pool_id' => request('pool')
        ]);

        return back()->with('success', 'The post was added to the pool.');
    }

    public function addPosts()
    {
        return view('pools.add-posts', ['pools' => Pool::all()]);
    }

    public function storePosts(Request $request)
    {
        $this->validate($request, [
            'pool' => 'required',
            'posts' => 'required|regex:/^\d+(?:,\d+)*$/'
        ]);

        $ignored = [];
        $added = [];
        $error = [];
        $posts = rtrim(request('posts'), ',');
        $posts = explode(',', $posts);
        $posts = array_unique($posts);

        foreach ($posts as $post) {
            $booru = Booru::where('id', $post)->first();
            $check = Pooled::where('booru_id', $post)->where('pool_id', request('pool'))->first();

            if ($check != null) {
                $ignored[] = $post;
            } elseif ($booru == null) {
                 $error[] = $post;
            } else {
                $added[] = $post;

                Pooled::create([
                    'booru_id' => $post,
                    'pool_id' => request('pool')
                ]);
            }
        }

        $data = [];

        (! empty($added)) ? $data['success'] = 'You have successfully added the following posts to the collection: '. implode(',', $added) : '';
        (! empty($ignored)) ? $data['warning'] = 'The following posts are already included in the collection and have been ignored: '. implode(',', $ignored) : '';
        (! empty($error)) ? $data['error'] = 'The following posts do not exist and have been ignored: '. implode(',', $error) : '';

        return back()->with($data);
    }

    public function addTags()
    {
        return view('pools.add-tags', ['pools' => Pool::all()]);
    }

    public function storeTags(Request $request)
    {
        $this->validate($request, [
            'pool' => 'required',
            'tags' => 'required'
        ]);

        $ignored = [];
        $error = [];
        $tags = rtrim(request('tags'), ',');
        $tags = explode(',', $tags);
        $tags = array_unique($tags);

        foreach ($tags as $tag) {
            $tag = trim($tag);

            if ($tag != '') {
                $tagCheck = Tag::where('name', $tag)->first();

                if ($tagCheck != null) {
                    foreach ($tagCheck->posts as $p) {
                        $postCheck = Pooled::where('booru_id', $p->id)->where('pool_id', request('pool'))->first();

                        if ($postCheck != null) {
                            $ignored[] = $p->id;
                        } else {
                            $added[] = $tagCheck->name .' ('. $tagCheck->posts->count() .')';

                            Pooled::create([
                                'booru_id' => $p->id,
                                'pool_id' => request('pool')
                            ]);
                        }
                    }
                } else {
                    $error[] = $tag;
                }
            }
        }

        $data = [];

        (! empty($added)) ? $data['success'] = 'You have successfully added the following tags to the collection: '. implode(',', array_unique($added)) : '';
        (! empty($ignored)) ? $data['warning'] = 'The following posts are already included in the collection and have been ignored: '. implode(',', array_unique($ignored)) : '';
        (! empty($error)) ? $data['error'] = 'The following tags do not exist and have been ignored: '. implode(',', array_unique($error)) : '';

        return back()->with($data);
    }
}
