<!DOCTYPE html>
<html>

<head>
    <title>Mahsis</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://unpkg.com/sanitize.css" />
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400&display=swap">
    @if(app('env')=='local')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/card.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/media.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.notify.css') }}">
    @endif
    @if(app('env')=='production')
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/card.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/media.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/jquery.notify.css') }}">
    @endif

    <style>
    </style>
</head>

<body class="nanikiru">
    @include('part.header')
    <div class="container">
        <form method="POST" action="result" name="nanikiruForm">
            <div class="card-outer">
                @csrf
                <!-- 牌姿画像 -->
                @foreach($paishi_image_array as $i => $paishi_image)
                <?php $qa_num = $i+1; ?>
                <div class="card fade-in-left">
                    <div class="problem">
                        <div class="question-area">

                            <!-- 牌姿を作成 -->
                            <div class="paishi">
                                @foreach($paishi_image as $pai_image)
                                @if(app('env')=='local')
                                    <img src="{{ asset("/tile_images/$pai_image") }}">
                                @endif
                                @if(app('env')=='production')
                                    <img src="{{ secure_asset("/tile_images/$pai_image") }}">
                                @endif
                                @endforeach
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </form>
    </div>
    @include('part.footer')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    @if(app('env')=='local')
        <script src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script src="{{ asset('js/jquery.notify.min.js') }}"></script>
    @endif
    @if(app('env')=='production')
        <script src="https://code.jquery.com/jquery-latest.min.js"></script>
        <script src="{{ secure_asset('js/jquery.notify.min.js') }}"></script>
    @endif

    <script>
    const todo = new Vue({
        el: '#app',
        data: {
            list: [],      // 入力テキストを入れる配列
            last: null,    // 入力テキストの最終更新日
            inputText: "", // テキストフォームで入力したデータの変数
        },
        methods: {
            // 送信機能
            send: function () {

                // 最終更新日がNULLのとき
                if(!todo.last){
                    todo.last = { created_at: "1970-01-01 00:00:00" }
                }

                sendMessage(this.inputText, todo.last.created_at); // 送信メッセージ関数
                this.inputText = ""; // 初期化
            },
        }
    });
    </script>

</body>

</html>
