<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/decompose','\Lubusin\Decomposer\Controllers\DecomposerController@index');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// Patterns
Route::pattern('id', '\d+');
Route::pattern('hash', '[a-z0-9]+');
Route::pattern('hex', '[a-f0-9]+');
Route::pattern('uuid', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
Route::pattern('base', '[a-zA-Z0-9]+');
Route::pattern('slug', '[a-z0-9_-]+');
Route::pattern('username', '[a-z0-9_-]{3,16}');
//Route::get('articles/{slug}', 'ArticleController@getFull');

/*
Route::get('user/{id}', function($id) {
    return 'User '.$id;
});
*/
Route::get('amazon', function() {
  $results = Amazon::search('Home Alone')->json();
  //dd($results);
  $product = Amazon::lookup('B004VLKY8M')->json();
  dd($product);
});

Route::get('UPC/{code}', 'RecommendationsController@productLookup');
    //dd($upc);
//});

Route::get('/search', function () {
    return view('search.search');
});





// redirect the user to "/login"
// and stores the url being accessed on session
Route::filter('auth', function() {
    if (Auth::guest()) {
        return Redirect::guest('login');
    }
});
//On login action:
// redirect the user back to the intended page
// or defaultpage if there isn't one
/*
if (Auth::attempt(['email' => $email, 'password' => $password])) {
    return Redirect::intended('defaultpage');
}
*/





Route::group(
[
    'prefix' => 'recommendations',
], function () {

    Route::get('/', 'RecommendationsController@index')
         ->name('recommendations.recommendation.index');


    Route::get('/mine', 'RecommendationsController@mine')
          ->name('recommendations.recommendation.mine')->middleware('auth');;


    Route::get('/create','RecommendationsController@create')
         ->name('recommendations.recommendation.create')->middleware('auth');
         /*Route::get('/show/{slug}', function($slug)
         {
           dd($slug);
         });
         */
    Route::get('/show/{slug}','RecommendationsController@show')
          ->name('recommendations.recommendation.show');
         //->where('id', '[0-9]+');

    Route::get('/{recommendation}/edit','RecommendationsController@edit')
         ->name('recommendations.recommendation.edit')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::post('/', 'RecommendationsController@store')
         ->name('recommendations.recommendation.store')->middleware('auth');

    Route::put('recommendation/{recommendation}', 'RecommendationsController@update')
         ->name('recommendations.recommendation.update')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::delete('/recommendation/{recommendation}','RecommendationsController@destroy')
         ->name('recommendations.recommendation.destroy')
         ->where('id', '[0-9]+')->middleware('auth');

});




Route::group(
[
    'prefix' => 'catalogs',
], function () {

  Route::get('/show/{slug}','CatalogsController@show')
        ->name('catalogs.catalog.show');
       //->where('id', '[0-9]+');

    Route::get('/', 'CatalogsController@index')
         ->name('catalogs.catalog.index');

   Route::get('/mine', 'CatalogsController@mine')
         ->name('catalogs.catalog.mine')->middleware('auth');




    Route::get('/create','CatalogsController@create')
         ->name('catalogs.catalog.create')->middleware('auth');
/*
    Route::get('/show/{list}','CatalogsController@show')
         ->name('catalogs.catalog.show')
         ->where('id', '[0-9]+');
*/
    Route::get('/{list}/edit','CatalogsController@edit')
         ->name('catalogs.catalog.edit')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::post('/', 'CatalogsController@store')
         ->name('catalogs.catalog.store')->middleware('auth');

    Route::put('catalog/{catalog}', 'CatalogsController@update')
         ->name('catalogs.catalog.update')
         ->where('id', '[0-9]+')->middleware('auth');

    Route::delete('/catalog/{catalog}','CatalogsController@destroy')
         ->name('catalogs.catalog.destroy')
         ->where('id', '[0-9]+')->middleware('auth');

});


Route::group(['domain' => '{account}.voyager.local'], function()
{
//echo $account . ' ' . $id;
//die();
    Route::get('user/{id}', function($account, $id)
    {
        //
    });

});
