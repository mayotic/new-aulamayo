<?php
global $conf;

// Especific styles
echo Tools::loadLibrary('css', 'menu');

// User info
$user = new User($_SESSION['userlogedin']);

// Hooks
Tools::includeHook('', 'menu');

$logout_button = (AutoIncludes::getCurrentPage() !== $conf['appinfo']['url_login']) ? '<button id="logout" class="btn btn-sm btn-primary btn-block" type="submit">Salir</button>' : '';

// Make a menu bar
$row_template = '<li class="nav-item {{pagename}}">
                    <a class="nav-link" href="{{link}}">
                      <i class="{{icon}}"></i>&nbsp;
                      <span>{{linkname}}</span>
                    </a>
                  </li>';
$submenu_wrapper = '<li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="{{icon}}"></i>&nbsp;
                        <span>{{parentname}}</span>
                      </a>
                      <div class="dropdown-menu triangle-top-left" aria-labelledby="pagesDropdown">
                        {{content}}
                      </div>
                    </li>';
$submenu_row_template = '<a class="dropdown-item {{pagename}}" href="{{link}}">
                          <i class="{{icon}}"></i>&nbsp;
                          <span>{{linkname}}</span>
                         </a>';
$wrapper = '<ul class="sidebar navbar-nav col-md-2 col-sm-9">
              {{content}}
            </ul>';

echo Tools::buildMenu('main',
                      true,
                      $row_template,
                      $submenu_wrapper,
                      $submenu_row_template,
                      $wrapper,
                      $_SERVER['DOCUMENT_ROOT'], 'manager');
?>

<script type="text/javascript">
$(function () {
  let subactive = $('#mysidebar ul.sidebar > li.active > a + .dropdown-menu > a.active > span').html();
  if (typeof subactive !== 'undefined') {
    $('#mysidebar ul.sidebar > li.active > a > span').append('&nbsp;&nbsp;<i class="fas fa-angle-right"></i>&nbsp;&nbsp;' + subactive);
  }
});
</script>
