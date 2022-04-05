<div class="search-box">
    <form action="<?php esc_url(home_url('/')) ?>" id="searchForm">
        <input class="search-input" id="open-search" value="<?= get_search_query() ?>" type="search" name="s" placeholder="Rechercher">
        <label class="search-button search-label"   for="open-search"><span class="search-logo">&#9906;</span></label>
    </form>
</div>

