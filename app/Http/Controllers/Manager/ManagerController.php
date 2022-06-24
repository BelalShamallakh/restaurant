<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

use App\Manager;
use Illuminate\Http\Request;
use DataTables;
use Lang;
use Hash;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Toastr;

class ManagerController extends Controller
{


    public function __construct()
    {
        $this->middleware('manager');

        $this->validationRules["name"] = 'required';
        $this->validationRules["password"] = 'required|min:6';
        $this->validationRules["email"] = 'unique:managers,email';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Manager.dashboard.manager.index');
    }


    public function getManagerData(Request $request)
    {


        $data = Manager::all();
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('timeDate', function ($row) {
                $btn = $row->created_at;
                return $btn;
            })

            ->addColumn('action', function ($row) {

                $btn = "<a href=" . route('manager.edit', $row->id) . "   class=' btn btn-outline-primary btn-sm  btn-icon btn-icon-sm'><i class='flaticon-edit'></i></a>
                <button type='button' name='delete' id='$row->id'  class='delete  btn btn-outline-primary btn-sm  btn-icon btn-icon-sm'><i class='flaticon-delete-1'></button>";
                return $btn;
            })

            ->rawColumns(['action', 'timeDate'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validator = JsValidator::make($this->validationRules, $this->validationMessages);

        return view('Manager.dashboard.manager.add')->with('validator', $validator);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate($this->validationRules);


        Manager::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        Toastr::success(t('Add Success'));

        return redirect()->route('manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $this->validationRules["email"] = 'unique:managers,email,' . $id . ',id';
        $this->validationRules["password"] = 'nullable';

        $validator = JsValidator::make($this->validationRules, $this->validationMessages);

        $manager = Manager::find($id);
        if (!$manager) {
            Toastr::error(t('Not Found'));
            return redirect()->route('manager.index');
        }

        return view("Manager.dashboard.manager.edit")->with('manager', $manager)->with('validator', $validator);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validationRules["email"] = 'unique:managers,email,' . $id . ',id';
        $this->validationRules["password"] = 'nullable';

        $request->validate($this->validationRules);

        $manager = Manager::find($id);
        if (!$manager) {
            Toastr::error(t('Not Found'));

            return redirect()->route('manager.index');
        }



        $manager->name = $request->name;
        $manager->email = $request->email;

        $manager->password = $request->get('password') ? bcrypt($request->get('password')) : $manager->password;
        $manager->save();
        Toastr::success(t('Edit Success'));
        return redirect()->route('manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manager  $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manager = manager::find($id);
        if (!$manager) {
            Toastr::error(t('Not Found'));
            return redirect()->route('manager.index');
        }
        $manager->delete();

        Toastr::success(t('Add Success'));
        return redirect()->route('manager.index');
    }
}
