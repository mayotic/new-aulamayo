
<!DOCTYPE html>
<html lang="es">
  <head>
    <title></title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-2.2.4.js" crossorigin="anonymous"></script><script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script type="text/javascript" src="/public/libraries/dropzone/dropzone.min.js"></script><link rel="stylesheet" href="/public/libraries/dropzone/dropzone.min.css"><link rel="stylesheet" href="/public/libraries//css/main.css"><script type="text/javascript" src="/public/libraries//js/main.js"></script><link rel="stylesheet" href="/public/libraries//css/magic-checkbox.min.css"><link rel="stylesheet" href="/public/autoincludes/css//login.css"><link rel="stylesheet" href="/public/autoincludes/css/header.css"><script type="text/javascript" src="/public/autoincludes/js//login.js"></script><script type="text/javascript" src="/public/autoincludes/js/header.js"></script><script type="text/javascript" src="/public/libraries//js/subject-observer.js"></script><script type="text/javascript" src="/public/libraries//js/jquery.dateformat.min.js"></script><script type="text/javascript">window.userlogedin = 0</script>        <link rel="stylesheet" href="/public/libraries/css/bootstrap-checkboxes.min.css">

<style type="text/css">

.xcrud-top-actions .xcrud-action.btn-success {
    background-color: #89BD2A;
    border-color: #89BD2A;
}
body {
 /* font: 24px Helvetica; */
 background: #f1f1f1;
}

footer {
   /* border-radius: 7pt; */
   background: #fff;
 }

#main {
   min-height: 800px;
   margin: 0px;
   padding: 0px;
   display: -webkit-flex;
   display:         flex;
   -webkit-flex-flow: row;
           flex-flow: row;
 }

#main > article {
   /* margin: 4px; */
   padding: 5px;
   border: 1px solid #eee;
   /* border-radius: 7pt; */
   background: #fff;
   /* -webkit-flex: 3 1 60%;
           flex: 3 1 60%;
   -webkit-order: 2;
           order: 2; */
 }

#main > nav {
   /* margin: 4px; */
   padding: 5px;
   border: 1px solid #fff;
   /* border-radius: 7pt; */
   background: #fff;
   /* -webkit-flex: 1 6 20%;
           flex: 1 6 20%;
   -webkit-order: 1;
           order: 1; */
 }

#main > aside {
   margin: 4px;
   padding: 5px;
   border: 1px solid #f1f1f1;
   /* border-radius: 7pt; */
   background: #fff;
   -webkit-flex: 1 6 20%;
           flex: 1 6 20%;
   -webkit-order: 3;
           order: 3;
 }

/* Too narrow to support three columns */
@media all and (max-width: 640px) {

 #main, #page {
    -webkit-flex-flow: column;
            flex-flow: column;
 }

 #main > article, #main > nav, #main > aside {
    /* Return them to document order */
    -webkit-order: 0;
            order: 0;
 }

 #main > nav, #main > aside, header, footer {
    min-height: 50px;
    max-height: 50px;
 }
}

h2 {
  padding-bottom: 10px;
}

h1 i.far, h2 i.far, h3 i.far,
h4 i.far, h5 i.far, h6 i.far,
h1 i.fa, h2 i.fa, h3 i.fa,
h4 i.fa, h5 i.fa, h6 i.fa {
  color: #89BD2A;
  font-size: 23px;
}
a.btn i.fa {
  color: #fff;
  margin-right: 7px;
}
ul.pagination li.active span {
  background-color: #007bff;
  color: #fff;
}
ul.pagination {
  float: left;
  margin-right: 155px;
}

/* Checkboxes styleds */
.styled-checkbox {
  position: absolute;
  opacity: 0;
}
.styled-checkbox + label {
  position: relative;
  cursor: pointer;
  padding: 0;
}
.styled-checkbox + label:before {
  content: "";
  margin-right: 10px;
  display: inline-block;
  vertical-align: text-top;
  width: 20px;
  height: 20px;
  background: white;
}
.styled-checkbox:hover + label:before {
  background: #f35429;
}
.styled-checkbox:focus + label:before {
  box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.12);
}
.styled-checkbox:checked + label:before {
  background: #f35429;
}
.styled-checkbox:disabled + label {
  color: #b8b8b8;
  cursor: auto;
}
.styled-checkbox:disabled + label:before {
  box-shadow: none;
  background: #ddd;
}
.styled-checkbox:checked + label:after {
  content: "";
  position: absolute;
  left: 5px;
  top: 9px;
  background: white;
  width: 2px;
  height: 2px;
  box-shadow: 2px 0 0 white, 4px 0 0 white, 4px -2px 0 white, 4px -4px 0 white, 4px -6px 0 white, 4px -8px 0 white;
  -webkit-transform: rotate(45deg);
          transform: rotate(45deg);
}

