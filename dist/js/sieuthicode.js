const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
function copy() {
    Toast.fire({
        icon: 'success',
        title: 'Đã sao chép vào bộ nhớ tạm'
    })
}
function changekey() {
    Swal.fire({
        title: 'Xác nhận thay đổi?',
        text: "Bạn chắc chắn muốn đổi API KEY mới chứ!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/ajaxs/changekey.php",
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    if (data.status == 'success') {
                        Toast.fire({
                            icon: 'success',
                            title: data.msg
                        });
                        setTimeout(function () {
                            window.location = data.redirect;
                        }, 1000);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.msg
                        })
                    }
                }
            });
        }

    })
}
$(document).ready(function () {
    $('#register_sieuthicode').on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/ajaxs/auth/register.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function () {
                        window.location = data.redirect;
                    }, 3000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });
    });
});

$(document).ready(function () {
    $('#login_sieuthicode').on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/ajaxs/auth/login.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function () {
                        window.location = data.redirect;
                    }, 1000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });
    });
});
$(document).ready(function () {
    $('#forgot_sieuthicode').on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/ajaxs/auth/forgot.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function () {
                        window.location = data.redirect;
                    }, 3000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });
    });
});
$(document).ready(function () {
    $('#reset_sieuthicode').on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/ajaxs/auth/reset.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function () {
                        window.location = data.redirect;
                    }, 3000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });
    });
});
$(document).ready(function () {
    $('#card_sieuthicode').on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/ajaxs/card.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function () {
                        window.location = data.redirect;
                    }, 3000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });
    });
});

$(document).ready(function () {
    $('#update_info').on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/ajaxs/updateinfo.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                    Toast.fire({
                        icon: 'success',
                        title: data.msg
                    });
                    setTimeout(function () {
                        window.location = data.redirect;
                    }, 3000);
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: data.msg
                    })
                }
            }
        });
    });
});
function modalPayment(id, name) {
    $("#id").val(id);
    $("#name").val(name);
    $("#payment").modal('show');
}
function buyHack() {
    var id = $("#id").val();
    $.ajax({
        type: "POST",
        url: "/ajaxs/buyHack.php",
        data: {
            id: id,
            type: $('.package' + id).val(),
            qty:$("#qty").val()
        },
        dataType: "json",
        success: function (res) {
            if (res.status == "success") {
                Toast.fire({
                    icon: 'success',
                    title: res.msg
                });
                setTimeout(function () {
                    window.location = res.redirect;
                }, 3000);
            } else {
                Toast.fire({
                    icon: 'error',
                    title: res.msg
                })
            }
        }
    });
}
function totalPayment() {
    $('#total').html('<i class="fa fa-spinner fa-spin"></i> Đang xử lý...');
    var id = $("#id").val();
    $.ajax({
        url: "/ajaxs/totalPayment.php",
        method: "POST",
        data: {
            type: $('.package' + id).val(),
            qty: $("#qty").val()
        },
        success: function(data) {
            $("#total").html(data);
        },
        error: function() {
            Toast.fire({
                icon: 'Không thể tính kết quả thanh toán',
                title: res.msg
            })
        }
    });
    //$("#total").html(total.toString().replace(/(.)(?=(\d{3})+$)/g, '$1,'));
}