
jQuery(document).ready(function(){

    jQuery(".go-login").click(function() {
        event.preventDefault();
        $('.carousel').carousel('pause');
        window.location.href = '/login';
    });
    
});

function goLogin(){
    event.preventDefault();
    $('.carousel').carousel('pause');
    window.location.href = '/login';
}

function fx(str, canalid){

    var search_text = document.getElementById("string_to_search").value;
    var xmlhttp;
    if (str.length == 0) {
        document.getElementById("livesearch").innerHTML = "";
        $('#textbox-clr').text("");
        return;
    }
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById("livesearch").innerHTML = xmlhttp.responseText;
            $('#textbox-clr').text("X");
        }
    }
    xmlhttp.open("GET", "/ajax/search-cursos-buscador.php?searchtext=" + search_text + "&canalid=" + canalid, true);
    xmlhttp.send();
}


function showIdMoodle(id_moodle){
    //swal("Id moodle", id_moodle);
    var titulo = "Id Moodle: " + id_moodle;
    
    Swal.fire({
        title: titulo,   
        text: "Accediendo al curso...", 
        showConfirmButton: false,
        timer: 3000
    })
    //window.location.href = 'link moodle';
}

function getTexosLegales(idcurso, idusuario, nombrecurso) {
    event.preventDefault();
    var res='';
    $.ajax({
        type: "POST",
        url: "/ajax/get-textoslegales.php",
        dataType: "json",
        data: {idcurso: idcurso},
        success: function (data) {
            if (data.status === 'ok') {
                //console.log( data.texts_legals );
                res = data.texts_legals;
                return res;
            } else {
                
            }
        }
    }).then((res) => {
        var length_res = res.texts_legals[0].length;
        var checkboxes = '<form id="form_text_legal" class="mb-3">';
        checkboxes += '<p>Debe aceptar las condiciones para inscribirse al curso</p>';
        var check = '', str = '', req = '', asterisco = '', resu = '', titol = '', textlegal = '', link_textlegal = '', id_texto_legal = '', id_curso = '';
        if( length_res > 0){
            //console.log( res.texts_legals );
            for (var i=0; i<res.texts_legals.length; i++) { 
                check = res.texts_legals[i];
                str = check.split("#--#");
                titol = str[0];
                textlegal = str[1];
                if( str[2] != ''){ link_textlegal = '&nbsp;&nbsp;<a href="'+str[2]+'" target="_blank" style="text-decoration:underline; color:#17a2b8; font-size:14px;">Ver</a>'; }else{ link_textlegal = ''; }
                if( str[3] === '1'){ req = 'required'; asterisco = ' <span class="font14">*</span>'; }else{ req = ''; asterisco = ''; }
                id_texto_legal = str[4];
                id_curso = str[5];
                checkboxes += '<div id="textslegals_'+[i]+'" class="form-check text-left ml-4 my-2">';
                checkboxes +=     '<input id="text_legal_'+id_curso+'_'+[i]+'" name="text_legal_'+[i]+'" class="form-check-input checkbox check_curso_'+id_curso+'" type="checkbox" data-idtextolegal="'+id_texto_legal+'" '+req+'>';
                checkboxes +=     '<label class="form-check-label" for="text_legal_'+[i]+'">'+titol+asterisco+link_textlegal+'</label>';
                checkboxes +=  '</div>';
            }
            checkboxes += '<br><p class="text-left font14 text-bold">* Campos obligatorios</p>';
            checkboxes += '</form>';
            
            Swal.fire({
                title: "<h3>Deseo inscribirme al curso de: </br>" + nombrecurso + "</h3>",   
                html: checkboxes,
                confirmButtonColor: '#17a2b8',
                confirmButtonText: 'INSCRIBIRME',
                cancelButtonText: "CANCELAR",
                showCancelButton: true,
                focusConfirm: false,
                
                preConfirm: () => {
                    // ----------- Check required all checkboxes  --------------
                    var InputElements = document.querySelectorAll(".form-check-input");
                    var i;
                    cont = 0;
                    for (i = 0; i < InputElements.length; i++) {
                       if(  InputElements[i].required && !InputElements[i].checked ){
                           InputElements[i].classList.add('is-invalid');
                           cont++;
                       }
                    }
                    
                    if( cont > 0 ){
                        Swal.showValidationMessage('Debe aceptar los términos y condiciones de uso'); 
                        return false;
                    }else{
                        resu = 'ok';
                        return [resu];
                    }
                }
                
            }).then((resu) => {
                if ( resu.value == 'ok' ){
                    var href = "/mis-cursos";
                    array_ids_textos_legales = [];
                    var InputElements = document.querySelectorAll(".check_curso_"+idcurso);
                    var i;
                    var id_texto_legal = '';
                    
                    for (i = 0; i < InputElements.length; i++) {
                        if( InputElements[i].checked ){
                            id_texto_legal = InputElements[i].dataset.idtextolegal;
                            array_ids_textos_legales.push(id_texto_legal);
                        }
                    }
                    
                    $.ajax({
                        type:"POST",
                        url: "/ajax/matricula-save.php",
                        dataType: "json",
                        data:{ id_curso: idcurso, id_usuario: idusuario, referencia: '123456', array_ids_textos_legales: JSON.stringify(array_ids_textos_legales) },
                        success:function(data){
                            if (data.status === 'ok') {
                                Swal.fire(
                                  'Inscrito!',
                                  'Se ha inscrito correctamente al curso.',
                                  'success',
                                );
                                $('.swal2-confirm').hide(); 
                            }
                            setTimeout(function(){
                                window.location.href = href;
                            }, 2000)
                        }
                    }); 
                    
                }
            })
        }
    });
}





// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    document.getElementById("myBtn").style.display = "block";
  } else {
    document.getElementById("myBtn").style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}


function truncateWithEllipses(text, max) 
{
    return text.substr(0,max-1)+(text.length>max?'&hellip;':''); 
}


/* COOKIES */ 
function getCookie(c_name){
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1){
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1){
		c_value = null;
	}else{
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1){
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start,c_end));
	}
	return c_value;
}

function setCookie(c_name,value,exdays){
	var exdate=new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}

if(getCookie('tiendaaviso')!="1"){
	document.getElementById("barraaceptacion").style.display="block";
}
function PonerCookie(){
	setCookie('tiendaaviso','1',365);
	document.getElementById("barraaceptacion").style.display="none";
}