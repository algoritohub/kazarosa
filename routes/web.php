<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ClubeController;
use App\Http\Controllers\NewAppController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// APP

// Landing page
Route::get('/', [UsuarioController::class, "HomeLanding"])->name('home');

// newslatter
Route::post('/newslatter/adicionar', [PrincipalController::class, "newslatter"])->name('newslatter');

// pagina principal
Route::get('/web', [PrincipalController::class, "principal"])->name('principal');


// BASE TESTE
Route::get('/test', [NetworkController::class, "test"])->name('test');

// REDE (EXIBIR)
Route::get('/feed', [NetworkController::class, "redes"])->name('redes');

// página de postagens de usuários
Route::get('/feed/{id}', [NetworkController::class, "rede"])->name('rede_usuario');

// Exibir login
Route::get('/web/login', [UsuarioController::class, "login"])->name('login');

// Rota logar
Route::post('/web/logar', [UsuarioController::class, "log"])->name('logar');

// Rota logout
Route::get('/web/logout', [UsuarioController::class, "logout"])->name('logout');

// Exibir registro
Route::get('/web/cadastro', [UsuarioController::class, "cadastro"])->name('cadastro');

// Exibir registro
Route::post('/web/registro', [UsuarioController::class, "register"])->name('registrar');

// Exibir verificador
Route::get('/web/verificar', [UsuarioController::class, "verificador"])->name('verificador');

// Exibir verificador
Route::post('/web/verificando', [UsuarioController::class, "verificar"])->name('verificar');

// ROTA DE VERIFICAÇÃO DE CAMINHO
Route::get('/web/rota', [UsuarioController::class, "rota"])->name('rota');

// PERFIL
Route::get('/perfil', [PerfilController::class, "perfil"])->name('perfil');

// PROFILE EXTERNO
// Route::get('/{id}', [PerfilController::class, "profile"])->name('profile');

// SEGUIR
Route::get('/seguir/{id}', [PerfilController::class, "seguir"])->name('seguir');

// DEIXAR DE SEGUIR
Route::get('/parar/{id}', [PerfilController::class, "deixarDeSeguir"])->name('deixarDeSeguir');

// PUBLICAR
Route::post('/web/adicionar/post', [UsuarioController::class, "adicionar_post"])->name('adicionar_post');

// EXCLUIR POSTAGEM
Route::get('/web/deletar/post/{id}', [NetworkController::class, "deletar_post"])->name('deletar_post');

// VER POSTAGEM
Route::get('/web/posts/{id}', [PerfilController::class, "post"])->name('ver_post');

// VER POSTAGEM EXTERNA
Route::get('/{id}/{post}', [PerfilController::class, "post_profile"])->name('post_profile');

// Exibir recuperar senha
Route::get('/web/recuperar/acesso', [UsuarioController::class, "recuperar"])->name('recuperar');

// Exibir recuperar senha
Route::post('/web/recuperar/verificar', [UsuarioController::class, "verificar_rec"])->name('verificar_rec');

// Exibir recuperar senha
Route::post('/web/recuperar/senha', [UsuarioController::class, "recuperar_senha"])->name('recuperar_senha');



// LINK DE PARCEIRAS
Route::get('/web/registro/parceira', [UsuarioController::class, "registro_registro"])->name('registro_registro');



// PLANOS MOBILE
Route::get('/web/iniciar/plano/{id}', [ClubeController::class, "plano_app"])->name('plano_app');



// EXIBIR DETALHE DA SALA
Route::get('/web/espaco/{id}', [SalaController::class, "show"])->name('sala');

// CRIAR UM AGENDAMENTO
Route::post('/web/agendamento/criar', [AgendamentoController::class, "agendar"])->name('agendar_sala');

// Detalhes de agendamento
Route::get('web/agendamentos/confirmar', function () {
    return view('detalhe_agenda');
})->name('agenda_detalhe');

// CONFIRMAR AGENDAMENTO
Route::get('/web/agendamento/confirmar/{id}', [AgendamentoController::class, "confirmar"])->name('confirmar_agenda');

// CANCELAR AGENDAMENTO
Route::get('/web/agendamento/cancelar/{id}', [AgendamentoController::class, "cancelar"])->name('cancelar_agenda');

// LISTA DE AGENDAMENTO
Route::get('web/agendamentos/geral', [AgendamentoController::class, "lista"])->name('agenda_lista');

