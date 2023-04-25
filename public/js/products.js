$(document).ready(function () {
    //get url id
    var url = window.location.href;
    var id = url.substring(url.lastIndexOf("/") + 1);

    get_products(id);
});

//save data
$(document).on("click", "#save_products", function () {
    var data = {
        product_name: $("#product_name").val(),
        price: $("#price").val(),
        availabe_items: $("#availabe_items").val(),
        description: $("#description").val(),
        member_id: $("#member_id").val(),
    };

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to save this product?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxRequest("POST", "/api/save-products", data, function (resp) {
                if (resp.code == 200) {
                    Swal.fire("Saved!", "Product has been saved.", "success");
                    get_products($("#member_id").val());
                    //clear form
                    $("#product_name").val("");
                    $("#price").val("");
                    $("#availabe_items").val("");
                    $("#description").val("");

                    //click modal close button
                    $("#close_modal").click();
                } else {
                    Swal.fire("Failed!", "Please fill all the fields", "error");
                }
            });
        }
    });
});

function get_products(id) {
    ajaxRequest("GET", "/api/get-products/" + id, null, function (response) {
        if (response) {
            console.log(response.data);
            var t = $("#products_table").DataTable({
                destroy: true,
                data: response.data,

                columns: [
                    {
                        data: "id",
                    },
                    {
                        data: "name",
                    },
                    {
                        data: "stock",
                    },
                    {
                        data: "id",
                    },
                ],
                columnDefs: [
                    {
                        targets: -1,
                        render: function (data, type, full, meta) {
                            return loadActionButtons(full);
                        },
                    },
                ],
                order: [[0, "desc"]],
            });

            $(function () {
                t.on("order.dt search.dt", function () {
                    let i = 1;

                    t.cells(null, 0, {
                        search: "applied",
                        order: "applied",
                    }).every(function (cell) {
                        this.data(i++);
                    });
                }).draw();
            });
        }
    });
}

function loadActionButtons(full) {
    var html = "";
    html += '<div class="btn-group" role="group" >';

    html +=
        '<button type="button" value="' +
        full["id"] +
        '" class="btn btn-primary btn-sm btn-display" data-toggle="tooltip" title="edit">Product Details<i class="fa fa-view"></i> </button>&nbsp;&nbsp;';
    return html;
}

$(document).on("click", ".btn-display", function () {
    value = $(this).val();
    display_details(value);
});

function display_details(value) {
    ajaxRequest("GET", "/api/product_details/" + value, null, function (resp) {
        if (resp.code == "200") {
            //dislay #modal-lg modal
            $("#product_modal").modal("show");
            $("#product_name_display").val(resp.data.name);
            $("#price_display").val(resp.data.price);
            $("#availabe_items_display").val(resp.data.stock);
            $("#description_display").val(resp.data.description);
        } else {
            Swal.fire("Something went wrong", "error");
        }
    });
}

$(document).on("click", "#update_seller", function () {
    value = $(this).val();
    update_members(value);
});

function update_members(value) {
    var data = {
        id: value,
        seller_name: $("#seller_name").val(),
        seller_email: $("#seller_email").val(),
        status: $("input[name=status]:checked").val(),
    };

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxRequest("PUT", "/api/update-members", data, function (resp) {
                if (resp.code == 200) {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                } else {
                    Swal.fire(
                        "Deleted!",
                        "Your file has been deleted.",
                        "success"
                    );
                }
            });
        }
    });
}
