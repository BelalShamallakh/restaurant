<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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




Auth::routes();


Route::get('admin/login', 'Auth\LoginController@showAdminForm')->name('showAdminForm');
Route::post('admin/login', 'Auth\LoginController@loginAdmin')->name('loginAdmin');




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        Route::group(['namespace' => 'Manager', 'prefix' => 'manager', 'middleware' => ['manager']], function () {


            Route::get('dashbaord', 'DashboardController@index')->name('dashbaord');



            Route::get('userProfile', 'DashboardController@userProfile')->name('userProfile');
            Route::post('updateProfile', 'DashboardController@updateProfile')->name('updateProfile');





            // ManagerController
            Route::get('managers', 'ManagerController@index')->name('manager.index');
            Route::get('manager/add', 'ManagerController@create')->name('manager.add');
            Route::post('manager/store', 'ManagerController@store')->name('manager.store');
            Route::get('manager/getManagerData', 'ManagerController@getManagerData')->name('manager.getManagerData');
            Route::get('manager/edit/{id}', 'ManagerController@edit')->name('manager.edit');
            Route::post('manager/update/{id}', 'ManagerController@update')->name('manager.update');
            Route::post('manager/delete/{id}', 'ManagerController@destroy')->name('manager.delete');






            //  Category
            Route::get('categories', 'CategoryController@index')->name('category.index');
            Route::get('category/add', 'CategoryController@create')->name('category.add');
            Route::post('category/store', 'CategoryController@store')->name('category.store');
            Route::get('category/getCategoryData', 'CategoryController@getCategoryData')->name('category.getCategoryData');

            Route::get('category/edit/{id}', 'CategoryController@edit')->name('category.edit');
            Route::post('category/update/{id}', 'CategoryController@update')->name('category.update');
            Route::post('category/delete/{id}', 'CategoryController@destroy')->name('category.delete');


            // image Gallary
            Route::get('imagesGallery', 'ImageGalleryController@index')->name('imageGallery.index');
            Route::get('imageGallery/add', 'ImageGalleryController@create')->name('imageGallery.add');
            Route::post('imageGallery/store', 'ImageGalleryController@store')->name('imageGallery.store');
            Route::get('imageGallery/getImageGalleryData', 'ImageGalleryController@getImageGalleryData')->name('imageGallery.getImageGalleryData');

            Route::get('imageGallery/edit/{id}', 'ImageGalleryController@edit')->name('imageGallery.edit');
            Route::post('imageGallery/update/{id}', 'ImageGalleryController@update')->name('imageGallery.update');
            Route::post('imageGallery/delete/{id}', 'ImageGalleryController@destroy')->name('imageGallery.delete');


            // Sub  Category
            Route::get('sub_categories', 'SubCategoryController@index')->name('sub_category.index');
            Route::get('sub_category/add', 'SubCategoryController@create')->name('sub_category.add');
            Route::post('sub_category/store', 'SubCategoryController@store')->name('sub_category.store');
            Route::get('sub_category/getSubCategoryData', 'SubCategoryController@getSubCategoryData')->name('sub_category.getSubCategoryData');

            Route::get('sub_category/edit/{id}', 'SubCategoryController@edit')->name('sub_category.edit');
            Route::post('sub_category/update/{id}', 'SubCategoryController@update')->name('sub_category.update');
            Route::post('sub_category/delete/{id}', 'SubCategoryController@destroy')->name('sub_category.delete');


            //  Items
            Route::get('items', 'ItemController@index')->name('item.index');
            Route::get('item/add', 'ItemController@create')->name('item.add');
            Route::post('item/store', 'ItemController@store')->name('item.store');
            Route::get('item/getItemData', 'ItemController@getItemData')->name('item.getItemData');

            Route::get('item/edit/{id}', 'ItemController@edit')->name('item.edit');
            Route::post('item/update/{id}', 'ItemController@update')->name('item.update');
            Route::post('item/delete/{id}', 'ItemController@destroy')->name('item.delete');

            // Route::post('item/fetchSubCategory', 'ItemController@fetchSubCategory')->name('item.fetchSubCategory');



            //  Contacts
            Route::get('contacts', 'ContactController@index')->name('contact.index');
            Route::get('contact/getContactData', 'ContactController@getContactData')->name('contact.getContactData');
            Route::post('contact/delete/{id}', 'ContactController@destroy')->name('contact.delete');



            // // SettingController
            // Route::get('setting/settings', 'SettingController@index')->name('setting.index');
            // Route::get('setting/add', 'SettingController@create')->name('setting.add');
            // Route::post('setting/store', 'SettingController@store')->name('setting.store');
            // Route::get('setting/getSettingData', 'SettingController@getsettingData')->name('setting.getsettingData');
            // Route::get('setting/edit/{id}', 'SettingController@edit')->name('setting.edit');
            // Route::post('setting/update/{id}', 'SettingController@update')->name('setting.update');
        });


        // For UI

        Route::post('/contact_store', 'FrontController@contact_store')->name('contact_store');
        Route::get('/menu', 'FrontController@menu')->name('menu');
        Route::get('/', 'FrontController@index')->name('index');
        // Route::post('/getItem', 'FrontController@getItem')->name('UI.getItem');
    }


);
