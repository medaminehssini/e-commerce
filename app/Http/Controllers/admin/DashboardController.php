<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $summSubs = User::count();
        $revenues = Commande::where('etat' , 3)->get();
        $summrevenues = 0;
        foreach ($revenues as $key => $commande) {
            $summrevenues +=  $commande->total ;
        }
        $revenues = Commande::count();

        return view('admin.welcome')->with([
            'subscribers' => $this->subscribers(),
            'summSubs' => $summSubs ,
            'revenues' => $this->revenue(),
            'summrevenues' =>   $summrevenues,
            'orders' => $this->orders(),
            'summorders' =>   $revenues,
            'thisYears'=>$this->revenueYear(0),
            'lastYears'=>$this->revenueYear(1),
            'clients' => $this->clients(),
            'clientsByMonth' => $this->clientsByMonth(),
        ]);
    }


    public function subscribers()
    {
        $subribers = User::where('created_at', '>' , Carbon::now()->subDays(6))->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $subs = [0,0,0,0,0,0,0];
        for ($i=6; $i >=0 ; $i--) {

            foreach ($subribers as $key => $value) {
                if ( Carbon::now()->subDays($i)->format('Y-m-d')  ==  Carbon::parse($value[0]->created_at)->format('Y-m-d')) {

                $subs[6-$i] = count($value);
            }

            }
        }
        return $subs;
    }

    public function revenue()
    {
        $revenues = Commande::where('created_at', '>' , Carbon::now()->subDays(6))->where('etat' , 3)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $revs = [0,0,0,0,0,0,0];
        for ($i=6; $i >=0 ; $i--) {

            foreach ($revenues as $key => $value) {
                if ( Carbon::now()->subDays($i)->format('Y-m-d')  ==  Carbon::parse($value[0]->created_at)->format('Y-m-d')) {
                {
                    $somme = 0;
                    foreach ($value as $key => $commande) {
                        $somme +=$commande->total;
                    }
                    $revs[6-$i] = $somme;
                }
            }

            }
        }
        return $revs;
    }

    public function orders()
    {
        $orders = Commande::where('created_at', '>' , Carbon::now()->subDays(6))->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m-d');
        });

        $ords = [0,0,0,0,0,0,0];
        for ($i=6; $i >=0 ; $i--) {

            foreach ($orders as $key => $value) {
                if ( Carbon::now()->subDays($i)->format('Y-m-d')  ==  Carbon::parse($value[0]->created_at)->format('Y-m-d')) {

                $ords[6-$i] = count($value);
            }

            }
        }
        return $ords;
    }

    public function revenueYear($m)
    {
        $revenues = Commande::whereYear('created_at' , Carbon::now()->subYear($m)->format('Y'))->where('etat' , 3)->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
        $revs = [0,0,0,0,0,0,0,0,0,0,0,0];
        for ($i=11; $i >=0 ; $i--) {

            foreach ($revenues as $key => $value) {
                if ( $i + 1 ==  Carbon::parse($value[0]->created_at)->format('m')) {
                {
                    $somme = 0;
                    foreach ($value as $key => $commande) {
                        $somme +=$commande->total;
                    }
                    $revs[$i] = $somme;
                }
            }

            }
        }
        return $revs;
    }

    public function clients()
    {
        $new = 0;
        $old =  0;
        $clients = User::get();
        foreach ($clients as $key => $client) {
            if(count($client->commande)>0)
                $old++;
            else
                $new++;
        }
        $clts = [$old,$new];

        return $clts;
    }

    public function clientsByMonth()
    {

        $clts = User::whereYear('created_at' , Carbon::now()->format('Y'))->get()->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $clients = [0,0,0,0,0,0,0,0,0,0,0,0,0];
        for ($i=11; $i >=0 ; $i--) {

            foreach ($clts as $key => $value) {
                if ( $i  +1  ==  Carbon::parse($value[0]->created_at)->format('m')) {


                    $clients[$i] = count($value);
                }

            }
        }
        return $clients;
    }
}
