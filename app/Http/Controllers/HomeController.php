<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cashflow;
use Charts;
use App\User;
use Carbon\Carbon;


class HomeController extends Controller
{
  private $offices;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->offices  = [1 => 'Head Office', 2 => 'Zimmerman', 3 => 'Gikomba',
            4 => 'Thika', 5 => 'Naivasha',6 => 'Kitengela', 7 => 'Kisii',8 => 'Donholm', 9 => 'Kariobangi',
            10 => 'Kawangware', 11 => 'Kiambu',12 => 'Machakos', 13 => 'Muranga',14 => 'Nakuru', 15 => 'Narok',
            16 => 'Rongai', 17 => 'Pilot',18 => 'Matuu', 19 => 'Molo',20 => 'Eldoret', 21 => 'HQ-Branch',
          ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $groupByDay = Charts::database(Cashflow::all(),'pie', 'google')
            ->elementLabel("Models")
            ->dimensions(1000,500)
            ->responsive(true)
            ->GroupByDay();
      $groupByOffice = Charts::database(Cashflow::all(), 'bar', 'google')
            ->elementLabel("Cashflow Loans")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupBy('officeId', null, $this->offices);
      $groupByDayTrend = Charts::database(Cashflow::all(), 'line', 'google')
            ->title('Cashflow Loans')
            ->elementLabel('Cashflow Loans')
            ->dimensions(1000,500)
            ->groupByMonth()
            ->dateFormat('F Y')
            ->responsive(true);
      $widgets = (object)[
        'totalModels' => Cashflow::count(),
        'todayModels' => Cashflow::whereDate('created_at', '=', date('Y-m-d'))->count(),
        'lastWeekModels' => Cashflow::whereBetween('created_at', [(Carbon::today()->subWeeks(2)), Carbon::today()->subWeek() ])->count(),
        'thisWeekModels' => Cashflow::whereBetween('created_at', [(Carbon::today()->subWeek()), Carbon::today()])->count(),
        'topBranchInTheWeek' => $this->getBranchByName(),
        'previousWeekTopBranch' => $this->highActiveBranchInThePreviousWeek()
      ];
        return view('home', compact('groupByDay','groupByOffice', 'groupByDayTrend','widgets'));
    }
    /*
      This function returns branch name based on its officeId.
      @input array of branch name indexed by their ID
      @ Cashflow::groupBy('officeId')->pluck('officeId')->max() //gets the most common branch
    */
    private function getBranchByName()
    {
      foreach ($this->offices as $key => $value) {
        if ($key == $this->highActiveBranchInTheWeek() ) {
          return $value;
        }
      }
    }
    /*
      This function gets the most active branch in the current week
    */
    private function highActiveBranchInTheWeek()
    {
      return Cashflow::whereBetween('created_at', [(Carbon::today()->subWeek()), Carbon::today()])
              ->groupBy('officeId')->pluck('officeId')->max();
    }
    private function highActiveBranchInThePreviousWeek()
    {
      return Cashflow::whereBetween('created_at', [(Carbon::today()->subWeeks(2)), Carbon::today()->subWeek() ])
              ->groupBy('officeId')->pluck('officeId')->max();
    }
    private function getOverallActiveBranch()
    {
      return Cashflow::groupBy('officeId')->pluck('officeId')->max();
    }
}
