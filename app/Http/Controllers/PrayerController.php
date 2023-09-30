<?php

namespace App\Http\Controllers;

use App\Models\Prayer;
use App\Models\PrayerLeader;
use Auth;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class PrayerController extends Controller
{  
    public function getPrayers(Request $request){ 

        $date = Carbon::create($request->date)->addDay(1);
        $dateStartEnd = Carbon::create($request->date)->addDay(1);
        
        $whereData = Carbon::create($request->date)->addDay(1);
        $startWeek = $date->startOfWeek();
        $imams = [];
        

        $prayers = Prayer::with(['prayerLeader' => function ($query) use ($date) {
            $query->where('prayer_date', $date );
        },'prayerLeader.user'])
        ->get(); 

        if( $request->tab === "daily" ){
             
            $prayerLeaders = PrayerLeader::with('user')
            ->whereBetween('prayer_date',[
                $whereData->startOfWeek()->format('Y-m-d'), $whereData->endOfWeek()->format('Y-m-d')
            ])->get()->toArray();
 
            $prayersSection = '<thead class="table-dark">
            <tr>
                <th scope="col">DAYS</th>';

            for($i=0; $i<5; $i++)
            {
                $prayersSection .= '<th>'.$prayers[$i]->name.'</th>';
            } 

            $prayersSection .= '</tr>
            </thead>';
            $prayersSection .= '<tbody>';
                    
                for($j=0; $j<7; $j++){

                    $prayersSection .= '<tr>';
                    $prayersSection .= '<td>'.$startWeek->format('D d').'</td>';

                    
                        for($k=0; $k<5; $k++){
                             
                            if($j!==4){
                                
                              
                                $prayersSection .='<td class="lead-pray-btn" data-id='.$prayers[$k]->id.' data-date='.$startWeek->format('Y-m-d').'>';

                                foreach($prayerLeaders as $prayerKey => $prayerVal){
                                    if($prayerVal['prayer_date'] === $startWeek->format('Y-m-d') && $prayers[$k]->id === $prayerVal['prayer_id']){
                                        $imams[] = [
                                            'name' => $prayerVal['user']['name'],
                                            'color' => $prayerVal['user']['color'],
                                        ];
                                        $prayersSection .= '<span class="badge badge-secondary" style="background-color:'.$prayerVal['user']['color'].';">'. $prayerVal['user']['name'] .'  <i class="fa fa-times" aria-hidden="true" data-id='.$prayers[$k]->id.' data-date='.$startWeek->format('Y-m-d').'  onclick="removeLeader(event)" ></i>
                                        </span>';
                                    }
                                } 

                                $prayersSection .='</td>'; 

                            }else{

                                if($k!==1){
 
                                $prayersSection .='<td class="lead-pray-btn"  data-id='.$prayers[$k]->id.' data-date='.$startWeek->format('Y-m-d').'>'; 
                                  
                                foreach($prayerLeaders as $prayerKey => $prayerVal){
                                    if($prayerVal['prayer_date'] === $startWeek->format('Y-m-d') && $prayers[$k]->id === $prayerVal['prayer_id']){
                                        $imams[] = [
                                            'name' => $prayerVal['user']['name'],
                                            'color' => $prayerVal['user']['color'],
                                        ];
                                        $prayersSection .= '<span class="badge badge-secondary" style="background-color:'.$prayerVal['user']['color'].';">'. $prayerVal['user']['name'] .'  <i class="fa fa-times" aria-hidden="true" data-id='.$prayers[$k]->id.' data-date='.$startWeek->format('Y-m-d').' onclick="removeLeader(event)" ></i>
                                        </span>';
                                    }
                                }  

                                $prayersSection .='</td>'; 

                                }else{
                                    $prayersSection .='<td></td>';
                                }
                                
                            }
 
                        }
                    $prayersSection .= '</tr>';
                    $startWeek->addDay(1);
                }

            $prayersSection .= '</tbody>';

        }else{

 
            $prayersSection = '<thead class="table-dark">
            <tr>
                <th scope="col">DAYS</th>';

            for($i=5; $i<8; $i++)
            {
                $prayersSection .= '<th>'.$prayers[$i]->name.'</th>';
            } 

            $prayersSection .= '</tr></thead>';
            $prayersSection .= '<tbody>';
             
            $fridays = $this->getAllFridayByMonth($dateStartEnd->format('Y'), $dateStartEnd->format('m')); 
         
            $prayerLeaders = PrayerLeader::with('user')
            ->whereRaw("EXTRACT(dow FROM prayer_date) = 5")->whereBetween(
                'prayer_date',
                [$whereData->startOfMonth()->format('Y-m-d'), $whereData->endOfMonth()->format('Y-m-d')]
            )
            ->get()
            ->toArray();  

            foreach ($fridays as $key => $friday) {
                
                    $prayersSection .= '<tr>';
                    $prayersSection .= '<td>'.$friday->format('D d').'</td>';

                    for($k=5; $k<8; $k++){
                        

                    $prayersSection .='<td class="lead-pray-btn" data-id='.$prayers[$k]->id.' data-date='.$friday->format('Y-m-d').'>'; 
 
                    foreach($prayerLeaders as $prayerLeader){
                        if($prayerLeader['prayer_date'] === $friday->format('Y-m-d') && $prayerLeader['prayer_id'] === $prayers[$k]->id){
                            $imams[] = [
                                'name' => $prayerLeader['user']['name'],
                                'color' => $prayerLeader['user']['color'],
                            ];
                            $prayersSection .= '<span class="badge badge-secondary" style="background-color:'.$prayerLeader['user']['color'].';">'. $prayerLeader['user']['name'] .' <i class="fa fa-times" aria-hidden="true" data-id='.$prayers[$k]->id.' data-date='.$friday->format('Y-m-d').' onclick="removeLeader(event)" ></i>
                            </span>';
                        }
                    }  

                    $prayersSection .='</td>';  

                    }

                    $prayersSection .= '</tr>'; 
            }

            $prayersSection .= '</tbody>';
            
        }  

        
        return response()->json([
            'message' => 'Prayers list',
            'data' => [
               'prayers' => $prayersSection,
               'imams' => $this->uniqueImams($imams),
            ]
        ], 200);
    }


    public function addLeadPray(Request $request){
 
        if(!Auth::user()){
            return response()->json([
                'message' => 'Please Login Your Account!',
                'data' => ''
            ],401);
        }

        if(Auth::user()->role_id===0){
            return response()->json([
                'message' => 'Only imams can lead the pray.',
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
            'message' => 'Prayer Lead Has Been Added Successfully.',
            'data' => ''
        ]);
    }

    public function getAllFridayByMonth($year, $month){
               
    // Create a Carbon instance for the first day of the specified month
    $startDate = Carbon::createFromDate($year, $month, 1);
    

    // Create a Carbon instance for the last day of the specified month
    $endDate = $startDate->copy()->endOfMonth();
 
    // Initialize an array to store the Fridays
    $fridays = [];

    // Loop through each day between the start and end date
    while ($startDate->lte($endDate)) {
        // Check if the current day is a Friday (Carbon's dayOfWeek returns 5 for Friday)
        if ($startDate->dayOfWeek === Carbon::FRIDAY) {
            // Add the current date to the array of Fridays
            $fridays[] = $startDate->copy();
        }
        
        // Move to the next day
        $startDate->addDay();
    }

    return $fridays;

    }

    public function uniqueImams($imams){

        $uniqueArray = [];

        foreach ($imams as $item) {
            // Create a unique key based on "name" and "color"
            $key = $item['name'] . '-' . $item['color'];
            
            // Check if the key doesn't exist in the uniqueArray
            if (!array_key_exists($key, $uniqueArray)) {
                // Add the item to the uniqueArray
                $uniqueArray[$key] = $item;
            }
        }

        // Reset array keys to have consecutive numeric keys (optional)
        $uniqueArray = array_values($uniqueArray);
        return $uniqueArray;
    }


    public function removeLeadPray(Request $request){

        try{

            PrayerLeader::where([
                ['prayer_id', $request->prayer_id],
                ['prayer_date', $request->prayer_date]
            ])->delete();

            return response()->json([
                'message' => 'Prayer Lead Has Been Removed Successfully.',
                'data' => ''
            ]);
            
        }catch(Exception $e){
            return response()->json([
                'message' => 'Something Went Wrong.',
                'data' => ''
            ]);
        }
        
    }
}
