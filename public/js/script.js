// LOADER
window.onload = function(){
    document.getElementById('conteudo').style.display = "block";
    setTimeout(function() {
    document.getElementById('carregando').style.display = "none";
    }, 2000);
}

jQuery(function($){
	$("#date").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
	$("#date0").mask("99/9999",{placeholder:"mm/aaaa"});
	$("#datex").mask("99/9999",{placeholder:"mm/aaaa"});
	$("#date01").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
	$("#date02").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
	$("#date1").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
	$("#date2").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
    $("#date3").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
    $("#date4").mask("99/99/9999",{placeholder:"dd/mm/aaaa"});
	$("#phone").mask("(99) 9999-9999");
	$("#phone1").mask("(99) 99999-9999");
	$("#phone2").mask("(99) 99999-9999");
	$("#cpf").mask("999.999.999-99");
	$("#cnpf").mask("99.999.999/9999-99");
	$("#cep").mask("99999-999");
	$("#hor1").mask("99:99");
	$("#hor2").mask("99:99");
    $("#hor3").mask("99:99");
    $("#hor4").mask("99:99");
	$("#real").mask("9,99");
	$("#code").mask("999999");
 });

// MODAL 01
$(document).ready(function(){
    $("#verMais1").click(function(event){
        event.preventDefault();
        $(".modal_lateral").fadeIn();
    });
});

$(document).ready(function(){
    $("#box1").click(function(event){
        event.preventDefault();
        $(".modal_lateral").fadeOut();
    });
});
// MODAL 02
$(document).ready(function(){
    $("#verMais2").click(function(event){
        event.preventDefault();
        $(".modal_latera2").fadeIn();
    });
});

$(document).ready(function(){
    $("#box2").click(function(event){
        event.preventDefault();
        $(".modal_latera2").fadeOut();
    });
});
// CARROSSEL

// img1
$(document).ready(function(){
    $("#img1").click(function(event){
        event.preventDefault();
        $("#imgx1").show();
        $("#imgx2").hide();
        $("#imgx3").hide();
        $("#imgx4").hide();
        $("#imgx5").hide();
        $("#imgx6").hide();
        $("#imgx7").hide();
    });
});

// img2
$(document).ready(function(){
    $("#img2").click(function(event){
        event.preventDefault();
        $("#imgx2").show();
        $("#imgx1").hide();
        $("#imgx3").hide();
        $("#imgx4").hide();
        $("#imgx5").hide();
        $("#imgx6").hide();
        $("#imgx7").hide();
    });
});

// img3
$(document).ready(function(){
    $("#img3").click(function(event){
        event.preventDefault();
        $("#imgx3").show();
        $("#imgx1").hide();
        $("#imgx2").hide();
        $("#imgx4").hide();
        $("#imgx5").hide();
        $("#imgx6").hide();
        $("#imgx7").hide();
    });
});

// img4
$(document).ready(function(){
    $("#img4").click(function(event){
        event.preventDefault();
        $("#imgx4").show();
        $("#imgx1").hide();
        $("#imgx2").hide();
        $("#imgx3").hide();
        $("#imgx5").hide();
        $("#imgx6").hide();
        $("#imgx7").hide();
    });
});

// img5
$(document).ready(function(){
    $("#img5").click(function(event){
        event.preventDefault();
        $("#imgx5").show();
        $("#imgx1").hide();
        $("#imgx2").hide();
        $("#imgx3").hide();
        $("#imgx4").hide();
        $("#imgx6").hide();
        $("#imgx7").hide();
    });
});

// img6
$(document).ready(function(){
    $("#img6").click(function(event){
        event.preventDefault();
        $("#imgx6").show();
        $("#imgx1").hide();
        $("#imgx2").hide();
        $("#imgx3").hide();
        $("#imgx4").hide();
        $("#imgx5").hide();
        $("#imgx7").hide();
    });
});

// img7
$(document).ready(function(){
    $("#img7").click(function(event){
        event.preventDefault();
        $("#imgx7").show();
        $("#imgx1").hide();
        $("#imgx2").hide();
        $("#imgx3").hide();
        $("#imgx4").hide();
        $("#imgx5").hide();
        $("#imgx6").hide();
    });
});

$(document).ready(function(){
    $("#s1").click(function(event){
        event.preventDefault();
        $(".f1").fadeIn();
    });
});

