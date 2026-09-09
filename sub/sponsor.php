<div class="inner">

  <div class="inner client-slider">
    <?php
    $organizations = [
      ["name" => "기장군", "url" => "https://www.gijang.go.kr", "img" => "sponsor-1.svg"],
      ["name" => "기장군의회", "url" => "https://council.gijang.go.kr/", "img" => "sponsor-2.svg"],
      ["name" => "기장군도시관리공단", "url" => "https://www.gijangcmc.or.kr", "img" => "sponsor-3.svg"],
      ["name" => "기장군체육회", "url" => "https://www.gijangspo.or.kr/", "img" => "sponsor-4.svg"],
      ["name" => "한국수자력원자력(주)", "url" => "https://www.khnp.co.kr/", "img" => "sponsor-5.svg"],
      ["name" => "대한축구협회", "url" => "https://www.kfa.or.kr", "img" => "sponsor-6.svg"],
      ["name" => "싸커애플라인드", "url" => "https://www.soccerapplerind.com", "img" => "sponsor-7.svg"],
      ["name" => "HR그룹", "url" => "https://www.hrgroup.kr/", "img" => "sponsor-8.svg"],
      ["name" => "태흥당한방병원", "url" => "http://thdang.co.kr", "img" => "sponsor-9.svg"],
      ["name" => "정관일신기독병원", "url" => "http://www.jgilsin.or.kr/default.htm", "img" => "sponsor-10.svg"],
      ["name" => "장수한우", "url" => "https://jangsu7.modoo.at/", "img" => "sponsor-11.svg"],
      ["name" => "하이리페움", "url" => "http://www.highlifeum.kr/", "img" => "sponsor-12.svg"],
      ["name" => "(주)태황건설", "url" => "", "img" => "sponsor-13.svg"],
      ["name" => "동부산온천호텔", "url" => "http://www.dongbusanspahotel.com/", "img" => "sponsor-14.svg"],
      ["name" => "기장산업협동조합", "url" => "", "img" => "sponsor-15.svg"],
      ["name" => "기장군소상공인연합회", "url" => "", "img" => "sponsor-16.svg"]
    ];

    $url = $org['url'] ? $org['url'] : '#'; // URL이 없으면 '#'으로 설정
    foreach ($organizations as $org) {
      echo '<a class="item" href="' . $url . '" target="_blank">';
      echo '<img src="' . G5_THEME_IMG_URL . '/sponsor/' . $org['img'] . '" alt="' . $org['name'] . '">';
      echo '<p class="tl">' . $org['name'] . '</p>';
      echo '</a>';
    }
    ?>
    
  </div>


  <script>
    $('#sub .content').addClass('sponsor');
  </script>