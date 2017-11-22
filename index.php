<?php
  require_once('functions.php');
  require_once('data.php');

  $page_content = include_template('./templates/index.php', ['categories' => $categories, 'products' => $products, 'lot_time_remaining' => $lot_time_remaining]);

  $layout = include_template('./templates/layout.php', ['content' => $page_content, 'page_title' => 'Главная', 'is_auth' => $is_auth, 'user_name' => $user_name, 'user_avatar' => $user_avatar]);

  print($layout);
 ?>
