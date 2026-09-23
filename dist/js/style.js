function nhanquanhuy() {
    swal({
        title: "Nhận quân huy",
        text: "Mỗi ngày chỉ nhận được 1 lần. Cơ hội nhận tới 1000 quân huy !",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Nhận ngay",
        cancelButtonText: "Để sau",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $.post('/load/client/nhan-quan-huy', function (data) {
            if (data.status == 'success') {
                swal({
                    title: 'Thành công',
                    type: 'success',
                    text: data.msg
                }, function () {
                    $('.fade-in').hide();
                });

            } else {
                swal({
                    html: true,
                    title: 'Thất bại',
                    type: 'error',
                    text: data.msg
                }, function () {
                    if (data.redirect) window.location = data.redirect;
                });
            }
        }, 'json');
    });
}
function showPopupAcc(acc) {
    swal({
        title: "Tài Khoản Số #" + acc,
        text: "Bạn có chắc chắn muốn giao dịch tài khoản này ?",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $.post('/ajaxs/buy.php', { acc: acc }, function (data) {
            if (data.status == 99) {
                swal({
                    title: 'Giao dịch hoàn tất',
                    type: 'success',
                    text: 'Mua thành công tài khoản #' + acc
                }, function () {
                    if (data.redirect) window.location = data.redirect;
                    else window.location.reload();
                });
            } else {
                swal({
                    html: true,
                    title: 'Có lỗi',
                    type: 'error',
                    text: data.messages
                })
            }
        }, 'json');
    });
}

function showPopupAccRandom(acc) {
    swal({
        title: "Thử vận may ID #" + acc,
        text: "Bạn có chắc chắn muốn giao dịch tài khoản này ?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Có",
        cancelButtonText: "Không",
        closeOnConfirm: false,
        showLoaderOnConfirm: true
    }, function () {
        $.post('/load/random/buy', { acc: acc }, function (data) {
            if (data.status === 0) {
                swal({
                    title: 'Giao dịch hoàn tất',
                    type: 'success',
                    text: data.msg
                }, function () {
                    if (data.redirect) window.location = data.redirect;
                    else load_account_list();
                });

            } else {
                swal({
                    html: true,
                    title: 'Có lỗi',
                    type: 'error',
                    text: data.msg
                }, function () {
                    if (data.redirect) window.location = data.redirect;
                });
            }
        }, 'json');
    });
}


$('.sl-icmenu').click(function () {
    $('.sl-menu').toggleClass('slshowmn');
});


$('.slchgame').swiper({
    slidesPerView: 5,
    paginationClickable: true,
    preventClicks: false,
    spaceBetween: 20,
    scrollbarHide: false,
    scrollbarDraggable: true,
    scrollbar: '.slchgame .swiper-scrollbar',
    breakpointsInverse: true,
    breakpoints: {
        992: {
            slidesPerView: 3
        }
    }
});