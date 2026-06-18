<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aquí están definidas las rutas de tu API.
|
*/

Route::group(['namespace' => 'Api'], function () {

    // Autenticación
    Route::post('users/login', 'AuthController@login');
    Route::post('users', 'AuthController@register');

    // Gestión de Usuario
    Route::get('user', 'UserController@index');
    Route::match(['put', 'patch'], 'user', 'UserController@update');

    // Perfiles
    Route::get('profiles/{user}', 'ProfileController@show');
    Route::post('profiles/{user}/follow', 'ProfileController@follow');
    Route::delete('profiles/{user}/follow', 'ProfileController@unFollow');

    // Artículos (puedes usarlos como base o crear los tuyos)
    Route::get('articles/feed', 'FeedController@index');
    Route::post('articles/{article}/favorite', 'FavoriteController@add');
    Route::delete('articles/{article}/favorite', 'FavoriteController@remove');

    Route::resource('articles', 'ArticleController', [
        'except' => [
            'create', 'edit'
        ]
    ]);

    Route::resource('articles/{article}/comments', 'CommentController', [
        'only' => [
            'index', 'store', 'destroy'
        ]
    ]);

    // Tags
    Route::get('tags', 'TagController@index');

    // --- NUEVAS RUTAS PARA "PLACES" ---
    // Usamos el controlador PlaceController que crearás después
    Route::resource('places', 'PlaceController', [
        'except' => ['create', 'edit']
    ]);

});