jQuery(document).ready(function ($) {

    $('.post-of-user_btn.hide-post').on('click', function (event) {

        var postId = $(this).data('postid'); // Получаем ID поста

        $('.page-cabinet_loader').addClass('_loader-active');
        document.body.style.overflow = 'hidden';

        // Отправить асинхронный запрос на сервер
        $.ajax({
            // url: '/wp-admin/admin-ajax.php',
            url: myajax.url,
            method: 'POST',
            data: {
                action: 'hide_user_post',
                nonce_code: myajax.nonce,
                post_id: postId
            },
            success: function (response) {
                if (response.success) {
                    // Чтобы перерисовать DOM
                    location.reload();
                    // $('.page-cabinet_loader').removeClass('_loader-active');

                } else {
                    console.error(response.data.message);
                    document.body.style.overflow = 'auto';
                }
            },
            error: function () {
                console.error('Произошла ошибка при выполнении запроса скрытия поста.');
                $('.page-cabinet_loader').removeClass('_loader-active');
                document.body.style.overflow = 'auto';

            }
        });

    });

    $('.post-of-user_btn.activate_post').on('click', function (event) {

        var postId = $(this).data('postid'); // Получаем ID поста

        $('.page-cabinet_loader').addClass('_loader-active');
        document.body.style.overflow = 'hidden';

        // Отправить асинхронный запрос на сервер
        $.ajax({
            // url: '/wp-admin/admin-ajax.php',
            url: myajax.url,
            method: 'POST',
            data: {
                action: 'activate_user_post',
                nonce_code: myajax.nonce,
                post_id: postId
            },
            success: function (response) {
                if (response.success) {
                    // $('.page-cabinet_loader').removeClass('_loader-active');
                    // Чтобы перерисовать DOM
                    location.reload();
                } else {
                    console.error(response.data.message);
                    document.body.style.overflow = 'auto';
                }
            },
            error: function () {
                console.error('Произошла ошибка при выполнении запроса скрытия поста.');
                $('.page-cabinet_loader').removeClass('_loader-active');
                document.body.style.overflow = 'auto';

            }
        });

    });

    $('.post-of-user_btn.delete-post').on('click', function (event) {
        var postId = $(this).data('postid'); // Получаем ID поста

        // Просим подтверждение у пользователя перед удалением
        var confirmDelete = confirm('Вы уверены, что хотите удалить этот пост?');

        if (confirmDelete) {

            $('.page-cabinet_loader').addClass('_loader-active');
            document.body.style.overflow = 'hidden';

            // Отправить асинхронный запрос на сервер
            $.ajax({
                // url: '/wp-admin/admin-ajax.php',
                url: myajax.url,
                method: 'POST',
                data: {
                    action: 'delete_user_post',
                    nonce_code: myajax.nonce,
                    post_id: postId
                },
                success: function (response) {
                    if (response.success) {
                        // $('.page-cabinet_loader').removeClass('_loader-active');
                        // Чтобы перерисовать DOM
                        location.reload();
                    } else {
                        console.error(response.data.message);
                        $('.page-cabinet_loader').removeClass('_loader-active');
                        document.body.style.overflow = 'auto';
                    }
                },
                error: function () {
                    console.error('Произошла ошибка при выполнении запроса скрытия поста.');
                    $('.page-cabinet_loader').removeClass('_loader-active');
                    document.body.style.overflow = 'auto';

                }
            });
        }
    });

});