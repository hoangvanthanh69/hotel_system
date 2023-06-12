function changeSlide(index) {
    $('.carousel-indicators > button').eq(index).trigger('click');
    $('.thumbnail').removeClass('active-thumbnail');
    $('.thumbnail').eq(index).addClass('active-thumbnail');
}
$(document).ready(function() {
    $('.thumbnail img').on('click', function() {
        var index = $(this).parent().index();
        changeSlide(index);
    });

    $('#carouselExampleIndicators').on('slide.bs.carousel', function (e) {
        var index = $(e.relatedTarget).index();
        changeSlide(index);
    });
});
$(document).ready(function() {
    $('#view-order-info').on('click', function() {
        var ma_phong = $('.ma_phong').text();
        $('#ma_phong').text(ma_phong);
        $('#orderInfoModal').modal('show');
    });
});
function placeOrder() {
    var roomCode = $('#roomCode').text();
    var roomPrice = $('#roomPrice').text();
    $('#orderRoomCode').text(roomCode);
    $('#orderRoomPrice').text(roomPrice);
    var stayNights = parseInt($('#stayNights').val());
    var roomPriceNumeric = parseFloat(roomPrice.replace(/[^0-9.-]+/g, ''));

    if (stayNights && roomPriceNumeric) {
        var totalPrice = stayNights * roomPriceNumeric;
        $('#totalPrice').text(totalPrice.toLocaleString('vi-VN') + ' VNĐ');
        $('#totalPriceInput').val(totalPrice); // Lưu giá trị tổng số tiền phòng vào trường ẩn
    }
}

$('#stayNights').on('blur', function() {
    placeOrder(); // Gọi lại hàm placeOrder() khi số đêm thay đổi
});


$(document).on('click', function(event) {
    var target = $(event.target);
    if (!target.closest('.modal').length && !target.is('#stayNights')) {
        placeOrder();
    }
});