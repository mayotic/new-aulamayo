<?php
global $hooks;

// We define the hook menuFilter for filter the menu options according to the rights of user
$hooks['menuFilter'] = 'menuFilter';

function menuFilter ($menuTree) {
  $user = new User($_SESSION['userlogedin']);
  foreach ($menuTree as $key => $menu) {
    if (isset($menu['link'])) {
      $pagepath = array_filter(explode('/', $menu['link']));
      $res = [];
      foreach ($pagepath as $part) {
        $res[] = $part;
      }
      if (!$user->can(['manage', 'view:' . implode('|', $pagepath)], false)) {
        unset($menuTree[$key]);
      }
    }else{
      $menuTree[$key] = menuFilter($menu);
    }
  }
  return array_filter($menuTree);
}
?>
