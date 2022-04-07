<?php $category = $args['category']; ?>
<div class="category card">
  <a href="/category/<?= $category->slug ?>" class="card-body">
    <h5 class="card-title"><?= $category->name ?></h5>
    <svg width="25" height="15" viewBox="0 0 25 15" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M14.1589 0.704285L12.7356 1.68211L20.2802 7.02191H0.224304V8.42583H20.2802L12.7356 13.7418L14.1589 14.7435L24.1122 7.72387L14.1589 0.704285Z" fill="#FCFCFC"/>
    </svg>
  </a>
</div>
