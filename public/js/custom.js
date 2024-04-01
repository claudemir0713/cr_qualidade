$(document).ready(function () {
    $(document).find('select').chosen();

    /**********sempre que tabalhar com Ajax no Laravel tem que incluir essa tag *************/
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /***********************colocando duas casas decimais************************************* */
    var decimal = $('.floatNumberField').attr('decimal');
    $('.floatNumberField').val(parseFloat($('.floatNumberField').val()).toFixed(decimal));

    $(".floatNumberField").on('change', function () {
        var decimal = $(this).attr('decimal');
        $(this).val(parseFloat($(this).val()).toFixed(decimal));
    });
    /**********************formata numero **************************************************/
    const formCurrency = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })


    /**********************formata cub **************************************************/
    const formCub = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 4
    })

    /*************************pegando a url do servidor**************************************/

    url = $('input#appurl').val();

    /************************ buscaCep ******************************************************/
    $(document).on('blur', 'input#Cep', function (event) {
        event.preventDefault() // não permite que o navegador faça o submit
        var cep = $(this).val();
        var endereco = $('input#endereco').val().trim();
        if (endereco == '') {
            buscaCep(cep);
        };
    })

    /************************ buscaCnpj ******************************************************/
    $(document).on('blur', 'input#cnpj', function (event) {
        var cnpj = $(this).val().replace('.', '').replace('/', '').replace('-', '');

        if (cnpj.length >= 14) {
            buscaCnpj(cnpj);
        };
    })

    function cnpj(v){
        v=v.replace(/\D/g,"")                           //Remove tudo o que não é dígito
        v=v.replace(/^(\d{2})(\d)/,"$1.$2")             //Coloca ponto entre o segundo e o terceiro dígitos
        v=v.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos
        v=v.replace(/\.(\d{3})(\d)/,".$1/$2")           //Coloca uma barra entre o oitavo e o nono dígitos
        v=v.replace(/(\d{4})(\d)/,"$1-$2")              //Coloca um hífen depois do bloco de quatro dígitos
        return v
    }
    function cpf(v){
        v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                                 //de novo (para o segundo bloco de números)
        v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
        return v
    }
    function cep(v){
        v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
        v=v.replace(/(\d{2})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        v=v.replace(/(\d{3})(\d)/,"$1-$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
        return v
    }

    /***********************mensagem confirma exclusão **************************************/
    $(document).on('click', '.delete', function (event) {
        event.preventDefault()
        Swal({
            title: 'Deseja realmente excluir?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Remover'
        }).then((result) => {
            if (result.value) {
                var form = $(this).parent()
                form.submit()
            }
        });
    })


    /**********************time intervel *********************************************************************/
        // atualizaCards();
        // setInterval(function(){
        //     atualizaCards();
        // }, 5000);



    /**********************gravar menu com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-menu', function (event) {
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = 'menu'

        var descricao = $(this).find('input#descricao').val();
        var tipo = $(this).find('select#tipo').val();
        var ordem = $(this).find('input#ordem').val();
        var rota = $(this).find('input#rota').val();
        var icone = $(this).find('input#icone').val();


        /********************************************************************************************* */
        if (!descricao || !tipo || !ordem) {
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer: 3000
            })
        } else {
            var dados = {
                'descricao': descricao
                , 'tipo': tipo
                , 'ordem': ordem
                , 'rota': rota
                , 'icone': icone
            }
            cadastrar(dados, route, type, origem);
        }
    })
    /***********************liberaMenu *****************************/
    $('#usuario').on('change',function(){
        liberaMenuDisponivel();
        removeMenuLiberado();
    })

    $(document).on('click','input.disponivel',function(event){
        if($(this).is(":checked")){
            var disponivelId = $(this).val();
            var usuario = $(document).find('#usuario').val();
            addMenuUsuario(disponivelId,usuario)
        }else{
            var liberadoId = $(this).val();
            removeMenuUsuario(liberadoId)
        }
    })
    $(document).on('click','button.liberado',function(event){
        var liberadoId = $(this).val();
        removeMenuUsuario(liberadoId)
    })

    /*************************adiciona mascara no cpf cnpj ***********************/
    var pessoa =  $(document).find('#pessoa').val();
    if(pessoa=='J'){
        $(document).find('.contribuinte_icms').show();
        $(document).find('.IE').show();
    }else{
        $(document).find('.contribuinte_icms').hide();
        $(document).find('.IE').hide();
    }

    $(document).on('change','#pessoa', function(event){
        var pessoa = $(this).val();
        if(pessoa=='J'){
            $(document).find('.contribuinte_icms').show();
            $(document).find('.IE').show();
        }else{
            $(document).find('.contribuinte_icms').hide();
            $(document).find('.IE').hide();
        }
    })

    $(document).on('keypress','#cnpj', function(event){
        var pessoa = $(document).find('#pessoa').val();
        if(pessoa=="J"){
            $(this).val(cnpj($(this).val()));
        }else{
            $(this).val(cpf($(this).val()));
        }
    })
    $(document).on('keypress','#contato_cpf', function(event){
        $(this).val(cpf($(this).val()));
    })

    /****************************adiciona mascara cep***********************************/
    $(document).on('keypress','#Cep', function(event){
        $(this).val(cep($(this).val()));
    })


    /**********************gravar moeda com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-moeda', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem =  $(this).find('input#origem').val();

        var moeda  = $(this).find('input#moeda').val();
        var simbolo  = $(this).find('input#simbolo').val();
        /********************************************************************************************* */
        if(!moeda  ){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'moeda'     : moeda
                ,'simbolo'  :simbolo
            }
            cadastrar(dados,route,type,origem);
        }
    })
    /**********************gravar moedaPtax com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-moedaPtax', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem =  $(this).find('input#origem').val();

        var moeda_id  = $(this).find('input#moeda_id').val();
        var data  = $(this).find('input#dataPatx').val();
        var ptax  = $(this).find('input#ptax').val();

        console.log(moeda_id,data,ptax);

        /********************************************************************************************* */
        if(!moeda_id || !data || !ptax ){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'moeda_id'  : moeda_id
                ,'data'     : data
                ,'valor'     :ptax
            }
            cadastrar(dados,route,type,origem);
        }
    })
    /************************ buscaMoedaPatx ******************************************************/
    $(document).on('blur', 'input#dataPatx', function(event){
        var moeda= $(document).find('#moeda_cod').val()
        var data = $(this).val();
        $.ajax({
            data: {
                'moeda': moeda
                ,'data': data
            },
            type: 'POST',
            dataType: 'JSON',
            url: url + '/moeda/buscaPtax',
            beforeSend: function () {
                Swal({
                    title: 'Aguarde consultado dados!',
                    type: 'warning'
                })
            },
            error:function(){
                swal.close();
                $(document).find('input#ptax').val();
            },
            success: function (result) {
                if(result[0]){
                    $(document).find('input#ptax').val(result[0].cotacaoCompra);
                    swal.close();
                }else{
                    swal.close();
                    $(document).find('input#ptax').val('');
                    swal({
                        title: 'Data sem cotação!',
                        type: 'warning',
                    })

                }
            }
        })
    })

    /**********************gravar produto com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-produto', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem =  $(this).find('input#origem').val();

        var codigo  = $(this).find('input#codigo').val();
        var produto  = $(this).find('input#produto').val();
        var un  = $(this).find('select#un').val();
        var status  = $(this).find('select#status').val();
        var custo  = $(this).find('input#custo').val();
        var quebra  = $(this).find('input#quebra').val();

        custo  = parseFloat(custo.replaceAll('.','').replaceAll(',','.'));
        quebra  = parseFloat(quebra.replaceAll('.','').replaceAll(',','.'));
        if(!quebra){quebra = 0;};


        /********************************************************************************************* */
        if(!produto || !un || !custo  ){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                "codigo" : codigo
                ,"produto" : produto
                ,"un" : un
                ,"custo" : custo
                ,"quebra" : quebra
                ,"status" : status
            }
            cadastrar(dados,route,type,origem);
        }
    })

    /***************************atualzia qtd pecas**********************************************************/
    $(document).on('keyup','.qtd_pc_pronta',function(event){
        let qtd_pacotes = $(document).find('#qtd_pacotes').val();
        let pecas_pacotes =$(document).find('#pecas_pacotes').val();
        $(document).find('#pecas_total').val(qtd_pacotes*pecas_pacotes);
    })
    /***************************atualzia qtda + quebra**********************************************************/
    $(document).on('change','.calcula_qtd_total',function(event){
        let id = $(this).attr('id').replace(/\D/g, '');
        let qtd_pc = parseFloat($(document).find('#qtd_pc'+id).val().replaceAll('.','').replaceAll(',','.'));
        let quebra = parseFloat($(document).find('#quebra'+id).val().replaceAll('.','').replaceAll(',','.'));
        let pecas_total =  parseFloat($(document).find('#pecas_total').val().replaceAll('.','').replaceAll(',','.'));
        let qtdTotal= parseFloat((qtd_pc* (1+(quebra/100)))*pecas_total)
        let preco =  parseFloat($(document).find('#preco'+id).val().replaceAll('.','').replaceAll(',','.'));
        let valor_total = parseFloat(qtdTotal*preco).toFixed(2)

        qtdTotal = formCurrency.format(qtdTotal.toFixed(2)).replace('R$', '')
        valor_total = formCurrency.format(valor_total).replace('R$', '')


        $(document).find('#qtd_total'+id).val(qtdTotal);
        $(document).find('#total'+id).val(valor_total);

    })

    /**********************gravar Maquina **************************************************/
    $(document).on('submit', 'form#cadastro-maquina', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var Maquina = $(this).find('#Maquina').val();

        /********************************************************************************************* */
        if(!Maquina){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'Maquina'            : Maquina
            }
            // console.log(dados,route,type,origem);
            cadastrar(dados,route,type,origem);

        }
    })
    /**********************gravar produto **************************************************/
    $(document).on('submit', 'form#cadastro-produto', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var Produto = $(this).find('#Produto').val();
        var QntGrade = $(this).find('#QntGrade').val();
        var CodPro = $(this).find('#CodPro').val();

        /********************************************************************************************* */
        if(!Produto){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'Produto'            : Produto
                ,'QntGrade'          : QntGrade
                ,'CodPro'            : CodPro
            }
            // console.log(dados,route,type,origem);
            cadastrar(dados,route,type,origem);

        }
    })

})
