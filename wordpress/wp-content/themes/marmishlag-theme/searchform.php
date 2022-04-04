<div class="search-box">
    <form action="<?php esc_url(home_url('/')) ?>" id="searchForm">
        <input class="search-input" id="open-search" value="<?= get_search_query() ?>" type="search" name="s" placeholder="Search">
        <label class="search-button search-label"   for="open-search"><span class="search-logo">&#9906;</span><span class="search-label-text">Recherche</span></label>
    </form>
</div>