$(document).ready(function(){
    $(".f1").click(function(event){
        event.preventDefault();
        $(".f1").fadeOut();
    });
});

$(document).ready(function(){
    $("#s2").click(function(event){
        event.preventDefault();
        $(".f2").fadeIn();
    });
});

$(document).ready(function(){
    $(".f2").click(function(event){
        event.preventDefault();
        $(".f2").fadeOut();
    });
});

$(document).ready(function(){
    $("#s3").click(function(event){
        event.preventDefault();
        $(".f3").fadeIn();
    });
});

$(document).ready(function(){
    $(".f3").click(function(event){
        event.preventDefault();
        $(".f3").fadeOut();
    });
});

$(document).ready(function(){
    $("#s3").click(function(event){
        event.preventDefault();
        $(".f3").fadeIn();
    });
});

$(document).ready(function(){
    $(".f3").click(function(event){
        event.preventDefault();
        $(".f3").fadeOut();
    });
});

$(document).ready(function(){
    $("#s4").click(function(event){
        event.preventDefault();
        $(".f4").fadeIn();
    });
});

$(document).ready(function(){
    $(".f4").click(function(event){
        event.preventDefault();
        $(".f4").fadeOut();
    });
});

$(document).ready(function(){
    $("#fechar").click(function(event){
        event.preventDefault();
        $(".modal_compra").fadeOut();
    });
});


$(document).ready(function(){
    $("#new_img").click(function(event){
        event.preventDefault();
        $(".modal_img").show();
    });
});

$(document).ready(function(){
    $("#fechar").click(function(event){
        event.preventDefault();
        $(".modal_img").hide();
    });
});

// DETALHES FOTOS
$(document).ready(function(){
    $("#ix_1").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeIn();
    });
});

$(document).ready(function(){
    $("#fx_1").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeOut();
    });
});

$(document).ready(function(){
    $("#ix_2").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeIn();
    });
});

$(document).ready(function(){
    $("#fx_2").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeOut();
    });
});

$(document).ready(function(){
    $("#ix_3").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeIn();
    });
});

$(document).ready(function(){
    $("#fx_3").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeOut();
    });
});

$(document).ready(function(){
    $("#ix_4").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeIn();
    });
});

$(document).ready(function(){
    $("#fx_4").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeOut();
    });
});

$(document).ready(function(){
    $("#ix_5").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeIn();
    });
});

$(document).ready(function(){
    $("#fx_5").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeOut();
    });
});

$(document).ready(function(){
    $("#ix_5").click(function(event){
        event.preventDefault();
        $(".modal_ft").fadeIn();
    });
});

// PUBLICAR
$(document).ready(function(){
    $("#publicar").click(function(event){
        event.preventDefault();
        $(".modal_postar").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_publicar").click(function(event){
        event.preventDefault();
        $(".modal_postar").fadeOut();
    });
});

// PERFIL
$(document).ready(function(){
    $("#pub").click(function(event){
        event.preventDefault();
        $("#publics").show();
        $("#vantags").hide();
    });
});

$(document).ready(function(){
    $("#van").click(function(event){
        event.preventDefault();
        $("#vantags").show();
        $("#publics").hide();
    });
});


// INFORMAÇÕES
$(document).ready(function(){
    $("#inform").click(function(event){
        event.preventDefault();
        $(".modal_inform").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_inform").click(function(event){
        event.preventDefault();
        $(".modal_inform").fadeOut();
    });
});

// ADIOCIONAR IMAGEM DE PERFIL
$(document).ready(function(){
    $("#add_img").click(function(event){
        event.preventDefault();
        $(".modal_add_foto").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_add_img").click(function(event){
        event.preventDefault();
        $(".modal_add_foto").fadeOut();
    });
});

// EDITAR PERFIL
$(document).ready(function(){
    $("#bt_edtr").click(function(event){
        event.preventDefault();
        $(".modal_editar").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_md_edt").click(function(event){
        event.preventDefault();
        $(".modal_editar").fadeOut();
    });
});


// MODAL SEGUIDOS
$(document).ready(function(){
    $("#seguindo").click(function(event){
        event.preventDefault();
        $(".modal_seguidos").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_md_seg").click(function(event){
        event.preventDefault();
        $(".modal_seguidos").fadeOut();
    });
});



