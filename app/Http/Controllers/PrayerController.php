<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use App\Models\PrayerLeader;
use Auth;
use Illuminate\Http\Request;

class PrayerController extends Controller
{  
    public function getPrayers(Request $request){

        $date = $request->date;

        $prayers = Prayer::with(['prayerLeader' => function ($query) use ($date) {
            $query->where('prayer_date', $date );
        },'prayerLeader.user'])
        ->get(); 

        $prayers_section = '<tbody>';
        foreach($prayers as $prayer){
            $prayers_section .= '<tr>
                <td scope="row" class="pray-name">'.$prayer->name.' '.( $prayer->prayerLeader ? '<p> <b>Lead By </b> '. $prayer->prayerLeader?->user?->name.'</p>' : '' ).' </td>
                <td><img src="'.asset($prayer->icon).'" width="30px" alt=""></td>
                <td><button class="btn btn-primary btn-sm lead-pray-btn" data-id='.$prayer->id.' data-date='.$date.'><img src="'.asset('images/lead-prayer.png').'" width="30px" alt=""></button></td>
            </tr>';
        }
        $prayers_section .= '</tbody>'; 

        return response()->json([
            'message' => 'Prayers list',
            'data' => $prayers_section
        ], 200);
    }


    public function addLeadPray(Request $request){
 
        if(!Auth::user()){
            return response()->json([
                'message' => 'Please Login Your Account!',
                'data' => ''
            ],401);
        }
         
        PrayerLeader::updateOrCreate(
            [
                
                'prayer_id' => $request->prayer_id,
                'prayer_date' => $request->date,
            ],
            [
                'user_id' => Auth::user()->id 
            ]
        );

        return response()->json([
            'message' => 'Fine....',
            'data' => ''
        ]);
    }
}
