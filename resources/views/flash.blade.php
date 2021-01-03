<!DOCTYPE html>
<html>

<head>
    <title>フラッシュ何切る</title>
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
                <div class="card fade-in-left">
                    <div class="problem">
                        <div class="question-area">

                            <!-- 牌姿を作成 -->
                            <div id="paishi_box" class="paishi">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <label>
                    問題数
                </label>
                <select name="question_count" id="question_count">
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                </select>
                問
            </div>
            <div>
                <label>
                    表示間隔
                </label>
                <select name="question_second" id="question_second">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                秒
            </div>

            <div class="action-choices">
                <label for="start-btn">
                    <div class="btn-shine">
                        <input id="start-btn" class="trans-btn pointer" type="button" value="スタート"
                            onfocus="this.blur();">
                    </div>
                </label>
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

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
    <script>

        let paishi_array = [];
        let paishi_img_tag_all = [];

        $('#start-btn').on('click', function () {
            $.ajax({
                type: 'GET',
                url: 'getFlashPaishi',
                dataType: 'json',
            }).done(function (data) {
                // 牌姿をm,p,s,zで記述する配列に変換
                data.forEach(element => {
                    paishi_array.push(convertFromStringToArrayImageUrl(element.paishi));
                });
                
                let question_count = document.getElementById('question_count').value;
                let question_second = document.getElementById('question_second').value;

                // 牌姿をimgタグに変換する（関数化）
                paishi_array.forEach(pai_array => {
                    let pai_img_tag_array = [];
                    pai_array.forEach((elem, index)=> {
                        pai_img_tag_array.push(createPaiImage(elem));
                    })
                    paishi_img_tag_all.push(pai_img_tag_array);
                });
                
                console.log(paishi_img_tag_all);
                startCount();
                flashHtml(paishi_img_tag_all, question_count, question_second);

            }).fail(function () {
                console.log("データ取得エラー");
            });
        })

        // カウントダウン
        function startCount() {
            let box = document.getElementById("paishi_box");
            //let timeCount = 3;
            console.log(box);
            console.log("カウントダウン");
            let getCount = function(timeCount) {
                console.log(timeCount);
                box.innerHTML = "";
                box.innerHTML += "<div>" + timeCount + "</div>";
                console.log(box.innerHTML);
                timeCount--;

                if(timeCount <= 0) {
                    clearInterval(timeId);
                }
            }

            let timeId = setInterval(getCount, 1000, timeCount);
        }

        function flashHtml(paishi_img_tag_all, question_count, question_second) {
            let box = document.getElementById("paishi_box");

            let showPaishi = function(paishi_img_tag_all) {
                box.innerHTML = "";
                paishi_img_tag_all[question_count].forEach(el => {
                    box.innerHTML += el;
                })
                question_count--;

                if(question_count <= 0) {
                    clearInterval(id);
                }
            }
            let id = setInterval(showPaishi, question_second*1000, paishi_img_tag_all);
        }

        function convertFromStringToArrayImageUrl(paishi) {

            let pure_manzu = colorConvert(paishi, 'm').replace('m', '');
            let pure_souzu = colorConvert(paishi, 's').replace('s', '');
            let pure_pinzu = colorConvert(paishi, 'p').replace('p', '');
            let pure_jihai = colorConvert(paishi, 'z').replace('z', '');
            
            let pure_manzu_img_array = [];
            let pure_souzu_img_array = [];
            let pure_pinzu_img_array = [];
            let pure_jihai_img_array = [];

            if(pure_manzu) {
                for(let i = 0; i < pure_manzu.length; i++) {
                    if(pure_manzu[i] === 'r') {
                        pure_manzu_img_array.push('r5m');
                        i++;
                    } else {
                        pure_manzu_img_array.push(pure_manzu[i]+'m');
                    }
                }
            }

            if(pure_souzu) {
                for(let i = 0; i < pure_souzu.length; i++) {
                    if(pure_souzu[i] === 'r') {
                        pure_souzu_img_array.push('r5s');
                        i++;
                    } else {
                        pure_souzu_img_array.push(pure_souzu[i]+'s');
                    }
                }
            }

            if(pure_pinzu) {
                for(let i = 0; i < pure_pinzu.length; i++) {
                    if(pure_pinzu[i] === 'r') {
                        pure_pinzu_img_array.push('r5p');
                        i++;
                    } else {
                        pure_pinzu_img_array.push(pure_pinzu[i]+'p');
                    }
                }
            }

            if(pure_jihai) {
                for(let i = 0; i < pure_jihai.length; i++) {
                    pure_jihai_img_array.push(pure_jihai[i]+'z');
                }
            }

            let paishi_img_array = [];
            paishi_img_array = paishi_img_array.concat(...pure_manzu_img_array,...pure_souzu_img_array,...pure_pinzu_img_array,pure_jihai_img_array);
            return paishi_img_array;

        }

        /**
         * 
         * @param {string} paishi 
         * @param {string} colorHead 
         */
        function colorConvert(paishi, colorHead) {

            // 除くべき色
            switch (colorHead) {
                case 'm':
                    other_color = ['p', 's', 'z'];
                    break;
                case 'p':
                    other_color = ['m', 's', 'z'];
                    break;
                case 's':
                    other_color = ['m', 'p', 'z'];
                    break;
                case 'z':
                    other_color = ['m', 'p', 's'];
                    break;
                default:
            }

            // mで区切られているポイント
            const m_point = paishi.indexOf(colorHead);
            // mのあとに存在するものは全て削除
            const later_removed_after = paishi.replace(paishi.substring(m_point+1, paishi.length), '');
            // m以前の文字列が存在する部分まで削除(rはのぞく)

            const other_color_point1 = paishi.indexOf(other_color[0]);
            const other_color_point2 = paishi.indexOf(other_color[1]);
            const other_color_point3 = paishi.indexOf(other_color[2]);

            const point_array = [];
            const other_color_point_array = [other_color_point1,other_color_point2,other_color_point3];
            for(const op of other_color_point_array) {
                // -1の場合は存在していないことになるのでスルー
                if(op == -1) {
                    continue;
                }
                // m_pointより大きい場合はmのあとに存在することになるのでスルー
                if(op > m_point) {
                    continue;
                }
                point_array.push(op);
            }
            const point = Math.max(...point_array);
            const removePaishi = later_removed_after.substring(0, point+1);
            const pure_color = later_removed_after.replace(removePaishi, '');

            return pure_color;
        }

        function createPaiImage (pai) {
            if(pai == '1m') return "<img src={{ asset('/tile_images/man1.png') }} />";
            if(pai == '2m') return "<img src={{ asset('/tile_images/man2.png') }} />";
            if(pai == '3m') return "<img src={{ asset('/tile_images/man3.png') }} />";
            if(pai == '4m') return "<img src={{ asset('/tile_images/man4.png') }} />";
            if(pai == '5m') return "<img src={{ asset('/tile_images/man5.png') }} />";
            if(pai == '6m') return "<img src={{ asset('/tile_images/man6.png') }} />";
            if(pai == '7m') return "<img src={{ asset('/tile_images/man7.png') }} />";
            if(pai == '8m') return "<img src={{ asset('/tile_images/man8.png') }} />";
            if(pai == '9m') return "<img src={{ asset('/tile_images/man9.png') }} />";
            if(pai == '1p') return "<img src={{ asset('/tile_images/pin1.png') }} />";
            if(pai == '2p') return "<img src={{ asset('/tile_images/pin2.png') }} />";
            if(pai == '3p') return "<img src={{ asset('/tile_images/pin3.png') }} />";
            if(pai == '4p') return "<img src={{ asset('/tile_images/pin4.png') }} />";
            if(pai == '5p') return "<img src={{ asset('/tile_images/pin5.png') }} />";
            if(pai == '6p') return "<img src={{ asset('/tile_images/pin6.png') }} />";
            if(pai == '7p') return "<img src={{ asset('/tile_images/pin7.png') }} />";
            if(pai == '8p') return "<img src={{ asset('/tile_images/pin8.png') }} />";
            if(pai == '9p') return "<img src={{ asset('/tile_images/pin9.png') }} />";
            if(pai == '1s') return "<img src={{ asset('/tile_images/sou1.png') }} />";
            if(pai == '2s') return "<img src={{ asset('/tile_images/sou2.png') }} />";
            if(pai == '3s') return "<img src={{ asset('/tile_images/sou3.png') }} />";
            if(pai == '4s') return "<img src={{ asset('/tile_images/sou4.png') }} />";
            if(pai == '5s') return "<img src={{ asset('/tile_images/sou5.png') }} />";
            if(pai == '6s') return "<img src={{ asset('/tile_images/sou6.png') }} />";
            if(pai == '7s') return "<img src={{ asset('/tile_images/sou7.png') }} />";
            if(pai == '8s') return "<img src={{ asset('/tile_images/sou8.png') }} />";
            if(pai == '9s') return "<img src={{ asset('/tile_images/sou9.png') }} />";
            if(pai == '1z') return "<img src={{ asset('/tile_images/ji1.png') }} />";
            if(pai == '2z') return "<img src={{ asset('/tile_images/ji2.png') }} />";
            if(pai == '3z') return "<img src={{ asset('/tile_images/ji3.png') }} />";
            if(pai == '4z') return "<img src={{ asset('/tile_images/ji4.png') }} />";
            if(pai == '5z') return "<img src={{ asset('/tile_images/ji5.png') }} />";
            if(pai == '6z') return "<img src={{ asset('/tile_images/ji6.png') }} />";
            if(pai == '7z') return "<img src={{ asset('/tile_images/ji7.png') }} />";
            if(pai == 'r5m') return "<img src={{ asset('/tile_images/aka5man.png') }} />";
            if(pai == 'r5p') return "<img src={{ asset('/tile_images/aka5pin.png') }} />";
            if(pai == 'r5s') return "<img src={{ asset('/tile_images/aka5sou.png') }} />";
    }
    </script>

</body>

</html>
