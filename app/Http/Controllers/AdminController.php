<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarDamage;
use App\Models\CarModel;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function adminPage(){

        $users = User::withTrashed()->get();

        return view('front.admin.admin', compact('users'));
    }

    public function getUser(Request $request){
        $user = User::withTrashed()->find($request->user_id);

        if ($user) {
            return response()->json([
                'success' => true,
                'id' => $user->id,
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'phone' => $user->phone,
                'role' => $user->role,
                'deleted_at' => $user->deleted_at,
                'job' => $user->job ?? '',
                'bio' => $user->bio ?? '',
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function editUser(Request $request){

        $user = User::withTrashed()->find($request->user_id);

        if ($user) {
            $user->name = $request->name;
            $user->surname = $request->surname;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            if ($request->status == 0){
                $user->deleted_at = null;
            } else {
                $user->delete();
            }
            $user->job = $request->job;
            $user->bio = $request->bio;
            $user->save();

            return response()->json(["success" => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function carsPage(){
        $cars = Car::withTrashed()->get();
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();

        $colors = [ " ", "Beyaz", "Siyah", "Gri", "Gümüş", "Mavi", "Kırmızı", "Diğer"];
        $guarantee = [" ","Var", "Yok"];
        $gearType = [" ", "Manuel", "Otomatik", "Yarı-Otomatik"];
        $fuelType = [" ", "Benzin", "Dizel", "LPG", "Elektrik"];

        $selectBoxValues = [$colors, $guarantee, $gearType, $fuelType];

        return view('front.admin.cars', compact('cars',"carBrands","carModels", "selectBoxValues"));
    }

    public function getCar(Request $request){
        $car = Car::withTrashed()->find($request->car_id);

        if ($car) {
            return response()->json([
                'success' => true,
                'id' => $car->id,
                'title' => $car->title,
                'brand' => $car->getModels->brand_id,
                'model' => $car->getModels->id,
                'year' => $car->year,
                'color' => $car->color,
                'km' => $car->km,
                'guarantee' => $car->guarantee,
                'gear_type' => $car->gear_type,
                'fuel_type' => $car->fuel_type,
                'description' => $car->description,
                'damage_description' => $car->getDamages->description,
                'deleted_at' => $car->deleted_at,
                'price' => $car->price,
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function editCar(Request $request){

        $car = Car::withTrashed()->find($request->car_id);

        if ($car) {
            $carDamage = CarDamage::withTrashed()->find($car->id);
            $carDamage->description = $request->damage_description;
            $carDamage->save();

            $car->title = $request->title;
            $car->description = $request->description;
            $car->model_id = $request->model;
            $car->year = $request->year;
            $car->color = $request->color;
            $car->km = $request->km;
            $car->guarantee = $request->guarantee;
            $car->gear_type = $request->gear_type;
            $car->fuel_type = $request->fuel_type;
            $car->damage_id = $carDamage->id;
            $car->price = $request->price;
            if ($request->status == 0){
                $car->deleted_at = null;
            } else {
                $car->delete();
            }
            $car->save();

            return response()->json(["success" => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function brandModelPage(){

        $carBrands = CarBrand::all();
        $carModels = CarModel::all();

        return view("front.admin.brandModel", compact('carBrands', "carModels"));
    }

    public function getModel(Request $request){

        $model = CarModel::find($request->model_id);

        if ($model) {
            return response()->json([
                'success' => true,
                'id' => $model->id,
                'brand' => $model->brand_id,
                'model' => $model->name
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function editModel(Request $request){

        $model = CarModel::find($request->model_id);

        if ($model) {
            $model->brand_id = $request->brand;
            $model->name = $request->model;
            $model->save();

            return response()->json(["success" => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function getBrand(Request $request){

        $brand = CarBrand::find($request->brand_id);

        if ($brand) {
            return response()->json([
                'success' => true,
                'id' => $brand->id,
                'brand' => $brand->name
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function editBrand(Request $request){

        $brand = CarBrand::find($request->brand_id);

        if ($brand) {
            $brand->name = $request->brand;
            $brand->save();

            return response()->json(["success" => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function addBrand(Request $request){

        $brand = new CarBrand();
        $brand->name = $request->brand_3;
        $brand->save();

        return redirect("/admin/brandModel")->with("success", "Marka başarıyla eklendi.");
    }

    public function addModel(Request $request){

        $model = new CarModel();
        $model->brand_id = $request->brand_4;
        $model->name = $request->model_4;
        $model->save();

        return redirect("/admin/brandModel")->with("success", "Model başarıyla eklendi.");
    }

    public function carDamagesPage(){

        $carDamages = CarDamage::all();

        return view("front.admin.carDamages", compact('carDamages'));
    }

    public function getCarDamage(Request $request){

        $carDamage = CarDamage::find($request->car_damage_id);

        if ($carDamage) {
            return response()->json([
                'success' => true,
                'damage_description' => $carDamage->description
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function editCarDamage(Request $request){

        $carDamage = CarDamage::find($request->car_damage_id);

        if ($carDamage) {
            $carDamage->description = $request->damage_description;
            $carDamage->save();

            return response()->json(["success" => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function blogsPage(){

        $blogs = Blog::withTrashed()->get();

        return view("front.admin.blogs", compact('blogs'));
    }

    public function getBlog(Request $request){

        $blog = Blog::withTrashed()->find($request->blog_id);

        if ($blog) {
            return response()->json([
                'success' => true,
                'title' => $blog->title,
                'content' => $blog->content,
                'deleted_at' => $blog->deleted_at
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function editBlog(Request $request){

        $blog = Blog::withTrashed()->find($request->blog_id);

        if ($blog) {
            $blog->title = $request->title;
            $blog->content = $request->input("content");
            if ($request->status == 0){
                $blog->deleted_at = null;
            } else {
                $blog->delete();
            }
            $blog->save();

            return response()->json(["success" => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function contactPage(){
        $contacts = Contact::all();

        return view("front.admin.contact", compact('contacts'));
    }

    public function getMessage(Request $request){

        $message = Contact::find($request->message_id);

        if ($message) {
            return response()->json([
                'success' => true,
                'name_surname' => $message->name_surname,
                'email' => $message->email,
                'topic' => $message->topic,
                'message' => $message->message
            ]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }
}
