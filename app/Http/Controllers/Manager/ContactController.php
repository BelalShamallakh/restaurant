<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

use App\Contact;
use Illuminate\Http\Request;
use DataTables;
use Lang;
use Hash;
use Proengsoft\JsValidation\Facades\JsValidatorFacade as JsValidator;
use Toastr;
use Str;

class ContactController extends Controller
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
        return view('Manager.dashboard.contact.index');
    }


    public function getContactData(Request $request)
    {


        $data = Contact::all();
        return  Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('timeDate', function ($row) {
                $btn = $row->created_at;
                return $btn;
            })

            ->addColumn('message', function ($row) {
                $btn = Str::limit($row->message, 50, '');
                return $btn;
            })

            ->addColumn('action', function ($row) {

                $btn = "<button type='button' name='delete' id='$row->id'  class='delete  btn btn-outline-info btn-sm  btn-icon btn-icon-sm'><i class='flaticon-delete-1'></button>";
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
        //
    }

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
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            Toastr::error(t('Not Found'));
            return redirect()->route('contact.index');
        }
        $contact->delete();

        Toastr::success(t('Add Success'));
        return redirect()->route('contact.index');
    }
}
