window.onload = function () {
    var options = document.getElementById('options');
    var btn = document.getElementById('SubmitButton');
    var input = document.getElementById('parametr');
    var errorMsg = document.getElementById('errorMsg');
    input.onkeyup = function () {
        if (input.value === "") {
            btn.disabled = true;
        }
        if(options.value !== "Название Клиента") {
            var regex = /^\d+$/;
            // alert(input.value);
            if (!regex.test(input.value) && input.value!== "") {
                errorMsg.innerHTML = "Допустимы только цифры от 0 до 9";
                btn.disabled = true;
            }else {
                errorMsg.innerHTML = "";
                if (input.value !== "") {
                    btn.disabled = false;
                }
            }
        }else {
            if (input.value !== "") {
                btn.disabled = false;
            }
        }
    };
    btn.onclick = function () {
        sendData();
    };
    function sendData() {
        var type = "";
        switch (options.value){
            case "Название Клиента":
                type = "ClientName";
                break;
            case "Айди клиента":
                type = "ClientID";
                break;
            default:
                type = "ContractID";
        }
        var request = "inp="+input.value+"&type="+type;
        ajax(request, 'actionfile.php', onResponse);
    }
    function onResponse(response) {

        var data = jQuery.parseJSON(response);
        var importTag = document.createElement('link');
        importTag.setAttribute('rel', 'import');
        importTag.setAttribute('href', 'test.html');
        document.body.appendChild(importTag);
        // document.getElementById('bdy').innerHTML = '';
        // document.getElementById('bdy').innerHTML = '<link rel="import" href="test.html" >';

    }
};


function ajax(request, method, action) {
    var httpReq = new XMLHttpRequest();
    httpReq.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            console.log(httpReq.responseText);
            action(httpReq.responseText);
        }
    };
    httpReq.open("POST", method, true);
    httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpReq.send(request);
}

