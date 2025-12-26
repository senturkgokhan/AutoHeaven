<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\VisitorController;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;


//Visitor Routes

Route::get("/testTemplate", [VisitorController::class, "testTemplatePage"])->name("app");

Route::get('/', [VisitorController::class, "indexPage"])->name("index");

Route::post("/sendMessage", [VisitorController::class, "sendMessage"])->name("sendMessage");

Route::get("/about", [VisitorController::class, "aboutPage"])->name("about");

Route::get("/blog", [VisitorController::class, "blogPage"])->name("blog");

Route::get("/blog-details/{id}", [VisitorController::class, "blogDetailsPage"])->name("blog-details");

Route::post("/sendComment", [VisitorController::class, "sendComment"])->name("sendComment");

Route::get("/car-details/{id}", [VisitorController::class, "carDetailsPage"])->name("car-details");
Route::post('/car-details/{id}/comment', [VisitorController::class, 'sendCarComment'])->middleware('auth')->name('car-details.comment');
Route::put('/car-details/{car}/comment/{comment}', [VisitorController::class, 'updateCarComment'])->middleware('auth')->name('car-details.comment.update');
Route::delete('/car-details/{car}/comment/{comment}', [VisitorController::class, 'deleteCarComment'])->middleware('auth')->name('car-details.comment.delete');

Route::get("/cars", [VisitorController::class, "carsPage"])->name("cars");

Route::post("/filterCarsPost", [VisitorController::class, "filterCars"])->name("filterCars");

Route::get("/contact", [VisitorController::class, "contactPage"])->name("contact");

Route::get("/faq", [VisitorController::class, "faqPage"])->name("faq");

Route::get("/profile/{id}", [VisitorController::class, "profilePage"])->name("profile");

Route::get("/team", [VisitorController::class, "teamPage"])->name("team");

Route::get("/terms", [VisitorController::class, "termsPage"])->name("terms");

Route::get("/testimonials", [VisitorController::class, "testimonialsPage"])->name("testimonials");

//End Visitor Routes



Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    //Dealer Routes

    Route::get('/myProfile', [DealerController::class, "myProfilePage"])->name('myProfile');

    Route::get("/inbox", [DealerController::class, "inboxPage"])->name('inbox');

    Route::get("/editMyProfile", [DealerController::class, "editMyProfilePage"])->name('editMyProfile');

    Route::post("/editMyProfilePost", [DealerController::class, "editMyProfile"])->name('editMyProfilePost');

    Route::post("/deleteMyProfilePhotoPost", [DealerController::class, "deleteMyProfilePhoto"])->name('deleteMyProfilePhoto');

    Route::get("/sellCar", [DealerController::class, "sellCarPage"])->name("sellCar");

    Route::get("/sellCarModelFilter/{id}", [DealerController::class, "sellCarModelFilter"])->name("sellCarModelFilter");

    Route::post("/sellCarPost", [DealerController::class, "sellCar"])->name("sellCarPost");

    Route::get("/editCar/{id}", [DealerController::class, "editCarPage"])->name("editCar");

    Route::post("/editCarPost/{id}", [DealerController::class, "editCar"])->name("editCarPost");

    Route::post("/deleteCar", [DealerController::class, "deleteCar"])->name("deleteCar");

    Route::get("/writeBlog", [DealerController::class, "writeBlogPage"])->name("writeBlog");

    Route::post("/writeBlogPost", [DealerController::class, "writeBlog"])->name("writeBlogPost");

    Route::get("/editBlog/{id}", [DealerController::class, "editBlogPage"])->name("editBlog");

    Route::post("/editBlogPost/{id}", [DealerController::class, "editBlog"])->name("editBlogPost");

    Route::post("/deleteBlog", [DealerController::class, "deleteBlog"])->name("deleteBlog");

    //End Dealer Routes



    //Admin Routes

    Route::group(["prefix" => "admin", "middleware" => [isAdmin::class]], function (){

        Route::get("/", [AdminController::class, "adminPage"])->name("admin");

        Route::post("/getUser", [AdminController::class, "getUser"])->name("getUser");

        Route::post("/editUser", [AdminController::class, "editUser"])->name("editUser");

        Route::get("/cars", [AdminController::class, "carsPage"])->name("admin.cars");

        Route::post("/getCar", [AdminController::class, "getCar"])->name("getCar");

        Route::post("/editCar", [AdminController::class, "editCar"])->name("admin.editCar");

        Route::get("/brandModel", [AdminController::class, "brandModelPage"])->name("brandModel");

        Route::post("/getModel", [AdminController::class, "getModel"])->name("getModel");

        Route::post("/editModel", [AdminController::class, "editModel"])->name("editModel");

        Route::post("/getBrand", [AdminController::class, "getBrand"])->name("getBrand");

        Route::post("/editBrand", [AdminController::class, "editBrand"])->name("editBrand");

        Route::post("/addBrand", [AdminController::class, "addBrand"])->name("addBrand");

        Route::post("/addModel", [AdminController::class, "addModel"])->name("addModel");

        Route::get("/carDamages", [AdminController::class, "carDamagesPage"])->name("carDamages");

        Route::post("/getCarDamage", [AdminController::class, "getCarDamage"])->name("getCarDamage");

        Route::post("/editCarDamage", [AdminController::class, "editCarDamage"])->name("editCarDamage");

        Route::get("/blogs", [AdminController::class, "blogsPage"])->name("blogs");

        Route::post("/getBlog", [AdminController::class, "getBlog"])->name("getBlog");

        Route::post("/editBlog", [AdminController::class, "editBlog"])->name("admin.editBlog");

        Route::get("/contact", [AdminController::class, "contactPage"])->name("admin.contact");

        Route::post("/getMessage", [AdminController::class, "getMessage"])->name("getMessage");
    });

    //End Admin Routes
});

