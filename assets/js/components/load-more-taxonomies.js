jQuery(document).ready(function ($) {
    $('.load-more_btn').on('click', function (event) {
        var button = $(this);
        var page = button.data('page');
        var maxPages = button.data('max-pages');

        if (page <= maxPages) {
            button.text('Загрузка...');
            // Отправить асинхронный запрос на сервер
            $.ajax({
                // url: '/wp-admin/admin-ajax.php',
                url: myajax.url,
                method: 'POST',
                data: {
                    action: 'load_more_taxonomies',
                    page: page,
                    nonce_code: myajax.nonce

                },
                success: function (response) {
                    // Parse the JSON response
                    var data = JSON.parse(response);
                    console.log(data);
                    // Check the status if needed
                    if (data.status === 'success') {
                        // Insert the HTML content into the DOM
                        $('.page-taxonomies_list').append(data.html_content);

                        if (button.data('page') + 1 == maxPages) {
                            button.hide();
                        }

                        // Increase the page number
                        button.data('page', page + 1);

                        // Восстанавливаем текст кнопки
                        button.text('Показать еще');

                    } else {
                        // Handle errors or other statuses
                        console.error('Error in server response');
                    }
                },
            });
        }
    });
});
