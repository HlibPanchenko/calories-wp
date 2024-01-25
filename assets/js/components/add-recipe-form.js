jQuery(document).ready(function ($) {
    // Функция для добавления новых шагов
    $('#add-step').click(function (e) {
        e.preventDefault();
        var stepCount = $('.recipe-add_step-group').length;

        // Проверяем, не превышено ли максимальное количество шагов
        if (stepCount >= 10) {
            $('.add-step-btn-wrapper').hide();
            alert('Максимальное количество шагов - 10.');
            return; // Прекращаем выполнение функции, не добавляя новый шаг
        }

        var newStep = $('.recipe-add_step-group:first').clone();

        // Очищаем значения полей ввода
        newStep.find('textarea').val('');

        // Установка нового индекса в атрибутах name для текстового поля и файла
        newStep.find('textarea').attr('name', 'recipe_steps[' + stepCount + '][recipe_steptext]');
        newStep.find('input[type="file"]').attr('name', 'recipe_steps[' + stepCount + '][recipe_stepimg]');

        // Очищаем только контейнер изображений
        newStep.find('.step-image-container').empty();

        // Добавляем новый шаг в контейнер
        newStep.appendTo('#recipe-add_steps-container');
    });


    // Функция для добавления новых ингредиентов
    $('#add-ingredient').click(function (e) {
        e.preventDefault();
        var ingredientCount = $('.ingredient-group').length;
        var newIngredient = $('.ingredient-group:first').clone();
        newIngredient.find('input').val('');
        newIngredient.find('input').each(function () {
            var name = $(this).attr('name').replace(/\[\d+\]/, '[' + ingredientCount + ']');
            $(this).attr('name', name).attr('id', name);
        });
        newIngredient.appendTo('#ingredients-container');
    });

    // Функция для обработки загрузки изображений и показа превью
    function readURL(input, previewContainer) {
        if (input.files && input.files.length > 10) {
            alert('Вы можете загрузить максимум 10 изображений.');
            input.value = ''; // Очищаем выбранные файлы
            return;
        }
        // Очищаем контейнер изображений
        $(previewContainer).empty();

        // Чтение и добавление превью изображений
        $.each(input.files, function (index, file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                var imgHtml = $('<img>').attr('src', e.target.result);
                $(previewContainer).append(imgHtml);
            }
            reader.readAsDataURL(file);
        });
    }

    // Обработчик событий при изменении основного поля для изображений рецепта
    $('input[name="images_of_recepie[]"]').change(function () {
        // readURL(this, '#main-image-preview');
        var previewContainer = $('#main-image-preview .main-image-container');
        readURL(this, previewContainer);
    });

    // Обработчик событий при изменении полей для шагов рецепта
    $(document).on('change', 'input[type="file"][name^="recipe_steps"]', function () {
        var previewContainer = $(this).closest('.recipe-add_step-group').find('.step-image-container');
        readURL(this, previewContainer);
    });

    // Открытие инпута для загрузки основных изображений
    $('#add-main-image-preview').click(function() {
        $('.page-add-recipe_hide-btn').click();
    });

    // Открытие инпута для загрузки изображений шагов
    $('#recipe-add_steps-container').on('click', '.page-add-recipe_add-step-img', function() {
        // Ищем ближайший скрытый input и "кликаем" по нему
        $(this).closest('.recipe-add_step-group').find('.page-add-recipe_hide-step-btn').click();
    });
});
