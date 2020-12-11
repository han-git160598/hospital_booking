<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class service_service extends Model
{
    use HasFactory;


    public function allservice_service ()
    {
    	$data = DB::table('tbl_service_service')->get();
    	return json_decode($data);
    }
    
}
