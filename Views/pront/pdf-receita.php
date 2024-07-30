<?php


date_default_timezone_set("America/Sao_Paulo");
require 'vendor/autoload.php';

try {
    // Cria uma nova instância do mPDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P");
    $mpdf->SetSubject('Receita paciente');
    $mpdf->SetKeywords('Receita-paciente, Documento, PDF');

    // Define o conteúdo do PDF
    foreach ($retorno as $dado) {
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
                            <h4>Receita</h4> 
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
                            <pre>
                                <p>$dado->receita</p>
                            </pre>
                           
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
    $mpdf->Output('receita.pdf', \Mpdf\Output\Destination::INLINE);

    echo "PDF gerado com sucesso!";

} catch (\Mpdf\MpdfException $e) { // Captura exceções de mPDF
    echo "Erro ao gerar o PDF: " . $e->getMessage();
}

