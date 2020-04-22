<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // https://api.covid19api.com/summary


    $response = Http::get('https://api.covid19api.com/summary');
    $covidData = json_decode($response->getBody()->getContents());


    $countryList = App\Country::all();
    $markers = [];

    foreach($countryList as $country) {
        for($i = 0; $i < sizeof($covidData->Countries); $i++) {
            if($country["title"] == $covidData->Countries[$i]->Country) {
                $marker["title"] = $country["title"];
                $marker["lat"] = $country["lat"];
                $marker["lng"] = $country["lng"];
                $strtotime = strtotime($covidData->Countries[$i]->Date);
                $date = date("M d Y G:i:s T", $strtotime);
                $marker["popup"] = "<h1>".$country["title"]."</h1>
                <p>New Confirmed: ".$covidData->Countries[$i]->NewConfirmed."</p>
                <p>Total Confirmed: ".$covidData->Countries[$i]->TotalConfirmed."</p>
                <p>New Deaths: ".$covidData->Countries[$i]->NewDeaths."</p>
                <p>Total Deaths: ".$covidData->Countries[$i]->TotalDeaths."</p>
                <p>New Recovered: ".$covidData->Countries[$i]->NewRecovered."</p>
                <p>Total Recovered: ".$covidData->Countries[$i]->TotalRecovered."</p>
                <p>Last update: ".$date."</p>";
                array_push($markers, $marker);
            }
        }
    }
    return view('map', ['markers' => $markers]);
});
