<form action="<?php esc_url(home_url('/')) ?>" id="searchForm">
    <input type="search" placeholder="Chercher" name="s" value="<?= get_search_query() ?>">

    <button type="submit">Chercher</button>
</form>
