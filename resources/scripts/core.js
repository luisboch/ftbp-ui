function carregar(data, param) {
    if (param === undefined) {
        param = {};
    }
    $.ajax({
        url: URL_HOME + data + '?ajax=true',
        complete: function() {
        },
        type:'post',
        data: param,
        dataType: 'xml'
    }).fail(function(a, b) {
        alert(a);
        alert(b);
    }).done(process);

    return false;

}

function process(data) {

    documento = $(data.documentElement).find('document').text();

    $('#conteudo').html(documento);

    messages = $(data.documentElement).find('messages');

    Messages.clear();

    $(messages).find('item').each(function() {
        Messages.add($(this).text());
    })

    Messages.show();

    redirect = $(data.documentElement).find('redirect').text();
    if (redirect != '') {
        window.location = redirect;
    }

    action = $(data.documentElement).find('action').text();
    if (action != '') {
        carregar(action);
    }

}

var Messages = {};

Messages.clear = function() {
    $('#msg-location').html('');
}

Messages.add = function(v) {
    $('#msg-location').append('<div class="msg-item">' + v + '</div>');
}


Messages.show = function() {
    text = $('#msg-location').text();
    if (text != '') {
        $('#bloco-mensagems').fadeIn(300);
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
        if (!dragging) {
            $('#bloco-mensagems').draggable('destroy');
        }
    })

    $('#msg-location').mouseout(function() {
        if (!dragging) {
            $('#bloco-mensagems').draggable();
        }
    })

})