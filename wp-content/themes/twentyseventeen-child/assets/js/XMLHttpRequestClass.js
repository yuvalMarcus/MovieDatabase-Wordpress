
function XMLHttpRequestClass(url, callbackBeforeResponse, callbackAfterResponse, getParams, method) {

    if (!method)
        method = 'POST';

    var http = new XMLHttpRequest();
    var url = url;
    var callback = callback;
    var gettingDataFromAjax = false;
    var dataFromAjaxEmpty = false;

    return {

        send: function (obj) {

            if (!gettingDataFromAjax) {

                callbackBeforeResponse(obj);

                http.open(method, url, true);

                //http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                //http.setRequestHeader('Content-type', 'application/json; charset=utf-8');

                gettingDataFromAjax = true;

                http.onreadystatechange = function () {

                    if (http.readyState == 4 && http.status == 200) {

                        callbackAfterResponse(http.responseText, obj);

                        gettingDataFromAjax = false;

                        if (JSON.parse(http.responseText).length <= 0)
                            dataFromAjaxEmpty = true;
                    }
                }

                var params = getParams();

                http.send(params);

            }
        }

    }
}