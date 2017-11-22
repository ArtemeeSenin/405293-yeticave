<?php
$categories = $template_args['categories'];
$products = $template_args['products'];
$lot_time_remaining = $template_args['lot_time_remaining'];
?>
<section class="promo">
    <h2 class="promo__title">Нужен стафф для катки?</h2>
    <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
    <ul class="promo__list">
      <?php foreach($categories as $key => $value):?>
        <li class="promo__item promo__item--<?=$key?>">
            <a class="promo__link" href="all-lots.html"><?=$value?></a>
        </li>
      <?php endforeach;?>
    </ul>
</section>
<section class="lots">
    <div class="lots__header">
        <h2>Открытые лоты</h2>
    </div>
    <ul class="lots__list">
      <?php foreach($products as $item => $properties):?>
        <?=include_template('./templates/_single_product.php', ['item' => $item, 'properties' => $properties, 'lot_time_remaining' => $template_args['lot_time_remaining']]);?>
      <?php endforeach;?>
    </ul>
</section>