// COMPROVANTE DE AGENDAMENTO
Route::get('web/agendamentos/comprovante/{id}', [AgendamentoController::class, "comprovante"])->name('comprovante');

// CURTIDAS
Route::get('web/curtidas/{id}', [NetworkController::class, "curtidas"])->name('curtidas_feed');

// EDITAR INFORMAÇÕES DO PERFIL
Route::post('web/editar/{id}', [UsuarioController::class, "editar"])->name('editar_perfil');


// SALVANDO NOS FAVORITOS
Route::get('web/favoritos/espaco/{id}', [PrincipalController::class, "favoritar_espaco"])->name('favoritar_espaco');

// EXIBIR TODOS OS FAVORITOS
Route::get('web/favoritos', [PrincipalController::class, "favoritos"])->name('favoritos');



// visualizar sala para agendamento
Route::get('/web/agendamento/{id}', [SalaController::class, "show"])->name('ver_sala');

// CARTEIRA (EXIBIR)
Route::get('/carteira', [CarteiraController::class, "exibir"])->name('carteira');

// PACOTES (EXIBIR)
Route::get('/pacotes', [TempoController::class, "exibir"])->name('pacotes');

// ADICIONAR INFORMAÇÕES
Route::post('/web/add/informacao/{id}', [UsuarioController::class, "informacao"])->name('informacao');

// AVALIAR ESPAÇO
Route::post('/web/agendamento/avaliar/{id}', [AgendamentoController::class, "avaliar"])->name('avaliar_espaco');

// ALTERAR E-MAIL DE ACESSO
Route::get('/web/configuracao/email/{id}', [UsuarioController::class, "alt_email"])->name('alt_email');

// ALTERAR SENHA DE ACESSO
Route::get('/web/configuracao/senha/{id}', [UsuarioController::class, "alt_senha"])->name('alt_senha');

// EXCLUIR CONTA
Route::get('/web/configuracao/excluir', [UsuarioController::class, "excluir"])->name('excluir_conta');

// MEU PLANO
Route::get('/web/plano/painel', [PrincipalController::class, "meu_plano"])->name('meu_plano');

// LIBERAR REDE
Route::get('/web/liberar/rede/{id}', [PrincipalController::class, "liberar_rede"])->name('liberar_rede');


// DASHBOARD

// Acesso dashboard
Route::get('/admin/dashboard/login', [AdminController::class, "login_xp"])->name('dashboard');

// Acesso dashboard
Route::post('/admin/dashboard/logar', [AdminController::class, "log"])->name('log_adm');

// logout dashboard
Route::get('/admin/dashboard/logout', [AdminController::class, "logout"])->name('logout_adm');

// painel geral
Route::get('/admin/dashboard/geral', [AdminController::class, "geral"])->name('geral');

// pagina salas
Route::get('/admin/dashboard/salas', [SalaController::class, "salas"])->name('salas');

// criar nova sala
Route::post('/admin/dashboard/salas', [SalaController::class, "create"])->name('new_sala');

// detalhe sala
Route::get('/admin/dashboard/salas/{id}', [SalaController::class, "detalhe"])->name('detalhe_sala');

// deletar sala
Route::post('/admin/dashboard/salas/atualizar/{id}', [SalaController::class, "atualizar"])->name('atl_sala');

// deletar sala
Route::get('/admin/dashboard/salas/delete/{id}', [SalaController::class, "delete"])->name('del_sala');

// pagina eventos
Route::get('/admin/dashboard/eventos', [EventoController::class, "eventos"])->name('eventos');

// criar novo evento
Route::post('/dashboard/eventos', [EventoController::class, "create"])->name('new_evento');

// detalhe de eventos
Route::get('/dashboard/eventos/{id}', [EventoController::class, "show"])->name('exb_eventos');

// atualizar evento
Route::post('/dashboard/eventos/atualizar/{id}', [EventoController::class, "atualizar"])->name('atl_evento');

// deletar evento
Route::get('/dashboard/eventos/delete/{id}', [EventoController::class, "delete"])->name('del_evento');

// criar variação de evento
Route::post('/dashboard/eventos/variante', [EventoController::class, "variacao"])->name('new_variacao');

// criar variação de evento
Route::get('/dashboard/eventos/variante/{id}', [EventoController::class, "delete_var"])->name('del_variacao');

