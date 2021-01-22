<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Weather;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeathersController extends Controller
{
    public function updateWeather(Request $request)
    {
        $coordinates = json_decode($request['data']);

        $response = [];
        $weatherData = [];
        foreach ($coordinates as $coordinate){
            $url = "api.openweathermap.org/data/2.5/weather?lat=$coordinate->lat&lon=$coordinate->long&units=metric&appid=bf65d8b174418831a16055a19f50144f";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($result);
            $now = Carbon::now()->toTimeString();

            $weatherData['time'] = $now;;
            $weatherData['temp'] = $data->main->temp;
            $weatherData['temp_min'] = $data->main->temp_min;
            $weatherData['temp_max'] = $data->main->temp_max;
            $weatherData['pressure'] = $data->main->pressure;
            $weatherData['humidity'] = $data->main->humidity;

            $weather = Weather::updateOrCreate(
                ['name' => $data->name, 'lat' => $coordinate->lat, 'long' => $coordinate->long],
                $weatherData
            );

            $tbody = '    <tr>\n' .
                '                            <td>' . $weather['time'] . '</td>\n' .
                '                            <td>' . $weather['name'] . '</td>\n' .
                '                            <td>' . $weather['lat'] . '</td>\n' .
                '                            <td>' . $weather['long'] . '</td>\n' .
                '                            <td>' . $weather['temp'] . ' °C</td>\n' .
                '                            <td>' . $weather['temp_min'] . ' °C</td>\n' .
                '                            <td>' . $weather['temp_max'] . ' °C</td>\n' .
                '                            <td>' . $weather['pressure'] . '</td>\n' .
                '                            <td>' . $weather['humidity'] . '</td>\n' .
                '                        </tr>';

            array_push($response, $tbody);
        }

        return response()->json($response);

    }
}
