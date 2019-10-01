$(document).on('click', '.add-to-cart_js', function (e) {
    e.preventDefault();
    var id = $(this).data('id'),
        weight = $('.select.list_weight').val();

    $.ajax({
        url: '/cart/add',
        data: { id: id, weight: weight },
        type: 'GET',
        success: function (res) {
            if (!res) alert('Товар не существует');
            showCart(res);
            $('body.modal-open header > nav').css({'padding-right': '-=17px'});
        },
        error: function () {
            alert('Ошибка добавления товара')
        }
    });

    $('body.modal-open header > nav').css({'padding-right': '0'});
});

function showCart(cart) {
    $('#cart .modal-body').html(cart);
    $('#cart').modal()
}

function clearCart() {
     $.ajax({
        url: '/cart/clear',
        type: 'GET',
        success: function (res) {
            if (!res) alert('Ошибка очистки корзины');
        },
        error: function () {
            alert('Ошибка')
        }
    })
}

function deleteProduct(id) {
    $.ajax({
        url: '/cart/delete',
        data: { id: id },
        type: 'GET',
        success: function (res) {
            if (!res) alert('Товар не существует');
        },
        error: function () {
            alert('Ошибка удаления товара')
        }
    })
}
