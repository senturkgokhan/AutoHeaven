<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Car;
use App\Models\CarComment;
use App\Models\CarBrand;
use App\Models\CarDamage;
use App\Models\CarModel;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealerController extends Controller
{
    public function myProfilePage(){
        $user = User::find(Auth::id());

        $cars = Car::where('user_id', Auth::id())->get();

        $blogs = Blog::where('user_id', Auth::id())->get();

        $carComments = $user->carComments()->with('car')->latest()->get();

        $gearTypes = ["", "Manuel", "Otomatik", "Yarı-Otomatik"];

        return view('front.dealer.myProfile',compact("user","cars", "blogs", "gearTypes", "carComments"));
    }

    public function inboxPage()
    {
        $comments = Comment::whereHas('getBlogs', function($query) {
            $query->where('user_id', auth()->id());
        })->get();

        $comments = $comments->map(function($comment) {
            $user = User::where('email', $comment->email)->first();

            if ($user) {
                if ($user->profile_photo_path){
                    $comment->user_photo = asset('assets/images/'.$user->profile_photo_path);
                }else{
                    $comment->user_photo = asset('assets/images/anonymous.png');
                }
                $comment->user_id = $user->id;
            } else {
                $comment->user_photo = asset('assets/images/anonymous.png');
            }

            return $comment;
        });

        $groupedComments = $comments->groupBy('blog_id');

        return view('front.dealer.inbox', compact('groupedComments'));
    }

    public function editMyProfilePage()
    {
        $user = User::find(Auth::id());

        return view('front.dealer.editMyProfile', compact("user"));
    }

    public function editMyProfile(Request $request){

        $request->validate([
            "name" => "required | min:1 | max:20",
            "surname" => "required | min:1 | max:20",
            "email" => "required | min:9 | max:50",
            "phone" => "required | min:10 | max:13",
            "job" => "max:20",
            "bio" => "max:200"
        ],[
            "name.required" => "Lütfen isim giriniz!",
            "name.min" => "İsim minimum 1 haneli olabilir!",
            "name.max" => "İsim maksimum 20 haneli olabilir!",
            "surname.required" => "Lütfen soyad giriniz!",
            "surname.min" => "Soyad minimum 1 haneli olabilir!",
            "surname.max" => "Soyad maksimum 20 haneli olabilir!",
            "email.required" => "Lütfen e-posta giriniz!",
            "email.min" => "E-posta minimum 9 haneli olabilir!",
            "email.max" => "E-posta maksimum 50 haneli olabilir!",
            "phone.required" => "Lütfen telefon numarası giriniz!",
            "phone.min" => "Telefon numarası minimum 10 haneli olabilir!",
            "phone.max" => "Telefon numarası maksimum 13 haneli olabilir!",
            "job.max" => "İş maksimum 20 haneli olabilir!",
            "bio.max" => "Biyografi maksimum 200 haneli olabilir!",
        ]);

        $editUser = User::find(Auth::id());
        $editUser->name = $request->input("name");
        $editUser->surname = $request->input("surname");
        $editUser->email = $request->input("email");
        if($request->input("password") != null){
            $request->validate([
                "password" => "min:8 | max:20",
            ],[
                "password.min" => "Parola minimum 8 haneli olabilir!",
                "password.max" => "Parola maksimum 20 haneli olabilir!",
            ]);

            $editUser->password = $request->input("password");
        }
        $editUser->phone = $request->input("phone");
        $editUser->job = $request->input("job");
        $editUser->bio = $request->input("bio");

        if($request->hasFile("photo")){
            $path = public_path("/assets/images");
            $file = $request->file("photo");
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
            $editUser->profile_photo_path = $name;
        }

        $editUser->save();

        return redirect("/myProfile")->with("success", "Profil başarıyla güncellendi.");
    }

    public function deleteMyProfilePhoto(Request $request){
        $user = User::find($request->user_id);

        if($user){
            $user->profile_photo_path = null;
            $user->save();

            return response()->json(['success' => true, 'redirect' => route('myProfile')]);
        }

        return response()->json(['success' => false]);
    }

    public function sellCarPage(){
        $carBrands = CarBrand::all();
        $carModels = CarModel::all();
        return view('front.dealer.sellCar', compact("carBrands", "carModels"));
    }

    public function sellCarModelFilter($id){
        $carModels = CarModel::where('brand_id', $id)->get();
        return response()->json($carModels);
    }

    public function sellCar(Request $request){

        $request->validate([
            "title" => "required | min:5 | max:100",
            "description" => "required | min:5 | max:1000",
            "brand" => "required",
            "model" => "required",
            "year" => "required | date | before_or_equal:today",
            "color" => "required",
            "km" => "required | numeric | min:0 | max:1000000",
            "guarantee" => "required",
            "gear" => "required",
            "fuel" => "required",
            "damage-description" => "max:1000",
            "price" => "required | numeric | min:1000 | max: 100000000"
        ],[
            "title.required" => "Lütfen başlık giriniz!",
            "title.min" => "Başlık minimum 5 haneli olabilir!",
            "title.max" => "Başlık maksimum 100 haneli olabilir!",
            "description.required" => "Lütfen açıklama giriniz!",
            "description.min" => "Açıklama minimum 5 haneli olabilir!",
            "description.max" => "Açıklama maksimum 1000 haneli olabilir!",
            "brand.required" => "Lütfen marka seçiniz!",
            "model.required" => "Lütfen model seçiniz!",
            "year.required" => "Lütfen tarih giriniz!",
            "year.date" => "Lütfen geçerli bir tarih giriniz!",
            "year.before_or_equal" => "Lütfen geçerli bir tarih giriniz!",
            "color.required" => "Lütfen renk seçiniz!",
            "km.required" => "Lütfen kilometre giriniz!",
            "km.numeric" => "Lütfen sayısal bir değer giriniz!",
            "km.min" => "Kilometre minimum 0 olabilir!",
            "km.max" => "Kilometre maksimum 1000000 olabilir!",
            "guarantee.required" => "Lütfen garanti seçiniz!",
            "gear.required" => "Lütfen vites türü seçiniz!",
            "fuel.required" => "Lütfen yakıt türü seçiniz!",
            "damage-description.max" => "Hasar açıklaması maksimum 1000 haneli olabilir!",
            "price.required" => "Lütfen fiyat giriniz!",
            "price.min" => "Fiyat minimum 1000₺ olabilir!",
            "price.max" => "Fiyat maksimum 100000000₺ olabilir!"
        ]);

        $carDamage = new CarDamage();
        $carDamage->description = $request->input("damage-description");
        $carDamage->save();

        $car = new Car();
        $car->user_id = Auth::id();
        $car->title = $request->input("title");
        $car->description = $request->input("description");
        $car->model_id = $request->input("model");
        $car->year = $request->input("year");
        $car->color = $request->input("color");
        $car->km = $request->input("km");
        $car->guarantee = $request->input("guarantee");
        $car->gear_type = $request->input("gear");
        $car->fuel_type = $request->input("fuel");
        $car->damage_id = $carDamage->id;
        $car->price = $request->input("price");

        if($request->hasFile("media")){
            $path = public_path("/assets/images");
            $file = $request->file("media");
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
            $car->media = $name;
        }

        $car->save();

        return redirect("/myProfile")->with("success", "Arabanız başarıyla yayınlandı.");
    }

    public function editCarPage($id){

        $car = Car::find($id);

        if(!$car){
            abort(404);
        }

        if ($car->user_id != Auth::id()) {
            abort(403);
        }

        $carBrands = CarBrand::all();
        $carModels = CarModel::all();

        $colors = [ " ", "Beyaz", "Siyah", "Gri", "Gümüş", "Mavi", "Kırmızı", "Diğer"];
        $guarantee = [" ","Var", "Yok"];
        $gearType = [" ", "Manuel", "Otomatik", "Yarı-Otomatik"];
        $fuelType = [" ", "Benzin", "Dizel", "LPG", "Elektrik"];

        $selectBoxValues = [$colors, $guarantee, $gearType, $fuelType];

        return view("front.dealer.editCar", compact("id", "car","carBrands", "carModels", "selectBoxValues"));
    }

    public function editCar(Request $request, $id){

        $request->validate([
            "title" => "required | min:5 | max:100",
            "description" => "required | min:5 | max:1000",
            "brand" => "required",
            "model" => "required",
            "year" => "required | date | before_or_equal:today",
            "color" => "required",
            "km" => "required | numeric | min:0 | max:1000000",
            "guarantee" => "required",
            "gear" => "required",
            "fuel" => "required",
            "damage-description" => "max:1000",
            "price" => "required | numeric | min:1000 | max: 100000000"
        ],[
            "title.required" => "Lütfen başlık giriniz!",
            "title.min" => "Başlık minimum 5 haneli olabilir!",
            "title.max" => "Başlık maksimum 100 haneli olabilir!",
            "description.required" => "Lütfen açıklama giriniz!",
            "description.min" => "Açıklama minimum 5 haneli olabilir!",
            "description.max" => "Açıklama maksimum 1000 haneli olabilir!",
            "brand.required" => "Lütfen marka seçiniz!",
            "model.required" => "Lütfen model seçiniz!",
            "year.required" => "Lütfen tarih giriniz!",
            "year.date" => "Lütfen geçerli bir tarih giriniz!",
            "year.before_or_equal" => "Lütfen geçerli bir tarih giriniz!",
            "color.required" => "Lütfen renk seçiniz!",
            "km.required" => "Lütfen kilometre giriniz!",
            "km.numeric" => "Lütfen sayısal bir değer giriniz!",
            "km.min" => "Kilometre minimum 0 olabilir!",
            "km.max" => "Kilometre maksimum 1000000 olabilir!",
            "guarantee.required" => "Lütfen garanti seçiniz!",
            "gear.required" => "Lütfen vites türü seçiniz!",
            "fuel.required" => "Lütfen yakıt türü seçiniz!",
            "damage-description.max" => "Hasar açıklaması maksimum 1000 haneli olabilir!",
            "price.required" => "Lütfen fiyat giriniz!",
            "price.min" => "Fiyat minimum 1000₺ olabilir!",
            "price.max" => "Fiyat maksimum 100000000₺ olabilir!"
        ]);

        $carDamage = CarDamage::find($id);
        $carDamage->description = $request->input("damage-description");
        $carDamage->save();

        $car = Car::find($id);
        $car->title = $request->input("title");
        $car->description = $request->input("description");
        $car->model_id = $request->input("model");
        $car->year = $request->input("year");
        $car->color = $request->input("color");
        $car->km = $request->input("km");
        $car->guarantee = $request->input("guarantee");
        $car->gear_type = $request->input("gear");
        $car->fuel_type = $request->input("fuel");
        $car->damage_id = $carDamage->id;
        $car->price = $request->input("price");

        if($request->hasFile("media")){
            $path = public_path("/assets/images");
            $file = $request->file("media");
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
            $car->media = $name;
        }

        $car->save();

        return redirect("/myProfile")->with("success", "Arabanız başarıyla güncellendi.");
    }

    public function deleteCar(Request $request){
        $carID = $request->input("car_id");
        $car = Car::find($carID);

        if ($car){
            $car->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function writeBlogPage(){
        return view('front.dealer.writeBlog');
    }

    public function writeBlog(Request $request){

        $request->validate([
            "title" => "required | min:5 | max:100",
            "content" => "required | min:5 | max:10000",
        ],[
            "title.required" => "Lütfen başlık giriniz!",
            "title.min" => "Başlık minimum 5 haneli olabilir!",
            "title.max" => "Başlık maksimum 100 haneli olabilir!",
            "content.required" => "Lütfen açıklama giriniz!",
            "content.min" => "Açıklama minimum 5 haneli olabilir!",
            "content.max" => "Açıklama maksimum 10000 haneli olabilir!",
        ]);

        $blog = new Blog();
        $blog->user_id = Auth::id();
        $blog->title = $request->input("title");
        $blog->content = $request->input("content");

        if($request->hasFile("media")){
            $path = public_path("/assets/images");
            $file = $request->file("media");
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
            $blog->media = $name;
        }

        $blog->save();

        return redirect("/myProfile")->with("success", "Blogunuz başarıyla yayınlandı.");
    }

    public function editBlogPage($id){
        $blog = Blog::find($id);

        if(!$blog){
            abort(404);
        }

        if ($blog->user_id != Auth::id()) {
            abort(403);
        }

        return view('front.dealer.editBlog', compact('blog', "id"));
    }

    public function editBlog(Request $request, $id){

        $request->validate([
            "title" => "required | min:5 | max:100",
            "content" => "required | min:5 | max:10000",
        ],[
            "title.required" => "Lütfen başlık giriniz!",
            "title.min" => "Başlık minimum 5 haneli olabilir!",
            "title.max" => "Başlık maksimum 100 haneli olabilir!",
            "content.required" => "Lütfen açıklama giriniz!",
            "content.min" => "Açıklama minimum 5 haneli olabilir!",
            "content.max" => "Açıklama maksimum 10000 haneli olabilir!",
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->input("title");
        $blog->content = $request->input("content");

        if($request->hasFile("media")){
            $path = public_path("/assets/images");
            $file = $request->file("media");
            $name = $file->getClientOriginalName();
            $file->move($path,$name);
            $blog->media = $name;
        }

        $blog->save();

        return redirect("/myProfile")->with("success", "Blogunuz başarıyla güncellendi.");
    }

    public function deleteBlog(Request $request){
        $blogID = $request->input("blog_id");
        $blog = Blog::find($blogID);

        if ($blog){
            $blog->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
