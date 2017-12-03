<?php
  function include_template($template_path, $template_args = NULL){
    if( !file_exists($template_path) ){
      return '';
    } else {
      ob_start();
      require($template_path);
      return ob_get_clean();
    }
  }
  
  function time_converter($bet_time){
    $now_time = time();
    $differene_time = $now_time - $bet_time;
    if($differene_time >= 86400){
      return date('d.m.y в H:i', $now_time - $differene_time);
    } else {
      if($differene_time >= 3600){
        return ($differene_time / 3600) . ' часов назад';
      } else {
        return ($differene_time / 60) . ' минут назад';
      }
    }
  }
