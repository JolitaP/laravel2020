<?php
//--- get--- validate--- create--- where--- find--- Request $request --- findOrFail
________________TRAVERSY_MEDIA__________________
// Traversy media:
  class RegisterController extends Controller
  {
      public function index()
      {
        return view('auth.register');
      }

// paimame uzklausa Request $request --- validate(paimti uzklausa). request yra uzklausimas i forma.
    public function store(Request $request)
    {
      $this->validate($request,[
        'name' => 'required|max:255',
        'username' => 'required|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|confirmed',
      ]);

// nusiunciame duomenis i lentele  ---- create --- Hash::make
      User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
      ]);

// now we need to sign in user. user Auth:: facades or auth() helper function
// when user sign in, he gets User model. This will be useful with users tables where you want output the users name or else.
auth()->user();
// but lets use auth() helper or Auth:: facades if you want, and atttempt(thats how we sign user in), and now we pass thow the users email or else {
auth()->attempt([
  'email' => $request->email,
  'password' => $request->password
]);
// but there is a much easier way to do this
auth()->attempt($request->only('email','password'));

      return redirect()->route('dashboard');
    }
}


// view

// if we ar signed in, show only theese buttons, we use if else statements
@if (auth()->user())
        <li>
          <a href="">Name username</a>
        </li>
        <li>
          <a href="">Logout</a>
        </li>
@else
        <li>
          <a href="">Login</a>
        </li>
        <li>
          <a href="">Register</a>
        </li>
@endif


// another way - is to use @auth and @guest

@auth
        <li>
          <a href="">Name username</a>
        </li>
        <li>
          <a href="">Logout</a>
        </li>
@endauth

@guest
        <li>
          <a href="">Login</a>
        </li>
        <li>
          <a href="">Register</a>
        </li>
@endguest
