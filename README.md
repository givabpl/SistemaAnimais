# Portal Veterinário Prefeitura 

## Principais Funcionalidades
- Cadastro de tutores e animais para consultas e rastreamento.
- A visão de cadastro dos veterinários foi criada apenas para testes. O ideal é que o cadastro seja feito de forma privada, não sendo dispoonibilizado publicamente.
- Na visão publica: Informações gerais, registro e listagem de animais desaparecidos ou perdidos.

### Login Veterinário
O veterinário logado pode cadastrar, editar e excluir (apenas do tipo "Administrador") animais e tutores.
Além disso, ele pode criar prontuários e receitas. Estes, podem ser convertidos em PDF e impressos.
#### Adicional do prontuário
Sobre o prontuário: Quando um prontuário é criado, a variável "peso" atualiza o peso do animal.

## Estrutura do Projeto

Este projeto está organizado no modelo MVC (Model, View e Controller), em PHP.
### Em resumo (referente às **pastas**):
- **/Models/** contém arquivos de classe. 
- **/DAOs/** contém arquivos de classe que complementam as classes, com métodos que lidam diretamente com o banco de dados.
- **/Views/** contém views de início e subpastas referentes a cada classe, essas subpastas agregam as demais visões.
- **/Controllers/** contém arquivos de classe que possuem métodos que realizam intermédio entre **Views, DAOs e Models**

### Biblioteca Utilizada
Esse projeto utiliza a biblioteca **mPDF** para gerar os PDFs de prontuário, receita, perfil do animal, animal desaparecido e animal perdido.
Os arquivos de PDF estão em Views e inicial com pdf

