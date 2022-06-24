<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

use App\Category;
use App\Contact;
use App\Item;
use App\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Toastr;
use DataTables;
use Lang;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;

class DashboardController extends Controller
{





    public function __construct()
    {
        $this->middleware('manager');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $categories = Category::all();
        $sub_categories = SubCategory::all();
        $items = Item::all();
        $contacts = Contact::all();

        // Latest Post
        $latest_items = Item::orderBy('created_at', 'desc')->take(6)->get();
        $latest_contacts = Contact::orderBy('created_at', 'desc')->take(6)->get();
        return view('Manager.dashboard.index')
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories)
            ->with('items', $items)
            ->with('contacts', $contacts)
            ->with('latest_items', $latest_items)
            ->with('latest_contacts', $latest_contacts);
    }


    public function userProfile()
    {
        $user = Auth::guard('manager')->user();
        return view('Manager.dashboard.profile.index')->with('user', $user);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = Auth::guard('manager')->user();


        if (trim($request->password) != '') {
            $user->password = Hash::make($request->password);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        Toastr::success(t('Edit Success'));

        return view('Manager.dashboard.profile.index')->with('user', $user);
    }
}
