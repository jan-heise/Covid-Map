<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Covid 19 Map</title>
        @mapstyles
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            .gnw-map-service {
                height: 100vh;
                width: 100vw;
            }
        </style>
    </head>
    <body>
        @map([
            'lat' => 48.134664,
            'lng' => 11.555220,
            'zoom' => 4,
            'markers' => $markers
        ])
       @mapscripts
    </body>
</html>
