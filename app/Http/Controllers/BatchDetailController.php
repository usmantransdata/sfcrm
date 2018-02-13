<?php

namespace App\Http\Controllers;

use App\BatchDetail;
use App\BatchStatus;
use App\OrderBatch;
use App\CompanyManager;
use Illuminate\Http\Request;
use DB;
use Auth;

class BatchDetailController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderBatch = BatchDetail::with('client')->with('batchStatus')->get();
        //DB::table('batch_details')->select('batch_details.*', 'order_batch.*')->join('order_batch', 'batch_details.id', 'order_batch.batch_id')->get();

        return view('data.view', compact('orderBatch'));
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
          $validatoin =  $this->validate($request,[
          'dataToggle' => 'required|string|max:255',
            ]); 
        print_r($request->all());dd();
            if($request->has('dataToggle')){
               echo "string";dd();
            }
            else{
                echo "dd";dd();
            }
        //print_r($request->all());dd();
    }

    public function statusChanged(Request $request){
       // print_r($request->all());dd();
         if(isset($request['inProcess_staus'])){
           // echo "string";dd();
           // print_r($request['client_id']);dd();
            BatchDetail::where('id', '=', $request['client_id'])->update(['status_id'=>3]);
            // return redirect()->route('viewData');
        }    
        if(isset($request['startQa_status'])){
           // echo "string";dd();
           // print_r($request['client_id']);dd();
            BatchDetail::where('id', '=', $request['client_id'])->update(['status_id'=>$request['startQa_status']]);
            // return redirect()->route('viewData');
        }    

         if(isset($request['pendindStatus'])){
           // echo "string";dd();
           // print_r($request['client_id']);dd();
            BatchDetail::where('id', '=', $request['client_id'])->update(['status_id'=>2]);
            // return redirect()->route('viewData');
        }        
      return redirect()->route('viewData');
    }

     public function statusChangedManager($id){

        $changeStatus = BatchDetail::where('id', '=', $id)->update(['status_id'=>3]);

     
      return redirect()->route('viewData');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function show(BatchDetail $batchDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(BatchDetail $batchDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BatchDetail $batchDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BatchDetail  $batchDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(BatchDetail $batchDetail)
    {
        //
    }
}
