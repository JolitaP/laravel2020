<?php

//  TRAVERSY MEDIA 6 lesson

//controller
// add eloquent to Post model
use App\Post;
// grabt data from DB
public function index()
{
  $posts = Post::all();
  return view('posts.index')->with('posts',$posts);
}


// view
// lets loop
      @if(count($posts) > 1)
        @foreach ($posts as $post)
          <h3>{{$post->title}}</h3>
          <small>Written by: {{$post->author}}</small>
        @endforeach
      @else
        <p>No posts found>
      @endif

_______________ CLICK ON POST AND GET INDIVIDUAL PAGE___________
