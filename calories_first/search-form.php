
<form class="search-block_form" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <div class="search-block_input-block">
        <input type="text" name="s" id="general-search__search-input" class="search-block_input"
               placeholder="Поиск..." required="required" value=""
               autocomplete="off">
        <button class="search-block_btn" type="submit">
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        <button class="search-block_close">
            <svg width="34px" height="34px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.528"></g><g id="SVGRepo_iconCarrier"> <path d="M19 5L4.99998 19M5.00001 5L19 19" stroke="#000000" stroke-width="1.3679999999999999" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
        </button>
    </div>
    <input type="hidden" name="post_type" value="recipe,post">
</form>
