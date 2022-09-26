<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use DB;
use Carbon\Carbon;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
       
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalCli = DB::table('users')
        ->get()
        ->count();
        $totalAdmin = DB::table('admins')
        ->get()
        ->count();
        $totalRes = DB::table('reservations')
        ->get()
        ->count();
        $acc = DB::table('reservations')
        ->where('status','=','Accepté')
        ->get()
        ->count();
        $att = DB::table('reservations')
        ->where('status','=','En attente')
        ->get()
        ->count();
        $ann = DB::table('reservations')
        ->where('status','=','Annulé')
        ->get()
        ->count();

        $res = DB::table('reservations')
       
        ->join('chambres', 'reservations.user_id', '=', 'chambres.id')
        ->select('chambres.*','reservations.*')
        ->orderBy('reservations.created_at','ASK')
        ->paginate(2);
        $resListe = DB::table('reservations')
        ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
       ->join('users', 'reservations.user_id', '=', 'users.id')
       ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','reservations.created_at','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
       ->orderBy('reservations.created_at','ASK')
       ->paginate(5);
        $now= Carbon::now()->format('Y-m-d');
        $sem = Carbon::now()->subDays(7)->format('Y-m-d');
       $semaine = DB::table('reservations')
       ->join('chambres', 'reservations.chambre_id', '=', 'chambres.id')
       ->join('users', 'reservations.user_id', '=', 'users.id')
       ->select('reservations.id','chambres.nbr_pers','users.id as cli','users.name','users.prenom_cli','reservations.desc','reservations.date_debut','reservations.date_fin','reservations.date_paye','reservations.nbr_jour','reservations.montant','reservations.status','reservations.created_at','chambres.description_ch','chambres.img_ch','chambres.num_ch','chambres.nbr_lit_ch','chambres.etage_ch','chambres.status_ch')
       ->whereDate('reservations.created_at','<=',$now)
       ->whereDate('reservations.created_at','>',$sem)
       ->orderBy('reservations.created_at','ASK')
       ->paginate(5);
     
       
        
        return view('templ')->with('totalCli',$totalCli)
                            ->with('totalAdmin',$totalAdmin)
                             ->with('totalRes',$totalRes)
                             ->with('acc',$acc)
                             ->with('att',$att)
                             ->with('ann',$ann)
                             ->with('res',$res)
                             ->with('resListe',$resListe)
                             ->with('semaine',$semaine);
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

	function getMonthlyPostData() {

		$monthly_post_count_array = array();
		$month_array = $this->getAllMonths();
		$month_name_array = array();
		if ( ! empty( $month_array ) ) {
			foreach ( $month_array as $month_no => $month_name ){
				$monthly_post_count = $this->getMonthlyPostCount( $month_no );
				array_push( $monthly_post_count_array, $monthly_post_count );
				array_push( $month_name_array, $month_name );
			}
		}

		$max_no = max( $monthly_post_count_array );
		$max = round(( $max_no + 10/2 ) / 10 ) * 10;
		$monthly_post_data_array = array(
			'months' => $month_name_array,
			'post_count_data' => $monthly_post_count_array,
			'max' => $max,
		);

		return $monthly_post_data_array;

	}
	
}
