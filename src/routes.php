<?php

use Illuminate\Support\Facades\Route;

/*
 * Routes
 */
Route::group(array('domain' => config('administrator.domain'), 'prefix' => config('administrator.uri'), 'middleware' => 'Frozennode\Administrator\Http\Middleware\ValidateAdmin'), function () {

    // hack by @Monkey: for custom route
    // Route::group(['prefix' => 'custom'], function () {
    //     require config('administrator.custom_routes_file');
    // });

    //Admin Dashboard
    Route::get('/', array(
        'as'   => 'admin_dashboard',
        'uses' => 'Frozennode\Administrator\AdminController@dashboard',
    ));

    //File Downloads
    Route::get('file_download', array(
        'as'   => 'admin_file_download',
        'uses' => 'Frozennode\Administrator\AdminController@fileDownload',
    ));

    //Custom Pages
    Route::get('page/{page}', array(
        'as'   => 'admin_page',
        'uses' => 'Frozennode\Administrator\AdminController@page',
    ));

    Route::group(array('middleware' => ['Frozennode\Administrator\Http\Middleware\ValidateSettings', 'Frozennode\Administrator\Http\Middleware\PostValidate']), function () {
        //Settings Pages
        Route::get('settings/{settings}', array(
            'as'   => 'admin_settings',
            'uses' => 'Frozennode\Administrator\AdminController@settings',
        ));

        //Display a settings file
        Route::get('settings/{settings}/file', array(
            'as'   => 'admin_settings_display_file',
            'uses' => 'Frozennode\Administrator\AdminController@displayFile',
        ));

        //Save Item
        Route::post('settings/{settings}/save', array(
            'as'   => 'admin_settings_save',
            'uses' => 'Frozennode\Administrator\AdminController@settingsSave',
        ));

        //Custom Action
        Route::post('settings/{settings}/custom_action', array(
            'as'   => 'admin_settings_custom_action',
            'uses' => 'Frozennode\Administrator\AdminController@settingsCustomAction',
        ));

        //Settings file upload
        Route::post('settings/{settings}/{field}/file_upload', array(
            'as'   => 'admin_settings_file_upload',
            'uses' => 'Frozennode\Administrator\AdminController@fileUpload',
        ));
    });

    //Switch locales
    Route::get('switch_locale/{locale}', array(
        'as'   => 'admin_switch_locale',
        'uses' => 'Frozennode\Administrator\AdminController@switchLocale',
    ));

    //The route group for all other requests needs to validate admin, model, and add assets
    Route::group(array('middleware' => ['Frozennode\Administrator\Http\Middleware\ValidateModel', 'Frozennode\Administrator\Http\Middleware\PostValidate']), function () {
        //Model Index
        Route::get('{model}', array(
            'as'   => 'admin_index',
            'uses' => 'Frozennode\Administrator\AdminController@index',
        ));

        //New Item
        Route::get('{model}/new', array(
            'as'   => 'admin_new_item',
            'uses' => 'Frozennode\Administrator\AdminController@item',
        ));

        //Update a relationship's items with constraints
        Route::post('{model}/update_options', array(
            'as'   => 'admin_update_options',
            'uses' => 'Frozennode\Administrator\AdminController@updateOptions',
        ));

        //Display an image or file field's image or file
        Route::get('{model}/file', array(
            'as'   => 'admin_display_file',
            'uses' => 'Frozennode\Administrator\AdminController@displayFile',
        ));

        //Updating Rows Per Page
        Route::post('{model}/rows_per_page', array(
            'as'   => 'admin_rows_per_page',
            'uses' => 'Frozennode\Administrator\AdminController@rowsPerPage',
        ));

        //Get results
        Route::post('{model}/results', array(
            'as'   => 'admin_get_results',
            'uses' => 'Frozennode\Administrator\AdminController@results',
        ));

        //Custom Model Action
        Route::post('{model}/custom_action', array(
            'as'   => 'admin_custom_model_action',
            'uses' => 'Frozennode\Administrator\AdminController@customModelAction',
        ));

        //Get Item
        Route::get('{model}/{id}', array(
            'as'   => 'admin_get_item',
            'uses' => 'Frozennode\Administrator\AdminController@item',
        ));

        //File Uploads
        Route::post('{model}/{field}/file_upload', array(
            'as'   => 'admin_file_upload',
            'uses' => 'Frozennode\Administrator\AdminController@fileUpload',
        ));

        //Save Item
        Route::post('{model}/{id?}/save', array(
            'as'   => 'admin_save_item',
            'uses' => 'Frozennode\Administrator\AdminController@save',
        ));

        //Delete Item
        Route::post('{model}/{id}/delete', array(
            'as'   => 'admin_delete_item',
            'uses' => 'Frozennode\Administrator\AdminController@delete',
        ));

        //Custom Item Action
        Route::post('{model}/{id}/custom_action', array(
            'as'   => 'admin_custom_model_item_action',
            'uses' => 'Frozennode\Administrator\AdminController@customModelItemAction',
        ));

        //Batch Delete Item
        Route::post('{model}/batch_delete', array(
            'as'   => 'admin_batch_delete',
            'uses' => 'Frozennode\Administrator\AdminController@batchDelete',
        ));

        //Batch Verify Item
        Route::post('{model}/batch_verify', array(
            'as'   => 'admin_batch_verify',
            'uses' => 'Frozennode\Administrator\AdminController@batchVerify',
        ));
    });

});
