<?php

  function validateField($value, $rule) {
    return preg_match($rule, $value);
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $required = ['lot-name', 'category', 'message', 'lot-date', 'lot-step', 'lot-rate'];
    $rules = [
      'lot-rate' => '/^\d$/',
      'lot-step' => '/^\d$/'
    ];
    $errors = [];
    $success = NULL;
    $file_img = '';

    foreach($_POST as $key => $value){
      if(in_array($key, $required) && $value == ''){
        array_push($errors, $key);
      }

      if(in_array($key, $rules)){
        foreach($rules as $field => $rule){
          if($field == $key && !validateField($value, $rule)){
            array_push($errors, $key);
            break;
          }
        }
      }
    }

    if(!count($errors)){
      $success = true;
    }
    if (isset($_FILES['photo2'])) {
      $file_name = $_FILES['photo2']['name'];
      $file_path = $_SERVER['DOCUMENT_ROOT'] . '\img\\';

      $file_url = '\img\\' . $file_name;
      $file_img = $file_url;
      move_uploaded_file($_FILES['photo2']['tmp_name'], $file_path . $file_name);
      print("<a href='$file_url'>$file_name</a>");

    }
  }



  /*echo '<pre>';
  print_r($errors);
  echo '</pre>';

  echo '<pre>';
  print_r($_POST);
  print_r($_FILES);
  echo '</pre>';*/

?>


<?=include_template('./templates/_top-nav.php');?>

<?php
  if(!$success):
?>


<form class="form form--add-lot container <?php if(count($errors)){echo 'form--invalid';}?>" action="add.php" method="post" enctype="multipart/form-data" novalidate>
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <div class="form__item <?php if(in_array('lot-name', $errors)){echo 'form__item--invalid';}?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" <?php if(count($errors) && !in_array('lot-name', $errors)){echo 'value="'.$_POST['lot-name'].'"';}?> required>
      <span class="form__error">Введите наименование лота</span>
    </div>
    <div class="form__item <?php if(in_array('category', $errors)){echo 'form__item--invalid';}?>">
      <label for="category">Категория</label>
      <select id="category" name="category" required>
        <option value="">Выберите категорию</option>
        <option>Доски и лыжи</option>
        <option>Крепления</option>
        <option>Ботинки</option>
        <option>Одежда</option>
        <option>Инструменты</option>
        <option>Разное</option>
      </select>
      <span class="form__error">Выберите категорию</span>
    </div>
  </div>
  <div class="form__item form__item--wide <?php if(in_array('message', $errors)){echo 'form__item--invalid';}?>">
    <label for="message">Описание</label>
    <textarea id="message" name="message" placeholder="Напишите описание лота" required><?php if(count($errors) && !in_array('message', $errors)){echo $_POST['message'];}?></textarea>
    <span class="form__error">Напишите описание лота</span>
  </div>
  <div class="form__item form__item--file "> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" name="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <div class="form__container-three">
    <div class="form__item form__item--small <?php if(in_array('lot-rate', $errors)){echo 'form__item--invalid';}?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot-rate" placeholder="0" <?php if(count($errors) && !in_array('lot-rate', $errors)){echo 'value="'.$_POST['lot-rate'].'"';}?> required>
      <span class="form__error">Введите начальную цену</span>
    </div>
    <div class="form__item form__item--small <?php if(in_array('lot-step', $errors)){echo 'form__item--invalid';}?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot-step" placeholder="0" <?php if(count($errors) && !in_array('lot-step', $errors)){echo 'value="'.$_POST['lot-step'].'"';}?> required>
      <span class="form__error">Введите шаг ставки</span>
    </div>
    <div class="form__item <?php if(in_array('lot-date', $errors)){echo 'form__item--invalid';}?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot-date" <?php if(count($errors) && !in_array('lot-date', $errors)){echo 'value="'.$_POST['lot-date'].'"';}?> required>
      <span class="form__error">Введите дату завершения торгов</span>
    </div>
  </div>
  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>

<?php
else:
   ?>
   <section class="lot-item container">
     <h2><?=$_POST['lot-name']?></h2>
     <div class="lot-item__content">
       <div class="lot-item__left">
         <div class="lot-item__image">
           <img src="<?=$file_img;?>" width="730" height="548" alt="Сноуборд">
         </div>
         <p class="lot-item__category">Категория: <span><?=$_POST['category']?></span></p>
         <p class="lot-item__description"><?=$_POST['message']?></p>
       </div>
       <div class="lot-item__right">
         <div class="lot-item__state">
           <div class="lot-item__timer timer">
             <?php $time = strtotime('tomorrow') - strtotime($_POST['lot-date']) - 1;?>
             <?=gmdate("H:i:s", $time)?>
           </div>
           <div class="lot-item__cost-state">
             <div class="lot-item__rate">
               <span class="lot-item__amount">Текущая цена</span>
               <span class="lot-item__cost"><?=$_POST['lot-rate']?></span>
             </div>
             <div class="lot-item__min-cost">
               Мин. ставка <span><?=$_POST['lot-rate']+$_POST['lot-step']?> р</span>
             </div>
           </div>
           <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post">
             <p class="lot-item__form-item">
               <label for="cost">Ваша ставка</label>
               <input id="cost" type="number" name="cost" placeholder="12 000">
             </p>
             <button type="submit" class="button">Сделать ставку</button>
           </form>
         </div>
         <div class="history">
           <h3>История ставок (<span>10</span>)</h3>
           <table class="history__list">
             <tr class="history__item">
               <td class="history__name">Илья</td>
               <td class="history__price">10 999 р</td>
               <td class="history__time">19.03.17 в 10:20</td>
             </tr>
           </table>
         </div>
       </div>
     </div>
   </section>

 <?php endif;?>
