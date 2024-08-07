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