// MODAL SEGUIDOS
$(document).ready(function(){
    $("#seguidoras").click(function(event){
        event.preventDefault();
        $(".modal_seguidoras").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_md_segrn").click(function(event){
        event.preventDefault();
        $(".modal_seguidoras").fadeOut();
    });
});


// MODAL SEGUIDOS
$(document).ready(function(){
    $("#fechar_modal_inform").click(function(event){
        event.preventDefault();
        $(".modal_inform_agenda").fadeOut();
    });
});



// MODAL SEGUIDOS
$(document).ready(function(){
    $("#add_sala").click(function(event){
        event.preventDefault();
        $(".add_new_sala").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_mod_add_sala").click(function(event){
        event.preventDefault();
        $(".add_new_sala").fadeOut();
    });
});

// MODAL AGENDAMENTO MANUAL
$(document).ready(function(){
    $("#bt_agenda_manual").click(function(event){
        event.preventDefault();
        $(".modal_agenda_manual").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_md").click(function(event){
        event.preventDefault();
        $(".modal_agenda_manual").fadeOut();
    });
});

// MODAL NOVO EVENTO
$(document).ready(function(){
    $("#bt_add_evv").click(function(event){
        event.preventDefault();
        $(".modal_novo_evento").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_evv").click(function(event){
        event.preventDefault();
        $(".modal_novo_evento").fadeOut();
    });
});

$(document).ready(function(){
    $("#button_ordem").click(function(event){
        event.preventDefault();
        $("#ord_gerl").toggle();
        $("#ord_nasc").toggle();
    });
});


// MODAL ADD ENTRADA
$(document).ready(function(){
    $("#add_entrada").click(function(event){
        event.preventDefault();
        $(".modal_incluir_entrada").fadeIn();
    });
});

$(document).ready(function(){
    $("#but_entrada_fechar").click(function(event){
        event.preventDefault();
        $(".modal_incluir_entrada").fadeOut();
    });
});


// MODAL ADD CONTATO
$(document).ready(function(){
    $("#incluir_contato").click(function(event){
        event.preventDefault();
        $(".modal_contato").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_modal_contato").click(function(event){
        event.preventDefault();
        $(".modal_contato").fadeOut();
    });
});


// MODAL ADD SAÍDA
$(document).ready(function(){
    $("#add_saida").click(function(event){
        event.preventDefault();
        $(".modal_incluir_saida").fadeIn();
    });
});

$(document).ready(function(){
    $("#but_saida_fechar").click(function(event){
        event.preventDefault();
        $(".modal_incluir_saida").fadeOut();
    });
});


$(document).ready(function(){
    $("#bt_fechar_modal_tel").click(function(event){
        event.preventDefault();
        $(".banner_telefone").fadeOut();
    });
});


// MODAL ADD SAÍDA
$(document).ready(function(){
    $("#button_form").click(function(event){
        event.preventDefault();
        $("#toggle_form").toggle("500");
    });
});


// RECORRENTES
$(document).ready(function(){
    $("#rec_agenda").click(function(event){
        event.preventDefault();
        $("#recorrente").fadeIn();
        $("#novo").hide();
    });
});

$(document).ready(function(){
    $("#new_agenda").click(function(event){
        event.preventDefault();
        $("#novo").fadeIn();
        $("#recorrente").hide();
    });
});



$(document).ready(function(){
    $("#new_expresso").click(function(event){
        event.preventDefault();
        $(".modal_agenda_manual_expresso").fadeIn();
    });
});

$(document).ready(function(){
    $("#fechar_new_expresso").click(function(event){
        event.preventDefault();
        $(".modal_agenda_manual_expresso").fadeOut();
    });
});


// FEED
$(document).ready(function(){
    $("#btn-bloco-feed").click(function(event){
        event.preventDefault();
        $("#feed-bloco").fadeIn();
        $("#feed-lista").hide();
    });
});

$(document).ready(function(){
    $("#btn-bloco-list").click(function(event){
        event.preventDefault();
        $("#feed-lista").fadeIn();
        $("#feed-bloco").hide();
    });
});


// MENSAGENS
$(document).ready(function(){
    $("#btn-recebidas").click(function(event){
        event.preventDefault();
        $("#box-recebidas").fadeIn();
        $("#box-enviadas").hide();
    });
});

$(document).ready(function(){
    $("#btn-enviadas").click(function(event){
        event.preventDefault();
        $("#box-enviadas").fadeIn();
        $("#box-recebidas").hide();
    });
});
