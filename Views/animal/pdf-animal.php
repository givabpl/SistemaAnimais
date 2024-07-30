<?php

date_default_timezone_set("America/Sao_Paulo");
require 'vendor/autoload.php'; 

try {
    // Cria uma nova instância do mPDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->AddPage("P");
    $mpdf->SetSubject('Perfil paciente');
    $mpdf->SetKeywords('Perfil-paciente, Documento, PDF');

    // Define o conteúdo do PDF
    foreach($retorno as $dado)
    {
        $head = "   <style>
                        .body{
                            margin: 20px;
                        }
                        div{
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                        }
                    </style>";
    
        $head = $head . "<div class='body'> Data: " . date("d/m/Y");

        $header = " 
                        <div>
                            <p>
                                Paciente:  $dado->nome &nbsp; | &nbsp;

                                Rga:  $dado->rga  &nbsp; |  &nbsp;

                                Tutor:  $dado->nome_tutor &nbsp; 
                            </p>

                        </div>
        ";

        $body = "   
                        <div>
                            <p>Chip:  $dado->chip </p>
                            <p>Data de nascimento:   
                            <?php 
                                $date = new DateTime($dado->datan); 
                                echo $date->format('d/m/Y'); 
                            ?> <!-- DATA DE NASCIMENTO -->
                            </p>
                            <p>Sexo:  $dado->sexo </p>
                            <p><strong>Peso: </strong> $dado->peso  Kg</p>
                            <p><strong>Espécie: </strong> $dado->especie </p>
                            <p><strong>Raça: </strong> $dado->raca </p>
                            <p><strong>Pelagem: </strong>
                                            $dado->pelagem </p>
                            <p><strong>Alergias: </strong>
                                            $dado->alergias </p>
                            <p><strong>Doenças pré-existentes:  </strong>
                                            $dado->doencas </p>
                            <p><strong>Cirurgias anteriores: </strong>
                                            $dado->cirurgias </p>
                            <p><strong>Aquisição: </strong>
                                            $dado->aquisicao </p>
                        </div>
                        <br>
                        <div>
                            <p style='text-align: center;'>___________________________________________________</p>
                            <p style='text-align: center;'>Emitido por</p>
                        </div>
                    </div>
        ";
    }

    $html = $head . $header . $body;
    $mpdf->WriteHTML($html);

    // Define o nome do arquivo PDF para download
    $mpdf->Output('pdf_perfil_animal.pdf', \Mpdf\Output\Destination::INLINE);

    echo "PDF gerado com sucesso!";
    
} catch (\Mpdf\MpdfException $e) { // Captura exceções de mPDF
    echo "Erro ao gerar o PDF: " . $e->getMessage();
}

