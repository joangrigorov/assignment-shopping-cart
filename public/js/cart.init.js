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



})(window.jQuery);