.table-bordered td, .table-bordered th {
  /* border: 0px solid #dee2e6 !important; */
  border: none;
}
.table-bordered {
  border: none;
}
.xcrud-th th {
  background: transparent !important;
}
.xcrud .tab-content {
  border: none !important;
}
.nav-tabs .nav-link:not(.active) {
    background-color: #f3f3f3;
    border-bottom: 1px solid #DDDDDD !important;
}
.btn-light {
  background-color: #f0f0f0 !important;
  border-color: #f0f0f0 !important;
}
.btn-light:hover {
  background-color: #dae0e5 !important;
}
.regresar .btn {
    margin-left: 18px;
}
.xcrud-top-actions.btn-group .btn-primary {
  background-color: #17a2b8;
    border-color: #17a2b8;
}
.xcrud-top-actions.btn-group .btn-primary:hover {
  background-color: #1495a8;
  border-color: #1495a8;
}
select[name=aW5zY3JpdG9zLkFsb2phbWllbnRv] option,
select[name=aW5zY3JpdG9zLlNlcnZpY2lvcw--] option {
      padding: 7px 15px;
      border-radius: 5px;
      margin-bottom: 5px;
}
.form-group .control-label {
    font-weight: bold;
}
select option:checked {
  background-color: #17a2b8 !important;
}
a.nav-link.programa {
  margin: 0 15px;
  color: #fff!important;
  background-color: #96C121;
  border-radius: 5px;
  font-weight: 630;
}
td.control-label.col-sm-3 {
    width: 25%;
}
td.control-label.col-sm-9 {

}
.inscrito-title {
  float: right;
}
.compativility {
    font-size: 11px;
    color: #aaa !important;
    /* text-align: left !important; */
}
@media (min-width: 992px) {
  .navbar-expand-lg .navbar-nav .nav-link {
      padding-right: 1rem;
      padding-left: 1rem;
  }
}
.xcrud-nested-container .xcrud-top-actions a {
    background-color: transparent !important;
    border-color: transparent !important;
    color: #aaa !important;
}
.xcrud-nested-container .xcrud-top-actions a.btn i.fa {
    color: #aaa !important;
}


header {
    /* background-image: url(/public/img/banner_foro_leo_2019.jpg), url(/public/img/banner_foro_leo_2019.jpg); */
    background-position: 100pt center, 79% center;
    background-repeat: no-repeat, no-repeat;
    /* background-image: url(/public/img/banner_foro_leo_2019.jpg); */
    /* background-size: 29%; */
    background-repeat: no-repeat;
    /* background-position: center; */
    height: 193px;
    background-color: #fff;

}
header, footer {
   display: block;
   margin: 0px;
   padding: 5px;
   min-height: 100px;
   border: 1px solid #f3f3f3;
   /* border-radius: 7pt; */
 }

</style>
  </head>
  <body class="login">
    <a href="/delegados">
        <header class="container" style="background-image: url(/public/img/logo-foro-img.png), url(/public/img/logo-foro-text.png)"> </header>
    </a>
<nav class="main container navbar navbar-expand-lg navbar-light bg-light">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    &nbsp;&nbsp;&nbsp;
  </ul>
  <form class="form-inline my-2 my-lg-0">
  </form>
</div>
</nav>
    <div id='main'>
      <article class="container">
        <h1 style="text-align:center">
          <br/>
          Estamos actualizando la página. Volvemos en seguida.
        </h1>
      </article>
    </div>
    <footer class="container">
	<center>
<b>Secretaría técnica</b><br>
Email: palonso@edicionesmayo.es<br><br>
	Horario de atención telefónica:<br>
De lunes a jueves: de 9.00 a 11.00 h y de 15.30 a 17.30 h<br>
Viernes: de 9.00 h a 11.00 h<br>
		<strong>Tel.: 93 209 02 55</strong>
<br>
<br>
<div class="compativility text-center">
Página web optimizada para navegadores Google Chrome, Mozilla Firefox, Safari, Android Browser &amp; WebView (v5.0+) y Microsoft Edge.
Sistemas operativos tipo Macintosh: versión 10 o superior.
</div>
<br>
© 2019 Ediciones Mayo, S.A.

</footer>
  </body>
  <script type="text/javascript">
    window.url_home = '/delegados';
  </script>
</html>
