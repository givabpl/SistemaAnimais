# Portal Veterinário Prefeitura 

## Principais Funcionalidades
- Cadastro de tutores e animais para consultas e rastreamento;
- A visão de cadastro dos veterinários foi criada apenas para testes. O ideal é que o cadastro seja feito de forma privada, não sendo disponibilizado publicamente;
- Na visão publica: Informações gerais, registro e listagem de animais desaparecidos ou perdidos;

### O Login Veterinário
O veterinário logado pode cadastrar, editar e excluir (apenas do tipo "Administrador") animais e tutores. Além disso, ele pode criar prontuários e receitas. Estes, podem ser convertidos em PDF e impressos.

#### A Função Adicional do Prontuário
Sobre o prontuário: Quando um prontuário é criado, a variável "peso" atualiza o peso do animal;



## Estrutura do Projeto

Este projeto está organizado no modelo MVC (Model, View e Controller), em PHP.
### Em resumo (referente às **pastas**):
- **/Models/** contém arquivos de classe;
- **/DAOs/** contém arquivos de classe que complementam as classes, com métodos que lidam diretamente com o banco de dados;
- **/Views/** contém views de início e subpastas referentes a cada classe, essas subpastas agregam as demais visões;
- **/Controllers/** contém arquivos de classe que possuem métodos que realizam intermédio entre **Views, DAOs e Models**

### Bibliotecas Utilizadas

- **mPDF** para gerar os PDFs de prontuário, receita, perfil do animal, animal desaparecido e animal encontrado. Os arquivos de PDF estão em **/Views/** e possuem o prefixo ___pdf___;
- **ApexCharts** para gerar gráficos de estatísticas de prontuários/atendimentos. O arquivo que utiliza o ApexCharts está em **/Views/pronts/** e se chama ___listar-estatisticas-pronts.php___




# Alterações após testes

De início, as tabelas de achados e perdidos eram vinculadas as tabelas de animais e tutores, porém, dessa forma, acessos públicos teriam a capacidade de inserir novos animais, "invadindo" a tabela de animais acessada pelos veterinários.

Dessa forma, em 12/08/2024 foi iniciada a desvinculação da tabela de animais.

Além dessa mudança, após análise, foi concluído que não seria prudente permitir que acessos públicos pudessem registrar diretamente animais desaparecidos/encontrados, em função de cadastros maliciosos que poderiam invadir a listagem de achados e perdidos.

Dito isso, em 12/08 também foi iniciada a implementação de uma etapa de aprovação de postagens, que devem ser atorizadas ou barradas pelos veterinários.


