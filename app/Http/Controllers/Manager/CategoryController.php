<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

use App\Category;
use Illuminate\Http\Request;
use DataTables;
use Lang;
use Hash;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Toastr;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');

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


        return view('Manager.dashboard.category.index');
    }


    public function getCategoryData(Request $request)
    {


        $data = Category::orderBy("created_at", "desc")->get();
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('timeDate', function ($row) {
                $btn = $row->created_at;
                return $btn;
            })



            ->addColumn('action', function ($row) {

                $btn = "<a href=" . route('category.edit', $row->id) . "   class=' btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-edit'></i></a>
                <button type='button' name='delete' id='$row->id'  class='delete  btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-delete-1'></button>";
                return $btn;
            })

            ->rawColumns(['action', 'timeDate'])
            ->make(true);
    }



    public function create()
    {
        $validator = JsValidator::make($this->validationRules, $this->validationMessages);
        return view('Manager.dashboard.category.add')
            ->with('validator', $validator);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $request->validate($this->validationRules);
        Category::create($data);


        Toastr::success(t('Add Success'));

        return redirect()->route('category.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {


        $validator = JsValidator::make($this->validationRules, $this->validationMessages);

        $category = Category::find($id);
        if (!$category) {
            Toastr::error(t('Not Found'));
            return redirect()->route('category.index');
        }

        return view("Manager.dashboard.category.edit")

            ->with('category', $category)
            ->with('validator', $validator);
    }


    public function update(Request $request, $id)
    {


        $request->validate($this->validationRules);

        $category = Category::find($id);
        if (!$category) {
            Toastr::error(t('Not Found'));
            return redirect()->route('category.index');
        }

        $data = $request->all();

        $category->update($data);


        Toastr::success(t('Edit Success'));
        return redirect()->route('category.index');
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            Toastr::error(t('Not Found'));
            return redirect()->route('category.index');
        }

        $category->delete();

        Toastr::success(t('Add Success'));
        return redirect()->route('category.index');
    }
}
