<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Lionix</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .content {
                text-align: center;
            }


        </style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div id="weather" class="col">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Name</th>
                            <th scope="col">Latitude</th>
                            <th scope="col">Longitude</th>
                            <th scope="col">Temp</th>
                            <th scope="col">Temp Min</th>
                            <th scope="col">Temp Max</th>
                            <th scope="col">Pressure</th>
                            <th scope="col">Humidity</th>
                        </tr>
                        </thead>
                        <tbody id="wbody">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script type="application/javascript">
            $(document).ready(function() {
                getWeather();
                setInterval(function(){ getWeather(); }, 120000);

                function getWeather(){

                    let url = '/api/get-weather';
                    let data = [
                        {
                            lat: '40.18',
                            long: '44.51'
                        },
                        {
                            lat: '39.21',
                            long: '46.41'
                        }
                    ];



                    let formData = new FormData();
                    formData.append('data', JSON.stringify(data));
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            $('#wbody').html(result);
                        },
                        error: function (data) {
                            //
                        }
                    });
                }
            });
        </script>
    </body>
</html>
