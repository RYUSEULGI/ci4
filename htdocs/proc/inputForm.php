<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="saveInfo.php" method="POST">

        <div class="name ip">
            <label for="eventName">이름</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="phone ip">
            <label for="eventPhone">휴대폰</label>
            <input type="text" id="phone" name="phone" maxlength="11">
        </div>

        <div class="address ip">
            <label for="eventAddress">주소</label>
            <input type="text" id="addr1" name="addr1" readonly>

            <input class="btnAddress" type="button" value="우편번호 찾기"><br>
            <!-- <div class="btnAddress">
                <a href=""><img src="images/btnAddress.png" alt="우편번호 검색"></a>
            </div> -->
        </div>
        <div class="address2 ip">
            <label for="detailAddress">상세주소</label>
            <input type="text" id="addr2" name="addr2" readonly>
            <input type="text" id="addr3" name="addr3">
        </div>

        <input type="hidden" name="device" value="web">
        <div id="zip-wrap" style="z-index:111;display:none;width:417px;height:466px;top:172px;left:-20px;margin:5px 0;position:absolute;">
            <img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnFoldWrap" style="cursor:pointer;position:absolute;right:0px;top:-20px;z-index:1" alt="접기 버튼">
        </div>

        <div class="agree">
            <div class="blind">
                <p>개인정보 제3자 제공 및 동의 안내</p>
            </div>
            <div class="ip">
                <input type="radio" id="agreeY2" name="agree">
                <label for="agreeY2">동의</label>
            </div>
            <div class="ip">
                <input type="radio" id="agreeN2" name="agree">
                <label for="agreeN2">비동의</label>
            </div>
        </div>

        <button class="btnEventGo">
            <a href=""><img src="images/btnEvent.png" alt="이벤트 응모하기"></a>
        </button>
    </form>


    <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script src="/js/address.js"></script>
</body>

</html>