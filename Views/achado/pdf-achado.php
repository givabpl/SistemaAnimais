<?php

date_default_timezone_set("America/Sao_Paulo");
require 'vendor/autoload.php';

try {
    // Cria uma nova instância do mPDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P");
    $mpdf->SetSubject('Perfil animal encontrado');
    $mpdf->SetKeywords('Perfil-animal, Documento, PDF');

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
                        h1{
                            font-size: 20px;
                        }
                        h2{
                            font-size: 18px;
                            font-weight: normal;
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
                            Data: " . date("d/m/Y");

        $header = "     <div>   <h1>Formulário de Animal Encontrado</h1>
                                <h2>
                                    Animal: $dado->especie $dado->raca <br>
                                    Pelagem: $dado->pelagem <br>
                                    Sexo: $dado->sexo
                                </h2>
                                
                                <h3>
                                    Encontrado em $dado->data_formatada às $dado->hora_formatada
                                </h3>
                                <h3>
                                    Local: $dado->localac
                                </h3>
                                
                                <h4>
                                    Quem encontrou: $dado->nome_pessoa $dado->sobrenome <br>
                                    Contato: $dado->telefone1  $dado->telefone2
                                </h4>
                                <h4>Descritivo:</h4>
                                <div class='infos'>
                                    <pre>
                                        <p>$dado->descritivo</p>
                                    </pre>
                                </div>
                                
                        </div>
                             
                        
        ";

        $body = "   
                        <div>
                            <h4>Animal</h4>
                            <p>
                                Nome:_____________________________       
                                Rga:____________________________ 
                                Chip:______________________  
                                <br><br>
                                Tutor:_________________________________________________
                                
                            </p>
                        </div>
                        <br>
                        <div>
                        <br> <br>
                            <p style='text-align: center;'>___________________________________________________</p>
                            <p style='text-align: center;'>Emitido por</p>
                        </div>
                    </div>
        ";
    }

    $html = $head . $header . $body;
    $mpdf->WriteHTML($html);

    // Define o nome do arquivo PDF para download
    $mpdf->Output('pdf_achado.pdf', \Mpdf\Output\Destination::INLINE);

    echo "PDF gerado com sucesso!";

} catch (\Mpdf\MpdfException $e) { // Captura exceções de mPDF
    echo "Erro ao gerar o PDF: " . $e->getMessage();
}

