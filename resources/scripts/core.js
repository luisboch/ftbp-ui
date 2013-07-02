function log (data){
    if(console && console.log){
        console.log(data);
    }
}

var siteHistory = new HistoryManager();

function HistoryManager() {
    var actions = new Array();
    
    if(logado){
        actions[0] = 'welcome';
        actions[1] = 'welcome';
    } else {
        actions[0] = '';
        actions[1] = '';
    }
    this.add = function(action) {
        actions[0] = actions[1];
        actions[1] = action;
    }
    this.goBack = function() {
        if (actions[0] !== undefined) {
            return carregar(actions[0], {}, true);
        }
        return false;
    }
}
/**
 * @returns boolean
 */
function goBack() {
    return siteHistory.goBack();
}

/**
 * 
 * @param string action
 * @param Array param
 * @param boolean changeUrl
 * @param function __callback
 * @returns boolean false always
 */
function carregar(action, param, changeUrl, __callback) {
    if (!param) {
        param = {};
    }

    if (changeUrl) {
        window.location = '#!' + action;
        siteHistory.add(action);
    }

    $.ajax({
        url: URL_HOME + action + '?ajax=true',
        beforeSend: function() {
            $('body').css('cursor', 'wait');
        },
        complete: function() {
            $('body').css('cursor', '');
        },
        type: 'post',
        data: param,
        dataType: 'xml'
    }).fail(function(a, b) {
        if (console && console.log) {
            console.log("Ajax Request Failed: [" + a + ", " + b + "]");
        }
    }).done(function(d) {
        process(d);
        if (__callback) {
            __callback(d);
        }
    });

    return false;

}

/**
 * @param xml data xml received from server.
 * @returns void 
 */

function process(data) {

    documento = $(data.documentElement).find('document').text();
    log(documento);
    if (documento != '') {
        $('#conteudo').slideUp('fast', function() {
            $('#conteudo').html(documento);
            $('#conteudo').slideDown('fast');
        });
    }
    messages = $(data.documentElement).find('messages');

    if ($(messages).length > 0) {
        Messages.clear();

        $(messages).find('message').each(function() {
            Messages.add($(this).find('text').text(), $(this).find('type').text());
        })

        Messages.show();
    }

    redirect = $(data.documentElement).find('redirect').text();
    if (redirect != '') {
        window.location = redirect;
    }

    action = $(data.documentElement).find('action').text();
    if (action != '') {
        carregar(action);
    }

}

/**
 * Object to manage messages.
 * @type Messages
 */
var Messages = {};

Messages.clear = function() {
    $('#msg-location').html('');
}

Messages.add = function(v, t) {

    var c;

    switch (t) {
        case 'INFO':
            c = 'info';
            break;
        case 'WARN':
            c = 'notice';
            break;
        case 'ERROR':
            c = 'alert';
            break;
        case 'SYS_ERROR':
            c = 'alert';
            break;
        default:
            c = 'info';
            break;

    }
    $('#msg-location').append(
            '<div class="msg-item">\
            <span class="ui-icon-' + c + ' ui-icon" style="float: left;margin-top:3px;"></span>\
' + v + '</div>');
}


Messages.show = function() {
    text = $('#msg-location').text();
    if (text != '') {
        $('#bloco-mensagems').fadeIn(300);
        $('#bloco-mensagems').scrollTo();
    }
}


Messages.hide = function() {
    $('#bloco-mensagems').fadeOut(300);
}


$(function() {
    var dragging = false;
    $('#msg-titulo').append('<span>x</span>');
    $('#msg-titulo').find('span').click(Messages.hide);
    $('#bloco-mensagems').draggable({start: function(e, ui) {
            dragging = true;
        }, stop: function(e, ui) {
            dragging = false;
        }
    });

    $('#msg-location').mouseenter(function() {
        if (dragging) {
            $('#bloco-mensagems').draggable('destroy');
        }
    })

    // Corrige o css das mensagens
    $('#bloco-mensagems').css('position', 'absolute');

    $('#msg-location').mouseout(function() {
        if (!dragging) {
            $('#bloco-mensagems').draggable();
        }
    })

    // Se verfica se é um link ajax, se sim recarrega o conteudo
    var loc = window.location.href;

    var p = loc.indexOf('#!');

    if (p != -1) {
        var action = loc.substr(p + 2);
        // Carrega a ação que estava na url
        carregar(action);
    }

    // Coloca evento no chat para ocultar o exibir
    $('#chat .titulo').click(function() {
        carregar('ChatController/toogleChat', {'chat': 'true'});
        if ($('#chat .usuarios').is(':visible')) {
            $('#chat .usuarios').slideUp();
        } else {
            $('#chat .usuarios').slideDown();
        }
    });

    // somente se estiver logado 
    if (logado) {
        // Coloca timer para atualizar a lista de usuários ativos de 5 em 5 segundos.
        chatAtualizador = window.setInterval(function() {
            carregar('ChatController/atualizarChat', {}, false, function(data) {
                var usr = $(data.documentElement).find('usuarios');

                var ul = $('#chat .usuarios ul').html('');
                var qtd = 0;
                $(usr).children().each(function() {
                    var nome = $(this).find('nome').text();
                    var id = $(this).find('id').text();
                    var com_mgs = $(this).find('com_mgs').text() === 'true' ? true : false;
                    var departamento = $(this).find('departamento').text();
                    var html = '<li onclick="popup(URL_HOME+\'ChatController/u/' + id + '\', \'' + nome + '\', 300, 400)">\n' +
                            '<span class="usuario-nome ' + (com_mgs ? 'icon_alert' : '') + ' ">' + nome + '</span>\n' +
                            '<span class="departamento-nome">' + departamento + '</span>\n' +
                            '</li>\n';
                    ul.append(html);
                    qtd++;
                })
                $('#chat .titulo span').html(qtd + '');
            })
        }, 5000);
    }
})
var chatAtualizador;

function popup(url, title, width, height) {
    p = window.open(url, title, 'width=' + width + ',height=' + height + ', location=no, menubar=no, resizable=no', false);
    p.focus();
}
