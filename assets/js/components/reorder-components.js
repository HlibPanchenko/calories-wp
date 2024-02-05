jQuery(document).ready(function ($) {
    const mediumBreakpoint = 1024;

    function rearrangeElements() {
        const metaBlock = $('.left-recipe_meta');
        const leftRecipe = $('.left-recipe');
        const rightRecipe = $('.single-recipe_right.right-recipe');
        const rightRecipeInfo = $('.right-recipe_info');
        const rightRecipeIngredients = $('.right-recipe_ingredients');

        // Проверка ширины экрана
        if ($(window).width() < mediumBreakpoint) {
            // Вставка элементов перед metaBlock
            // console.log('true');
            rightRecipeInfo.appendTo(metaBlock);
            rightRecipeIngredients.appendTo(metaBlock);

        } else {
            // Проверка наличия детей у rightRecipeIngredients и rightRecipeInfo
            if (metaBlock.children().length > 0) {
                // Удаление всех элементов из metaBlock
                metaBlock.empty();
                // возвращаем на место
                rightRecipeIngredients.prependTo(rightRecipe);
                rightRecipeInfo.prependTo(rightRecipe);
            }
        }
    }


        rearrangeElements();
        $(window).resize(rearrangeElements);

});