// painel agendamento
Route::get('/admin/dashboard/agendamentos', [AgendamentoController::class, "agendamento_adm"])->name('agendamento');

// agendamento manual
Route::post('/web/agendamentos/manual', [AgendamentoController::class, "manual"])->name('agendar_manual');

// EDITAR AGENDAMENTO
Route::get('/admin/dashboard/agendamentos/edit/{id}', [AgendamentoController::class, "agendamento_adm_edt"])->name('agendamento_edit');

// EDITANDO AGENDAMENTO
Route::post('/admin/dashboard/agendamentos/editando/{id}', [AgendamentoController::class, "editando_agendamento"])->name('agenda_editando');

// painel agendamento
Route::get('/admin/dashboard/excluir/usuario/{id}', [AdminController::class, "excluir_user"])->name('excluir_user');

// painel newslatter
Route::get('/admin/dashboard/newsletter', [PrincipalController::class, "pg_newsletter"])->name('pg_newsletter');

// PAINEL FINANCEIRO
Route::get('/admin/dashboard/financeiro', [AdminController::class, "pg_financeiro"])->name('pg_financeiro');

// PAINEL ENTRADA E SAIDA
Route::get('/admin/dashboard/entrada-saida', [AdminController::class, "entradaSaida"])->name('entrada_saida');

// ADICIONAR ENTRADA
Route::post('/admin/dashboard/entrada-saida/add/entrada', [AdminController::class, "addNewEntrada"])->name('new_add_entrada');

// ADICIONAR SAÍDA
Route::post('/admin/dashboard/entrada-saida/add/saida', [AdminController::class, "addSaida"])->name('add_saida');

// EXIBIR MODAL DE EDIÇÃO
Route::get('/admin/dashboard/entrada-saida/edit/{id}', [AdminController::class, "editEntradaSaida"])->name('edit_entrada_saida');

// EDITAR ITEM ENTRADA E SAÍDA
Route::get('/admin/dashboard/entrada-saida/editar/{id}', [AdminController::class, "editarEntradaSaida"])->name('editar_entrada_saida');

// EXCLUIR ITEM DE ENTRADA E SAÍDA
Route::get('/admin/dashboard/entrada-saida/delete/{id}', [AdminController::class, "deleteEntradaSaida"])->name('delete_entrada_saida');



// AGENDAMENTO PELA ATENDENTE (DESCONTINUADO)
// Route::post('/dashboard/agendamento/manual', [AgendamentoController::class, "agenda_manual"])->name('agendar_giche');

// AGENDAMENTO PELA ATENDENTE (NOVO)
Route::post('/dashboard/agendamento/manual', [AgendamentoController::class, "NewAgendamentoManual"])->name('new.agendamento.manual');

// AGENDAMENTO EXPRESSO (NOVO)
Route::post('/dashboard/agendamento/expresso', [AgendamentoController::class, "NewAgendamentoExpresso"])->name('new.agendamento.expresso');



// DISPENSAR AGENDAMENTO MANUAL
Route::get('/dashboard/agendamento/dipensar/{id}', [AgendamentoController::class, "agenda_dispensar"])->name('agenda_dispensar');

// CONFIRMAR AGENDAMENTO MANUAL
Route::get('/dashboard/agendamento/confirmar/{id}', [AgendamentoController::class, "agenda_confirma"])->name('agenda_confirma');

// EXCLUIR AGENDAMENTO
Route::get('/dashboard/agendamento/excluir/{id}', [AgendamentoController::class, "agenda_delete"])->name('agenda_delete');

// REFAZER CONSULTA
Route::post('/dashboard/agendamento/refazer/{id}', [AgendamentoController::class, "refazer_consulta"])->name('refazer_consulta');


// VER INFORMAÇÕES
Route::get('/dashboard/agendamento/autorizar/{id}', [AgendamentoController::class, "liberar"])->name('liberar');

// liberar o agendamento
Route::get('/dashboard/agendamento/informacoes/{id}', [AgendamentoController::class, "informacoes"])->name('informacoes');

// liberar o agendamento
Route::get('/dashboard/agendamento/encerrar/{id}', [AgendamentoController::class, "encerrar"])->name('encerrar');



// Adicionar usuário admin
Route::get('/admin/dashboard/master', [AdminController::class, "master"])->name('admin');

