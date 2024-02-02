import {truncateText} from './/utils.js';

jQuery(document).ready(function ($) {
    $('#show-filters').click(function() {
        // Переключение стиля отображения для формы поиска
        $('.search-big').toggle();

        // Переключение стиля отображения для блока сортировки
        $('.all-recepies_sort.sort-block').toggle();
    });

    // При клике на заголовок sort-block_header
    $('.sort-block_header').click(function () {
        // Находим ближайший блок .sort-block_dropdown
        var dropdown = $(this).closest('.sort-block_item').find('.sort-block_dropdown');

        // Скрываем все другие выпадающие списки
        $('.sort-block_dropdown').not(dropdown).removeClass('show');

        // Переключаем видимость текущего выпадающего списка
        dropdown.toggleClass('show');

        // Скрываем все другие стрелочки
        $('.sort-block_arrow').not($(this).find('.sort-block_arrow')).removeClass('rotate-arrow');

        // Переключаем класс для поворота текущей стрелочки
        var arrow = $(this).find('.sort-block_arrow');
        arrow.toggleClass('rotate-arrow');
    });

    // При клике вне .sort-block_item, скрываем .sort-block_dropdown
    $(document).on('click', function (event) {
        if (!$(event.target).closest('.sort-block_item').length) {
            $('.sort-block_dropdown').removeClass('show');
            $('.sort-block_arrow').removeClass('rotate-arrow');
        }
    });

    var selectedData = {};

    $('.dropdown-sort_input').change(function() {
        var sortBy = $(this).closest('.sort-block_item').attr('id');
        var filterID = this.id;
        var filterText = $(this).data('filtertext');
        // console.log('Состояние чекбокс поменялось');
        selectedData.slugs ??= {};

        // Проверяем, существует ли уже запись для данного фильтра
        if (!selectedData.slugs[filterID]) {
            // Если не существует, создаем запись с ключом filterID и значением filterText
            selectedData.slugs[filterID] = filterText;
        } else {
            // Если запись уже существует, удаляем ее
            delete selectedData.slugs[filterID];
        }

        if (sortBy.startsWith('taxonomy_')) {
            // Обработка для таксономий
            var taxonomy = sortBy.replace('taxonomy_', '');
            // Инициализация массива, если он еще не создан
            selectedData[taxonomy] = selectedData[taxonomy] || [];

            // Проверяем, есть ли уже такое значение в массиве
            var index = selectedData[taxonomy].indexOf(filterID);

            if (index === -1) {
                // Если значения нет в массиве, добавляем его
                selectedData[taxonomy].push(filterID);
            } else {
                // Если значение уже есть в массиве, удаляем его
                selectedData[taxonomy].splice(index, 1);
            }
        } else {
            // Обработка для cook_time и calories
            // Инициализация массива, если он еще не создан
            selectedData[sortBy] = selectedData[sortBy] || [];

            // Проверяем, есть ли уже такое значение в массиве
            var index = selectedData[sortBy].indexOf(filterID);

            if (index === -1) {
                // Если значения нет в массиве, добавляем его
                selectedData[sortBy].push(filterID);
            } else {
                // Если значение уже есть в массиве, удаляем его
                selectedData[sortBy].splice(index, 1);
            }
        }

            // renderChoosenFilters(selectedData);
            sendRequestToServer(selectedData);

    });

// Функция для отправки данных на сервер
    function sendRequestToServer(data, pageNumber = 1) {

        // $('.catalog-posts_list').empty();
        $('.catalog-posts_list').children().not('.loader').remove();

        $('.pagination').empty();

        showLoader();

        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'handle_custom_request',
                selectedData: data,
                page: pageNumber,
            },
            success: function(response) {
                // console.log(response);
                updateRecipeList(response);
            },
            error: function(error) {
                console.error('Ошибка при отправке запроса на сервер:', error);
            },
            complete: function() {
                hideLoader();
            }
        });
    }

    function updateRecipeList(response) {
        var $catalogPostsList = $('.catalog-posts_list');
        // $catalogPostsList.empty();
        /*удаляем все кроме лоудера*/
        // $catalogPostsList.children().not('.loader').remove();
        // $('.pagination').empty();

        if (response.status === 'success') {
            var postsData = response.posts;

            if (postsData.length > 0) {
                postsData.forEach(function (post) {
                    var truncatedExcerpt = truncateText(post.excerpt, 100);
                    var postHTML = `
                    <a href="${post.permalink}" class="catalog-posts_card card">
                        <div class="card_box">
                            <div class="card_header">
                                <div class="card_img">
                                    <img src="${post.images[0]}" alt="Image in card" class="card-day_img">
                                </div>
                            </div>
                            <div class="card_content">
                                <div class="card_title">${post.title}</div>
                                <div class="card_info">${truncatedExcerpt}</div>
<!--                                <div class="card_info">${post.excerpt}</div>-->
<!--                                <div class="card_meta">-->
<!--                                    <div class="card_author">Marina Volkova</div>-->
<!--                                    <div class="card_date">10.12.2023</div>-->
<!--                                </div>-->
                            </div>
                        </div>
                    </a>`;

                    $catalogPostsList.append(postHTML);
                });
            } else {
                // Если массив постов пуст, добавляем надпись об отсутствии рецептов
                $catalogPostsList.append('<p>Рецепты с такими критериями не найдены</p>');
            }

            // отрисовка выбранных фильтров
            // renderChoosenFilters(response.filters);
            // console.log('Запрос на сервер для получения новых рецептов');
            // console.log('selectedData которую передаем на перерисовку: ', selectedData);
            renderChoosenFilters(selectedData);
            if (response.pagination.max_num_pages > 1) {
                renderPagination(response.pagination);
            }

        } else {
            console.error('Ошибка при обработке запроса:', response.message);
        }
    }

    function showLoader() {
        $('.loader').addClass('show-loader');
    }

    function hideLoader() {
        $('.loader').removeClass('show-loader');
    }

    function renderPagination(paginationData) {
        // Предполагаем, что у вас есть контейнер для ссылок пагинации
        var $paginationContainer = $('.pagination');

        // Очищаем предыдущие ссылки пагинации
        $paginationContainer.empty();

        // Рендерим ссылки пагинации
        for (var i = 1; i <= paginationData.max_num_pages; i++) {
            var linkClass = i === paginationData.current_page ? 'current ajax-pagination' : 'ajax-pagination';
            $paginationContainer.append('<a href="' + i + '" class="' + linkClass + '">' + i + '</a>');
        }
    }


    // Обрабатываем событие клика по ссылкам пагинации
    /*Когда пользователь только заходит на страницу рецептов, то работает пагинация на основе paginate_links.
    Это происходит с перезагрузкой страницы. Также формируется ссылка: http://localhost:3000/recipes/page/4/
    * */
    /*Но Когда пользователь начинает выставлять фильтры, то пагинация формируется с помощью js, когда приходит ответ
    * от ajax запроса. Мы этому прослушиваем только блоки пагинации ('.pagination .ajax-pagination'), которые сформированы в результате ajax запроса.
    * без перезагрузки страницы. Ссылка не формируется.  */
    $(document).on('click', '.pagination .ajax-pagination', function(event) {
    // $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href');
        // console.log(selectedData);
        /*отправлять пользователя в начало блока с клаассом catalog-posts_list*/
        // Определяем блок с классом catalog-posts_list
        var catalogListBlock = $('.catalog-posts_list');
        var choosenFilters = $('.catalog-posts_choosenFilters');

        // Отправляем пользователя в начало блока
        $('html, body').animate({
            // scrollTop: catalogListBlock.offset().top
            scrollTop: choosenFilters.offset().top
        }, 500);

        sendRequestToServer(selectedData, page);
    });

    function renderChoosenFilters(selectedFilters) {
        // console.log('перерисовка фильтров');
        // Выбираем контейнер для отображения выбранных фильтров
        var choosenFiltersList = $('.choosenFilters_list');

        // Очищаем текущий список выбранных фильтров
        choosenFiltersList.empty();

        // Проходимся по объекту выбранных фильтров
        $.each(selectedFilters.slugs, function (filterID, filterText) {
            // Создаем элемент li
            var liElement = $('<li class="choosenFilters_item"></li>');

            // Добавляем текст фильтра и кнопку для удаления
            liElement.html(filterText + ' <button class="remove-filter" data-filter-id="' + filterID + '"></button>');

            // Добавляем элемент li в список
            choosenFiltersList.append(liElement);
        });

        // Удаляем все предыдущие обработчики событий для кнопок удаления
        // choosenFiltersList.off('click', '.remove-filter');
        choosenFiltersList.off('click', '.choosenFilters_item');

        // Добавляем обработчик события для кнопок удаления
        // choosenFiltersList.on('click', '.remove-filter', function() {
        choosenFiltersList.on('click', '.choosenFilters_item', function() {
            // console.log('Сработал обработчик события для кнопок удаления, тут вызываем функцию handleRemoveFilter')
            // var filterID = $(this).data('filter-id');
            var filterItem = $(this);
            var filterID = $(this).find('.remove-filter').data('filter-id');
            handleRemoveFilter(selectedFilters, filterID, filterItem);
        });
    }

    function handleRemoveFilter(selectedFilters, filterID, filterItem) {
        var checkbox = $('#' + filterID);

        checkbox.prop('checked', false);
        delete selectedFilters.slugs[filterID];

        // Проходимся по всем свойствам объекта selectedFilters
        for (var key in selectedFilters) {
            if (selectedFilters.hasOwnProperty(key) && Array.isArray(selectedFilters[key])) {
                // Ищем значение filterID в массиве и удаляем его, если оно присутствует
                var index = selectedFilters[key].indexOf(filterID.toString());
                if (index !== -1) {
                    selectedFilters[key].splice(index, 1);
                }
            }
        }

        // console.log('handleRemoveFilter вызван');

        // Удаляем элемент из DOM
        filterItem.remove();

        // Отправляем запрос на сервер
        sendRequestToServer(selectedFilters);

        // Обновляем отображение выбранных фильтров
        // renderChoosenFilters(selectedFilters);
    }

});
