
jQuery(document).ready(function(){

});


function verCursosActivos(iduser, idscursosusuario, canalid){
    event.preventDefault();
    card = '';
    if( idscursosusuario != '' ){
        idscursos = idscursosusuario.split('#++#');
    }
    //console.log(idscursos);
    $.ajax({
        type: "POST",
        url: '/ajax/get-cursosactivos.php',
        dataType: 'json',
        data: { canalid: canalid},
        success: function (data) {
        //console.log(data.status);
            if(data.status == 'ok'){
                for (var i=0; i<data.result.length; i++) {
                   var id_curso = data.result[i].id_curso;
                   //alert("id_curso: "+id_curso);
                   var id_moodle = data.result[i].id_moodle;
                   var precio = data.result[i].precio;
                   var nombrecurso = data.result[i].nombre;

                   var img = data.result[i].imagen;
                   var imagen = img.split('.');
                   var name_img = imagen[0];
                   var ext_img = imagen[1];
                   var img_curso = '/public/img/'+name_img+'.'+ext_img;

                   if( data.result[i].creditos == '' || data.result[i].creditos == 0 || data.result[i].creditos === null){
                        var num_creditos = '&nbsp;';
                   }else{
                        var num_creditos = data.result[i].creditos;
                        var numero_creditos = data.result[i].creditos;
                        
                        //Si numero_creditos no es null
                        if( !!numero_creditos ){ 
                            var num_cred = numero_creditos.split('.');
                            //alert("decimals: "+num_cred[1]);
                            if( num_cred[1] == '00' && num_cred[0] == '1'  ){
                                num_creditos = numero_creditos.slice(0, -3) + ' crédito';
                            }else if( num_cred[1] == '00' ){
                                num_creditos = numero_creditos.slice(0, -3) + ' créditos';
                            }else{
                                num_creditos = num_creditos.replace('.', ',') + ' créditos';
                            }
                        }
                        if( numero_creditos == '0.01'){
                            num_creditos = '0,1 crédito';
                        }
                        if( numero_creditos.slice(-1) == '0' && num_cred[1] != '00' ){
                            num_creditos = numero_creditos.slice(0, -1);
                            num_creditos = num_creditos.replace('.', ',') + ' créditos';
                        }
                        if( num_cred[1] == '10' ){ 
                            num_creditos = numero_creditos.slice(0, -1);
                            num_creditos = num_creditos.replace('.', ',') + ' crédito';
                        }
                        
                   }

                   var titulo_curso = data.result[i].nombre.toUpperCase();
                   titulo_curso = truncateWithEllipses(titulo_curso, 100);

                   var fecha_ini_curso = data.result[i].fecha_inicio;
                   var myDate = new Date(fecha_ini_curso);
                   dd = (myDate.getDate() < 10 ? '0' + myDate.getDate() : myDate.getDate());
                   mm = (myDate.getMonth() < 10 ? '0' + myDate.getMonth() : myDate.getMonth());
                   num_mes = parseInt(mm.padStart(2, 0)) +1;
                   var fecha_curso_ini = dd + '/' + String(num_mes).padStart(2, 0) + '/' + myDate.getFullYear();

                   var fecha_fin_curso = data.result[i].fecha_fin;
                   var myDate = new Date(fecha_fin_curso);
                   dd = (myDate.getDate() < 10 ? '0' + myDate.getDate() : myDate.getDate());
                   mm = (myDate.getMonth() < 10 ? '0' + myDate.getMonth() : myDate.getMonth());
                   num_mes = parseInt(mm.padStart(2, 0)) +1;
                   var fecha_curso_fin = dd + '/' + String(num_mes).padStart(2, 0) + '/' + myDate.getFullYear();

                   var url_id = data.result[i].url_id;
                   
                   //console.log(data.result[i].btn_curso);

                   card += '<div class="col-lg-3 mb-4">'+
                                '<div class="card card-canal card-curso">'+
                                    '<div class="card-img-top">'+
                                        '<a href="/ficha-curso/'+url_id+'" class="text-dark nav__link">'+
                                            '<div class="pl-2 pr-2 pt-2">'+
                                                '<img src="'+img_curso+'" class="img-fluid w-100">'+
                                                '<p class="mt-3 text-info text-left p-1" style="font-size:14px; font-weight: bold;">'+num_creditos+'</p>'+
                                                '<div style="height:110px;">'+
                                                    '<p class="mt-1 text-dark text-left p-1"><span class="font-weight-bold">'+titulo_curso+'</span></p>'+
                                                '</div>'+
                                                '<div class="d-flex flex-row justify-content-left p-2">'+
                                                    '<div class="text-left">'+
                                                        '<i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-dark" style="font-size:13px;"><b>'+fecha_curso_ini+'  -  '+fecha_curso_fin+'</b></span>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<br><div class="text-center">'+data.result[i].btn_curso+'</div>'+
                                            '</div>'+
                                            '<i class="w-100">&nbsp;</i>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                }
                $('#cards').html(card);
            }else{
                $('#cards').html("<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.result+"</p>");
            }
            $( "#btn_cursos_activos" ).removeClass( "blue-outline" ).addClass("blue-background");
            $( "#btn_cursos_activos" ).addClass( "text-white" );
            $( "#btn_cursos_realizados" ).removeClass( "blue-background" ).addClass("blue-outline");
            $( "#btn_cursos_realizados" ).removeClass( "text-white" );
        }

    }).fail( function( data ) {
        //console.log(data);
    });
}



function verTososCursosCanal(iduser, idscursosusuario, canalid){
    event.preventDefault();
    card = '';
    if( idscursosusuario != '' ){
        idscursos = idscursosusuario.split('#++#');
    }
    //console.log(idscursos);
    $.ajax({
        type: "POST",
        url: '/ajax/get-cursostodoscanal.php',
        dataType: 'json',
        data: { canalid: canalid},
        success: function (data) {
        //console.log(data.status);
            //alert( "Status: " + data.status );
            if(data.status == 'ok'){
                for (var i=0; i<data.result.length; i++) {
                   var id_curso = data.result[i].id_curso;
                   //alert("id_curso: "+id_curso);
                   var id_moodle = data.result[i].id_moodle;
                   var precio = data.result[i].precio;
                   var nombrecurso = data.result[i].nombre;

                   var img = data.result[i].imagen;
                   var imagen = img.split('.');
                   var name_img = imagen[0];
                   var ext_img = imagen[1];
                   var img_curso = '/public/img/'+name_img+'.'+ext_img;

                   if( data.result[i].creditos == '' || data.result[i].creditos == 0 || data.result[i].creditos === null){
                        var num_creditos = '&nbsp;';
                   }else{
                        var num_creditos = data.result[i].creditos;
                        var numero_creditos = data.result[i].creditos;
                        
                        //Si numero_creditos no es null
                        if( !!numero_creditos ){ 
                            var num_cred = numero_creditos.split('.');
                            //alert("decimals: "+num_cred[1]);
                            if( num_cred[1] == '00' && num_cred[0] == '1'  ){
                                num_creditos = numero_creditos.slice(0, -3) + ' crédito';
                            }else if( num_cred[1] == '00' ){
                                num_creditos = numero_creditos.slice(0, -3) + ' créditos';
                            }else{
                                num_creditos = num_creditos.replace('.', ',') + ' créditos';
                            }
                        }
                        if( numero_creditos == '0.01'){
                            num_creditos = '0,1 crédito';
                        }
                        if( numero_creditos.slice(-1) == '0' && num_cred[1] != '00' ){
                            num_creditos = numero_creditos.slice(0, -1);
                            num_creditos = num_creditos.replace('.', ',') + ' créditos';
                        }
                        if( num_cred[1] == '10' ){ 
                            num_creditos = numero_creditos.slice(0, -1);
                            num_creditos = num_creditos.replace('.', ',') + ' crédito';
                        }
                   }

                   var titulo_curso = data.result[i].nombre.toUpperCase();
                   titulo_curso = truncateWithEllipses(titulo_curso, 100);

                   var fecha_ini_curso = data.result[i].fecha_inicio;
                   var myDate = new Date(fecha_ini_curso);
                   dd = (myDate.getDate() < 10 ? '0' + myDate.getDate() : myDate.getDate());
                   mm = (myDate.getMonth() < 10 ? '0' + myDate.getMonth() : myDate.getMonth());
                   num_mes = parseInt(mm.padStart(2, 0)) +1;
                   var fecha_curso_ini = dd + '/' + String(num_mes).padStart(2, 0) + '/' + myDate.getFullYear();

                   var fecha_fin_curso = data.result[i].fecha_fin;
                   var myDate = new Date(fecha_fin_curso);
                   dd = (myDate.getDate() < 10 ? '0' + myDate.getDate() : myDate.getDate());
                   mm = (myDate.getMonth() < 10 ? '0' + myDate.getMonth() : myDate.getMonth());
                   num_mes = parseInt(mm.padStart(2, 0)) +1;
                   var fecha_curso_fin = dd + '/' + String(num_mes).padStart(2, 0) + '/' + myDate.getFullYear();

                   var url_id = data.result[i].url_id;

                   card += '<div class="col-lg-3 mb-4">'+
                                '<div class="card card-canal card-curso">'+
                                    '<div class="card-img-top">'+
                                        '<a href="/ficha-curso/'+url_id+'" class="text-dark nav__link">'+
                                            '<div class="pl-2 pr-2 pt-2">'+
                                                '<img src="'+img_curso+'" class="img-fluid w-100">'+
                                                '<p class="mt-3 text-info text-left p-1" style="font-size:14px; font-weight: bold;">'+num_creditos+'</p>'+
                                                '<div style="height:110px;">'+
                                                    '<p class="mt-3 text-dark text-left p-1"><span class="font-weight-bold">'+titulo_curso+'</span></p>'+
                                                '</div>'+
                                                '<div class="d-flex flex-row justify-content-left p-2">'+
                                                    '<div class="text-left">'+
                                                        '<i class="fa fa-calendar text-info" aria-hidden="true"></i>&nbsp;&nbsp;<span class="text-dark" style="font-size:13px;"><b>'+fecha_curso_ini+'  -  '+fecha_curso_fin+'</b></span>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<br><div class="text-center">'+data.result[i].btn_curso+'</div>'+
                                            '</div>'+
                                            '<i class="w-100">&nbsp;</i>'+
                                        '</a>'+
                                    '</div>'+
                                '</div>'+
                            '</div>';
                }
                $('#cards').html(card);
            }else{
                $('#cards').html("<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+data.result+"</p>");
            }
            $( "#btn_cursos_realizados" ).removeClass( "blue-outline" ).addClass("blue-background");
            $( "#btn_cursos_realizados" ).addClass( "text-white" );
            $( "#btn_cursos_activos" ).removeClass( "blue-background" ).addClass("blue-outline");
            $( "#btn_cursos_activos" ).removeClass( "text-white" );
        }

    }).fail( function( data ) {
        //console.log(data);
    });
}
