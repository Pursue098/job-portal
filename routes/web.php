<?php


/* Routes for Job Module start*/
Route::group(['middleware' => array('admin_logged'), 'prefix' => 'admin', 'as' => 'admin.'], function () {

/* Start: Change application status*/
    Route::get('applications/changeStatus', ['uses' => 'Jobs\Admin\JobsController@applicationStatus', 'as' => 'application-status']);
/* End: Change application status*/

/* Start: Download CV*/
    Route::get('application/{application_id}/download', ['uses' => 'Jobs\Admin\JobsController@downloadCV', 'as' => 'download-cv']);
/* End: Download CV*/

/* Start: Get all applications for a job*/
    Route::get('jobs/{job_id}/application', ['uses' => 'Jobs\Admin\JobsController@applicationsByjob', 'as' => 'application-by-job']);
/* End: Get all applications for a job*/

/* Start: Apply for a job, get method load form*/
    Route::get('jobs/{id}/apply', ['uses' => 'Jobs\Admin\JobsController@applyForJob', 'as' => 'apply-for-job-admin']);
/* End: Apply for a job*/

/* Start: Apply for a job, post method*/
    Route::post('applied', ['uses' => 'Jobs\Admin\JobsController@applyForJobStore', 'as' => 'applied-admin']);
/* End: Apply for a job*/

/* Start: Get all applied jobs by a user*/
    Route::get('jobs/applied/{id}', ['uses' => 'Jobs\Admin\JobsController@AppliedJobs', 'as' => 'appliedJobsByAdmin']);
/* End: Get all applied jobs by a user*/

/* Start: Cancel a job*/
    Route::get('application/cancel/{job_id}', ['uses' => 'Jobs\Admin\JobsController@cancelApplication', 'as' => 'cancelApplicationByAdmin']);
/* End: Cancel a job*/

/* Start: Get all CVs by a user*/
    Route::get('viewAllcv/{id}', ['uses' => 'Jobs\Admin\JobsController@ViewAllCvs', 'as' => 'viewAllCvsByAdmin']);
/* End: Get all CVs by a user*/

/* Start: Get all CVs by a user*/
    Route::get('job/{id}/changeStatus', ['uses' => 'Jobs\Admin\JobsController@jobStatus', 'as' => 'job-status']);
/* End: Get all CVs by a user*/

/* Start: Get all CVs by a user*/
    Route::get('deactiveJobs', ['uses' => 'Jobs\Admin\JobsController@deactiveJobs', 'as' => 'deactive-jobs']);
/* End: Get all CVs by a user*/

/* Start: resource controller for job controller*/
    Route::resource('jobs', 'Jobs\Admin\JobsController');
/* End: resource controller for job controller*/

});

Route::group([], function () {

/* Start: get applied jobs*/
    Route::get('applied', ['uses' => 'Jobs\ApplicantController@AppliedJobs', 'as' => 'appliedJobsByApplicant']);
/* End: get applied jobs*/

/* Start: Cancel the application*/
    Route::get('jobs/{id}/cancel', ['uses' => 'Jobs\ApplicantController@cancelJob', 'as' => 'cancelJobByApplicant']);
/* End: Cancel the application*/

/* Start: Download CV for an application*/
    Route::get('application/download/{application_id}', ['uses' => 'Jobs\ApplicantController@downloadCV', 'as' => 'download-cv']);
/* Start: Download CV for an application*/

/* Start: Route for apply jobs, get resource by id*/
    Route::get('jobs/{id}/apply', ['uses' => 'Jobs\ApplicantController@getJob', 'as' => 'apply-for-job']);
/* End: Route for apply jobs*/

/* Start: Get all CVs by a user*/
    Route::get('viewAllcv/{id}', ['uses' => 'Jobs\ApplicantController@ViewAllCvs', 'as' => 'viewAllCvsByClient']);
/* End: Get all CVs by a user*/

/* Start: Get all CVs by a user*/
    Route::get('destroyCV/{id}', ['uses' => 'Jobs\ApplicantController@destroyCV', 'as' => 'destroyCVbyClient']);
/* End: Get all CVs by a user*/

/* Start: resource controller for application controller*/
    Route::resource('jobs', 'Jobs\ApplicantController');
/* End: resource controller for application controller*/

});

/* Routes for Job Module end*/

/* Routes for Event Module start*/
Route::group(['middleware' => array('admin_logged'), 'prefix' => 'admin', 'as' => 'admin.'], function () {


    Route::get('list_subscribe', ['uses' => 'Events\Admin\EventController@listSubscribedEvents', 'as' => 'event.list_subscribed_event']);
    Route::get('list_unsubscribe', ['uses' => 'Events\Admin\EventController@listUnSubscribedEvents', 'as' => 'event.list_unsubscribed_event']);
    Route::get('subscribed_user/{event_id}', ['uses' => 'Events\Admin\EventController@listSubscribedUsers', 'as' => 'event.list_subscribed_user']);

    Route::get('operation/{event_id}', ['uses' => 'Events\Admin\EventController@operations', 'as' => 'event.operation']);

    Route::get('create_post/{event_id}', ['uses' => 'Events\Admin\PostController@createPost', 'as' => 'post.create_post']);
    Route::post('dropzone', ['uses' => 'Events\Admin\PostController@dropZone', 'as' => 'post.dropzone']);
    Route::post('delete_image', ['uses' => 'Events\Admin\PostController@deleteImage', 'as' => 'post.delete_image']);

    Route::get('event/{e_id}/operation/{op_key}', ['uses' => 'Events\Admin\EventController@eventOperation', 'as' => 'event.operation']);


    Route::resource('event', 'Events\Admin\EventController', ['names' => [
        'index' => 'event.index',
        'store' => 'event.store',
        'create' => 'event.create',
        'destroy' => 'event.destroy',
        'update' => 'event.update',
        'show' => 'event.show',
        'edit' => 'event.edit',

    ]]);


    Route::resource('post', 'Events\Admin\PostController', ['names' => [
        'index' => 'post.index',
        'store' => 'post.store',
        'create' => 'post.create',
        'destroy' => 'post.destroy',
        'update' => 'post.update',
        'show' => 'post.show',
        'edit' => 'post.edit',

    ]]);
    
});

Route::group([], function () {

    Route::get('create_post/{event_id}', ['uses' => 'Events\PostController@createPost', 'as' => 'post.create_post']);
    Route::post('dropzone', ['uses' => 'Events\PostController@dropZone', 'as' => 'post.dropzone']);

    Route::get('event/{e_id}/operation/{op_key}', ['uses' => 'Events\EventController@eventOperation', 'as' => 'event.operation']);


    Route::resource('event', 'Events\EventController');
    Route::resource('post', 'Events\PostController');

});

/* Routes for Event Module end*/
