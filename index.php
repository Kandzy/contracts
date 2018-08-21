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
        <div style="display: flex; flex-direction: row">
            <div>
                <label for="work">Work</label>
                <input id="work" type="checkbox">
            </div>
            <div>
                <label for="connecting">Connecting</label>
                <input id="connecting" type="checkbox">
            </div>
            <div>
                <label for="disconnected">Disconnected</label>
                <input id="disconnected" type="checkbox">
            </div>
        </div>
        <button id="SubmitButton" type="button" disabled>Отправить</button>
    </form>
</body>
</html>

