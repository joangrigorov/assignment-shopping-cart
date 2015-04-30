(function ($) {

    'use strict';

    $(document).on('cart.reset',

        /**
         * Resets all quantity changes
         */
        function () {
            $('.quantity-input').each(function () {
                $(this).val($(this).attr('data-default-value'));
            });
        }
    );

    $(document).on('cart.submit',

        /**
         * Goes to checkout preview
         */
        function () {
            var form = $('#cart-form');
            $('input[name=goToCheckoutPreview]', form).val(1);
            form.submit();
        }
    );

})(window.jQuery);