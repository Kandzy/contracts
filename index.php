<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="utf-8">
    <title>тестовое задание</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="action.js"></script>
</head>
<body id="bdy">
    <form method="get" action="actionfile.php">
        <div style="display: flex; flex-direction: row;">
            <input id="parametr" type="text">
            <div>
                <select id="options">
                    <option>Айди контракта</option>
                    <option>Айди клиента</option>
                    <option>Название Клиента</option>
                </select>
            </div>
        </div>
        <div>
            <p id="errorMsg"></p>
        </div>
        <div>
            <label for="connected">Connected</label>
            <input id="connected" type="checkbox">
        </div>
        <button id="SubmitButton" type="button" disabled>Отправить</button>
    </form>

<!--    <table>-->
<!--        <tr>-->
<!--            <td colspan="2"><b>Инфо по клиенту</b></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>Название клиента</td>-->
<!--            <td>[name_customer]</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>компания</td>-->
<!--            <td>[company]</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td colspan="2"><b>Информация про договор</b></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>номер договора</td>-->
<!--            <td>[number]</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>дата подписания</td>-->
<!--            <td>[date_sign]</td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td colspan="2"><b>информация про сервисы</b></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--            <td>[services_name]</td>-->
<!--        </tr>-->
<!--    </table>-->
</body>
</html>

