<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
 
Route::middleware('auth:api')->get('ebms_api/getLogin', function(Request $request) {
    return view('backend.pages.ebms_api.login');
});
Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Frontend\SiteController@index')->name('eden-garden-resort');


//comments
Route::get('comments/create', 'Frontend\SiteController@create')->name('site.comments.create');
Route::post('comments/store', 'Frontend\SiteController@postComment')->name('site.comments.store');

//contact
Route::post('post-message', 'Frontend\SiteController@postContact')->name('site.contact.store');

Route::get('/rooms','Frontend\SiteController@room')->name('site.rooms');
Route::get('infrastructures','Frontend\SiteController@infrastructure')->name('site.infrastructure');
Route::get('infrastructures','Frontend\SiteController@infrastructure')->name('site.infrastructure');
Route::get('salles','Frontend\SiteController@salle')->name('site.salle');
Route::get('events','Frontend\SiteController@event')->name('site.event');

 Route::get('/publications/newsletter','Frontend\SiteController@newsletter')->name('site.newsletter');
 Route::get('/publications/actualite','Frontend\SiteController@actualite')->name('site.actualite');
 Route::get('/publications/actualite/show/{id}','Frontend\SiteController@actualiteShow')->name('site.actualite-show');
 Route::get('/publications/appels-d-offres','Frontend\SiteController@appelsOffres')->name('site.appels_offres');

