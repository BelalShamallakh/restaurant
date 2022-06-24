<?php

namespace App\Http\Controllers\Manager;

use App\Category;
use App\Http\Controllers\Controller;
use App\SubCategory;
use Illuminate\Http\Request;
use DataTables;
use Lang;
use Hash;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Toastr;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');

        $this->validationRules["category_id"] = 'required|exists:categories,id';
        $this->validationRules["ar.name"] = 'required';
        $this->validationRules["en.name"] = 'required';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Manager.dashboard.sub_category.index');
    }


    public function getSubCategoryData(Request $request)
    {


        $data = SubCategory::orderBy("created_at", "desc")->get();
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('timeDate', function ($row) {
                $btn = $row->created_at;
                return $btn;
            })

            ->addColumn('cateogry', function ($row) {
                $btn = "<span class='badge badge-primary'>" . $row->category_name . "</span>";
                return $btn;
            })



            ->addColumn('action', function ($row) {

                $btn = "<a href=" . route('sub_category.edit', $row->id) . "   class=' btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-edit'></i></a>
                <button type='button' name='delete' id='$row->id'  class='delete  btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-delete-1'></button>";
                return $btn;
            })

            ->rawColumns(['action', 'cateogry', 'timeDate'])
            ->make(true);
    }



    public function create()
    {
        $validator = JsValidator::make($this->validationRules, $this->validationMessages);
        $categories = Category::all();
        return view('Manager.dashboard.sub_category.add')
            ->with('categories', $categories)
            ->with('validator', $validator);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $request->validate($this->validationRules);
        SubCategory::create($data);


        Toastr::success(t('Add Success'));

        return redirect()->route('sub_category.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {


        $validator = JsValidator::make($this->validationRules, $this->validationMessages);

        $sub_category = SubCategory::find($id);
        if (!$sub_category) {
            Toastr::error(t('Not Found'));
            return redirect()->route('sub_category.index');
        }
        $categories = Category::all();

        return view("Manager.dashboard.sub_category.edit")
            ->with('categories', $categories)
            ->with('sub_category', $sub_category)
            ->with('validator', $validator);
    }


    public function update(Request $request, $id)
    {


        $request->validate($this->validationRules);

        $sub_category = SubCategory::find($id);
        if (!$sub_category) {
            Toastr::error(t('Not Found'));
            return redirect()->route('sub_category.index');
        }

        $data = $request->all();

        $sub_category->update($data);


        Toastr::success(t('Edit Success'));
        return redirect()->route('sub_category.index');
    }


    public function destroy($id)
    {
        $sub_category = SubCategory::find($id);
        if (!$sub_category) {
            Toastr::error(t('Not Found'));
            return redirect()->route('sub_category.index');
        }
        // $sub_category->items()->delete();
        $sub_category->delete();

        Toastr::success(t('Add Success'));
        return redirect()->route('sub_category.index');
    }
}
