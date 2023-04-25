

function ajaxRequest(Method, url, data, callBack) {
    if (typeof data == "function") {
        callBack = data;
    }

    $.ajax({
        type: Method,
        headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
            Accept: "application/json",
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        url: url,
        data: data,
        dataType: "json",
        cache: false,
        success: function (result) {
            if (typeof callBack === "function") {
                callBack(result);
            }
        },
        error: function (jqXHR, exception) {
            var msg = "";
            if (jqXHR.status === 0) {
                msg = "Not connect.\n Verify Network.";
            } else if (jqXHR.status === 401) {
                msg = "You Dont Have Privilege To Perform This Action!";
            } else if (jqXHR.status === 422) {
                msg = "Validation Error !";
            } else if (jqXHR.status === 404) {
                msg = "Requested page not found. [404]";
            } else if (jqXHR.status === 500) {
                msg = "Internal Server Error [500].";
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error.";
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Uncaught Error.\n" + jqXHR.responseText;
            }

            if (typeof callBack === "function") {
                callBack(msg);
            }
        },
    });
}
