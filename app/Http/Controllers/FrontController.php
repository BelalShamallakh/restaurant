<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contact;
use App\ImageGallery;
use App\Item;
use App\MainCategory;
use App\SubCategory;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imageGallery = ImageGallery::all();
        $seo_items = Item::all();
        return view('UI.index')
            ->with('seo_items', $seo_items)
            ->with('imageGalleries', $imageGallery);
    }


    public function menu()
    {
        $categories = Category::all();
        return view('UI.menu')
            ->with('categories', $categories);
    }


    public function contact_store(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
        ]);


        $check = Contact::create($request->all());
        if ($check) {
            return response()->json([
                'status'  => true,
                'message' => __('front.alert-success-contact'),
            ]);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getItem(Request $request)
    // {
    //     $main_category =  $request->get('main_category');
    //     if ($main_category) {

    //         $main_categories = MainCategory::where('id', $main_category)->first();

    //         $categories =  Category::where('main_category_id', $main_categories->id)->pluck('id');
    //         $subCategories =  SubCategory::wherein('category_id', $categories)->pluck('id');
    //         $items = Item::wherein('sub_category_id', $subCategories)->get();


    //         $output = ' ';
    //         if ($items) {
    //             foreach ($main_categories->categories as  $category) {
    //                 foreach ($category->subCategories as $subCategory) {
    //                     if ($subCategory->items->count() > 0) {
    //                         # code...
    //                         $output .= '<div class="col-lg-12">
    //                                 <div class="parent-menu-item">
    //                                     <span>' . $category->name . '</span>
    //                                     <span>-</span>
    //                                     <span>' . $subCategory->name . '</span>
    //                                 </div></div>';

    //                         foreach ($subCategory->items as $item) {
    //                             $output .= '<div class="col-lg-4 col-md-6">
    //                                 <div class="menu-item">
    //                                     <div class="item-img">
    //                                         <img src="' . $item->image . '" alt="' . $item->description . '">
    //                                     </div>

    //                                     <div class="item-content">
    //                                         <h2>' . $item->name . '</h2>
    //                                         <p>' . $item->description . '  </p>
    //                                         <div class="sar-cal">
    //                                             <span class="sar">' . $item->price . ' SAR</span>
    //                                             <span class="cal">' . $item->calorie . ' CAL</span>
    //                                         </div>

    //                                     </div>

    //                                 </div>
    //                             </div>';
    //                         }
    //                     }
    //                 }
    //             }
    //         }

    //         return   [$output, $main_categories->name];
    //     } else {
    //         $output = ' ';

    //         $offer_items = Item::where('offer', 1)->orderBy('created_at', 'desc')->get();

    //         if ($offer_items->count() > 0) {
    //             foreach ($offer_items as $offer_item) {
    //                 $output .= '<div class="col-lg-4 col-md-6">
    //                                 <div class="menu-item">
    //                                     <div class="item-img">
    //                                         <img src="' . $offer_item->image . '" alt="' . $offer_item->description . '">
    //                                     </div>

    //                                     <div class="item-content">
    //                                         <h2>' . $offer_item->name . '</h2>
    //                                         <p>' . $offer_item->description . '  </p>
    //                                         <div class="sar-cal">
    //                                             <span class="sar">' . $offer_item->price . ' SAR</span>
    //                                             <span class="cal">' . $offer_item->calorie . ' CAL</span>
    //                                         </div>

    //                                     </div>

    //                                 </div>
    //                             </div>';
    //             }
    //         }

    //         return   [$output, t('Offer Menu')];
    //     }
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
