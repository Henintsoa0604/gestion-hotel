<?php

namespace App\Http\Controllers\Statistique;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\Models\Reservation;
use DateTime;
class StatistiqueController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
     
    }
    function getAllMonths(){

        $month_array = array();
        $posts_dates = Reservation::orderBy( 'created_at', 'ASC' )->pluck( 'created_at' );

        $posts_dates = json_decode( $posts_dates );

        if ( ! empty( $posts_dates ) ) {
                foreach ( $posts_dates as $unformatted_date ) {
                        $date = new \DateTime( $unformatted_date->date );
                        $month_no = $date->format( 'm' );
                        $month_name = $date->format( 'M' );
                        $month_array[ $month_no ] = $month_name;
                }
        }
        return $month_array;
    }

function getMonthlyPostCount( $month ) {
   $monthly_post_count = DB::table('reservations')
                ->where('status','=','Accepté')
                ->whereMonth('created_at',$month)
                ->sum('montant');
                    
   return $monthly_post_count;
}


    public function index(){
        $res = DB::table('reservations')
               ->selectRaw('sum(montant) as sumMontant')
               ->where('status','=','Accepté') 
               ->get();
        $cons = DB::table('consommations')
               ->selectRaw('sum(montant_cons) as sumCons')
               ->get();
        $pres = DB::table('prestations')
               ->selectRaw('sum(montant_pres) as sumPres')
               ->get();
        $post = DB::table('reservations')
               ->join('users','reservations.user_id','users.id') 
               ->where('reservations.status','=','Accepté')  
               ->get()->toArray();
               foreach($post as $row)
                {
                   $data[] = array
                    (
                     'label'=>$row->name,
                     'y'=>$row->montant
                    ); 
                }
        $cli = DB::table('users')
                ->selectRaw('count(id) as countCli')
                ->get();
        $totalres = DB::table('reservations')
                ->selectRaw('count(id) as countRes')
                ->get();
        $top = DB::table('reservations')
                ->join('users','reservations.user_id','users.id')
                ->select('users.*','reservations.*')  
                ->where('reservations.status','=','Accepté')
                ->orderBy('reservations.montant','ask') 
                ->paginate(5);
                $monthly_post_count_array = array();
                $month_array = $this->getAllMonths();
                $month_name_array = array();
                if ( ! empty( $month_array ) ) {
                        foreach ( $month_array as $month_no => $month_name ){
                                $monthly_post_count = $this->getMonthlyPostCount( $month_no );
                                $datares[] = array
                                (
                                'label'=>$month_name,
                                'y'=>$monthly_post_count,
                                ); 
                        }
                }
        
               
              
               
        
                $reservation = DB::table('reservations')
                ->join('chambres','reservations.chambre_id','chambres.id')
                ->select('reservations.id','reservations.created_at','reservations.montant','chambres.num_ch')
                ->where('status','=','Accepté')
                ->get();
                $sum = DB::table('reservations')
                ->join('chambres','reservations.chambre_id','chambres.id')
                ->select('reservations.id','reservations.created_at','reservations.montant','chambres.num_ch')
                ->where('status','=','Accepté')
                ->sum('reservations.montant');
               
        return view('statistique.statistique')->with('sumMontant',$res)
                                              ->with('sumCons',$cons)
                                              ->with('sumPres',$pres)
                                              ->with('data',$data)
                                              ->with('countCli',$cli)
                                              ->with('countRes',$totalres)
                                              ->with('top',$top)
                                              ->with('datares',$datares)
                                              ->with('reservation',$reservation)
                                              ->with('sum',$sum);
    }
}
