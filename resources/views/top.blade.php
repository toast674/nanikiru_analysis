
<!DOCTYPE html>
<html>
    <head>
        <title>Mizukuma</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://unpkg.com/sanitize.css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&display=swap">
        @if(app('env')=='local')
            <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ asset('css/media.css') }}">
        @endif
        @if(app('env')=='production')
            <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/style.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/card.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/media.css') }}">
        @endif
        <style>
        </style>

        @include('part.ga')
    </head>
    <body class="top full-screen">
        @include('part.header')
        <div class="container top">
            <div class="front">
                <!-- <div class="action-choices">
                    <button type="button" class="trans-btn" onclick="location.href='nanikiru'" onfocus="this.blur();"><span class="btn-shine">分析する</span></button>
                </div>
                <div class="action-choices">
                    <button type="button" class="trans-btn" onclick="location.href='chart'" onfocus="this.blur();"><span class="btn-shine">戦術書検索</span></button>
                </div> -->
                <div class="action-choices">
                    <button type="button" class="trans-btn" onclick="location.href='flash'" onfocus="this.blur();"><span class="btn-shine">フラッシュ何切る</span></button>
                </div>
            </div>
        </div>
        @include('part.footer')
    </body>
</html>