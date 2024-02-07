/**********************formata numero **************************************************/
const formCurrency = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL',
    minimumFractionDigits: 2
})

/********************* busca cep cliente *****************************************/
function buscaCep(cep){
    $.ajax({
        data: {cep:cep},
        type: 'POST',
        dataType: 'JSON',
        url:url+'/cliente/buscaCep',
        beforeSend: function(){

        },
        success: function(result)
        {
            $('#cidade').val(result.localidade);
            $('#endereco').val(result.logradouro);
            $('#bairro').val(result.bairro);
            $('#uf').val(result.uf);
        }
    });

}

/*****************************busca cnpj*****************************************/
function buscaCnpj(cnpj){
    $.ajax({
        data: {cnpj:cnpj},
        type: 'POST',
        dataType: 'JSON',
        url:url+'/cliente/buscaCnpj',
        beforeSend: function(){
            Swal({
                title: 'Aguarde consultado dados!',
                type: 'warning',
                timer:2000
            })
        },
        success: function(result)
        {
            $('input#cliente').val(result.nome);
            $('input#Cep').val(result.cep);
            $('input#telefone').val(result.telefone);
            $('input#cidade').val(result.municipio);
            $('input#email').val(result.email);
            $('input#endereco').val(result.logradouro+','+result.numero);
            $('input#bairro').val(result.bairro);
            $('input#uf').val(result.uf);
            $('input#contato').val(result.qsa['0'].nome);
        }
    });
}


function atualizaCards(){
    $.ajax({
        data: '',
        type: 'post',
        url:url+'/home/atualizaCard',
        dataType: 'JSON',
        error: function(result){
            // console.log(result)
        },
        success: function(result)
        {
            console.log(result)
            $.each(result, function(i, val){
                $('#span-nr'+val.etapa.replace(/\s/g, '')).html(val.qtd)
            });
        }

    })
}

/***********************************cadastrar************************************ */
function cadastrar(dados,route,type,origem){
    var title = 'Cadastro alterado com sucesso!';
    if(type == 'POST'){
        title = 'Cadastro efetuado com sucesso!';
    }
    var tipo = 'success';
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            if(origem){
                if(result!="success"){
                    title="Cadastro não efetuado";
                    tipo = 'error';
                    Swal({
                        title: title,
                        type: tipo,
                        text:result.errorInfo,
                        timer:3000
                    })
                }else if(result=='success'){
                    $('.limpar').val('');
                    $('select').trigger("chosen:updated");
                    tipo = 'success';
                    Swal({
                        title: title,
                        type: tipo,
                        text:result.errorInfo,
                        timer:1000
                    })
                    if( origem=='modelo' && type == 'POST'){
                        window.location.replace(url+'/'+origem);
                    }else if(origem=='orcamento'){
                        window.location.replace(url+'/'+origem);
                    }else if( origem!='modelo' && type != 'POST'){
                        window.location.replace(url+'/'+origem);
                    }else if(origem=='modal'){
                        window.location.reload();
                    }
                };
            }
        },
        complete: function(){
            // $('#salvar').prop("disabled",false);
        }
    })
}


/***********************************deletar************************************ */
function deletar(dados,route,type){
    $.ajax({
        data: dados,
        type: type,
        dataType: 'JSON',
        url:url+route,
        success: function(result)
        {
            window.location.reload();;
        }
    })
}


function liberaMenuDisponivel()
{
    var usuario = $(document).find('#usuario').val();
    var dados = {
        'usuario': usuario
    };
    var route = '/menu/disponivel'
    var linhas = '';
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        beforeSend : function(){
            linhas = '';
            $('#menuDisponivel').html('');
            swal({
                title: 'Aguarde!',
                type: 'warning',
                html: '<strong>Efetuando busca</strong>',
                onOpen: () => {
                    swal.showLoading()
                }
            })
        },
        success: function (result) {
            linhas = '';
            classe = '';
            $.each(result, function (i, val) {
                if(val.tipo=='Título'){
                    classe='negrito';
                }else{
                    classe='paragrafo';
                };
                var id = 0;
                (val.selecionado=="checked")?id = val.selecionadoId : id=val.disponivelId
                linhas += '<tr>';
                    linhas += '<td class="'+classe+'"><button class="btn btn-link" value="'+val.disponivelId+'">'+val.ordem+'-'+val.descricao+'</button></td>';
                    linhas += '<td>';
                        linhas += '<label class="switch" >';
                            linhas += '<input type="checkbox" class="disponivel" id="protrang" name="protrang" '+val.selecionado+' value="'+id+'">';
                            linhas += '<span class="slider round"></span>';
                        linhas += '</label>';
                    linhas += '</td>';
                linhas += '</tr>';
            })

        },
        complete:function(){
            $('#menuDisponivel').html(linhas);
            swal.close();
        }
    })
}

function removeMenuLiberado()
{
    var usuario = $(document).find('#usuario').val();
    var dados = {
        'usuario': usuario
    };
    var route = '/menu/menuLiberado'
    var linhas = '';
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        beforeSend : function(){
            linhas = '';
            $('#menuLiberado').html('');
            swal({
                title: 'Aguarde!',
                type: 'warning',
                html: '<strong>Efetuando busca</strong>',
                onOpen: () => {
                    swal.showLoading()
                }
            })
        },
        success: function (result) {
        },
        complete:function(){
            $('#menuLiberado').html(linhas);
            swal.close();
        }
    })
}

function addMenuUsuario(disponivelId,usuario){
    var dados = {
        'usuario': usuario,
        'disponivelId' : disponivelId
    };
    var route = '/menu/addMenuUsuario'
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        complete:function(){
            liberaMenuDisponivel();
            removeMenuLiberado();
        }
    })
}
function removeMenuUsuario(liberadoId){
    var dados = {
        'liberadoId' : liberadoId
    };
    var route = '/menu/removeMenuUsuario'
    $.ajax({
        data: dados,
        type: 'post',
        dataType: 'JSON',
        url: url + route,
        complete:function(){
            liberaMenuDisponivel();
            removeMenuLiberado();
        }
    })
}


