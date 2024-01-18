
<form class="search-big" role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
    <div class="search-big_block">
        <input type="text" name="s" id="general-search__search-input" class="search-big_input"
               placeholder="Поиск..." required="required" value=""
               autocomplete="off">
        <button class="search-big_btn" type="submit">
            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.9536 14.9458L21 21M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
    <input type="hidden" name="post_type" value="recipe">
</form>
