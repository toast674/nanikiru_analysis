
<!DOCTYPE html>
<html>
    <head>
        <title>Mahsis</title>
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
    </head>
    <body class="top full-screen">
        @include('part.header')
        {{-- <div class="container top">
            <div class="front">
                <div class="top-description">
                    <div class="description-title">
                        <h2>質問に答えよう<span class="sp-none">、</span><br class="sp-br">雀力の強みと弱みを<br class="sp-br">分析できます。</h2>
                    </div>
                </div>
            </div>
        </div> --}}
        <div id="content">
            <div id="app">
              <p class="question_text">{{ question_text }}</p>
              <form name="q_form" action="result.php" method="post">
                <div v-show="answer1"><!-- 三人麻雀について知りたい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Result1')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer(2)">いいえ</button>
                  <input type="hidden" name="book0" value="">
                  <input type="hidden" name="book_img" value="">
                  <input type="hidden" name="book_url" value="">
                </div>
                <div v-show="answer2"><!-- 戦術書を比較的読む方だ -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Yes3')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer('No3')">いいえ</button>
                </div>
                <div v-show="answer3"><!-- 問題集形式の戦術書がいい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Yes4')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer('No4')">いいえ</button>
                </div>
                <div v-show="answer4"><!-- 特定の技術ではなく全体的に知識を深めたい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Result2_3')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer(5)">いいえ</button>
                </div>
                <div v-show="answer5"><!-- 牌効率について詳しく学びたい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Result5_6_7_8')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer(6)">いいえ</button>
                </div>
                <div v-show="answer6"><!-- 押し引きについて詳しく学びたい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Result9_10')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer(7)">いいえ</button>
                </div>
                <div v-show="answer7"><!-- 鳴きについて詳しく学びたい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Result11_12')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer(8)">いいえ</button>
                </div>
                <div v-show="answer8"><!-- 場況について詳しく学びたい -->
                  <button type="button" class="yes btn btn-primary" v-on:click="clickAnswer('Result13')">はい</button>
                  <button type="button" class="no btn btn-primary" v-on:click="clickAnswer('Result2_3')">いいえ</button>
                </div>
              </form>
            </div>
        </div>
        @include('part.footer')

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
  <script>
    Vue.config.devtools = true

    function init(){
      questions = [
      "三人麻雀について知りたい",
      "戦術書を比較的読む方だ",
      "問題集形式の戦術書がいい",
      "特定の技術ではなく全体的に知識を深めたい",
      "牌効率について詳しく学びたい",
      "押し引きについて詳しく学びたい",
      "鳴きについて詳しく学びたい",
      "場況について詳しく学びたい",
      ];

      books = [
        {
          id: 1,
          text: "データで勝つ3人麻雀",
          img: "img/book1.jpg",
          url: "https://www.amazon.co.jp/gp/product/4866730870/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4866730870&linkCode=as2&tag=toast6740c-22&linkId=8be34705597ae8bce6914815233f66aa"
        },
        {
          id: 2,
          text: "新版 おしえて! 科学する麻雀 ",
          img: "img/book2.jpg",
          url: "https://www.amazon.co.jp/gp/product/4800313457/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4800313457&linkCode=as2&tag=toast6740c-22&linkId=94db437c20ada37c0aff6c1515d85ed7"
        },
        {
          id: 3,
          text: "勝つための現代麻雀技術論",
          img: "img/book3.jpg",
          url: "https://www.amazon.co.jp/gp/product/4800303109/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4800303109&linkCode=as2&tag=toast6740c-22&linkId=d30fb30412b7bc9e5ee2e38b0b32a4ae"
        },
        {
          id: 4,
          text: "もっと勝つための現代麻雀技術論 実戦編",
          img: "img/book4.jpg",
          url: "https://www.amazon.co.jp/gp/product/4800304660/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4800304660&linkCode=as2&tag=toast6740c-22&linkId=fbea4b408a32445b4aa6b087e607d4b7"
        },
        {
          id: 5,
          text: "麻雀技術の教科書 効率的なアガリ方",
          img: "img/book5.jpg",
          url: "https://www.amazon.co.jp/gp/product/B06WGVS827/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=B06WGVS827&linkCode=as2&tag=toast6740c-22&linkId=8b9ddbd25437ea7522bd4b629d397033"
        },
        {
          id: 6,
          text: "ウザク式麻雀学習 牌効率",
          img: "img/book6.jpg",
          url: "https://www.amazon.co.jp/gp/product/4866731117/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4866731117&linkCode=as2&tag=toast6740c-22&linkId=175424b05a43c431ee945fd78f433c13"
        },
        {
          id: 7,
          text: "麻雀 傑作「何切る」300選",
          img: "img/book7.jpg",
          url: "https://www.amazon.co.jp/gp/product/4861998948/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4861998948&linkCode=as2&tag=toast6740c-22&linkId=18d60c31e549b8f10f28967c301f42fc"
        },
        {
          id: 8,
          text: "これだけで勝てる！麻雀の基本形80",
          img: "img/book8.jpg",
          url: "https://www.amazon.co.jp/gp/product/B00TNZX94C/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=B00TNZX94C&linkCode=as2&tag=toast6740c-22&linkId=99a5e09aaba9511bd0473bb0fc9c20c7"
        },
        {
          id: 9,
          text: "現代麻雀押し引きの教科書",
          img: "img/book9.jpg",
          url: "https://www.amazon.co.jp/gp/product/4800311209/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4800311209&linkCode=as2&tag=toast6740c-22&linkId=51e9cb09abe1cd08b29395cd4c97c011"
        },
        {
          id: 10,
          text: "実戦でよく出る！読むだけで勝てる麻雀講義",
          img: "img/book10.jpg",
          url: "https://www.amazon.co.jp/gp/product/4801915043/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4801915043&linkCode=as2&tag=toast6740c-22&linkId=96b2472f6063626aaa174dc332fcb437"
        },
        {
          id: 11,
          text: "麻雀 麒麟児の一打",
          img: "img/book11.jpg",
          url: "https://www.amazon.co.jp/gp/product/B00TJFHCU8/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=B00TJFHCU8&linkCode=as2&tag=toast6740c-22&linkId=4ea7c3fd06e021d438336d1ee0099290"
        },
        {
          id: 12,
          text: "麻雀勝ち組の鳴きテクニック",
          img: "img/book12.jpg",
          url: "https://www.amazon.co.jp/gp/product/B0794XH3ZH/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=B0794XH3ZH&linkCode=as2&tag=toast6740c-22&linkId=620f84b6f297b64bca2933ae358cdedd"
        },
        {
          id: 13,
          text: "超実戦立体何切る",
          img: "img/book13.jpg",
          url: "https://www.amazon.co.jp/gp/product/4839966974/ref=as_li_tl?ie=UTF8&camp=247&creative=1211&creativeASIN=4839966974&linkCode=as2&tag=toast6740c-22&linkId=5b37a9ad74ddcba18f10537d5f95395b"
        }
      ];
    }

    init();

    //戦術書を比較的読む方だ
    let book_read_flug = false;
    //問題形式の戦術書がよい
    let problem_format_flug = false;

    var app = new Vue({
      el: "#app",
      data: {
        question_text: questions[0],
        answer1: true,
        answer2: false,
        answer3: false,
        answer4: false,
        answer5: false,
        answer6: false,
        answer7: false,
        answer8: false
      },
      methods: {
        clickAnswer: function(answer){
          switch(answer){
            //数値→正常ルート
            //Yes or No + 数値→flug管理
            //Result + 数値→結果
            case 2:
              this.answer1 = false;
              this.answer2 = true;
              this.answer3 = false;
              this.answer4 = false;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[1];
              break;
            case 'Yes3':
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = true;
              this.answer4 = false;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[2];
              this.book_read_flug = true;
              break;
            case 'No3':
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = true;
              this.answer4 = false;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[2];
              this.book_read_flug = false;
              break;
            case 'Yes4':
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = false;
              this.answer4 = true;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[3];
              this.problem_format_flug = true;
              break;
            case 'No4':
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = false;
              this.answer4 = true;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[3];
              this.problem_format_flug = false;
              break;
            case 5:
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = false;
              this.answer4 = false;
              this.answer5 = true;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[4];
              break;
            case 6:
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = false;
              this.answer4 = false;
              this.answer5 = false;
              this.answer6 = true;
              this.answer7 = false;
              this.answer8 = false;
              this.question_text = questions[5];
              break;
            case 7:
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = false;
              this.answer4 = false;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = true;
              this.answer8 = false;
              this.question_text = questions[6];
              break;
            case 8:
              this.answer1 = false;
              this.answer2 = false;
              this.answer3 = false;
              this.answer4 = false;
              this.answer5 = false;
              this.answer6 = false;
              this.answer7 = false;
              this.answer8 = true;
              this.question_text = questions[7];
              break;
            case 'Result1':
              form = document.forms['q_form'];
              document.q_form.book0.value = books[0]["text"];
              document.q_form.book_img.value = books[0]["img"];
              document.q_form.book_url.value = books[0]["url"];
              form.submit();
              break;
            case 'Result2_3':
              if(this.book_read_flug){
                document.q_form.book0.value = books[2]["text"];
                document.q_form.book_img.value = books[2]["img"];
                document.q_form.book_url.value = books[2]["url"];
              } else {
                document.q_form.book0.value = books[1]["text"];
                document.q_form.book_img.value = books[1]["img"];
                document.q_form.book_url.value = books[1]["url"];
              }
              form = document.forms['q_form'];
              form.submit();
              break;
            case 'Result5_6_7_8':
              if(this.book_read_flug && this.problem_format_flug){
                document.q_form.book0.value = books[6]["text"];
                document.q_form.book_img.value = books[6]["img"];
                document.q_form.book_url.value = books[6]["url"];
              } else if(this.book_read_flug) {
                document.q_form.book0.value = books[5]["text"];
                document.q_form.book_img.value = books[5]["img"];
                document.q_form.book_url.value = books[5]["url"];
              } else if(this.problem_format_flug){
                document.q_form.book0.value = books[7]["text"];
                document.q_form.book_img.value = books[7]["img"];
                document.q_form.book_url.value = books[7]["url"];
              } else {
                document.q_form.book0.value = books[4]["text"];
                document.q_form.book_img.value = books[4]["img"];
                document.q_form.book_url.value = books[4]["url"];
              }
              form = document.forms['q_form'];
              form.submit();
              break;
            case 'Result9_10':
              if(this.problem_format_flug){
                document.q_form.book0.value = books[8]["text"];
                document.q_form.book_img.value = books[8]["img"];
                document.q_form.book_url.value = books[8]["url"];
              } else {
                document.q_form.book0.value = books[9]["text"];
                document.q_form.book_img.value = books[9]["img"];
                document.q_form.book_url.value = books[9]["url"];
              }
              form = document.forms['q_form'];
              form.submit();
              break;
            case 'Result11_12':
              if(this.book_read_flug){
                document.q_form.book0.value = books[11]["text"];
                document.q_form.book_img.value = books[11]["img"];
                document.q_form.book_url.value = books[11]["url"];
              } else {
                document.q_form.book0.value = books[10]["text"];
                document.q_form.book_img.value = books[10]["img"];
                document.q_form.book_url.value = books[10]["url"];
              }
              form = document.forms['q_form'];
              form.submit();
              break;
            case 'Result13':
              form = document.forms['q_form'];
              document.q_form.book0.value = books[12]["text"];
              document.q_form.book_img.value = books[12]["img"];
              document.q_form.book_url.value = books[12]["url"];
              form.submit();
              break;
          }
          return;
        }
      }
    });
  </script>
    </body>
</html>