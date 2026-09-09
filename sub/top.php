<section id="sub">

    <div id="subTop" class="visual 
        <?php
        if ($bo_table == "proLeague" || $bo_table == "proMatch" || $bo_table == "proNotice" || $bo_table == "schedule") {
            echo "menu2";
        }
        //생활축구카테고리 
        if ($bo_table == "lifeLeague") {
            echo "menu3_1";
        } //K5·6·7 리그
        if ($bo_table == "lifeMatch") {
            echo "menu3_2";
        }  // 대회
        if ($bo_table == "lifeNotice") {
            echo "menu3_3";
        }  // 공지사항
        if ($bo_table == "lifeSchedule") {
            echo "menu3_4";
        }  // 일정및결과
        if ($co_id == "ground") {
            echo "menu5";
        }
        if ($bo_table == "leader" || $bo_table == "referee" || $bo_table == "goldenAge") {
            echo "menu6";
        }
        if ($bo_table == "rule" || $bo_table == "dataRoom" || $bo_table == "gallery") {
            echo "menu7";
        }
        ?>  ">
        <h2>
            <?
            if ($bo_table) {  //게시판에 들어 갔을 경우
                if ($board[bo_subject] != '') { // 게시판 이름 출력
                    echo "<a href='$g5[path]/$board[bo_table]'>$board[bo_subject]</a>";
                }
                if ($sca) {
                    echo "$sca";
                } // 카테고리 이름 출력
            } else {
                echo "$g5[title]";
            } //일반페이지에 접속했을 경우
            //echo " > ";
            //echo cut_str($write[wr_subject], 25);  // 게시물 제목 출력, 현재는 미표시, #제거하면 표시
            ?>
        </h2>
        <p>기장에서 시작되는 축구의 열정</p>
    </div>



    <div class="navigation">
        <?php echo $_menu->viewNav(); ?>
    </div>
    <script>
        $(".navigation .hist_depth2").click(function() {
            if ($(".navigation .hist_depth2").hasClass("active")) {
                $(".navigation .hist_depth2").removeClass("active");
            } else {
                $(".navigation .hist_depth2").addClass("active");
            }
        });
    </script>

    <? if ($co_id == "welcome" || $co_id == "organization" || $co_id == "member" || $co_id == "history" || $co_id == "football" || $co_id == "location") { ?>

    <? } ?>

    <div class="content">