// Adicionar plano
Route::get('/admin/dashboard/planos', [AdminController::class, "add_plano"])->name('admin_add_plano');

// Adicionar usuário atendente
Route::get('/admin/dashboard/atendente', [AdminController::class, "atendente"])->name('atendente');



// CLUBE DE NEGÓCIO
Route::get('/admin/dashboard/clube', [ClubeController::class, "clube_negocio"])->name('clube_negocio');

// AUTORIZA PLANO
Route::get('/admin/dashboard/clube/autoriza/{id}', [ClubeController::class, "autoriza_plano"])->name('autoriza_plano');

// SUSPENDER PLANO
Route::get('/admin/dashboard/clube/suspender/{id}', [ClubeController::class, "suspender_plano"])->name('suspender_plano');

// LIBERAR PLANO
Route::get('/admin/dashboard/clube/liberar/{id}', [ClubeController::class, "liberar_plano"])->name('liberar_plano');

// LOG CHECK
Route::get('/admin/dashboard/log/checked', [ClubeController::class, "log_check"])->name('log_check');

// CLUBE DE NEGÓCIO
Route::post('/admin/dashboard/cadastro/plano', [ClubeController::class, "cadastro_plano"])->name('cadastro_plano');

// PÁGINA DE PAGAMENTO
Route::get('/web/payment/plano/basico', [ClubeController::class, "pag_pay"])->name('pag_pay');

// VISUALIZAR EMAIL PLANO
Route::get('/teste/view/email/plano', function () {
    return view('email_plan_autorizado');
})->name('teste_mail');


// CONTATO
Route::post('/contato/adicionar', [UsuarioController::class, "ContatoCliente"])->name('contato_cliente');

// ADM ADD CONTATO
Route::post('/admin/contato/adicionar', [UsuarioController::class, "AdmContatoCliente"])->name('adm_contato_cliente');

// MARCAR CONTATO
Route::get('/contato/marcado/cliente/{id}', [UsuarioController::class, "ContatoMarcado"])->name('contato_marcado');

// REMOVER CONTAO
Route::get('/contato/remover/cliente/{id}', [UsuarioController::class, "RemoverContato"])->name('remover_contato');



// INCLUIR TELEFONE
Route::post('/web/add/telefone/usuario', [UsuarioController::class, "cadastrar_telefone"])->name('cadastrar_telefone');


// NEW APP
Route::get('/teste/algorito/app/home', [PrincipalController::class, "homeApp"])->name('app.home');

// LOGIN APP
Route::get('/teste/algorito/app/login', [PrincipalController::class, "loginApp"])->name('app.login');

// CADASTRO APP
Route::get('/teste/algorito/app/cadastro', [PrincipalController::class, "cadastroApp"])->name('app.cadastro.page');

// REGISTRO APP
Route::post('/teste/algorito/app/cadastro/registrar', [PrincipalController::class, "registroApp"])->name('app.registro');

// PRINCIPAL APP
Route::get('/teste/algorito/app/principal', [PrincipalController::class, "principalApp"])->name('app.principal');

// TODAS AS SALAS APP
Route::get('/teste/algorito/app/todos/espacos', [PrincipalController::class, "TodosEspacos"])->name('app.todos.espacos');

// AGENDAMENTO APP
Route::get('/teste/algorito/app/agendamento', [PrincipalController::class, "agendamentoApp"])->name('app.agendamento');

// RESERVA APP
Route::get('/teste/algorito/app/reserva/{id}', [PrincipalController::class, "reservaApp"])->name('app.reserva');

// PLANO APP
Route::get('/teste/algorito/app/plano', [PrincipalController::class, "meuPlanoApp"])->name('app.meu_plano');

// DETALHE PLANO APP
Route::get('/teste/algorito/app/plano/{id}', [PrincipalController::class, "PlanoDetalheApp"])->name('app.plano_detalhe');

// DETALHE RESERVA APP
Route::get('/teste/algorito/app/reserva/detalhe', [PrincipalController::class, "reservaDetalheApp"])->name('app.detalhe.reserva');

// STATUS RESERVA APP
Route::get('/teste/algorito/app/reserva/{id}/{status}', [PrincipalController::class, "reservaStatusApp"])->name('app.status.reserva');

// DETALHES ESPAÇOS APP
Route::get('/teste/algorito/app/coworking/{id}', [PrincipalController::class, "CoworkingDetalheApp"])->name('app.coworking.detalhe');

