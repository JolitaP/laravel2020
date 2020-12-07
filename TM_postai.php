<?php

____________TRAVERSY MEDIA POSTS____________

// create controller
// -m (create migration, table for that post) -f (create factory)
php artisan make:controller PostController -m -f

// route
Route::get('/posts',[PostController::class, 'index'])-name('posts');
Route::post('/posts',[PostController::class, 'store']);

// controller
public function index()
  {
    return view('posts.index');
  }
public function store(Request $request)
  {
    $this->validate($request,[
      'body'=>'required'
    ]);
    Post::create([
// we can pass the user id in there, so you can extract that from currently authenticated user, using auth()->user()->id, or
// shorter: auth()->id()
      'user_id'=> auth()->user()->id,
      'body' => $request->body
    ])
  }

// hook up the link in menu view
<a href="{{route('posts')}}">Posts</a>

// view index.blade.php
                <form action="{{ route('posts') }}" method="post">
                  @csrf
                    <div class="form-group">
                      <label for="body">Body</label>
                      <textarea name="body" id="body" cols="30" rows="4" placeholder="Enter your post"></textarea>
                          @error('name')
                          <div class="text-danger">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div>
                        <button type="submit">Submit</button>
                    </div>
                </form>

// create model Post, migration(teble for migration) and factory
php artisan make:model Post -m -f

// fill migration table
Schema::create('posts', function (Blueprint $table){
  $table->id();
// we can use this method, but...
  $table->integer('user_id')->unsigned()->index();
// or better way is:
// reference a foreign key automatically. foreignId('user_id')-references users table on the id column. constreined()-means
// that we have foreign key contrained to this and that helps to pick records constain foreign keys. onDelete('cascade')-
// when we delete user, any users posts are cascade and delete in db.
// referance foreign key atomatically table will be constrained to user_id
  $table->foreignId('user_id')->constrained()->onDelete('cascade');
  $table->text('body');
  $table->timestamps();
});

// foreignId , unsignedInteger ,

// migrate
php artisan migrate

//go back to controller


// relationship between posts and users
