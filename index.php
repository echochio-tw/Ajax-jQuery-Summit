<!DOCTYPE html>
<html>
    <head>
        <title>jQuery Ajax 實現不刷新頁面提交資料 datainput (後端使用 PHP 處理回傳 json)</title>
    </head>
    <body>
        <h1>jQuery Ajax 實現不刷新頁面提交資料 datainput (後端使用 PHP 處理回傳 json)</h1>
        <hr><br>
        <div id="loading"></div>
        <form id="datainput">
            网域：<input type="text" id="domain">
            <p>
            密码：<input type="text" id="passid">
            <p>
            <button type="button" id="submitID">執行範例</button>
        </form>
        <br><hr>
        <p id="result"></p> <!-- 顯示回傳資料 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- 引入 jQuery -->
        <script type="text/javascript">
        $(document).ready(function() {
            $("#submitID").click(function() { //ID 為 submitID 的按鈕被點擊時
                $.ajax({
                    type: "POST", //傳送方式
                    url: "server.php", //傳送目的地
                    dataType: "json", //資料格式
                    data: { //傳送資料
                        domain: $("#domain").val(), //表單欄位 ID domain
                        passid: $("#passid").val() //表單欄位 ID passid
                    },
                     beforeSend: function () {
                        $('#loading').append('<div id="loading-image"><img src="loading.gif" alt="Loading..." /></div>');
                        $("#submitID").val("正在處理......");
                        $("#submitID").css("background-color","aqua");
                        $("#submitID").attr({ disabled: "disabled" });
                    },
                    success: function(data) {
                        if (data.domain) { //如果後端回傳 json 資料有 domain
                            $("#datainput")[0].reset(); //重設 ID 為 datainput 的 form (表單)
                            $("#result").html('<font color="#007500">您的 domain : <font color="#0000ff">' + data.domain + '</font><p>密码為 : <font color="#0000ff">' + data.passid + '</font></font>');
                        } else { //否則讀取後端回傳 json 資料 errorMsg 顯示錯誤訊息
                            $("#datainput")[0].reset(); //重設 ID 為 datainput 的 form (表單)
                            $("#result").html('<font color="#ff0000">' + data.errorMsg + '</font>');
                        }
                    },
                    complete: function () {
                        $('#loading-image').remove();
                        $("#submitID").val("執行範例");
                        $("#submitID").css("background-color","white");
                        $("#submitID").removeAttr('disabled');
                    },
                    error: function(jqXHR) {
                        $("#datainput")[0].reset(); //重設 ID 為 datainput 的 form (表單)
                        $("#result").html('<font color="#ff0000">發生錯誤：' + jqXHR.status + '</font>');
                    }
                })
            })
        });
        </script>
    </body>
</html>
