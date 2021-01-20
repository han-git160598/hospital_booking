<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\AuthModel;

class ReportStatisticalController extends Controller
{
    public function statistical_examination_schedule(Request $request)
    {
        $year = $request->year_statistical; 
        $total_moth= array();
        for($i = 1; $i<=12;$i++)
        {
            if($i < 10)
            {
                $i = "0".$i;
            }
            $data_billing = DB::table('tbl_billing_billing')
            ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
            ->where('tbl_billing_billing.billing_status',4)
            ->where('tbl_billing_billing.billing_date', 'LIKE', "%".$year."-".$i."%")
            ->select([DB::raw("SUM(tbl_billing_detail.billing_price) as total_billing")])
            ->groupBy('tbl_billing_detail.id_billing')
            ->get();
            //actually
            $data_actually = DB::table('tbl_billing_billing')
            ->join('tbl_billing_actually','tbl_billing_actually.id_billing','=','tbl_billing_billing.id')
            ->where('tbl_billing_billing.billing_status',4)
            ->where('tbl_billing_billing.billing_date', 'LIKE', "%".$year."-".$i."%")
            ->select([DB::raw("SUM(tbl_billing_actually.billing_price) as total_billing_actually")])
            ->groupBy('tbl_billing_actually.id_billing')
            ->get();

            $total_moth_actually = 0;
            if(isset($data_actually) && !empty($data_actually))
            {
                foreach($data_actually as $v)
                {
                    $total_moth_actually+=$v->total_billing_actually;
                    
                }
            }
           
            $total_moth_billing = 0;
            foreach($data_billing as $v)
            {
                $total_moth_billing+=$v->total_billing;
                
            }
            $total_moth_price = $total_moth_actually + $total_moth_billing;
            array_push($total_moth,["moth"=>$i,"total_moth"=>$total_moth_price]);
        }
        $data_total['total_moth']=$total_moth;
        return json_encode($data_total);
    }
    public function fillter_total_examination_schedule(Request $request) // lọc tổng doanh thu lịch khám 
    {
        $from_date = $request->from_date; 
        $to_date = $request->to_date; 
        $total_billing= 0;
        
        $data_billing = DB::table('tbl_billing_billing')
        ->join('tbl_billing_detail','tbl_billing_detail.id_billing','=','tbl_billing_billing.id')
        ->where('tbl_billing_billing.billing_status',4)
        ->where('tbl_billing_billing.billing_date', 'LIKE', "%{$from_date}%")
        ->orwhere('tbl_billing_billing.billing_date', 'LIKE', "%{$to_date}%") 
        ->select([DB::raw("SUM(tbl_billing_detail.billing_price) as total_billing")])
        ->groupBy('tbl_billing_detail.id_billing')
        ->get();

        // $total_moth_billing = 0;
        foreach($data_billing as $v)
        {
            $total_billing+=$v->total_billing;
            
        }
      //  $total_moth_price = $total_moth_actually + $total_moth_billing;
      //  array_push($total_moth,["moth"=>$i,"total_moth"=>$total_moth_price]);
        return json_encode($total_billing);
    }
}
