<?php
/**
 * Template Name: recipes
 */
get_header();

use src\utilsClass;

?>


    <main id="primary" class="main-wrapper">

        <article class="main-article all-popular-article">
            <section class="all-recepies all-popular-recepies">
                <div class="all-recepies_container">
                    <div class="all-recepies_header">

                        <div class="all-recepies_breadcrumbs">
                            <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                        </div>

                        <div class="all-recepies_running running">
                            <div class="running_inner">
                                <p class="running_line">Рецепты.
                                    На каждый день. 365 дней в году
                                    <svg width="50px" height="50px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M35.70206 248.785503s23.001723 11.924206 34.361469 20.532212c14.534831 10.936402 118.042583 65.195066 103.29608 192.339558-7.055743 47.202922-56.234273 141.255977-144.642734 158.189761-0.141115 2.257838 0 0 0 0s236.367395 24.695101 219.574726-190.998967C242.011989 369.015366 218.304692 266.848205 66.606215 249.914422c-24.201199-1.128919-30.904155-1.128919-30.904155-1.128919z" fill="#F3AF1A"></path><path d="M35.70206 248.785503L583.368842 170.043409l220.915317 48.190726L66.676773 249.914422z" fill="#F3AF1A"></path><path d="M35.70206 248.785503l768.582099-30.551368s217.81079 244.622614-46.42679 542.727761H658.794736s12.065321-60.891063-50.236891-69.640184c-27.446841-3.316199-77.683732 12.700338-64.912837 75.002549-78.318749-1.975608-514.857576-5.997382-514.857576-5.997382v-140.409288s170.255082 19.614966 208.638324-127.638393c7.620203-68.370151 11.148074-211.883966-168.491146-240.741956-15.945979-2.328395-33.23255-2.75174-33.23255-2.751739z" fill="#F4C323"></path><path d="M757.645697 570.174602m-64.912837 0a64.912837 64.912837 0 1 0 129.825674 0 64.912837 64.912837 0 1 0-129.825674 0Z" fill="#F6AF1C"></path><path d="M692.73286 612.650176c-38.312685 0-69.49907-31.186385-69.49907-69.49907s31.186385-69.49907 69.49907-69.49907 69.49907 31.186385 69.49907 69.49907-31.186385 69.49907-69.49907 69.49907z m0-117.830911c-26.670709 0-48.33184 21.661131-48.33184 48.331841s21.661131 48.33184 48.33184 48.33184 48.33184-21.661131 48.331841-48.33184-21.661131-48.33184-48.331841-48.331841zM399.072831 434.986564c-28.364087 0-51.36581-23.07228-51.36581-51.36581s23.07228-51.36581 51.36581-51.36581 51.36581 23.07228 51.36581 51.36581-23.07228 51.36581-51.36581 51.36581z m0-81.634948c-16.651554 0-30.198581 13.547027-30.19858 30.19858s13.547027 30.198581 30.19858 30.198581 30.198581-13.547027 30.198581-30.198581-13.547027-30.198581-30.198581-30.19858z" fill="#7A4721"></path><path d="M325.48143 658.018604m-73.5914 0a73.591401 73.591401 0 1 0 147.182801 0 73.591401 73.591401 0 1 0-147.182801 0Z" fill="#F6AF1C"></path><path d="M565.941156 416.359402m-67.805691 0a67.805691 67.805691 0 1 0 135.611383 0 67.805691 67.805691 0 1 0-135.611383 0Z" fill="#F6AF1C"></path><path d="M793.347757 279.125198m-29.210776 0a29.210777 29.210777 0 1 0 58.421553 0 29.210777 29.210777 0 1 0-58.421553 0Z" fill="#F6AF1C"></path><path d="M876.111624 751.577758h119.171501v89.678495l-25.471232 40.217736h-116.490319l-30.76304-32.174189z" fill="#F4C323"></path><path d="M969.811893 881.473989l25.471232-40.217736v-44.945084l-48.896299 6.138497-5.362365 36.830979H925.007924l-9.384138 34.149797-1.763936 8.043547z" fill="#F3AF1A"></path></g></svg>
                                    Рецепты. На каждый день. 365 дней в году
                                    <svg width="50px" height="50px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M35.70206 248.785503s23.001723 11.924206 34.361469 20.532212c14.534831 10.936402 118.042583 65.195066 103.29608 192.339558-7.055743 47.202922-56.234273 141.255977-144.642734 158.189761-0.141115 2.257838 0 0 0 0s236.367395 24.695101 219.574726-190.998967C242.011989 369.015366 218.304692 266.848205 66.606215 249.914422c-24.201199-1.128919-30.904155-1.128919-30.904155-1.128919z" fill="#F3AF1A"></path><path d="M35.70206 248.785503L583.368842 170.043409l220.915317 48.190726L66.676773 249.914422z" fill="#F3AF1A"></path><path d="M35.70206 248.785503l768.582099-30.551368s217.81079 244.622614-46.42679 542.727761H658.794736s12.065321-60.891063-50.236891-69.640184c-27.446841-3.316199-77.683732 12.700338-64.912837 75.002549-78.318749-1.975608-514.857576-5.997382-514.857576-5.997382v-140.409288s170.255082 19.614966 208.638324-127.638393c7.620203-68.370151 11.148074-211.883966-168.491146-240.741956-15.945979-2.328395-33.23255-2.75174-33.23255-2.751739z" fill="#F4C323"></path><path d="M757.645697 570.174602m-64.912837 0a64.912837 64.912837 0 1 0 129.825674 0 64.912837 64.912837 0 1 0-129.825674 0Z" fill="#F6AF1C"></path><path d="M692.73286 612.650176c-38.312685 0-69.49907-31.186385-69.49907-69.49907s31.186385-69.49907 69.49907-69.49907 69.49907 31.186385 69.49907 69.49907-31.186385 69.49907-69.49907 69.49907z m0-117.830911c-26.670709 0-48.33184 21.661131-48.33184 48.331841s21.661131 48.33184 48.33184 48.33184 48.33184-21.661131 48.331841-48.33184-21.661131-48.33184-48.331841-48.331841zM399.072831 434.986564c-28.364087 0-51.36581-23.07228-51.36581-51.36581s23.07228-51.36581 51.36581-51.36581 51.36581 23.07228 51.36581 51.36581-23.07228 51.36581-51.36581 51.36581z m0-81.634948c-16.651554 0-30.198581 13.547027-30.19858 30.19858s13.547027 30.198581 30.19858 30.198581 30.198581-13.547027 30.198581-30.198581-13.547027-30.198581-30.198581-30.19858z" fill="#7A4721"></path><path d="M325.48143 658.018604m-73.5914 0a73.591401 73.591401 0 1 0 147.182801 0 73.591401 73.591401 0 1 0-147.182801 0Z" fill="#F6AF1C"></path><path d="M565.941156 416.359402m-67.805691 0a67.805691 67.805691 0 1 0 135.611383 0 67.805691 67.805691 0 1 0-135.611383 0Z" fill="#F6AF1C"></path><path d="M793.347757 279.125198m-29.210776 0a29.210777 29.210777 0 1 0 58.421553 0 29.210777 29.210777 0 1 0-58.421553 0Z" fill="#F6AF1C"></path><path d="M876.111624 751.577758h119.171501v89.678495l-25.471232 40.217736h-116.490319l-30.76304-32.174189z" fill="#F4C323"></path><path d="M969.811893 881.473989l25.471232-40.217736v-44.945084l-48.896299 6.138497-5.362365 36.830979H925.007924l-9.384138 34.149797-1.763936 8.043547z" fill="#F3AF1A"></path></g></svg>

                                </p>
                                <p class="running_line">Рецепты.
                                    На каждый день. 365 дней в году
                                    <svg width="50px" height="50px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M35.70206 248.785503s23.001723 11.924206 34.361469 20.532212c14.534831 10.936402 118.042583 65.195066 103.29608 192.339558-7.055743 47.202922-56.234273 141.255977-144.642734 158.189761-0.141115 2.257838 0 0 0 0s236.367395 24.695101 219.574726-190.998967C242.011989 369.015366 218.304692 266.848205 66.606215 249.914422c-24.201199-1.128919-30.904155-1.128919-30.904155-1.128919z" fill="#F3AF1A"></path><path d="M35.70206 248.785503L583.368842 170.043409l220.915317 48.190726L66.676773 249.914422z" fill="#F3AF1A"></path><path d="M35.70206 248.785503l768.582099-30.551368s217.81079 244.622614-46.42679 542.727761H658.794736s12.065321-60.891063-50.236891-69.640184c-27.446841-3.316199-77.683732 12.700338-64.912837 75.002549-78.318749-1.975608-514.857576-5.997382-514.857576-5.997382v-140.409288s170.255082 19.614966 208.638324-127.638393c7.620203-68.370151 11.148074-211.883966-168.491146-240.741956-15.945979-2.328395-33.23255-2.75174-33.23255-2.751739z" fill="#F4C323"></path><path d="M757.645697 570.174602m-64.912837 0a64.912837 64.912837 0 1 0 129.825674 0 64.912837 64.912837 0 1 0-129.825674 0Z" fill="#F6AF1C"></path><path d="M692.73286 612.650176c-38.312685 0-69.49907-31.186385-69.49907-69.49907s31.186385-69.49907 69.49907-69.49907 69.49907 31.186385 69.49907 69.49907-31.186385 69.49907-69.49907 69.49907z m0-117.830911c-26.670709 0-48.33184 21.661131-48.33184 48.331841s21.661131 48.33184 48.33184 48.33184 48.33184-21.661131 48.331841-48.33184-21.661131-48.33184-48.331841-48.331841zM399.072831 434.986564c-28.364087 0-51.36581-23.07228-51.36581-51.36581s23.07228-51.36581 51.36581-51.36581 51.36581 23.07228 51.36581 51.36581-23.07228 51.36581-51.36581 51.36581z m0-81.634948c-16.651554 0-30.198581 13.547027-30.19858 30.19858s13.547027 30.198581 30.19858 30.198581 30.198581-13.547027 30.198581-30.198581-13.547027-30.198581-30.198581-30.19858z" fill="#7A4721"></path><path d="M325.48143 658.018604m-73.5914 0a73.591401 73.591401 0 1 0 147.182801 0 73.591401 73.591401 0 1 0-147.182801 0Z" fill="#F6AF1C"></path><path d="M565.941156 416.359402m-67.805691 0a67.805691 67.805691 0 1 0 135.611383 0 67.805691 67.805691 0 1 0-135.611383 0Z" fill="#F6AF1C"></path><path d="M793.347757 279.125198m-29.210776 0a29.210777 29.210777 0 1 0 58.421553 0 29.210777 29.210777 0 1 0-58.421553 0Z" fill="#F6AF1C"></path><path d="M876.111624 751.577758h119.171501v89.678495l-25.471232 40.217736h-116.490319l-30.76304-32.174189z" fill="#F4C323"></path><path d="M969.811893 881.473989l25.471232-40.217736v-44.945084l-48.896299 6.138497-5.362365 36.830979H925.007924l-9.384138 34.149797-1.763936 8.043547z" fill="#F3AF1A"></path></g></svg>
                                    Рецепты. На каждый день. 365 дней в году
                                    <svg width="50px" height="50px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M35.70206 248.785503s23.001723 11.924206 34.361469 20.532212c14.534831 10.936402 118.042583 65.195066 103.29608 192.339558-7.055743 47.202922-56.234273 141.255977-144.642734 158.189761-0.141115 2.257838 0 0 0 0s236.367395 24.695101 219.574726-190.998967C242.011989 369.015366 218.304692 266.848205 66.606215 249.914422c-24.201199-1.128919-30.904155-1.128919-30.904155-1.128919z" fill="#F3AF1A"></path><path d="M35.70206 248.785503L583.368842 170.043409l220.915317 48.190726L66.676773 249.914422z" fill="#F3AF1A"></path><path d="M35.70206 248.785503l768.582099-30.551368s217.81079 244.622614-46.42679 542.727761H658.794736s12.065321-60.891063-50.236891-69.640184c-27.446841-3.316199-77.683732 12.700338-64.912837 75.002549-78.318749-1.975608-514.857576-5.997382-514.857576-5.997382v-140.409288s170.255082 19.614966 208.638324-127.638393c7.620203-68.370151 11.148074-211.883966-168.491146-240.741956-15.945979-2.328395-33.23255-2.75174-33.23255-2.751739z" fill="#F4C323"></path><path d="M757.645697 570.174602m-64.912837 0a64.912837 64.912837 0 1 0 129.825674 0 64.912837 64.912837 0 1 0-129.825674 0Z" fill="#F6AF1C"></path><path d="M692.73286 612.650176c-38.312685 0-69.49907-31.186385-69.49907-69.49907s31.186385-69.49907 69.49907-69.49907 69.49907 31.186385 69.49907 69.49907-31.186385 69.49907-69.49907 69.49907z m0-117.830911c-26.670709 0-48.33184 21.661131-48.33184 48.331841s21.661131 48.33184 48.33184 48.33184 48.33184-21.661131 48.331841-48.33184-21.661131-48.33184-48.331841-48.331841zM399.072831 434.986564c-28.364087 0-51.36581-23.07228-51.36581-51.36581s23.07228-51.36581 51.36581-51.36581 51.36581 23.07228 51.36581 51.36581-23.07228 51.36581-51.36581 51.36581z m0-81.634948c-16.651554 0-30.198581 13.547027-30.19858 30.19858s13.547027 30.198581 30.19858 30.198581 30.198581-13.547027 30.198581-30.198581-13.547027-30.198581-30.198581-30.19858z" fill="#7A4721"></path><path d="M325.48143 658.018604m-73.5914 0a73.591401 73.591401 0 1 0 147.182801 0 73.591401 73.591401 0 1 0-147.182801 0Z" fill="#F6AF1C"></path><path d="M565.941156 416.359402m-67.805691 0a67.805691 67.805691 0 1 0 135.611383 0 67.805691 67.805691 0 1 0-135.611383 0Z" fill="#F6AF1C"></path><path d="M793.347757 279.125198m-29.210776 0a29.210777 29.210777 0 1 0 58.421553 0 29.210777 29.210777 0 1 0-58.421553 0Z" fill="#F6AF1C"></path><path d="M876.111624 751.577758h119.171501v89.678495l-25.471232 40.217736h-116.490319l-30.76304-32.174189z" fill="#F4C323"></path><path d="M969.811893 881.473989l25.471232-40.217736v-44.945084l-48.896299 6.138497-5.362365 36.830979H925.007924l-9.384138 34.149797-1.763936 8.043547z" fill="#F3AF1A"></path></g></svg>

                                </p>
                            </div>
                        </div>

                        <div class="all-recepies_description">
                            Добро пожаловать на страницу всех <span>рецептов</span> ! <br>
                            Ищите вдохновение для ваших кулинарных творений среди нашего разнообразного ассортимента.
                            <span class="span-recepies-1">Используйте блок поиска для быстрого поиска и настройте фильтры</span>, чтобы отобразить только те
                            рецепты, которые соответствуют вашим предпочтениям. Приятного кулинарного путешествия!
                        </div>

                        <?php get_template_part('search-form-big'); ?>


                        <div class="all-recepies_sort sort-block">

                            <ul class="sort-block_list">
                                <?php
                                $taxonomy_keys = array('ingredients', 'cooking-method', 'dish');
                                $result = UtilsClass::get_taxonomy_terms($taxonomy_keys);

                                // Проход по всем данным из $result
                                foreach ($result as $taxonomy_data) {
                                    foreach ($taxonomy_data as $taxonomy => $terms) {
                                        ?>
                                        <li class="sort-block_item" id="taxonomy_<?php echo esc_attr($taxonomy); ?>">
                                            <div class="sort-block_wrapper">
                                                <div class="sort-block_header">
                                                    <div class="sort-block_text">
                                                        <?php
                                                        // Получите название таксономии
                                                        $taxonomy_labels = get_taxonomy_labels(get_taxonomy($taxonomy));
                                                        echo esc_html($taxonomy_labels->singular_name);
                                                        ?>
                                                    </div>
                                                    <div class="sort-block_btn">
                                                        <div class="sort-block_arrow"></div>
                                                    </div>

                                                </div>

                                                <?php
                                                // Проверка, есть ли термины
                                                if (!empty($terms)) {
                                                    ?>
                                                    <div class="sort-block_dropdown dropdown-sort">
                                                        <?php
                                                        // Проход по всем терминам
                                                        foreach ($terms as $term) {
                                                            ?>
                                                            <div class="dropdown-sort_checkbox">
                                                                <label>
                                                                    <input class="dropdown-sort_input" type="checkbox" data-filterText="<?php echo esc_html($term->name); ?>" id="<?php echo esc_attr($term->term_id); ?>">
                                                                    <?php echo esc_html($term->name); ?>
                                                                </label>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <li class="sort-block_item" id="calories" >
                                    <div class="sort-block_wrapper">
                                        <div class="sort-block_header">
                                            <div class="sort-block_text">
                                                Количество калорий
                                            </div>
                                            <div class="sort-block_btn">
                                                <div class="sort-block_arrow"></div>
                                            </div>
                                        </div>
                                        <div class="sort-block_dropdown dropdown-sort">
                                            <?php
                                            // Получите уникальные значения для поля k-vo_kalorij
//                                            $calories = get_unique_recipe_field_values('k-vo_kalorij');

                                            // Определите диапазоны калорий
                                            $ranges = array(
                                                '0-100' => '0-100 калорий',
                                                '100-200' => '100-200 калорий',
                                                '200-300' => '200-300 калорий',
                                                '300-400' => '300-400 калорий',
                                                '400-1000' => '400+ калорий',
                                            );

                                            // Выведите чекбоксы для каждого диапазона
                                            foreach ($ranges as $key => $range) {
                                                ?>
                                                <div class="dropdown-sort_checkbox">
                                                    <label>
                                                        <input class="dropdown-sort_input"  type="checkbox" data-filterText="<?php echo $range; ?>" id="<?php echo esc_attr($key); ?>">
                                                        <?php echo esc_html($range); ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="sort-block_item" id="cook_time">
                                    <div class="sort-block_wrapper">
                                        <div class="sort-block_header">
                                            <div class="sort-block_text">
                                                Время на готовку
                                            </div>
                                            <div class="sort-block_btn">
                                                <div class="sort-block_arrow"></div>
                                            </div>
                                        </div>
                                        <div class="sort-block_dropdown dropdown-sort">
                                            <?php
                                            // Определите диапазоны времени на готовку
                                            $cook_times = array(
                                                '0-10' => 'до 10 минут',
                                                '10-20' => '10-20 минут',
                                                '20-30' => '20-30 минут',
                                                '30-40' => '30-40 минут',
                                                '40-60' => '40-1 час',
                                                '60-120' => 'больше часа',
                                                '120-180' => 'больше 2 часов',
                                            );

                                            // Выведите чекбоксы для каждого диапазона
                                            foreach ($cook_times as $range => $label) {
                                                ?>
                                                <div class="dropdown-sort_checkbox">
                                                    <label>
                                                        <input class="dropdown-sort_input" type="checkbox" data-filterText="<?php echo $label; ?>" id="<?php echo esc_attr($range); ?>">
                                                        <?php echo esc_html($label); ?>
                                                    </label>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>

<!--                            <div class="sort-block_side">-->
<!--                                sidebar-->
<!--                            </div>-->
                        </div>

                    </div>
                        <div class="all-recepies_catalog catalog-posts">
                            <div class="catalog-posts_choosenFilters choosenFilters">
<!--                                <div class="choosenFilters_title">Фильтры:</div>-->
                                <ul class="choosenFilters_list">
<!--                                    <li class="choosenFilters_item">-->
<!--                                        Мясо &#215;-->
<!--                                    </li>-->
                                </ul>
                            </div>



                            <span class="loader"></span>

                        <div class="catalog-posts_list">
                            <?php

                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                            $args = array(
                                'post_type' => 'recipe',
                                'posts_per_page' => 8,
                                'order' => 'DESC',
                                'orderby' => 'date',
                                'paged'          => $paged,
                            );
                            $recipe_query = new WP_Query($args);

                            // Loop through the recipe posts
                            while ($recipe_query->have_posts()) :
                                $recipe_query->the_post();

                                // Get ACF fields
                                $images = get_field('images_of_recepie');
                                $calories = get_field('k-vo_kalorij');
                                $timeCook = get_field('vremya_na_gotovku');


                                if (isset($timeCook) && is_numeric($timeCook)) {
                                    [$timeCookHours, $timeCookMins] = UtilsClass::minsToHours($timeCook);
                                } else {
                                    // Handle the case when $timeCook is not set or not a number
                                    $timeCookHours = 0;
                                    $timeCookMins = 0;
                                }
                                /*render markup*/
                                $time_markup = UtilsClass::generateTimeMarkup($timeCookHours, $timeCookMins);

                                // Получаем все таксономии для текущего поста
                                $part_of_the_day_terms = get_the_terms(get_the_ID(), 'part_of_the_day');
//                    var_dump(  $part_of_the_day_terms);
                                ?>

                                <a href="<?php the_permalink(); ?>" class="catalog-posts_card card">
                                    <div class="card_box">
                                        <div class="card_header">
                                            <div class="card_img">
                                                <?php

                                                if ($images && is_array($images) && !empty($images)) {

                                                    echo '<img src="' . esc_url($images[0]) . '" alt="Image in card" class="card-day_img">';

                                                } else {
                                                    // Fallback image if no images are found
                                                    echo '<img src="' . get_template_directory_uri() . '/dist/images/default-image.jpg" alt="Default Image" class="card-day_img">';
                                                }
                                                ?>
                                                <!--                                            <img src="-->
                                                <?php //echo get_template_directory_uri()
                                                ?><!--/dist/images/Cheeseburger-Casserole-Lead-5-a7f9bee676c146e5b00820f30a211855.webp" alt="image in card">-->
                                            </div>
                                        </div>
                                        <div class="card_content">
                                            <div class="card_title"><?php the_title(); ?></div>
                                            <!--                                        <div class="card_subtitle">SubTitle</div>-->
                                            <div class="card_info">
                                                <?php echo get_the_excerpt() ?>
                                            </div>
                                            <div class="card_meta">
                                                <div class="card_author">Marina Volkova</div>
                                                <div class="card_date"><?php echo get_the_date('d.m.Y'); ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            <?php endwhile; ?>

                            <?php wp_reset_postdata(); ?>

                        </div>

                            <div class="pagination">
                                <?php
                                // Пагинация
                                echo paginate_links(array(
                                    'total'     => $recipe_query->max_num_pages,
                                    'current'   => max(1, get_query_var('paged')),
                                    'prev_text' => '&laquo;',
                                    'next_text' => '&raquo;',
                                ));
                                ?>
                            </div>
                    </div>
            </section>
        </article>

        <?php get_template_part('template-parts/floating-button') ?>

    </main>


<?php
get_footer();