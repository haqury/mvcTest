/**
 * контроллер главной страницы
 * @type {{init: Controller_Home.init, authorization: Controller_Home.authorization, withdraw: Controller_Home.withdraw}}
 */
var Controller_Home = {

    /**
     * инициализация
     */
    init: function () {
        var self = this;;
        $(document).on('click', '.js-submit', function () {
            self.authorization()
        });
        $(document).on('click', '.js-buy' ,function () {
            self.withdraw()
        });
    },

    /**
     * отправка данных для авторизации
     */
    authorization: function () {
        data = {};
        $('.js-loginForm').find('input').each(function () {
            var $name = this.name;
            data[$name] = $(this).val();
        });
        console.log(data);
        collback = function (result) {
            console.log(result);
            $('body').html(result);
        };
        $.ajax({
            url: '/',
            type: "POST",
            data: data,
            success: function (result) {
                collback(result);
            }
        })
    },

    /**
     * отправка данных для списания средств
     */
    withdraw: function () {
        var data = {};
        $('.js-buy_form').find('input').each(function () {
            var $name = this.name;
            data[$name] = $(this).val();
        });
        console.log(data);
        collback = function (result) {
            $('body').html(result);
        };
        $.ajax({
            url: '/',
            type: "POST",
            data: data,
            success: function (result) {
                collback(result);
            }
        })
    }
}