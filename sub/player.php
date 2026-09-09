    <div class="container player">
      <div class="tab">
        <ul>
          <li data-id="con1" class="on">GK</li>
          <li data-id="con2">DF</li>
          <li data-id="con3">MF</li>
          <li data-id="con4">FW</li>
        </ul>

        <!-- GK--->
        <div id="con1" class="conBox on">
          <?php
          $players = [
            ["index" => 13, "name" => "김민근", "birth" => "2002.01.12"],
            ["index" => 25, "name" => "김은도", "birth" => "1994.04.11"]
          ];

          // 선수 정보를 HTML 구조로 출력
          foreach ($players as $player) {
            echo '<div class="item player">';
            echo '<img src="' . G5_THEME_IMG_URL . '/player/GK/' . $player['index'] . '.jpg">';
            echo '<div class="label">';
            echo '<p class="index">' . $player['index'] . '</p>';
            echo '<div class="info">';
            echo '<p class="name">' . $player['name'] . '</p>';
            echo '<p class="birth">' . $player['birth'] . '</p>';
            echo '</div></div></div>';
          }
          ?>
        </div>


        <!-- DF--->
        <div id="con2" class="conBox">
          <?php
          $players = [
            ["index" => 2, "name" => "박진배", "birth" => "2001.04.05"],
            ["index" => 3, "name" => "손승현", "birth" => "2003.08.02"],
            ["index" => 4, "name" => "방우진", "birth" => "2002.02.27"],
            ["index" => 5, "name" => "이주성", "birth" => "2002.06.23"],
            ["index" => 6, "name" => "안상진", "birth" => "1999.03.18"],
            ["index" => 14, "name" => "전효석", "birth" => "1997.05.28"],
            ["index" => 18, "name" => "박세웅", "birth" => "2002.07.09"],
            ["index" => 19, "name" => "최현빈", "birth" => "2000.10.28"],
            ["index" => 20, "name" => "공호원", "birth" => "1997.09.04"],
            ["index" => 22, "name" => "이상진", "birth" => "2002.02.19"],
            ["index" => 33, "name" => "박현응", "birth" => "2003.07.02"],
            ["index" => 41, "name" => "이호준", "birth" => "2005.03.25"],
            ["index" => 66, "name" => "김창수", "birth" => "1999.03.18"]
          ];

          // 선수 정보를 HTML 구조로 출력
          foreach ($players as $player) {
            echo '<div class="item player">';
            echo '<img src="' . G5_THEME_IMG_URL . '/player/DF/' . $player['index'] . '.jpg">';
            echo '<div class="label">';
            echo '<p class="index">' . $player['index'] . '</p>';
            echo '<div class="info">';
            echo '<p class="name">' . $player['name'] . '</p>';
            echo '<p class="birth">' . $player['birth'] . '</p>';
            echo '</div></div></div>';
          }
          ?>
        </div>

        <!-- MF--->
        <div id="con3" class="conBox">
          <?php
          $players = [
            ["index" => 8, "name" => "신윤호", "birth" => "2000.07.15"],
            ["index" => 10, "name" => "김기찬", "birth" => "1999.10.04"],
            ["index" => 23, "name" => "윤주훈", "birth" => "1999.06.19"],
            ["index" => 26, "name" => "김민혁", "birth" => "2002.09.06"],
            ["index" => 27, "name" => "김준수", "birth" => "2001.07.20"],
            ["index" => 44, "name" => "노승기", "birth" => "2005.03.25"],
            ["index" => 70, "name" => "김대원", "birth" => "2005.05.20"],
            ["index" => 71, "name" => "김민결", "birth" => "2004.06.21"],
            ["index" => 77, "name" => "박세준", "birth" => "2002.07.08"]
          ];

          // 선수 정보를 HTML 구조로 출력
          foreach ($players as $player) {
            echo '<div class="item player">';
            echo '<img src="' . G5_THEME_IMG_URL . '/player/MF/' . $player['index'] . '.jpg">';
            echo '<div class="label">';
            echo '<p class="index">' . $player['index'] . '</p>';
            echo '<div class="info">';
            echo '<p class="name">' . $player['name'] . '</p>';
            echo '<p class="birth">' . $player['birth'] . '</p>';
            echo '</div></div></div>';
          }
          ?>
        </div>

        <!-- FW--->
        <div id="con4" class="conBox">
          <?php
          $players = [
            ["index" => 7, "name" => "임예닮", "birth" => "1997.03.09"],
            ["index" => 9, "name" => "강영웅", "birth" => "1999.03.04"],
            ["index" => 11, "name" => "김경구", "birth" => "1999.01.06"],
            ["index" => 17, "name" => "이장현", "birth" => "2003.01.10"],
            ["index" => 29, "name" => "이정훈", "birth" => "2003.04.29"],
            ["index" => 88, "name" => "곽성용", "birth" => "1996.09.21"]
          ];

          // 선수 정보를 HTML 구조로 출력
          foreach ($players as $player) {
            echo '<div class="item player">';
            echo '<img src="' . G5_THEME_IMG_URL . '/player/FW/' . $player['index'] . '.jpg">';
            echo '<div class="label">';
            echo '<p class="index">' . $player['index'] . '</p>';
            echo '<div class="info">';
            echo '<p class="name">' . $player['name'] . '</p>';
            echo '<p class="birth">' . $player['birth'] . '</p>';
            echo '</div></div></div>';
          }
          ?>
        </div>

      </div>
    </div>

    <script>
      $('#sub .content').addClass('member');
      $(function() {
        $(".tab ul li").click(function() {
          $(".tab ul li").removeClass('on');
          $(".tab .conBox").removeClass('on');
          $(this).addClass('on');
          $("#" + $(this).data('id')).addClass('on');
        });
      });
    </script>