<?php
/**
 * Template Name: page-add-recipe
 */

acf_form_head();
get_header();

?>

<main id="primary" class="main-wrapper">
    <article class="main-article page-add-recipe">
        <section class=page-add-recipe_section">
            <div class="page-add-recipe_container">
                <div class="page-add-recipe_header">

                    <div class="layout-posts_breadcrumbs page-add-recipe_breadcrumbs">
                        <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
                    </div>

                    <h1 class="page-add-recipe_title">
                        Поделись своим рецептом!
                    </h1>
                    <?php if (is_user_logged_in()) : ?>
                    <div class="page-add-recipe_description">
                        <div class="page-add-recipe_description-item">
                            Добро пожаловать на <span> CALORIES.365! </span>
                        </div>
                        <br>
                        <div class="page-add-recipe_description-item">
                            Мы рады, что вы решили поделиться своим кулинарным творением
                            с нашим сообществом. Ваш уникальный рецепт может вдохновить многих и принести радость домашнего
                            приготовления во многие дома. Пожалуйста, <span> следуйте шагам ниже, чтобы добавить ваш рецепт. </span>
                        </div>
                        <br>
                        <div class="page-add-recipe_description-item">
                            Заполните необходимые поля, чтобы добавить свой рецепт на  <span> CALORIES.365. </span> Укажите название вашего рецепта,
                            опишите процесс приготовления и ингредиенты, а также добавьте качественные изображения. Не забудьте
                            поделиться секретами и особыми советами, которые сделают ваш рецепт по-настоящему особенным!

                        </div>
                        <br>
                        <div class="page-add-recipe_description-item">
                            Как только вы опубликуете рецепт, он <span> пройдет модерацию перед публикацией </span> в общем доступе.
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php
                /*только авторизованный пользователь может добавить свой рецепт*/
                if (!is_user_logged_in()) : ?>

                    <div class="page-add-recipe_content">
                        <div class="page-add-recipe_redirect go-register">
                            <div class="go-register_left">
                                <p>
                                    Для того чтобы добавить свой рецепт на наш сайт, Вам необходимо создать аккаунт. <br>
                                </p>

                                <a href="<?php echo home_url('/auth'); ?>">
                                    <span class="header-layout_linktext"> Перейти к регистрации </span>
                                    <span class="header-layout_svg-wrapper">
                        <svg width="36px" height="36px" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M20 12L16 8M20 12L16 16" stroke="#000000" stroke-width="2" stroke-linecap="round"
      stroke-linejoin="round"/>
