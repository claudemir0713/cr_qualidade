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

        var Produto                         = $(this).find('#Produto').val();
        var QntGrade                        = $(this).find('#QntGrade').val();
        var CodPro                          = $(this).find('#CodPro').val();
        var extrusora_pesoi                 = $(this).find('#extrusora_pesoi').val();
        var extrusora_pesos                 = $(this).find('#extrusora_pesos').val();
        var extrusora_alturai               = $(this).find('#extrusora_alturai').val();
        var extrusora_alturas               = $(this).find('#extrusora_alturas').val();
        var extrusora_largurai              = $(this).find('#extrusora_largurai').val();
        var extrusora_larguras              = $(this).find('#extrusora_larguras').val();
        var extrusora_comprimentoi          = $(this).find('#extrusora_comprimentoi').val();
        var extrusora_comprimentos          = $(this).find('#extrusora_comprimentos').val();
        var extrusora_dim_paredei           = $(this).find('#extrusora_dim_paredei').val();
        var extrusora_dim_paredes           = $(this).find('#extrusora_dim_paredes').val();
        var extrusora_umidadei              = $(this).find('#extrusora_umidadei').val();
        var extrusora_umidades              = $(this).find('#extrusora_umidades').val();
        var extrusora_vacuoi                = $(this).find('#extrusora_vacuoi').val();
        var extrusora_vacuos                = $(this).find('#extrusora_vacuos').val();
        var extrusora_durometroi            = $(this).find('#extrusora_durometroi').val();
        var extrusora_durometros            = $(this).find('#extrusora_durometros').val();
        var cargavagao_pesoi                = $(this).find('#cargavagao_pesoi').val();
        var cargavagao_pesos                = $(this).find('#cargavagao_pesos').val();
        var cargavagao_dim_externai         = $(this).find('#cargavagao_dim_externai').val();
        var cargavagao_dim_externas         = $(this).find('#cargavagao_dim_externas').val();
        var cargavagao_dim_paredei          = $(this).find('#cargavagao_dim_paredei').val();
        var cargavagao_dim_paredes          = $(this).find('#cargavagao_dim_paredes').val();
        var cargavagao_umidadei             = $(this).find('#cargavagao_umidadei').val();
        var cargavagao_umidades             = $(this).find('#cargavagao_umidades').val();
        var cargavagao_resistenciai         = $(this).find('#cargavagao_resistenciai').val();
        var cargavagao_resistencias         = $(this).find('#cargavagao_resistencias').val();
        var forno_pesoi                     = $(this).find('#forno_pesoi').val();
        var forno_pesos                     = $(this).find('#forno_pesos').val();
        var forno_dim_paredei               = $(this).find('#forno_dim_paredei').val();
        var forno_dim_paredes               = $(this).find('#forno_dim_paredes').val();
        var forno_resistenciai              = $(this).find('#forno_resistenciai').val();
        var forno_resistencias              = $(this).find('#forno_resistencias').val();
        var forno_absorcaoi                 = $(this).find('#forno_absorcaoi').val();
        var forno_absorcaos                 = $(this).find('#forno_absorcaos').val();
        var laboratorio_resistenciai        = $(this).find('#laboratorio_resistenciai').val();
        var laboratorio_resistencias        = $(this).find('#laboratorio_resistencias').val();
        var laboratorio_absorcaoi           = $(this).find('#laboratorio_absorcaoi').val();
        var laboratorio_absorcaos           = $(this).find('#laboratorio_absorcaos').val();
        var laboratorio_largurai            = $(this).find('#laboratorio_largurai').val();
        var laboratorio_larguras            = $(this).find('#laboratorio_larguras').val();
        var laboratorio_alturai             = $(this).find('#laboratorio_alturai').val();
        var laboratorio_alturas             = $(this).find('#laboratorio_alturas').val();
        var laboratorio_comprimentoi        = $(this).find('#laboratorio_comprimentoi').val();
        var laboratorio_comprimentos        = $(this).find('#laboratorio_comprimentos').val();
        var laboratorio_parede_externai     = $(this).find('#laboratorio_parede_externai').val();
        var laboratorio_parede_externas     = $(this).find('#laboratorio_parede_externas').val();
        var laboratorio_septosi             = $(this).find('#laboratorio_septosi').val();
        var laboratorio_septoss             = $(this).find('#laboratorio_septoss').val();
        var laboratorio_planezai            = $(this).find('#laboratorio_planezai').val();
        var laboratorio_planezas            = $(this).find('#laboratorio_planezas').val();
        var laboratorio_esquadroi           = $(this).find('#laboratorio_esquadroi').val();
        var laboratorio_esquadros           = $(this).find('#laboratorio_esquadros').val();
        var laboratorio_densidadei          = $(this).find('#laboratorio_densidadei').val();
        var laboratorio_densidades          = $(this).find('#laboratorio_densidades').val();


        /********************************************************************************************* */
        if(!Produto){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'Produto'                       : Produto
                ,'QntGrade'                     : QntGrade
                ,'CodPro'                       : CodPro
                ,'extrusora_pesoi'              : extrusora_pesoi
                ,'extrusora_pesos'              : extrusora_pesos
                ,'extrusora_alturai'            : extrusora_alturai
                ,'extrusora_alturas'            : extrusora_alturas
                ,'extrusora_largurai'           : extrusora_largurai
                ,'extrusora_larguras'           : extrusora_larguras
                ,'extrusora_comprimentoi'       : extrusora_comprimentoi
                ,'extrusora_comprimentos'       : extrusora_comprimentos
                ,'extrusora_dim_paredei'        : extrusora_dim_paredei
                ,'extrusora_dim_paredes'        : extrusora_dim_paredes
                ,'extrusora_umidadei'           : extrusora_umidadei
                ,'extrusora_umidades'           : extrusora_umidades
                ,'extrusora_vacuoi'             : extrusora_vacuoi
                ,'extrusora_vacuos'             : extrusora_vacuos
                ,'extrusora_durometroi'         : extrusora_durometroi
                ,'extrusora_durometros'         : extrusora_durometros
                ,'cargavagao_pesoi'             : cargavagao_pesoi
                ,'cargavagao_pesos'             : cargavagao_pesos
                ,'cargavagao_dim_externai'      : cargavagao_dim_externai
                ,'cargavagao_dim_externas'      : cargavagao_dim_externas
                ,'cargavagao_dim_paredei'       : cargavagao_dim_paredei
                ,'cargavagao_dim_paredes'       : cargavagao_dim_paredes
                ,'cargavagao_umidadei'          : cargavagao_umidadei
                ,'cargavagao_umidades'          : cargavagao_umidades
                ,'cargavagao_resistenciai'      : cargavagao_resistenciai
                ,'cargavagao_resistencias'      : cargavagao_resistencias
                ,'forno_pesoi'                  : forno_pesoi
                ,'forno_pesos'                  : forno_pesos
                ,'forno_dim_paredei'            : forno_dim_paredei
                ,'forno_dim_paredes'            : forno_dim_paredes
                ,'forno_resistenciai'           : forno_resistenciai
                ,'forno_resistencias'           : forno_resistencias
                ,'forno_absorcaoi'              : forno_absorcaoi
                ,'forno_absorcaos'              : forno_absorcaos
                ,'laboratorio_resistenciai'     : laboratorio_resistenciai
                ,'laboratorio_resistencias'     : laboratorio_resistencias
                ,'laboratorio_absorcaoi'        : laboratorio_absorcaoi
                ,'laboratorio_absorcaos'        : laboratorio_absorcaos
                ,'laboratorio_largurai'         : laboratorio_largurai
                ,'laboratorio_larguras'         : laboratorio_larguras
                ,'laboratorio_alturai'          : laboratorio_alturai
                ,'laboratorio_alturas'          : laboratorio_alturas
                ,'laboratorio_comprimentoi'     : laboratorio_comprimentoi
                ,'laboratorio_comprimentos'     : laboratorio_comprimentos
                ,'laboratorio_parede_externai'  : laboratorio_parede_externai
                ,'laboratorio_parede_externas'  : laboratorio_parede_externas
                ,'laboratorio_septosi'          : laboratorio_septosi
                ,'laboratorio_septoss'          : laboratorio_septoss
                ,'laboratorio_planezai'         : laboratorio_planezai
                ,'laboratorio_planezas'         : laboratorio_planezas
                ,'laboratorio_esquadroi'        : laboratorio_esquadroi
                ,'laboratorio_esquadros'        : laboratorio_esquadros
                ,'laboratorio_densidadei'       : laboratorio_densidadei
                ,'laboratorio_densidades'       : laboratorio_densidades

            }
            cadastrar(dados,route,type,origem);

        }
    })

    /**********************gravar extrusora **************************************************/
    $(document).on('submit', 'form#cadastro-extrusora', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var data            = $(this).find('input#data').val();
        var user_id         = $(this).find('#user_id').val();
        var produto_id      = $(this).find('select#produto_id').val();
        var peso            = $(this).find('input#peso').val();
        var dim_externa     = $(this).find('input#dim_externa').val();
        var dim_parede      = $(this).find('input#dim_parede').val();
        var vacuo           = $(this).find('input#vacuo').val();
        var durometro       = $(this).find('input#durometro').val();
        var residuo         = $(this).find('input#residuo').val();
        var turno           = $(this).find('select#turno').val();
        var altura          = $(this).find('input#altura').val();
        var largura         = $(this).find('input#largura').val();
        var comprimento     = $(this).find('input#comprimento').val();
        var umidade         = $(this).find('input#umidade').val();

        /********************************************************************************************* */
        if(!data){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'data'            : data
                ,'user_id'        : user_id
                ,'produto_id'     : produto_id
                ,'peso'           : peso
                ,'dim_externa'    : dim_externa
                ,'dim_parede'     : dim_parede
                ,'vacuo'          : vacuo
                ,'durometro'      : durometro
                ,'residuo'        : residuo
                ,'turno'          : turno
                ,'altura'         : altura
                ,'largura'        : largura
                ,'comprimento'    : comprimento
                ,'umidade'        : umidade
            }
            cadastrar(dados,route,type,origem);
            // console.log(dados,route,type,origem);

        }
    })

    /**********************gravar cargavagao **************************************************/
    $(document).on('submit', 'form#cadastro-cargavagao', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var data            = $(this).find('input#data').val();
        var user_id         = $(this).find('#user_id').val();
        var produto_id      = $(this).find('select#produto_id').val();
        var peso            = $(this).find('input#peso').val();
        var dim_externa     = $(this).find('input#dim_externa').val();
        var dim_parede      = $(this).find('input#dim_parede').val();
        var umidade         = $(this).find('input#umidade').val();
        var resistencia     = $(this).find('input#resistencia').val();
        var extrusora_id    = $(this).find('select#extrusora_id').val();
        var perda           = $(this).find('input#perda').val();
        var historico_id    = $(this).find('select#historico_id').val();

        /********************************************************************************************* */
        if(!data || !produto_id){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'data'            : data
                ,'user_id'        : user_id
                ,'produto_id'     : produto_id
                ,'peso'           : peso
                ,'dim_externa'    : dim_externa
                ,'dim_parede'     : dim_parede
                ,'umidade'        : umidade
                ,'resistencia'    : resistencia
                ,'extrusora_id'   : extrusora_id
                ,'perda'          : perda
                ,'historico_id'   : historico_id
            }
            cadastrar(dados,route,type,origem);

        }
    })

    /**********************gravar forno **************************************************/
    $(document).on('submit', 'form#cadastro-forno', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var data            = $(this).find('input#data').val();
        var user_id         = $(this).find('#user_id').val();
        var produto_id      = $(this).find('select#produto_id').val();
        var peso            = $(this).find('input#peso').val();
        var dim_parede      = $(this).find('input#dim_parede').val();
        var resistencia     = $(this).find('input#resistencia').val();
        var absorcao        = $(this).find('input#absorcao').val();
        var residuo         = $(this).find('input#residuo').val();
        var historico_id    = $(this).find('select#historico_id').val();
        var extrusora_id    = $(this).find('select#extrusora_id').val();

        /********************************************************************************************* */
        if(!data){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'data'            : data
                ,'user_id'        : user_id
                ,'produto_id'     : produto_id
                ,'peso'           : peso
                ,'dim_parede'     : dim_parede
                ,'absorcao'       : absorcao
                ,'resistencia'    : resistencia
                ,'extrusora_id'   : extrusora_id
                ,'residuo'        : residuo
                ,'historico_id'   : historico_id
            }
            cadastrar(dados,route,type,origem);

        }
    })

    /**********************gravar historico **************************************************/
    $(document).on('submit', 'form#cadastro-historico', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var historico            = $(this).find('input#historico').val();

        /********************************************************************************************* */
        if(!historico){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'historico'            : historico
            }
            cadastrar(dados,route,type,origem);

        }

    })

     /**********************gravar laboratorio **************************************************/
     $(document).on('submit', 'form#cadastro-laboratorio', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var data            = $(this).find('input#data').val();
        var user_id         = $(this).find('#user_id').val();
        var produto_id      = $(this).find('select#produto_id').val();
        var resistencia     = $(this).find('input#resistencia').val();
        var absorcao        = $(this).find('input#absorcao').val();
        var extrusora_id    = $(this).find('select#extrusora_id').val();
        var largura         = $(this).find('input#largura').val();
        var altura          = $(this).find('input#altura').val();
        var comprimento     = $(this).find('input#comprimento').val();
        var parede_ext      = $(this).find('input#parede_ext').val();
        var septos          = $(this).find('input#septos').val();
        var planeza         = $(this).find('input#planeza').val();
        var esquadro        = $(this).find('input#esquadro').val();
        var densidade       = $(this).find('input#densidade').val();


        /********************************************************************************************* */
        if(!data || !produto_id){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'data'            : data
                ,'user_id'        : user_id
                ,'produto_id'     : produto_id
                ,'resistencia'    : resistencia
                ,'absorcao'       : absorcao
                ,'extrusora_id'   : extrusora_id
                ,'largura'        : largura
                ,'altura'         : altura
                ,'comprimento'    : comprimento
                ,'parede_ext'     : parede_ext
                ,'septos'         : septos
                ,'planeza'        : planeza
                ,'esquadro'       : esquadro
                ,'densidade'      : densidade
                }
            // console.log(dados);
            cadastrar(dados,route,type,origem);

        }

    })


})
