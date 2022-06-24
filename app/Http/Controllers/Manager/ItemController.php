<?php

namespace App\Http\Controllers\Manager;

use App\Category;
use App\Http\Controllers\Controller;

use App\Item;
use App\SubCategory;
use Illuminate\Http\Request;
use DataTables;
use Lang;
use Hash;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Toastr;
use Intervention\Image\ImageManagerStatic as Image;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');

        $this->validationRules["image"] = 'required|image';
        $this->validationRules["sub_category_id"] = 'required|exists:sub_categories,id';
        $this->validationRules["ar.name"] = 'required';
        $this->validationRules["en.name"] = 'required';
        $this->validationRules["ar.description"] = 'nullable';
        $this->validationRules["en.description"] = 'nullable';
        $this->validationRules["price"] = 'required|numeric';
        $this->validationRules["calorie"] = 'nullable|numeric';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('Manager.dashboard.item.index')->with('categories', $categories);
    }


    public function getItemData(Request $request)
    {

        if ($request->get('filter_category')) {
            $categories = Category::where('id', $request->get('filter_category'))->first();
            $subCategories =  SubCategory::wherein('category_id', $categories)->pluck('id');
            $data = Item::wherein('sub_category_id', $subCategories)->get();
        } else {
            $data = Item::all();
        }


        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('timeDate', function ($row) {
                $btn = $row->created_at;
                return $btn;
            })

            ->addColumn('image', function ($row) {
                $btn = "<img class='img-thumbnail' width='100px' height='70px' src='" . $row->image . " '>";
                return $btn;
            })


            ->addColumn('sub_cateogry', function ($row) {
                $btn = "<span class='badge badge-primary'>" . $row->subCategory_name . "</span>";
                return $btn;
            })

            ->addColumn('category', function ($row) {
                if ($row->subCategory) {
                    $btn = "<span class='badge badge-primary'>" . $row->subCategory->category_name . "</span>";
                } else {
                    $btn = null;
                }
                return $btn;
            })


            ->addColumn('action', function ($row) {

                $btn = "<a href=" . route('item.edit', $row->id) . "   class=' btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-edit'></i></a>
                <button type='button' name='delete' id='$row->id'  class='delete  btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-delete-1'></button>";
                return $btn;
            })

            ->rawColumns(['action', 'category', 'image', 'sub_cateogry', 'timeDate'])
            ->make(true);
    }



    public function create()
    {
        $validator = JsValidator::make($this->validationRules, $this->validationMessages);
        $categories = Category::all();
        $sub_categories = SubCategory::all();

        return view('Manager.dashboard.item.add')
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories)
            ->with('validator', $validator);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $request->validate($this->validationRules);


        if ($request->file('image')) {
            Image::make($request->image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/items/" .  $request->image->hashName());

            $data['image'] = "uploads/items/" . $request->image->hashName();
        }

        Item::create($data);


        Toastr::success(t('Add Success'));

        return redirect()->route('item.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $this->validationRules["image"] = 'nullable|image';


        $validator = JsValidator::make($this->validationRules, $this->validationMessages);

        $item = Item::find($id);
        if (!$item) {
            Toastr::error(t('Not Found'));
            return redirect()->route('item.index');
        }
        $categories = Category::all();
        $sub_categories = SubCategory::all();

        return view("Manager.dashboard.item.edit")
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories)
            ->with('item', $item)
            ->with('validator', $validator);
    }


    public function update(Request $request, $id)
    {

        $this->validationRules["image"] = 'nullable|image';

        $request->validate($this->validationRules);

        $item = Item::find($id);
        if (!$item) {
            Toastr::error(t('Not Found'));
            return redirect()->route('item.index');
        }

        $data = $request->all();



        if ($request->file('image')) {
            Image::make($request->image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/items/" .  $request->image->hashName());

            $data['image'] = "uploads/items/" . $request->image->hashName();
        } else {
            $data['image'] =  $item->image;
        }


        // $data['image'] = $request->file('image') ? $this->uploadImage($request->image, 'items') : $item->image;

        $item->update($data);


        Toastr::success(t('Edit Success'));
        return redirect()->route('item.index');
    }


    public function destroy($id)
    {
        $item = Item::find($id);
        if (!$item) {
            Toastr::error(t('Not Found'));
            return redirect()->route('item.index');
        }
        $item->delete();

        Toastr::success(t('Add Success'));
        return redirect()->route('item.index');
    }


    // public function fetchSubCategory(Request $request)
    // {
    //     $category_id = $request->get('category_id');

    //     $sub_categories  = SubCategory::where('category_id', $category_id)->get();

    //     $output = '<option value="" disabled selected>' . t('Sub Category') . '</option>';

    //     foreach ($sub_categories as $sub_category) {
    //         $output .= '<option  value="' . $sub_category->id . '">' . $sub_category->name . '</option>';
    //     }
    //     return  $output;
    // }
}