</svg>
                    </span>
                                </a>
                            </div>
                            <div class="go-register_right">
                                <svg viewBox="0 0 128 128" version="1.1" xml:space="preserve"
                                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <style type="text/css"> .st0{fill:#69A401;} .st1{fill:#EFE691;} .st2{fill:#B20000;} .st3{fill:#DF1801;} .st4{fill:#F40603;} .st5{fill:#FFEEEE;} .st6{fill:#847B3C;} .st7{fill:#CEB600;} .st8{fill:#F8CD02;} .st9{fill:#F7C800;} .st10{fill:#F6E8B9;} .st11{fill:#F6E9CA;} .st12{fill:#CF8A11;} .st13{fill:#286F0D;} .st14{fill:#63271D;} .st15{fill:#EB8102;} .st16{fill:#E37303;} .st17{fill:#D97102;} .st18{fill:#BF6302;} .st19{fill:#EA9735;} .st20{fill:#3E1A01;} .st21{fill:#C96A0A;} .st22{fill:#CE2335;} .st23{fill:#C0242D;} .st24{fill:#BA1A23;} .st25{fill:#F9DCC7;} .st26{fill:#DBE2CE;} .st27{fill:#7D4B12;} .st28{fill:#75480C;} .st29{fill:#66410C;} .st30{fill:#88550D;} .st31{fill:#FFFEE9;} .st32{fill:#9B9F1A;} .st33{fill:#F6E177;} .st34{fill:#443A00;} .st35{fill:#305209;} .st36{fill:#7F7C04;} .st37{fill:#BAB424;} .st38{fill:#F7CF43;} .st39{fill:#DE940E;} .st40{fill:#5F570A;} .st41{fill:#175424;} .st42{fill:#215B25;} .st43{fill:#1B5020;} .st44{fill:#C0F9C0;} .st45{fill:#F3DA78;} .st46{fill:#BC441C;} .st47{fill:#148E2E;} .st48{fill:#283767;} .st49{fill:#425285;} .st50{fill:#CFDFFF;} .st51{fill:#1F2C55;} .st52{fill:#776220;} .st53{fill:#90236B;} .st54{fill:#5D1A47;} .st55{fill:#99499A;} .st56{fill:#FCCAFA;} .st57{fill:#917C31;} .st58{fill:#F4C435;} .st59{fill:#F1BC02;} .st60{fill:#F0B102;} .st61{fill:#F1F7BA;} .st62{fill:#E3DCB9;} .st63{fill:#BD6800;} .st64{fill:#E19704;} .st65{fill:#B2CA2B;} .st66{fill:#AFC20F;} .st67{fill:#B9CB00;} .st68{fill:#E5F392;} .st69{fill:#F78202;} .st70{fill:#F79613;} .st71{fill:#331F07;} .st72{fill:#402B16;} .st73{fill:#669404;} .st74{fill:#F58E13;} .st75{fill:#D87117;} .st76{fill:#216604;} .st77{fill:#286D08;} .st78{fill:#C8C625;} .st79{fill:#2C441F;} .st80{fill:#F1E6BF;} .st81{fill:#F2BE2E;} .st82{fill:#BF8F33;} .st83{fill:#568804;} .st84{fill:#669614;} .st85{fill:#688E0C;} .st86{fill:#4C7005;} .st87{fill:#A0CA49;} .st88{fill:#99BD70;} .st89{fill:#78AA25;} .st90{fill:#4B7C23;} .st91{fill:#EADBC8;} .st92{fill:#F0D5B0;} .st93{fill:#DF2B2B;} .st94{fill:#D1262C;} .st95{fill:#B7252C;} .st96{fill:#46670C;} .st97{fill:#F49D5B;} .st98{fill:#F57A55;} .st99{fill:#F1C3A7;} .st100{fill:#CC0917;} .st101{fill:#DC1035;} .st102{fill:#9BAC0F;} .st103{fill:#667A1D;} .st104{fill:#7A9D18;} .st105{fill:#F6F7E6;} .st106{fill:#F0194D;} .st107{fill:#362420;} .st108{fill:#530618;} .st109{fill:#44041A;} .st110{fill:#490419;} .st111{fill:#F8A459;} .st112{fill:#871B22;} .st113{fill:#600613;} .st114{fill:#F8C790;} .st115{fill:#447832;} .st116{fill:#7C473D;} .st117{fill:#441432;} .st118{fill:#51163F;} .st119{fill:#5B1A41;} .st120{fill:#FCEBF9;} .st121{fill:#ECE5CE;} .st122{fill:#BC3E2C;} .st123{fill:#A60F26;} .st124{fill:#C61632;} .st125{fill:#BD1331;} .st126{fill:#F8B772;} .st127{fill:#F7DDAC;} .st128{fill:#850E11;} .st129{fill:#191200;} .st130{fill:#553D2D;} .st131{fill:#F9E2D2;} .st132{fill:#CA8937;} .st133{fill:#462D16;} .st134{fill:#6D8916;} .st135{fill:#96B54E;} .st136{fill:#E3E2DE;} .st137{fill:#261811;} .st138{fill:#525C11;} .st139{fill:#14581E;} .st140{fill:#3D7712;} .st141{fill:#9BC148;} .st142{fill:#E22434;} .st143{fill:#C6DD9E;} .st144{fill:#F89A07;} .st145{fill:#F7A410;} .st146{fill:#F8AB19;} .st147{fill:#F7B81C;} .st148{fill:#E5870A;} .st149{fill:#97A304;} .st150{fill:#A88C5C;} .st151{fill:#ADC21E;} .st152{fill:#A3BA0B;} .st153{fill:#8D9E08;} .st154{fill:#E0DAB9;} .st155{fill:#684219;} .st156{fill:#777F05;} .st157{fill:#F2E9C4;} .st158{fill:#CBB465;} .st159{fill:#FFF5CA;} .st160{fill:#E52828;} .st161{fill:#F87302;} .st162{fill:#FF7B22;} .st163{fill:#FC7F10;} .st164{fill:#F8A200;} .st165{fill:#F8DC91;} .st166{fill:#FFFFFF;} .st167{fill:#F5D7D5;} .st168{fill:#EDA07A;} .st169{fill:#FCBEBE;} .st170{fill:#EAD991;} .st171{fill:#582612;} </style> <g id="_x33_0_Mulberry"></g> <g id="_x32_9_Star_Fruit"></g> <g id="_x32_8_Apricot"></g> <g id="_x32_7_Litchi"></g> <g id="_x32_6_Kiwi"></g> <g id="_x32_5_Jackfruit"></g> <g id="_x32_4_Avacado"></g> <g id="_x32_3_Blueberry"></g> <g id="_x32_2_Purple_Grapes"></g> <g id="_x32_1_Melon"></g> <g id="_x32_0_Green_Grapes"> <g id="XMLID_1040_"> <g id="XMLID_1041_"> <path class="st35" d="M65.655,10.65c-3.299,4.901-3.705,10.629-1.673,15.614 c5.884-0.739,11.359-3.749,14.657-8.65C81.938,12.713,82.344,6.985,80.313,2C74.429,2.739,68.954,5.749,65.655,10.65z" id="XMLID_1043_"></path> <path class="st14" d="M64.426,43.402c-1.104,0-2-0.896-2-2V29.899c0-4.502-2.354-8.664-6.299-11.134 c-0.937-0.587-1.22-1.82-0.634-2.757c0.587-0.936,1.82-1.219,2.757-0.634c5.119,3.206,8.176,8.636,8.176,14.524v11.503 C66.426,42.507,65.53,43.402,64.426,43.402z"></path> </g> <g id="XMLID_1044_"> <ellipse class="st65" cx="36.278" cy="42.503" id="XMLID_1063_" rx="9.868" ry="11.423"></ellipse> <ellipse class="st66" cx="54.557" cy="41.458" id="XMLID_1062_" rx="9.868" ry="11.423"></ellipse> <ellipse class="st67" cx="72.148" cy="41.458" id="XMLID_1061_" rx="9.868" ry="11.423"></ellipse> <ellipse class="st67" cx="89.657" cy="39.275" id="XMLID_1060_" rx="9.868" ry="11.423"></ellipse> <ellipse class="st65" cx="65.084" cy="56.817" id="XMLID_1059_" rx="9.961" ry="11.53"></ellipse> <ellipse class="st66" cx="82.282" cy="55.838" id="XMLID_1058_" rx="9.961" ry="11.53"></ellipse> <ellipse class="st67" cx="47.041" cy="57.862" id="XMLID_1057_" rx="9.961" ry="11.53"></ellipse> <ellipse class="st65" cx="99.039" cy="55.838" id="XMLID_1056_" rx="9.961" ry="11.53"></ellipse> <ellipse class="st65" cx="28.961" cy="56.817" id="XMLID_1055_" rx="9.961" ry="11.53"></ellipse> <ellipse class="st66" cx="39.155" cy="72.381" id="XMLID_1054_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st66" cx="57.002" cy="72.955" id="XMLID_1053_" rx="9.932" ry="11.497"></ellipse> <ellipse class="st65" cx="73.808" cy="72.381" id="XMLID_1052_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st65" cx="89.657" cy="72.381" id="XMLID_1051_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st65" cx="47.17" cy="86.632" id="XMLID_1050_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st66" cx="64.594" cy="88.103" id="XMLID_1049_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st67" cx="81.681" cy="86.632" id="XMLID_1048_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st65" cx="56.553" cy="101.541" id="XMLID_1047_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st65" cx="73.808" cy="101.541" id="XMLID_1046_" rx="9.382" ry="10.861"></ellipse> <ellipse class="st67" cx="65.084" cy="115.139" id="XMLID_1045_" rx="9.382" ry="10.861"></ellipse> </g> <g id="XMLID_1569_"> <g id="XMLID_2427_"> <g id="XMLID_2464_"> <ellipse class="st68" cx="34.899" cy="39.515" id="XMLID_2465_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2462_"> <ellipse class="st68" cx="53.52" cy="39.515" id="XMLID_2463_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2460_"> <ellipse class="st68" cx="26.41" cy="55.838" id="XMLID_2461_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2458_"> <ellipse class="st68" cx="46.146" cy="56.817" id="XMLID_2459_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2456_"> <ellipse class="st68" cx="70.139" cy="39.515" id="XMLID_2457_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2454_"> <ellipse class="st68" cx="64.594" cy="53.926" id="XMLID_2455_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2452_"> <ellipse class="st68" cx="37.788" cy="75.368" id="XMLID_2453_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2450_"> <ellipse class="st68" cx="56.553" cy="72.955" id="XMLID_2451_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2448_"> <ellipse class="st68" cx="75.045" cy="69.392" id="XMLID_2449_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2446_"> <ellipse class="st68" cx="96.857" cy="53.829" id="XMLID_2447_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2444_"> <ellipse class="st68" cx="91.063" cy="36.528" id="XMLID_2445_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2442_"> <ellipse class="st68" cx="79.789" cy="52.851" id="XMLID_2443_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2440_"> <ellipse class="st68" cx="46.146" cy="84.961" id="XMLID_2441_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2438_"> <ellipse class="st68" cx="64.425" cy="86.632" id="XMLID_2439_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2436_"> <ellipse class="st68" cx="79.789" cy="84.961" id="XMLID_2437_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2434_"> <ellipse class="st68" cx="91.063" cy="69.967" id="XMLID_2435_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2432_"> <ellipse class="st68" cx="57.189" cy="102.25" id="XMLID_2433_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2430_"> <ellipse class="st68" cx="73.808" cy="103.841" id="XMLID_2431_" rx="2.182" ry="2.987"></ellipse> </g> <g id="XMLID_2428_"> <ellipse class="st68" cx="63.753" cy="120.1" id="XMLID_2429_" rx="2.182" ry="2.987"></ellipse> </g> </g> </g> </g> </g> <g id="_x31_9_Papaya"></g> <g id="_x31_8_Pineapple"></g> <g id="_x31_7_Banana"></g> <g id="_x31_6_Tender_Coconut"></g> <g id="_x31_5_Strawberry"></g> <g id="_x31_4_Dragon_Fruit"></g> <g id="_x31_3_Plum"></g> <g id="_x31_2_Fig"></g> <g id="_x31_1_Peach"></g> <g id="_x31_0_Cherry"></g> <g id="_x30_9_Sapota"></g> <g id="_x30_8_Custard_Apple"></g> <g id="_x30_7_Watermelon"></g> <g id="_x30_6_Mango"></g> <g id="_x30_5_Pear"></g> <g id="_x30_4_Guava"></g> <g id="_x30_3_Pomegranate"></g> <g id="_x30_2_Orange"></g> <g id="_x30_1_Apple"></g> </g></svg>
                            </div>

                        </div>
                    </div>

                <?php else: ?>
                    <div class="page-add-recipe_content recipe-add">
                        <h2 class="recipe-add_title">
                            Создайте свой рецепт
                        </h2>
                        <?php
                        // Подготовка аргументов для acf_form
                        $acf_form_args = array(
                            'field_groups' => array('group_657acfb249ef7'),
                            'post_id'       => 'new_post', // Это создаст новый пост
                            'post_title'    => true,
                            'post_content'  => true,
                            'new_post'      => array(
                                'post_type'   => 'recipe',
                                'post_status' => 'pending'
                            ),
//                            'uploader' => 'basic',
                            'submit_value'  => 'Опубликовать',
//                            'html_submit_spinner' => '<span class="acf-spinner"></span>',
                        );

                        // Вывод формы ACF на фронтенде
                        acf_form($acf_form_args);

                        ?>
                    </div>

                <?php endif; ?>
            </div>
        </section>

        <?php get_template_part('template-parts/floating-button') ?>

    </article>

</main>

<?php
get_footer()
?>
