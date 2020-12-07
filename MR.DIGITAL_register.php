<?php

___________________MR.DIGITAL____________
// Mr. digital lesson 6 for older versions of Laravel.
// in controller get everything from DB
_________________________
// controller - show all
$users = User::get();
 // view
@foreach($users as $user)
  {{$user->fname}}
@endforeach

________________________________
// where email is this, grab the first result and display it
$user = User::where('email', info@email.com)->first();
_________________________________
// ieskome daugiau duomenu, paimti visus su name - Sean
$user = User::where('name', Sean)->get();
____________________________________
// kaip nusiusti is routes i controller uzklausima apie DB esancia eilute
Route:: get('users/user/{id}, [UserController::class, 'index']');
// controlleryje paimame kintamaji id, ieskome kintamojo id ir persiuciame ji per nurodyma  compact('user')
public function index($id)
$user = User::findOrFail($id);
return view('home', compact ('user'));


____________________GRAB_DATA_FROM_FORM_____________
// view
// success message loop
@if(session()->has('success'))
  {{session()->get('success')}}
@endif

// errors, vienas is budu iskviesti klaidas
@if($errors->any())
  @forech($errors->all() as $error)
  {{$error}}
  @endforeach
@endif
// action- mums reikia nurodyti post nuoroda
<form method="post" action="{{route('createuser')}}">
@scrf
  <input type="text" name="fname" placeholder="Enter name" value="old('fname')"></br>
  <input type="text" name="lname" placeholder="Enter last name"></br>
  <input type="text" name="email" placeholder="Enter email"></br>
  <input type="password" name="password" placeholder="Enter password"></br>
  <textarea name="notes" placeholder="Notes"></textarea></br>
  <button type="submit">Create User</button>
</form>
// route
// create post route for post method --- name of the route is name->'createuser'
Route::post('users/create',[UsersController::class, 'saveUser'])->name('createuser');
// controller
// now in controller we do type hint called Request
public function saveUser(Request $request)
  {
    // dd($request->all());

    // using Eloquent lets create a new user we use this in L7 and earlier
    $user = new User
    // i lenteles fname skilti -> idedame is formje esanti fname (reiksme)
    $user->fname = $request->fname;
    $user->lname = $request->lname;
    $user->email = $request->email;
    $user->password = $request->password;
    $user->notes = $request->notes;
    $user->save();

    return redirect()->back->with('success','User has been added successfully');
    // but we need loop through the seesion and grab the success message we have just sent back
  }

____________________DISPLAY_DATA_FROM_DB_________

//route
Route::get('users', [UsersController::class, 'showUsers']);
//Controller
public function showUsers(){
  $users = User::get();
// or
  $users = User::paginate(20);
// return view
 return view('users', compact('users'));
}
// create view table
<table>
<thead>
  <tr>
    <th>First name</th>
    <th>Last name</th>
    <th>Email</th>
  </tr>
</thead>
<tbody>
@foreach($users as $user)
  <tr>{{ $user->fname }}</tr>
  <tr>{{ $user->lname }}</tr>
  <tr>{{ $user->email }}</tr>
@endforeach
</tbody>
</table>
// function with links , automate paginating for laravel
{{ $users->links() }}

___________________DISPLAY_DATA_OF_ONE_USER__________

// ROUTE
Route::get('users/view/{id}', [UserController::class, 'viewUser']);
// controller
public function viewUsers($id)
  {
    $user = User::findOrFail($id);
    return view ('viewuser', compact('user'));
  }
// view
<h1>{{$user->fname}}{{$user->lname}}</h1>

_______________EDIT_USER______________

// route and controller same as display user
// view, grab the form, create new action="" (find the data in the DB and make the changes)
<form method="post" action="">
// here we dont need csrf
  <input type="text" name="fname" placeholder="Enter name" value="{{$user->fname}}"></br>
  <input type="text" name="lname" placeholder="Enter last name" value="{{$user->lname}}"></br>
  // we have to check if the email is unique
  <input type="text" name="email" placeholder="Enter email" value="{{$user->email}}"></br>
  <input type="password" name="password" placeholder="Enter password" value="{{$user->password}}"></br>
  // in the notes we do it like this
  <textarea name="notes" placeholder="Notes">{{$user->notes}}</textarea></br>
  <button type="submit">Save changes</button>
</form>
