const btnAddress = document.querySelector('.btnAddress'),
    btnEventGo = document.querySelector('.btnEventGo');

btnAddress.addEventListener('click', getAddress);
btnEventGo.addEventListener('click', function () {
    alert('이벤트 응모가 완료되었습니다.');
});

function getAddress() {
    new daum.Postcode({
        oncomplete: function (data) {
            let addr = '';

            if (data.userSelectedType === 'R') {
                addr = data.roadAddress;
            } else {
                addr = data.jibunAddress;
            }

            document.getElementById('addr1').value = data.zonecode;
            document.getElementById('addr2').value = addr;
            document.getElementById('addr3').focus();
        },
    }).open();
}
