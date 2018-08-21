window.onload = function () {
    var options = document.getElementById('options');
    var btn = document.getElementById('SubmitButton');
    var input = document.getElementById('parametr');
    var errorMsg = document.getElementById('errorMsg');
    var work = document.getElementById('work');
    var conn = document.getElementById('connecting');
    var disc = document.getElementById('disconnected');

    input.onkeyup = function () {
        if (input.value === "") {
            btn.disabled = true;
        }
        if(options.value !== "Название Клиента") {
            var regex = /^\d+$/;
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
        var request = "inp="+input.value+"&type="+type+"&conn="+conn.checked+"&work="+work.checked+"&disc="+disc.checked;
        ajax(request, 'actionfile.php', onResponse);
    }
    function onResponse(response) {

        var data = jQuery.parseJSON(response);
        document.getElementById('bdy').innerHTML = '';

        if (!data[0])
        {
            printList(0);
            $('#clientInfoText'+0).append('<td colspan="2">Информация про клиента</td>');
            $('#clientName'+0).append('<td >Название клиента</td>');
            $('#clientName'+0).append('<td >'+data.Customer_name+'</td>');
            $('#company'+0).append('<td >Компания</td>');
            $('#company'+0).append('<td >'+data.Company+'</td>');
            $('#DealInfo'+0).append('<td colspan="2" >Информация про договор</td>');
            $('#NumOfDeal'+0).append('<td >Номер договора</td>');
            $('#NumOfDeal'+0).append('<td >'+data.ContractN+'</td>');
            $('#DateOfDeal'+0).append('<td >Дата подписания</td>');
            $('#DateOfDeal'+0).append('<td >'+data.Date+'</td>');
            $('#ServiseInfo'+0).append('<td colspan="2" >Иформация про сервисы</td>');
            var n = 0;
            while (data.services[n]) {
                $('#ServiceName'+0).append(data.services[n]+'<br>');
                n++;
            }

        } else {
            var i = 0;
            while(data[i]){
                printList(i);
                $('#clientInfoText'+i).append('<td colspan="2">Информация про клиента</td>');
                $('#clientName'+i).append('<td >Название клиента</td>');
                $('#clientName'+i).append('<td >'+data[i].Customer_name+'</td>');
                $('#company'+i).append('<td >Компания</td>');
                $('#company'+i).append('<td >'+data[i].Company+'</td>');
                $('#DealInfo'+i).append('<td colspan="2" >Информация про договор</td>');
                $('#NumOfDeal'+i).append('<td >Номер договора</td>');
                $('#NumOfDeal'+i).append('<td >'+data[i].ContractN+'</td>');
                $('#DateOfDeal'+i).append('<td >Дата подписания</td>');
                $('#DateOfDeal'+i).append('<td >'+data[i].Date+'</td>');
                $('#ServiseInfo'+i).append('<td colspan="2" >Иформация про сервисы</td>');
                var n = 0;
                while (data[i].services[n]) {
                    $('#ServiceName'+i).append(data[i].services[n]+'<br>');
                    n++;
                }
                $('#ServiceName'+i).append('____________________________');
                i++;
            }
        }
    }
};

function printList(i) {
    var element = $('#bdy');
    element.append('<table id="table"></table>');
    $('#table').append('<tr id="clientInfoText'+i+'"></tr>');
    $('#table').append('<tr id="clientName'+i+'" ></tr>');
    $('#table').append('<tr id="company'+i+'"></tr>');
    $('#table').append('<tr id="DealInfo'+i+'"></tr>');
    $('#table').append('<tr id="NumOfDeal'+i+'"></tr>');
    $('#table').append('<tr id="DateOfDeal'+i+'"></tr>');
    $('#table').append('<tr id="ServiseInfo'+i+'"></tr>');
    $('#table').append('<tr id="ServiceName'+i+'"></tr>');

}

function ajax(request, method, action) {
    var httpReq = new XMLHttpRequest();
    httpReq.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200) {
            action(httpReq.responseText);
        }
    };
    httpReq.open("POST", method, true);
    httpReq.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    httpReq.send(request);
}

