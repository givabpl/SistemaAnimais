<?php

date_default_timezone_set("America/Sao_Paulo");
require 'vendor/autoload.php'; 

try {
    // Cria uma nova instância do mPDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P");
    $mpdf->SetSubject('Prontuario paciente');
    $mpdf->SetKeywords('Prontuario-paciente, Documento, PDF');

    // Define o conteúdo do PDF
    foreach($retorno as $dado)
    {
        $head = "   <style>
                        .infos {
                            margin: 0;
                            padding: 0;
                        }
                        pre,p {
                            margin: 0;
                            padding: 0;
                            white-space: pre-wrap;
                        }
                        table {
                            width: 100%;
                            border-collapse: collapse;
                        }
                        table, th, td {
                            border: 1px grey;
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        }
                        th, td {
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #f2f2f2;
                        }
                        .body{
                            margin: 20px;
                        }
                        div{
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        }
                    </style>";
    
        $head = $head . "<div class='body'> 
                            <img src='src/assets/timbre-prefeitura/timbre-cabecalho.jpeg' alt='' width='100%'>
                            <h4>Prontuário Médico</h4> 
                            Emissão: " . date("d/m/Y") . "&nbsp; | &nbsp; $dado->titulo";

        $header = " 
                        <div>
                            <p>
                                Consulta em: $dado->dataa_formatada  &nbsp; |  &nbsp;

                                $dado->locala  &nbsp; |  &nbsp;

                                Paciente:  $dado->nome_animal &nbsp; | &nbsp;
                                Tutor:  $dado->nome_tutor
                            </p>
                            <p>
                                Atendimento: $dado->nome_vet
                            </p>
                        </div>
                        
        ";

        $body = "       
                        <br>
                        <div class='infos'>
                            Descritivo:
                            <pre>
                                <p>$dado->descritivo</p>
                            </pre>
                            <br>
                            
                            Medicação: $dado->medicacao
                            <pre>
                                <p>$dado->medicacao_info</p>
                            </pre>
                            
                            Internação: $dado->internacao
                            <pre>
                                <p>$dado->internacao_info</p>
                            </pre>

                            <p><strong>Perfil de:</strong> $dado->nome_animal </p>

                            <table>
                                <tr>
                                    <th>Rga</th>
                                    <th>Data nascimento</th>
                                    <th>Sexo</th>
                                    <th>Peso</th>
                                    <th>Espécie</th>
                                    <th>Raça</th>
                                </tr>
                                <tr>
                                    <td>$dado->rga</td>
                                    <td>$dado->datan_formatada</td>
                                    <td>$dado->sexo</td>
                                    <td>$dado->peso</td>
                                    <td>$dado->especie</td>
                                    <td>$dado->raca</td>
                                </tr>
                            </table>

                            <table>
                                <tr>
                                    <th>Pelagem</th>
                                    <th>Alergias</th>
                                    <th>Doenças <br> pré-existentes</th>
                                    <th>Cirurgias</th>
                                    <th>Aquisição</th>
                                </tr>
                                <tr>
                                    <td>$dado->pelagem</td>
                                    <td>$dado->alergias</td>
                                    <td>$dado->doencas</td>
                                    <td>$dado->cirurgias</td>
                                    <td>$dado->aquisicao</td>
                                </tr>
                            </table>
                        </div>
                        <br> <br> <br>
                        <div>
                            <p style='text-align: center;'>___________________________________________________</p>
                            <p style='text-align: center;'>Assinatura / carimbo de $dado->nome_vet</p>
                        </div>
                    </div>
        ";
    }

    $html = $head . $header . $body;
    $mpdf->WriteHTML($html);

    // Define o nome do arquivo PDF para download
    $mpdf->Output('prontuario.pdf', \Mpdf\Output\Destination::INLINE);

    echo "PDF gerado com sucesso!";
    
} catch (\Mpdf\MpdfException $e) { // Captura exceções de mPDF
    echo "Erro ao gerar o PDF: " . $e->getMessage();
}