//contact
Route::post('post-message', 'Frontend\SiteController@postContact')->name('site.contact.store');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);




    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
    
    //change language
    Route::get('/changeLang','Backend\DashboardController@changeLang')->name('changeLang');

     //abouts routes
    Route::get('abouts/index', 'Backend\AboutController@index')->name('admin.abouts.index');
    Route::get('abouts/create', 'Backend\AboutController@create')->name('admin.abouts.create');
    Route::post('abouts/store', 'Backend\AboutController@store')->name('admin.abouts.store');
    Route::get('abouts/edit/{id}', 'Backend\AboutController@edit')->name('admin.abouts.edit');
    Route::put('abouts/update/{id}', 'Backend\AboutController@update')->name('admin.abouts.update');
    Route::delete('abouts/destroy/{id}', 'Backend\AboutController@destroy')->name('admin.abouts.destroy');

    //actualites routes
    Route::get('actualites/index', 'Backend\ActualiteController@index')->name('admin.actualites.index');
    Route::get('actualites/create', 'Backend\ActualiteController@create')->name('admin.actualites.create');
    Route::post('actualites/store', 'Backend\ActualiteController@store')->name('admin.actualites.store');
    Route::get('actualites/edit/{id}', 'Backend\ActualiteController@edit')->name('admin.actualites.edit');
    Route::put('actualites/update/{id}', 'Backend\ActualiteController@update')->name('admin.actualites.update');
    Route::delete('actualites/destroy/{id}', 'Backend\ActualiteController@destroy')->name('admin.actualites.destroy');

    //sliders routes
    Route::get('sliders/index', 'Backend\SliderController@index')->name('admin.sliders.index');
    Route::get('sliders/create', 'Backend\SliderController@create')->name('admin.sliders.create');
    Route::post('sliders/store', 'Backend\SliderController@store')->name('admin.sliders.store');
    Route::get('sliders/edit/{id}', 'Backend\SliderController@edit')->name('admin.sliders.edit');
    Route::put('sliders/update/{id}', 'Backend\SliderController@update')->name('admin.sliders.update');
    Route::delete('sliders/destroy/{id}', 'Backend\SliderController@destroy')->name('admin.sliders.destroy');

    //categories routes
    Route::get('categories/index', 'Backend\CategoryController@index')->name('admin.categories.index');
    Route::get('categories/create', 'Backend\CategoryController@create')->name('admin.categories.create');
    Route::post('categories/store', 'Backend\CategoryController@store')->name('admin.categories.store');
    Route::get('categories/edit/{id}', 'Backend\CategoryController@edit')->name('admin.categories.edit');
    Route::put('categories/update/{id}', 'Backend\CategoryController@update')->name('admin.categories.update');
    Route::delete('categories/destroy/{id}', 'Backend\CategoryController@destroy')->name('admin.categories.destroy');

    //category_salles routes
    Route::get('category_salles/index', 'Backend\CategorySalleController@index')->name('admin.category_salles.index');
    Route::get('category_salles/create', 'Backend\CategorySalleController@create')->name('admin.category_salles.create');
    Route::post('category_salles/store', 'Backend\CategorySalleController@store')->name('admin.category_salles.store');
    Route::get('category_salles/edit/{id}', 'Backend\CategorySalleController@edit')->name('admin.category_salles.edit');
    Route::put('category_salles/update/{id}', 'Backend\CategorySalleController@update')->name('admin.category_salles.update');
    Route::delete('category_salles/destroy/{id}', 'Backend\CategorySalleController@destroy')->name('admin.category_salles.destroy');

    //category_rooms routes
    Route::get('category_rooms/index', 'Backend\CategoryRoomController@index')->name('admin.category_rooms.index');
    Route::get('category_rooms/create', 'Backend\CategoryRoomController@create')->name('admin.category_rooms.create');
    Route::post('category_rooms/store', 'Backend\CategoryRoomController@store')->name('admin.category_rooms.store');
    Route::get('category_rooms/edit/{id}', 'Backend\CategoryRoomController@edit')->name('admin.category_rooms.edit');
    Route::put('category_rooms/update/{id}', 'Backend\CategoryRoomController@update')->name('admin.category_rooms.update');
    Route::delete('category_rooms/destroy/{id}', 'Backend\CategoryRoomController@destroy')->name('admin.category_rooms.destroy');

    //category_restaurations routes
    Route::get('category_restaurations/index', 'Backend\CategoryRestaurationController@index')->name('admin.category_restaurations.index');
    Route::get('category_restaurations/create', 'Backend\CategoryRestaurationController@create')->name('admin.category_restaurations.create');
    Route::post('category_restaurations/store', 'Backend\CategoryRestaurationController@store')->name('admin.category_restaurations.store');
    Route::get('category_restaurations/edit/{id}', 'Backend\CategoryRestaurationController@edit')->name('admin.category_restaurations.edit');
    Route::put('category_restaurations/update/{id}', 'Backend\CategoryRestaurationController@update')->name('admin.category_restaurations.update');
    Route::delete('category_restaurations/destroy/{id}', 'Backend\CategoryRestaurationController@destroy')->name('admin.category_restaurations.destroy');

    //comments routes
    Route::get('comments/index', 'Backend\CommentController@index')->name('admin.comments.index');
    Route::get('comments/create', 'Backend\CommentController@create')->name('admin.comments.create');
    Route::post('comments/store', 'Backend\CommentController@store')->name('admin.comments.store');
    Route::get('comments/edit/{id}', 'Backend\CommentController@edit')->name('admin.comments.edit');
    Route::put('comments/update/{id}', 'Backend\CommentController@update')->name('admin.comments.update');
    Route::put('comments/publish/{id}', 'Backend\CommentController@publish')->name('admin.comments.publish');
    Route::delete('comments/destroy/{id}', 'Backend\CommentController@destroy')->name('admin.comments.destroy');

    //positions routes
    Route::get('positions/index', 'Backend\PositionController@index')->name('admin.positions.index');
    Route::get('positions/create', 'Backend\PositionController@create')->name('admin.positions.create');
    Route::post('positions/store', 'Backend\PositionController@store')->name('admin.positions.store');
    Route::get('positions/edit/{id}', 'Backend\PositionController@edit')->name('admin.positions.edit');
    Route::put('positions/update/{id}', 'Backend\PositionController@update')->name('admin.positions.update');
    Route::delete('positions/destroy/{id}', 'Backend\PositionController@destroy')->name('admin.positions.destroy');

    //rooms routes
    Route::get('rooms/index', 'Backend\RoomController@index')->name('admin.rooms.index');
    Route::get('rooms/create', 'Backend\RoomController@create')->name('admin.rooms.create');
    Route::post('rooms/store', 'Backend\RoomController@store')->name('admin.rooms.store');
    Route::get('rooms/edit/{id}', 'Backend\RoomController@edit')->name('admin.rooms.edit');
    Route::put('rooms/update/{id}', 'Backend\RoomController@update')->name('admin.rooms.update');
    Route::delete('rooms/destroy/{id}', 'Backend\RoomController@destroy')->name('admin.rooms.destroy');

    //paillotes routes
    Route::get('paillotes/index', 'Backend\PailloteController@index')->name('admin.paillotes.index');
    Route::get('paillotes/create', 'Backend\PailloteController@create')->name('admin.paillotes.create');
    Route::post('paillotes/store', 'Backend\PailloteController@store')->name('admin.paillotes.store');
    Route::get('paillotes/edit/{id}', 'Backend\PailloteController@edit')->name('admin.paillotes.edit');
    Route::put('paillotes/update/{id}', 'Backend\PailloteController@update')->name('admin.paillotes.update');
    Route::delete('paillotes/destroy/{id}', 'Backend\PailloteController@destroy')->name('admin.paillotes.destroy');

    //salles routes
    Route::get('salles/index', 'Backend\SalleController@index')->name('admin.salles.index');
    Route::get('salles/create', 'Backend\SalleController@create')->name('admin.salles.create');
    Route::post('salles/store', 'Backend\SalleController@store')->name('admin.salles.store');
    Route::get('salles/edit/{id}', 'Backend\SalleController@edit')->name('admin.salles.edit');
    Route::put('salles/update/{id}', 'Backend\SalleController@update')->name('admin.salles.update');
    Route::delete('salles/destroy/{id}', 'Backend\SalleController@destroy')->name('admin.salles.destroy');

    //galleries routes
    Route::get('galleries/index', 'Backend\GallerieController@index')->name('admin.galleries.index');
    Route::get('galleries/create', 'Backend\GallerieController@create')->name('admin.galleries.create');
    Route::post('galleries/store', 'Backend\GallerieController@store')->name('admin.galleries.store');
    Route::get('galleries/edit/{id}', 'Backend\GallerieController@edit')->name('admin.galleries.edit');
    Route::put('galleries/update/{id}', 'Backend\GallerieController@update')->name('admin.galleries.update');
    Route::delete('galleries/destroy/{id}', 'Backend\GallerieController@destroy')->name('admin.galleries.destroy');

    //teams routes
    Route::get('teams/index', 'Backend\TeamController@index')->name('admin.teams.index');
    Route::get('teams/create', 'Backend\TeamController@create')->name('admin.teams.create');
    Route::post('teams/store', 'Backend\TeamController@store')->name('admin.teams.store');
    Route::get('teams/edit/{id}', 'Backend\TeamController@edit')->name('admin.teams.edit');
    Route::put('teams/update/{id}', 'Backend\TeamController@update')->name('admin.teams.update');
    Route::delete('teams/destroy/{id}', 'Backend\TeamController@destroy')->name('admin.teams.destroy');

    //certifications routes
    Route::get('certifications/index', 'Backend\CertificationController@index')->name('admin.certifications.index');
    Route::get('certifications/create', 'Backend\CertificationController@create')->name('admin.certifications.create');
    Route::post('certifications/store', 'Backend\CertificationController@store')->name('admin.certifications.store');
    Route::get('certifications/edit/{id}', 'Backend\CertificationController@edit')->name('admin.certifications.edit');
    Route::put('certifications/update/{id}', 'Backend\CertificationController@update')->name('admin.certifications.update');
    Route::delete('certifications/destroy/{id}', 'Backend\CertificationController@destroy')->name('admin.certifications.destroy');

    //restaurations routes
    Route::get('restaurations/index', 'Backend\RestaurationController@index')->name('admin.restaurations.index');
    Route::get('restaurations/create', 'Backend\RestaurationController@create')->name('admin.restaurations.create');
    Route::post('restaurations/store', 'Backend\RestaurationController@store')->name('admin.restaurations.store');
    Route::get('restaurations/edit/{id}', 'Backend\RestaurationController@edit')->name('admin.restaurations.edit');
    Route::put('restaurations/update/{id}', 'Backend\RestaurationController@update')->name('admin.restaurations.update');
    Route::delete('restaurations/destroy/{id}', 'Backend\RestaurationController@destroy')->name('admin.restaurations.destroy');

    //testimonials routes
    Route::get('testimonials/index', 'Backend\TestimonialController@index')->name('admin.testimonials.index');
    Route::get('testimonials/create', 'Backend\TestimonialController@create')->name('admin.testimonials.create');
    Route::post('testimonials/store', 'Backend\TestimonialController@store')->name('admin.testimonials.store');
    Route::get('testimonials/edit/{id}', 'Backend\TestimonialController@edit')->name('admin.testimonials.edit');
    Route::put('testimonials/update/{id}', 'Backend\TestimonialController@update')->name('admin.testimonials.update');
    Route::delete('testimonials/destroy/{id}', 'Backend\TestimonialController@destroy')->name('admin.testimonials.destroy');

    //events routes
    Route::get('events/index', 'Backend\EventController@index')->name('admin.events.index');
    Route::get('events/create', 'Backend\EventController@create')->name('admin.events.create');
    Route::post('events/store', 'Backend\EventController@store')->name('admin.events.store');
    Route::get('events/edit/{id}', 'Backend\EventController@edit')->name('admin.events.edit');
    Route::put('events/update/{id}', 'Backend\EventController@update')->name('admin.events.update');
    Route::delete('events/destroy/{id}', 'Backend\EventController@destroy')->name('admin.events.destroy');

    //bookings routes
    Route::get('bookings/index', 'Backend\BookingController@index')->name('admin.bookings.index');
    Route::get('bookings/create', 'Backend\BookingController@create')->name('admin.bookings.create');
    Route::post('bookings/store', 'Backend\BookingController@store')->name('admin.bookings.store');
    Route::get('bookings/edit/{id}', 'Backend\BookingController@edit')->name('admin.bookings.edit');
    Route::put('bookings/update/{id}', 'Backend\BookingController@update')->name('admin.bookings.update');
    Route::delete('bookings/destroy/{id}', 'Backend\BookingController@destroy')->name('admin.bookings.destroy');
    Route::put('bookings/confirm/{id}', 'Backend\BookingController@confirm')->name('admin.bookings.confirm');

    //infrastructures routes
    Route::get('infrastructures/index', 'Backend\InfrastructureController@index')->name('admin.infrastructures.index');
    Route::get('infrastructures/create', 'Backend\InfrastructureController@create')->name('admin.infrastructures.create');
    Route::post('infrastructures/store', 'Backend\InfrastructureController@store')->name('admin.infrastructures.store');
    Route::get('infrastructures/edit/{id}', 'Backend\InfrastructureController@edit')->name('admin.infrastructures.edit');
    Route::put('infrastructures/update/{id}', 'Backend\InfrastructureController@update')->name('admin.infrastructures.update');
    Route::delete('infrastructures/destroy/{id}', 'Backend\InfrastructureController@destroy')->name('admin.infrastructures.destroy');

    //messages routes
    Route::get('messages/index', 'Backend\MessageController@index')->name('admin.messages.index');


    //setting routes
    Route::get('settings/index', 'Backend\SettingController@index')->name('admin.settings.index');
    Route::get('settings/create', 'Backend\SettingController@create')->name('admin.settings.create');
    Route::post('settings/store', 'Backend\SettingController@store')->name('admin.settings.store');
    Route::get('settings/edit/{id}', 'Backend\SettingController@edit')->name('admin.settings.edit');
    Route::put('settings/update/{id}', 'Backend\SettingController@update')->name('admin.settings.update');
    Route::delete('settings/destroy/{id}', 'Backend\SettingController@destroy')->name('admin.settings.destroy');
    
    Route::get('/404/muradutunge/ivyomwasavye-ntibishoboye-kuboneka',function(){
        return view('errors.404');
    });
});
