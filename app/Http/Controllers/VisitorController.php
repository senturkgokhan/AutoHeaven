<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarComment;
use App\Models\CarDamage;
use App\Models\CarModel;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{
    public function testTemplatePage(){
        return view('front.layouts.app');
    }

    public function indexPage(){
        $cars = Car::orderBy("price", "desc")->get();
        $blogs = Blog::paginate(3);

        $gearTypes = [" ", "Manuel", "Otomatik", "Yarı-Otomatik"];

        return view("front.index", compact("cars", "blogs", "gearTypes"));
    }

    public function sendMessage(Request $request){

        $request->validate([
            "name_surname" => "required | min:2 | max:50",
            "email" => "required | min:5 | max:50",
            "topic" => "min:5 | max:100",
            "message" => "required | min:5 | max:10000",
        ],[
            "name_surname.required" => "Lütfen ad soyad giriniz!",
            "name_surname.min" => "Ad soyad minimum 2 haneli olabilir!",
            "name_surname.max" => "Ad soyad maksimum 50 haneli olabilir!",
            "email.required" => "Lütfen e-posta giriniz!",
            "email.min" => "E-posta minimum 5 haneli olabilir!",
            "email.max" => "E-posta maksimum 50 haneli olabilir!",
            "topic.min" => "Konu minimum 5 haneli olabilir!",
            "topic.max" => "Konu maksimum 100 haneli olabilir!",
            "message.required" => "Lütfen mesaj giriniz!",
            "message.min" => "Mesaj minimum 5 haneli olabilir!",
            "message.max" => "Mesaj maksimum 10000 haneli olabilir!",
        ]);

        $contact = new Contact();

        $contact->name_surname = $request->name_surname;
        $contact->email = $request->email;
        $contact->topic = $request->topic;
        $contact->message = $request->message;

        $contact->save();

        return redirect()->back();
    }

    public function aboutPage(){
        return view("front.about");
    }

    public function blogPage(){

        $blogs = Blog::orderBy("updated_at", "desc")->paginate(5);

        return view("front.blog", compact("blogs"));
    }

    public function blogDetailsPage($id){

        $blog = Blog::find($id);

        if(!$blog){
            abort(404);
        }

        return view("front.blog-details", compact("blog"));
    }

    public function sendComment(Request $request){

        $comment = new Comment();
        $comment->blog_id = $request->blog_id;
        $comment->name_surname = $request->name_surname;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json(['success' => true], 404);
    }

    public function carDetailsPage($id){

        $car = Car::with('comments.user')->find($id);

        if(!$car){
            abort(404);
        }

        $user = $car->getUsers;

        $colors = [ " ", "Beyaz", "Siyah", "Gri", "Gümüş", "Mavi", "Kırmızı", "Diğer"];
        $guarantee = [" ","Var", "Yok"];
        $gearType = [" ", "Manuel", "Otomatik", "Yarı-Otomatik"];
        $fuelType = [" ", "Benzin", "Dizel", "LPG", "Elektrik"];

        $selectBoxValues = [$colors[$car->color], $guarantee[$car->guarantee], $gearType[$car->gear_type], $fuelType[$car->fuel_type]];

        return view("front.car-details", compact("car","user","selectBoxValues"));
    }

    public function sendCarComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:2000',
        ]);

        $car = Car::findOrFail($id);

        $car->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->route('car-details', ['id' => $car->id])->with('success', 'Yorumunuz kaydedildi.');
    }

    public function updateCarComment(Request $request, $carId, $commentId)
    {
        $request->validate([
            'comment' => 'required|string|min:3|max:2000',
        ]);

        $comment = CarComment::where('id', $commentId)
            ->where('car_id', $carId)
            ->firstOrFail();

        if (!Auth::user() || (Auth::id() !== $comment->user_id && Auth::user()->role !== 0)) {
            abort(403);
        }

        $comment->update(['comment' => $request->comment]);

        return redirect()->route('car-details', ['id' => $carId])->with('success', 'Yorum güncellendi.');
    }

    public function deleteCarComment($carId, $commentId)
    {
        $comment = CarComment::where('id', $commentId)
            ->where('car_id', $carId)
            ->firstOrFail();

        if (!Auth::user() || (Auth::id() !== $comment->user_id && Auth::user()->role !== 0)) {
            abort(403);
        }

        $comment->delete();

        return redirect()->route('car-details', ['id' => $carId])->with('success', 'Yorum silindi.');
    }

    public function carsPage(){

        $cars = Car::paginate(15);
        $gearTypes = [" ", "Manuel", "Otomatik", "Yarı-Otomatik"];

        $carBrands = CarBrand::all();

        return view("front.cars", compact("cars", "gearTypes", "carBrands"));
    }

    public function filterCars(Request $request){
        $carsQuery = Car::with('getModels.getBrands');
        $gearTypes = [" ", "Manuel", "Otomatik", "Yarı-Otomatik"];

        if ($request->filled('brand') && $request->get('brand') != 0) {
            $carsQuery->whereHas('getModels.getBrands', function ($query) use ($request) {
                $query->where('id', $request->brand);
            });
        }

        if ($request->filled('yearStart') && $request->yearStart != 0) {
            $carsQuery->where('year', '>=', $request->yearStart);
        }

        if ($request->filled('yearEnd') && $request->yearEnd != 0) {
            $carsQuery->where('year', '<=', $request->yearEnd);
        }

        if ($request->filled('color') && $request->color != 0) {
            $carsQuery->where('color', $request->color);
        }

        if ($request->filled('kmStart') && $request->kmStart != 0) {
            $carsQuery->where('km', '>=', $request->kmStart);
        }

        if ($request->filled('kmEnd') && $request->kmEnd != 0) {
            $carsQuery->where('km', '<=', $request->kmEnd);
        }

        if ($request->filled('guarantee') && $request->guarantee != 0) {
            $carsQuery->where('guarantee', $request->guarantee);
        }

        if ($request->filled('gearType') && $request->gearType != 0) {
            $carsQuery->where('gear_type', $request->gearType);
        }

        if ($request->filled('fuelType') && $request->fuelType != 0) {
            $carsQuery->where('fuel_type', $request->fuelType);
        }

        if ($request->filled('priceStart') && $request->priceStart != 0) {
            $carsQuery->where('price', '>=', $request->priceStart);
        }

        if ($request->filled('priceEnd') && $request->priceEnd != 0) {
            $carsQuery->where('price', '<=', $request->priceEnd);
        }

        $cars = $carsQuery->paginate(15);

        return response()->json([
            'success' => true,
            'cars' => $cars->items(),
            'gearTypes' => $gearTypes,
            'pagination' => [
                'previousPageUrl' => $cars->previousPageUrl(),
                'nextPageUrl' => $cars->nextPageUrl(),
                'lastPage' => $cars->lastPage(),
                'currentPage' => $cars->currentPage(),
                'url' => $cars->url(1)
            ]
        ]);
    }

    public function contactPage(){
        return view("front.contact");
    }

    public function faqPage(){
        return view("front.faq");
    }

    public function profilePage($id){
        $user = User::find($id);

        if(!$user){
            abort(404);
        }

        $cars = Car::where('user_id', $id)->get();
        $blogs = Blog::where('user_id', $id)->get();
        $carComments = $user->carComments()->with('car')->latest()->get();

        $gearTypes = ["", "Manuel", "Otomatik", "Yarı-Otomatik"];

        if($id == Auth::id()){
            return view("front.dealer.myProfile", compact("id", "user", "cars", "blogs", "gearTypes", "carComments"));
        }

        return view("front.profile", compact("id", "user", "cars", "blogs", "gearTypes", "carComments"));
    }

    public function teamPage(){
        return view("front.team");
    }

    public function termsPage(){
        return view("front.terms");
    }

    public function testimonialsPage(){
        return view("front.testimonials");
    }
}
