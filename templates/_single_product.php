<?php
  $item = $template_args['item'];
  $properties = $template_args['properties'];
  $lot_time_remaining = $template_args['lot_time_remaining'];

?>
<li class="lots__item lot">
    <div class="lot__image">
        <img src="<?=$properties['url'];?>" width="350" height="260" alt="Сноуборд">
    </div>
    <div class="lot__info">
        <span class="lot__category"><?=$properties['category'];?></span>
        <h3 class="lot__title"><a class="text-link" href="lot.html"><?=$properties['name'];?></a></h3>
        <div class="lot__state">
            <div class="lot__rate">
                <span class="lot__amount">Стартовая цена</span>
                <span class="lot__cost"><?=$properties['price'];?><b class="rub">р</b></span>
            </div>
            <div class="lot__timer timer">
                <?=$lot_time_remaining;?>
            </div>
        </div>
    </div>
</li>
