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
