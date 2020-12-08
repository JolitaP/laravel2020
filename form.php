<?php
<form class="form-signin" action="{{ route('register') }}" method="post">
         @csrf
         <div class="form-group">
           <label for="name">Name</label>
           <input class="form-control @error('name')is-invalid @enderror"  type="text" name="name" id="name" placeholder="Enter your name"
           value="{{ old('name') }}">
             @error('name')
             <div class="text-danger">
               {{ $message }}
             </div>
             @enderror
           </div>

         <div class="form-group">
           <label for="username">Username</label>
           <input class="form-control  @error('username')is-invalid @enderror" type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
           @error('username')
           <div class="text-danger">
             {{ $message }}
           </div>
           @enderror
         </div>

         <div class="form-group">
           <label for="email">Email</label>
           <input class="form-control  @error('email')is-invalid @enderror" type="text" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
           <small id="emailHelp" class="form-text text-muted">We'll never share your name with anyone else.</small>
           @error('email')
           <div class="text-danger">
             {{ $message }}
           </div>
           @enderror
         </div>

         <div class="form-group">
           <label for="password">Password</label>
           <input class="form-control  @error('password')is-invalid @enderror" type="password" name="password" id="password" placeholder="password" value="">
           @error('password')
           <div class="text-danger">
             {{ $message }}
           </div>
           @enderror
         </div>

         <div class="form-group">
           <label for="password_confirmation">Repeat password</label>
           <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" value="">
         </div>

         <div class="form-group">
           <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
         </div>
</form>
