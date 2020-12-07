<?php

// modeliuose nustatome relationships,

_____ONE_TO_ONE____________

// create User and Profile models
php artisan make:model Profile -m
// in models we set relationships
public function profile()
{
  return $this->hasOne(Profile::class);
}


// ___________________Belongs to _________________________


    public function user()
    {
        return $this->belongsTo(User::class);
    }

// _______________________________________________________

//>migrations
// now for any given profile we can link it up with a given user('user_id')
public function up()
{
  $table->increments('id');
// unsignedincrement yra eloquent pavadinimas, user-lenteles pavadinimas
// id - user lenteleje esantis laukelis.
  $table->unsignedIncrement('user_id')
  $table->string(website_url);
  $table->timestamps();
}
// migrate our database
php artisan migrate

___________ONE_TO_MANY_______________
// models
public function posts()
{
  return $this->hasMany(Post::class);
}
migration

// migrations
// if the user has many posts, then a single post belongs to user
$table->unsignedInteger('user_id');
