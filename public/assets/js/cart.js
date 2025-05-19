$(function() {
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        let button = $(this);
        let productId = button.data('product-id');
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '/cart/add',
            method: 'POST',
            data: {
                product_id: productId,
                _token: csrfToken
            },
            success: function(response) {
                if(response.status === 'success') {
                    // Update cart count and total in real-time
                    $('#cart-count').text(response.count);
                    $('#cart-total').text('$' + response.total);
                    // Optionally, show a toast or highlight the cart
                }
            },
            error: function(xhr) {
                alert('Could not add to cart. Please try again.');
            }
        });
    });
});
