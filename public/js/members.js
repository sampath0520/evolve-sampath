$(document).ready(function () {
    get_members();
});

//save data
$(document).on("click", "#save_seller", function () {
    var data = {
        seller_name: $("#seller_name").val(),
        seller_email: $("#seller_email").val(),
        status: $("input[name=status]:checked").val(),
    };

    Swal.fire({
        title: "Are you sure?",
        text: "Do you want to save this seller?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.isConfirmed) {
            ajaxRequest("POST", "/api/save-members", data, function (resp) {
                if (resp.code == 200) {
                    Swal.fire("Saved!", "Seller has been saved.", "success");
                    //clear form
                    $("#seller_name").val("");
                    $("#seller_email").val("");
                    $("#status").val("");

                    //close modal
                    $("#modal-lg").modal("hide");
                } else {
                    Swal.fire("Failed!", "Please fill all the fields", "error");
                }
            });
        }
    });
});

function get_members() {
    ajaxRequest("GET", "/api/get-members/", null, function (response) {
        if (response) {
            console.log(response.data);
            var t = $("#sellers_table").DataTable({
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
                        data: "email",
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
        '" class="btn btn-primary btn-sm btn-edit" data-toggle="tooltip" title="edit"><i class="fa fa-edit"></i> </button>&nbsp;&nbsp;';

    //add redirect to products route
    html +=
        '<a href="/products/' +
        full["id"] +
        '" class="btn btn-success btn-sm" data-toggle="tooltip" title="Products"><i class="fa fa-eye"></i> </a>&nbsp;&nbsp;';

    html +=
        '<button type="button" value="' +
        full["id"] +
        '" class="btn btn-danger btn-sm btn-del"   data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>';
    html += "</div>";
    return html;
}

$(document).on("click", ".btn-edit", function () {
    value = $(this).val();

    edit_members(value);
});

$(document).on("click", ".btn-del", function () {
    value = $(this).val();

    Swal.fire({
        title: "Do you want to delete this member?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Delete",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            delete_members(value);
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
});

function delete_members(value) {
    ajaxRequest(
        "DELETE",
        "/api/delete-members/" + value,
        null,
        function (resp) {
            console.log(resp);
            if (resp.status == "success") {
                get_members(null);
            } else {
            }
        }
    );
}

//edit_members
function edit_members(value) {
    ajaxRequest("GET", "/api/edit-members/" + value, null, function (resp) {
        if (resp.code == "200") {
            //dislay #modal-lg modal
            $("#modal-lg").modal("show");
            $("#seller_name").val(resp.data.name);
            $("#seller_email").val(resp.data.email);
            $("#save_seller").addClass("d-none");
            $("#update_seller").removeClass("d-none");
            $("input[name=status][value=" + resp.data.active + "]").prop(
                "checked",
                true
            );
            $("#update_seller").val(resp.data.id);
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
        text: "Do you want to update this seller?",
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
                        "Updated!",
                        "Seller has been updated.",
                        "success"
                    );

                    //clear form
                    $("#seller_name").val("");
                    $("#seller_email").val("");
                    $("#status").val("");

                    //close modal
                    $("#modal-lg").modal("hide");
                } else {
                    Swal.fire(
                        "Failed!",
                        "Seller has not been updated.",
                        "success"
                    );
                }
            });
        }
    });
}
