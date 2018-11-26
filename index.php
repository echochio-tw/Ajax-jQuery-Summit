<!DOCTYPE html>
<html>
    <head>
        <title>jQuery Ajax 刷新</title>
    </head>
    <body>
        <h1>刷新頁面</h1>
        <hr><br>
        <form id="demo">
            刷新 ： <input type="text" id="domain">
            <p>
            密码 ： <input type="password" id="passid">
            <p>
            <button type="button" id="submitID">執行</button>
        </form>
        <br><hr>
        <p id="result"></p> <!-- 顯示回傳資料 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- 引入 jQuery -->
        <script type="text/javascript">
        $(document).ready(function() {
            $("#submitID").click(function() { //ID 為 submitID 的按鈕被點擊時
                $.ajax({
                    type: "POST", //傳送方式
                    url: "service.php", //傳送目的地
                    dataType: "json", //資料格式
                    data: { //傳送資料
                        domain: $("#domain").val(), //表單欄位 ID domain
                        passid: $("#passid").val() //表單欄位 ID passid
                    },
                    success: function(data) {
                        if (data.domain) { //如果後端回傳 json 資料有 domain
                            $("#demo")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#007500">您的domain「<font color="#0000ff">' + data.domain + '</font>」，pass 「<font color="#0000ff">' + data.passid + '</font>」！</font>');
                        } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                            $("#demo")[0].reset(); //重設 ID 為 demo 的 form (表單)
                            $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                        }
                    },
                    error: function(jqXHR) {
                        $("#demo")[0].reset(); //重設 ID 為 demo 的 form (表單)
                        $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                    }
                })
            })
        });
        </script>
    </body>
</html>
