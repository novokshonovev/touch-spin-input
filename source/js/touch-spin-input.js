(function ($) {
    var TimeInput = function ($input, params) {
        var $upBtn = $input.parent().find('.caret.step-up');
        var $downBtn = $input.parent().find('.caret.step-down');

        $upBtn.on('click', function (event) {
            up();
        });

        $downBtn.on('click', function (event) {
            down();
        });

        $input.on('keydown', function (event) {
            if (event.type === 'keydown' && event.keyCode === 38) {
                up();
            }
            if (event.type === 'keydown' && event.keyCode === 40) {
                down();
            }
        });

        var up = function () {
            var value = getVal();
            if (value < params.maxValue) {
                setVal(value + 1);
            }
        };

        var down = function () {
            var value = getVal();
            if (value > params.minValue) {
                setVal(value - 1);
            }
        };

        var getVal = function () {
            return parseInt($input.val());
        };

        var setVal = function (value) {
            $input.val(value).change();
        };
    };
    $.fn.touchSpinInput = $.fn.widgetGenerator({
            minValue: 0,
            maxValue: 999
        },
        'touchSpin-input-widget', function ($input, params) {
            return new TimeInput($input,  params);
        }
    );
})(jQuery);