// FEED APP
Route::get('/teste/algorito/app/feed', [PrincipalController::class, "feedApp"])->name('app.feed');

// PERFIL APP
Route::get('/teste/algorito/app/perfil/{id}', [PrincipalController::class, "perfilApp"])->name('app.perfil_now');

// PÁGINA DE POSTAGEM APP
Route::get('/teste/algorito/app/postagem/{id}', [PrincipalController::class, "pagPostagemApp"])->name('app.pag_postagem');

// CAIXA DE MENSAGEM APP
Route::get('/teste/algorito/app/mensagens', [PrincipalController::class, "mensagensApp"])->name('app.mensagens');

// CAIXA DE MENSAGEM APP
Route::get('/teste/algorito/app/mensagens/18', [PrincipalController::class, "mensagensDetalheApp"])->name('app.mensagens.detalhe');

// CAIXA DE MENSAGEM APP
Route::get('/teste/algorito/app/configura', [PrincipalController::class, "AppConfigura"])->name('app.configuracao');


// BACK CADASTRO
Route::post('/teste/algorito/app/registro', [NewAppController::class, "NewCadastroApp"])->name('app.new_cadastro');

Route::post('/teste/algorito/app/logar', [NewAppController::class, "NewLogarApp"])->name('app.new_logar');

Route::post('/teste/algorito/app/postar', [NewAppController::class, "NewPostarApp"])->name('app.new_postar');

Route::get('/teste/algorito/app/comentar/{id}', [NewAppController::class, "NewComentarioApp"])->name('app.comentario_post');

Route::get('/teste/algorito/app/curtir/{id}', [NewAppController::class, "NewCurtirApp"])->name('app.curtir_post');

Route::post('/teste/algorito/app/agendamento', [NewAppController::class, "NewAgendaApp"])->name('app.agendamento_sala');

Route::get('/teste/algorito/app/confirmar/reserva/{id}', [NewAppController::class, "NewConfirmarApp"])->name('app.confirmar_reserva');

Route::get('/teste/algorito/app/cancela/reserva/{id}', [NewAppController::class, "NewCancelaApp"])->name('app.cancela_reserva');

Route::post('/teste/algorito/app/filtrar/reserva', [NewAppController::class, "NewFiltraraApp"])->name('app.filtrar_reserva');

Route::get('/teste/algorito/app/confirma/plano/{id}', [NewAppController::class, "PlanoConfirmaApp"])->name('app.plano_confirma');

Route::get('/teste/algorito/app/cancelar/plano', [NewAppController::class, "CancelarPlano"])->name('app.cancelar_plano');

Route::get('/teste/algorito/app/seguir/user/{id}', [NewAppController::class, "SeguirNewUser"])->name('app.seguir_user');

Route::get('/teste/algorito/app/deixar/seguir/user/{id}', [NewAppController::class, "DeixarSeguirUser"])->name('app.deixar_seguir_user');

Route::get('/teste/algorito/app/delete/post/{id}', [NewAppController::class, "ExcluirPost"])->name('app.excluir.post');



Route::get('/teste/algorito/app/alterar/email', [NewAppController::class, "AlterarEmail"])->name('app.alterar.email');

Route::get('/teste/algorito/app/alterar/senha', [NewAppController::class, "AlterarSenha"])->name('app.alterar.senha');

Route::get('/teste/algorito/app/alterar/imagem', [NewAppController::class, "AlterarImagem"])->name('app.alterar.imagem');

Route::get('/teste/algorito/app/alterar/nome_perfil', [NewAppController::class, "AlterarNomePerfil"])->name('app.alterar.nome_perfil');

Route::get('/teste/algorito/app/alterar/nome_usuario', [NewAppController::class, "AlterarNomeUsuario"])->name('app.alterar.nome_usuario');

Route::get('/teste/algorito/app/adicionar/bio', [NewAppController::class, "AddBioApp"])->name('app.adicionar.bio');

Route::get('/teste/algorito/app/alterar/bio', [NewAppController::class, "AlterarBioApp"])->name('app.alterar.bio');

Route::get('/teste/algorito/app/delete/conta', [NewAppController::class, "DeleteContaApp"])->name('app.delete.conta');

Route::get('/teste/algorito/app/logout', [NewAppController::class, "LogoutContaApp"])->name('app.logout.conta');
