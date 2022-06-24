<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

use App\ImageGallery;
use Illuminate\Http\Request;
use Lang;
use Hash;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Toastr;
use DataTables;
use Intervention\Image\ImageManagerStatic as Image;

class ImageGalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('manager');

        $this->validationRules["image"] = 'required|image';
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Manager.dashboard.imageGallery.index');
    }


    public function getImageGalleryData(Request $request)
    {


        $data = ImageGallery::orderBy("created_at", "desc")->get();
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


            ->addColumn('action', function ($row) {

                $btn = "<a href=" . route('imageGallery.edit', $row->id) . "   class=' btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-edit'></i></a>
                <button type='button' name='delete' id='$row->id'  class='delete  btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-delete-1'></button>";
                return $btn;
            })

            ->rawColumns(['action', 'image', 'timeDate'])
            ->make(true);
    }



    public function create()
    {
        $validator = JsValidator::make($this->validationRules, $this->validationMessages);
        return view('Manager.dashboard.imageGallery.add')
            ->with('validator', $validator);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $request->validate($this->validationRules);

        if ($request->file('image')) {
            Image::make($request->image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/imageGallery/" .  $request->image->hashName());

            $data['image'] = "uploads/imageGallery/" . $request->image->hashName();
        }

        ImageGallery::create($data);


        Toastr::success(t('Add Success'));

        return redirect()->route('imageGallery.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {


        $validator = JsValidator::make($this->validationRules, $this->validationMessages);

        $imageGallery = ImageGallery::find($id);
        if (!$imageGallery) {
            Toastr::error(t('Not Found'));
            return redirect()->route('imageGallery.index');
        }

        return view("Manager.dashboard.imageGallery.edit")
            ->with('imageGallery', $imageGallery)
            ->with('validator', $validator);
    }


    public function update(Request $request, $id)
    {


        $request->validate($this->validationRules);

        $imageGallery = ImageGallery::find($id);
        if (!$imageGallery) {
            Toastr::error(t('Not Found'));
            return redirect()->route('imageGallery.index');
        }

        $data = $request->all();

        if ($request->file('image')) {
            Image::make($request->image)->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save("uploads/imageGallery/" .  $request->image->hashName());

            $data['image'] = "uploads/imageGallery/" . $request->image->hashName();
        } else {
            $data['image'] =  $imageGallery->image;
        }


        $imageGallery->update($data);


        Toastr::success(t('Edit Success'));
        return redirect()->route('imageGallery.index');
    }


    public function destroy($id)
    {
        $imageGallery = ImageGallery::find($id);
        if (!$imageGallery) {
            Toastr::error(t('Not Found'));
            return redirect()->route('imageGallery.index');
        }

        $imageGallery->delete();

        Toastr::success(t('Add Success'));
        return redirect()->route('imageGallery.index');
    }
}
