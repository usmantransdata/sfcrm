<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BatchDetail extends Model
{
   
 protected $table = 'batch_details';

 public $timestamps = false;

  protected $fillable = [ 'uploader_id', 'client_id',	'batch_process_bit', 'total_record_count', 'batch_name', 'instructions'];


 public function orderBatch()
  {
    return $this->belongsTo('App\CotentBatch');
  }


  public function client(){

  	return $this->belongsTo('App\Client');
  }


   public function batchStatus()
    {
        return $this->belongsTo('App\BatchStatus', 'status_id');
    }
}
