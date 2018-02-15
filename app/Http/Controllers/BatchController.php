<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Client;
use App\User;
use App\OrderBatch;
use App\BatchDetail;
use App\CompanyManager;
use Excel;
use Session;
use Auth;
use DB;
use Mail;
use App\Mail\VerifyMail;
use App\VerifyUser;


class BatchController extends Controller
{


    public function upload(){
       

        if(Auth::check()){
         // print_r(Auth::user()->role_id);dd();
            if(Auth::user()->role_id == 5){
                   $company = Client::where('contact_person_email', '=', Auth::user()->email)->first();
       return view('data.upload', compact('company'));
             }
                else{
                  return redirect()->back();
                }
       }

    }

    public function delBatch(Request $request)
    {

         $batchDetail = BatchDetail::findOrFail($request['batch_id']);
         $batchDetail->delete();
         $orderBatch = OrderBatch::where('batch_id', '=', $request['batch_id'])->delete();
            
        return redirect()->back();
      // print_r($request->all());dd();
    }

    public function batchFullView($id){

            $content_batch = OrderBatch::where('batch_id', '=', $id)->get();

            return view('data.batch_full_view', compact('content_batch'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function updateBatch(Request $request, $id){

        $batch_detail = BatchDetail::find($id);
        $batch_detail->batch_name = $request['batch_name'];
        $batch_detail->instructions = $request['notes'];
        $batch_detail->due_date = $request['due_date'];
        $batch_detail->save();


        return redirect()->to('viewData')->with('edit_message', 'You have successfully edit the batch');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $batchEdit = BatchDetail::find($id);
        return view('data.batch_edit', compact('batchEdit'));
       // echo "string";dd();
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
