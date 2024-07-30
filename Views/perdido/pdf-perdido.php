<?php

date_default_timezone_set("America/Sao_Paulo");
require 'vendor/autoload.php'; 

try {
    // Cria uma nova instância do mPDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P");
    $mpdf->SetSubject('Desaparecido');
    $mpdf->SetKeywords('Animal-desaparecido, Documento, PDF');

    // Define o conteúdo do PDF
    foreach($retorno as $dado)
    {
        $head = "   <style>
                        h1{
                            font-size: 50px;
                        }
                        h1, h2, p, img {
                            text-align: center;
                        }
                        img{
                            margin-left: 20%;
                            width: 400px;
                        }
                        p{
                            font-size: 24px;
                        }
                        .body{
                            margin: 20px;
                        }
                        div{
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        }
                    </style>";
    
        $head = $head . "<div class='body'> <h1>DESAPARECIDO</h1>";

        $header = " 
                        <div>
                            <img src='$dado->imagem' class='card-img-top' alt='...'>
                            <h1>$dado->nome_animal</h1>
                            <p>
                                Visto(a) pela última vez em $dado->data_formatada às $dado->hora_formatada <br>
                                $dado->locald
                            </p>
                            <p>
                                $dado->descritivo
                            </p>
                        
                        </div>
        ";

        $body = "   
                        <div>
                            <p>
                                Tutor(a): $dado->nome_tutor <br>
                                Contato: $dado->telefone1 &nbsp;&nbsp;  $dado->telefone2
                            </p>
                        </div>
                        <br> <br> 
                    </div>
        ";
    }

    $html = $head . $header . $body;
    $mpdf->WriteHTML($html);

    // Define o nome do arquivo PDF para download
    $mpdf->Output('desaparecido.pdf', \Mpdf\Output\Destination::INLINE);

    echo "PDF gerado com sucesso!";
    
} catch (\Mpdf\MpdfException $e) { // Captura exceções de mPDF
    echo "Erro ao gerar o PDF: " . $e->getMessage();
}

