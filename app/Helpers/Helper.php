<?php

namespace App\Helpers;

use App\Models\fluxo;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Helper {

    public static function trataFiltroRegistrosPagina($filtroRegistrosPagina) {
        return $filtroRegistrosPagina ? $filtroRegistrosPagina : 50;
    }

    public static function formataData($dataParam = null, $isTimestamp = false, $isHoraMinuto = false) {
        if (!empty($dataParam)) {
            $formatoBrasileiro = false;

            if (strpos($dataParam, '/') !== false) {
                $formatoBrasileiro = true;
                $dataParam = explode('/', $dataParam);
                $dataParam = $dataParam[2].'-'.$dataParam[1].'-'.$dataParam[0];
            }

            $data = new \DateTime($dataParam);

            if ($formatoBrasileiro) {
                return $data->format('Y-m-d');
            } else {
                if ($isTimestamp) {
                    return $data->format('d/m/Y H:i:s');
                } else if ($isHoraMinuto) {
                    return $data->format('d/m/Y H:i');
                }

                return $data->format('d/m/Y');
            }
        }

        return $dataParam;
    }

    public static function formataDataParaInputDate($data) {
        if ($data) {
            $data = new \DateTime($data);

            return $data->format('Y-m-d');
        }

        return null;
    }

    public static function formataHora($horaParam) {
        if (!empty($horaParam)) {
            $data = new \DateTime($horaParam);
            $horaParam = $data->format('H:i:s');
        }

        return $horaParam;
    }



    public static function retornaEstados() {
        // Faz a chamada na API do IBGE e retorna os estados do Brasil.
        $curl = curl_init();

        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/estados";
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $estados = json_decode(curl_exec($curl));

        $retorno = [];
        foreach ($estados as $estado) {
            $retorno[] = $estado->sigla;
        }

        sort($retorno);

        return $retorno;
    }

    public static function retornaArrayValores($objects, $value) {
        $values = [];

        foreach ($objects as $object) {
            $values[] = $object->$value;
        }

        return $values;
    }


    public static function removeCaracterMonetario($valor) {
        if ($valor && $valor != '-') {
            return
            str_replace(',', '.',
                str_replace('.', '',
                    str_replace('R$ ', '', $valor)
                )
            );
        }

        return 0;
    }

    public static function formataValor($valor, $tipoValor = true, $origemRelatorio = false) {
        if ($valor == 0 && !$origemRelatorio) {
            return '-';
        }

        if (!$tipoValor) {
            return number_format($valor, 2, ',', '.');
        }

        return 'R$ '.number_format($valor, 2, ',', '.');
    }

    public static function separarStringPorLinhas($texto) {
        $removendoEntersDoUsuario = str_replace("\r","", $texto);

        $separandoLinhas = preg_split('/\n+/', $removendoEntersDoUsuario);

        return $separandoLinhas;
    }


    public static function formataValorPorcentagem($valor) {
        return number_format($valor, 2, ',', '.').'%';
    }


    public static function validaCnpj($cnpj) {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) == 14) {
            // Valida primeiro dígito verificador
            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }

            $resto = $soma % 11;
            if ($cnpj[12] == ($resto < 2 ? 0 : 11 - $resto)) {
                // Valida segundo dígito verificador
                for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
                    $soma += $cnpj[$i] * $j;
                    $j = ($j == 2) ? 9 : $j - 1;
                }

                $resto = $soma % 11;

                if ($cnpj[13] == ($resto < 2 ? 0 : 11 - $resto)) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function validaCpf($cpf) {
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

        if (strlen($cpf) == 11) {
            // Cálculo do primeiro digito
            for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
                $soma += $cpf[$i] * $j;
            }

            // Se o resto for maior que 9, então digito = 0
            $digito1 = (11 - ($soma % 11)) > 9 ? 0 : (11 - ($soma % 11));

            if ($cpf[9] == $digito1) {
                // Cálculo do segundo digito
                for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
                    $soma += $cpf[$i] * $j;
                }

                // Se o resto for maior que 9, então digito = 0
                $digito2 = (11 - ($soma % 11)) > 9 ? 0 : (11 - ($soma % 11));

                if ($cpf[10] == $digito2) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function gravaFluxo($NF, $CodSerie, $Dpl, $Lanc, $Doc, $Fornecedor, $CodCa, $Desp, $Valor, $Tipo, $DataCom, $DataVenc, $ValorVenc, $DataVencBaixa, $DataPagto, $ValorPagto, $Obs, $CodBancoMov, $DataConc)
    {
        try {
            if ($Valor < 0) {
                $Tipo = 'DÉBITO';
            }
            $fluxo = new fluxo();
            $fluxo->NF              = $NF;
            $fluxo->CodSerie        = $CodSerie;
            $fluxo->Dpl             = $Dpl;
            $fluxo->Lanc            = $Lanc;
            $fluxo->Doc             = $Doc;
            $fluxo->Fornecedor      = $Fornecedor;
            $fluxo->CodCa           = $CodCa;
            $fluxo->Desp            = $Desp;
            $fluxo->Valor           = $Valor;
            $fluxo->Tipo            = $Tipo;
            $fluxo->DataCom         = $DataCom;
            $fluxo->DataVenc        = $DataVenc;
            $fluxo->ValorVenc       = $ValorVenc;
            $fluxo->DataVencBaixa   = $DataVencBaixa;
            $fluxo->DataPagto       = $DataPagto;
            $fluxo->ValorPagto      = $ValorPagto;
            $fluxo->Obs             = $Obs;
            $fluxo->CodBancoMov     = $CodBancoMov;
            $fluxo->DataConc        = $DataConc;
            $fluxo->save();
        } catch (\Exception $e) {
            return response()->json($e);
        }

    }

    // public static function formataCnpj($cnpj) {
    //     if (Str::length($cnpj) == 14) {
    //         $cnpjFormatada = '';
    //         for ($i=0; $i < Str::length($cnpj); $i++) {
    //             $cnpjFormatada .= $cnpj[$i];

    //             if ($i == 1 || $i == 4) {
    //                 $cnpjFormatada .= '.';
    //             }

    //             if ($i == 7) {
    //                 $cnpjFormatada .= '/';
    //             }

    //             if ($i == 11) {
    //                 $cnpjFormatada .= '-';
    //             }
    //         }
    //         $cnpj = $cnpjFormatada;
    //     }

    //     return $cnpj;
    // }

    // public static function formataCpf($cpf) {
    //     if (Str::length($cpf) == 11) {
    //         $cpfFormatada = '';
    //         for ($i=0; $i < Str::length($cpf); $i++) {
    //             $cpfFormatada .= $cpf[$i];

    //             if ($i == 2 || $i == 5) {
    //                 $cpfFormatada .= '.';
    //             }

    //             if ($i == 8) {
    //                 $cpfFormatada .= '-';
    //             }
    //         }
    //         $cpf = $cpfFormatada;
    //     }

    //     return $cpf;
    // }

    /**
     * Retorna as colunas com os nomes dos campos para a importação em formato de array
     */
}
