<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Little Light</title>

        <!-- Styles -->
        <link href="{{url('css/home.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Eyes up, Guardian
                </div>
				<div class="download">
					Download Little Light
				</div>
                <div class="links">
                    <a href="https://play.google.com/store/apps/details?id=me.markezine.luzinha">
						<img src="{{url('img/google-play-badge.png')}}" />
					</a>
					<a href="https://itunes.apple.com/us/app/little-light-for-destiny-2/id1373037254?ls=1&mt=8">
						<img src="{{url('img/app-store-badge.svg')}}" />
					</a>
                </div>
            </div>
        </div>
    </body>
</html>
