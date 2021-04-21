// $(function(){
//   $('#logout').on('click', function (event) {
//     event.preventDefault();
//     $.get('/ajax/logout.php',
//             {},
//             function (data) {
//               switch (data) {
//                 case 'ok':
//                   let redirect = '/login';
//                   if (window.location.pathname.search('manager') != -1) {
//                     redirect = '/manager/login';
//                   }
//                   window.location.href = redirect;
//                   break;
//                 case 'error':
//                   alert('Ha habido un error al cerrar la sesion.');
//                   break;
//                 default:
//               }
//             }
//     );
//   });
// });
