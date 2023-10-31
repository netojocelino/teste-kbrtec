## Escopo


Criação de um sistema básico para inscrição de atletas em Campeonatos de Jiu-Jitsu.

Neste sistema, deverá haver as seguintes áreas:

1. **Site:** Área em que os campeonatos serão exibidos, assim como as informações das diferentes fases da competição: inscrição, chaves de lutas e resultados. Também haverá uma área restrita do atleta para que ele possa conferir os seus certificados.

2. **Painel Administrativo:** Área restrita para os administradores do sistema, por onde realizarão algumas funções básicas, como cadastro de campeonatos, consultas de inscrições de atletas, entre outros recursos. Maiores detalhes serão mencionados nos próximos tópicos.


> **Atenção:** Como trata-se de uma avaliação técnica de programação back-end, iremos fornecer o front-end básico para esse projeto, tanto do site, quanto do painel administrativo.
>
> Sobre o painel, estamos disponibilizando uma base de um modelo genérico, ou seja, ainda assim o candidato terá que adaptar e clonar alguns elementos para criar os recursos que são solicitados.


Seguem os links para download do front-end:

-  **Site e Área do Atleta:**  https://www.dropbox.com/scl/fi/er8308in316hrtq5jp0fg/osu-bjj.zip?rlkey=ebcekzx9ybqr5c7meeaiu3njh&dl=0

-  **Painel Administrativo:**  https://www.dropbox.com/scl/fi/vvxzqh1adgqh9ka4fwzme/painel.zip?rlkey=hyn2pdc9p1kuagwzp1hghgx2i&dl=0



A seguir estarão listados os detalhes que deverão ser desenvolvidos para cada uma das áreas desse sistema.

## Recursos:

#### Área Pública:

Esta área deverá conter os seguintes elementos:

1. **Exibição dinâmica dos campeonatos com status de ativo**:

    - a. Na home exibir 8 campeonatos em destaque no topo da página, conforme definido no painel administrativo.

    - b. Na home, abaixo do bloco de destaques, listar 8 campeonatos que não sejam destaques, ordenados dos mais recentes aos antigos.

    - c. Na listagem, existirão filtros para busca de campeonatos pelos seguintes campos: Local (Estado/Cidade), Tipo: (Select: Kimono ou No-GI) e Título do Evento.

    - d. Validar para que apenas campeonatos ativos sejam exibidos e retornados nas buscas que forem realizadas.

    - e. Inserir paginação de registros.

2. **Página de detalhes do campeonato**:

    - a. Ao clicar no bloco de exibição de cada campeonato, abrir uma página a exibição dinâmica dos respectivos dados cadastrais do campeonato clicado.

    - b. As URLs da página de íntegra de cada campeonato devem ser amigáveis e conter o código e nome de cada evento.

3. **Fases do Campeonato**:

    - a. No painel administrativo haverá a opção de inserir a fase atual do campeonato e de acordo com cada fase deverá ser exibido os seguintes recursos:
        - i. **Inscrições Abertas**: Durante essa fase deverá aparecer um botão que levará ao formulário de inscrição do atleta.
            - 1. Toda vez que um atleta se inscrever, enviar um e-mail ao administrador.
            - 2. Realizar as devidas validações de preenchimento e consistência de campos.
            - 3. Bloquear automaticamente o acesso ao formulário de inscrição e consequentemente o envio de inscrições quando essa fase não estiver ativa.
            - 4. Deverá haver o recurso de Captcha neste formulário.


        - ii. **Chaves de Lutas**: Durante essa fase, não será mais possível se inscrever no campeonato. No entanto, deverá ser exibida uma opção em que apareçam as Chaves de Lutas.
            - 1. Serão 4 chaves de lutas diferentes por evento:
                - a. Faixa Preta: Peso Leve
                - b. Faixa Preta: Peso Pesado
                - c. Faixa Marrom: Peso Leve
                - d. Faixa Marrom: Peso Pesado

                > Lembrando que haverá as divisões entre atletas do sexo Masculino e Feminino.

            - 2. Validar para que as informações de chaves só apareçam quando esta respectiva fase estiver ativa.

            - 3. Conferir demais detalhes mencionados dentro da seção do painel administrativo.

        - iii. **Resultados**: Durante essa fase, não será mais permitido se inscrever no campeonato e as informações das chaves de lutas serão ocultadas. No entanto, na Fase de Resultados deverá aparecer as informações dos vencedores de cada categoria do evento.
            1. Os registros de resultados serão importados através do painel administrativo.
            2. Lembrar que haverá 4 tipos diferentes de disputas por campeonatos e para cada um pódio de 3 atletas.

4. **Área do Atleta**:

O atleta possuirá uma área restrita por onde ele poderá logar e acessar todos os seus certificados, um por cada campeonato em que se inscrever. Sendo assim:
* Deverá haver o recurso completo de login e autenticação desta área.
* Haverá 2 tipos de certificado e sua exibição deverá ser feita dinamicamente:
    * Certificado de Participação: Para atletas que participaram e não venceram.
    * Certificado de Vitória: Para atletas que foram ao pódio, ou seja, se classificam em 1º, 2º ou em 3º lugar.
        * Notar que download de front-end que disponibilizamos existem estes dois certificados com as frases distintas. Validar para que seja exibida a frase correta para o atleta de acordo com a sua participação em cada campeonato.
        * Necessário haver também a função de exportar o certificado em PDF.



#### Painel Administrativo:

- 1. Autenticação do Painel Administrativo:
    - a. Deverá haver autenticação para acessar esse sistema, ou seja, apenas usuários previamente cadastrados poderão realizar o login e ter acesso a essas funcionalidades restritas. Criar então funcionalidades de login, autenticação e recuperação de senha.
    - b. Criar também um CRUD de Usuários Administrativos do painel.
        i. Nível de acesso: Inserir função de 2 níveis diferentes de usuários administrativos: “Administradores” terão acesso completo, já os “Usuários” poderão apenas visualizar as listagens de campeonatos, inscrições e resultados, sem poderem realizar nenhuma ação (cadastro, alteração e exclusão).



- 2. Cadastro de Campeonatos:
    - a. Dentro do painel restrito deve ser possível cadastrar, alterar e excluir campeonatos:
        - i. Imagem do Campeonato: Inserir recurso de JCrop, ou seja, ao carregar uma foto para o campeonato o administrador poderá selecionar e cortar uma área específica da imagem e essa será a parte que será exibida no site.
        - ii. Não permitir cadastrar campeonatos repetidos, ou seja, com mesmo Título, Local (Estado + Cidade), Ginásio e Data de Realização.
        - iii. Realizar as devidas validações de preenchimento e consistência de campos.

    - b. Deverá haver uma listagem de campeonatos cadastrados, com filtros básicos e paginação, além das opções citadas acima para alterar e excluir cada um dos campeonatos cadastrados.

    - c. Destaques de Campeonatos (na home):  Criar opção de “Destaques”, por onde o administrador poderá selecionar até 8 campeonatos, podendo selecionar a ordem entre eles, clicando e arrastando cada produto. Apenas poderá selecionar campeonatos com o status “Ativo”.



- 3. Fase dos Campeonatos:
    - a. Dentro do módulo de Campeonatos, inserir opção para alterar a fase dos campeonatos, selecionando uma destas opções: Inscrições Abertas, Chaves de Lutas e Resultados.
        - i. Inscrições Abertas: Durante essa fase os atletas poderão se inscrever nos campeonatos.
        - ii. Chaves de Lutas:
            - 1. Quando o administrador selecionar esta fase, o sistema deverá gerar automaticamente as chaves de lutas, ou seja, gerar randomicamente as duplas de atletas que se enfrentarão até a etapa final, seguindo o modelo de chaves com disputas eliminatórias. Essas chaves deverão ser apresentadas dentro da página do campeonato durante esta própria fase.
            - 2. Não haverá número mínimo e nem número máximo de atletas por cada chave.
            - 3. Caso houver mais de um atleta da mesma equipe (mesmo nome), eles não poderão se enfrentar diretamente na primeira etapa, desde que tenham atletas de outras equipes na mesma chave. Sendo assim: atletas da mesma equipe só se enfrentarão a partir das disputas posteriores.

        - iii. Resultados: Quando o administrador selecionar esta fase, deverá ser habilitada uma opção para importar os resultados das disputas através de CSV. Deixar na tela um atalho para download do arquivo de exemplo do modelo de arquivo que deverá ser carregado.


- 4. Inscrição de Atletas:
    - a. Deverá haver uma listagem com os registros preenchidos no formulário de Inscrição de Atletas com filtros básicos e paginação.
        - i. Na listagem exibir apenas algumas colunas básicas e ter uma opção para clicar e conseguir abrir os demais detalhes dos campos preenchidos (pode abrir em uma página de detalhes ou em uma popup).

        - ii. Os filtros devem ser: Nome do Atleta, Sexo: Masc/Fem, Título do Campeonato e Local (Cidade / estado).

        - iii. Na listagem de campeonatos, deve haver as opções para extrair os registros em CSV e em PDF, ou seja, botão em que o usuário clica e gera os arquivos com os dados exportados. Importante considerar os filtros aplicados no resultado que será exportado.


Estrutura dos Campos:

Campeonatos:
    * Código (obrigatório)
    * Título do Campeonato (obrigatório)
    * Imagem: (obrigatório)
    * Cidade + Estado (select) (obrigatório)
    * Data de Realização (obrigatório)
    * Sobre o evento (Ckeditor) (obrigatório)
    * Ginásio (Ckeditor)  (obrigatório)
    * Informações Gerais (Ckeditor) (obrigatório)
    * Entrada ao Público (Ckeditor) (preenchimento opcional)
    * Tipo: (Select: “Kimono” ou “No-Gi) / (obrigatório)
    * Fase (select: 3 opções mencionadas anteriormente) (obrigatório)
    * Status: Ativo/Inativo (obrigatório)



Inscrições de Atletas:
    * Código (obrigatório)
    * Nome (obrigatório)
    * Data de Nascimento (obrigatório)
    * CPF: (obrigatório)
    * Sexo: Masculino ou Feminino (obrigatório)
    * E-mail: (obrigatório)
    * Senha: (obrigatório)
    * Equipe: (obrigatório)
    * Faixa: (Select: Marrom / Preta) (obrigatório) - reduziremos apenas para essas 2 faixas para simplicar o sistema
    * Peso: (Select: Leve / Pesado) (obrigatório) – reduziremos apenas para essas 2 opções para simplificar o sistema
    * Data da Inscrição


Chaves de Lutas:
    * Código do Campeonato
    * Faixa
    * Peso
    * Atletas

Observação: Para cada campeonato, haverá disputas nas seguintes categorias:
    * Faixa Preta: Peso Leve
    * Faixa Preta: Peso Pesado
    * Faixa Marrom: Peso Leve
    * Faixa Marrom: Peso Pesado
Lembrando que haverá as divisões entre atletas do sexo Masculino e Feminino.



Resultados:
    * Código do Campeonato
    * Faixa
    * Peso
    * 1º Colocado
    * 2º Colocado
    * 3º Colocado

Observação: Para cada campeonato, haverá pódios de 1º, 2º e 3º colocados nas seguintes categorias:
    * Faixa Preta: Peso Leve
    * Faixa Preta: Peso Pesado
    * Faixa Marrom: Peso Leve
    * Faixa Marrom: Peso Pesado

Lembrando que haverá as divisões entre atletas do sexo Masculino e Feminino.





## Product Backlog:
Confira abaixo a listagem de cada recurso necessário para o projeto e que já foi mencionado acima:

| |  ÁREA PÚBLICA: SITE |
| :-: | :-: |
| 1 | Exibição dos Campeonatos |
| 1.1 | Home: Listagem dos campeonatos em destaque |
| 1.2 | Home: Listagem das 8 demais competições na home |
| 1.3 | Listagem interna dos campeonatos |
| 1.4 | Filtros de busca na página de listagem |
| 1.5 | Paginação de registros |
| 2 |  **Íntegra dos Campeonatos** |
| 2.1 | Exibição dinâmica dos dados |
| 2.2 | URL amigável da página de íntegra do campeonato |
| 2.3 | Exibição do botão correto correspondente à atual fase do campeonato |
| 3 |  **Fase: Inscrições Abertas** |
| 3.1 | Programação do formulário de inscrição do atleta |
| 3.2 | Validação e consistência dos campos |
| 3.3 | Inserção de Captcha no formulário |
| 3.4 | Envio de e-mail com os dados preenchidos no formulário de inscrição |
| 3.5 | Bloqueios e validações necessárias para que só apareçam informações  |desta fase quando estiver ativa
| 4 |  **Fase: Chave de Lutas** |
| 4.1 | Montagem dinâmica das chaves de lutas conforme as regras solicitadas |
| 4.2 | Bloqueios e validações necessárias para que só apareçam informações  |desta fase quando estiver ativa
| 5 |  **Fase: Resultados** |
| 5.1 | Exibição dinâmica dos resultados de cada campeonato |
| 5.2 | Bloqueios e validações necessárias para que só apareçam informações  |desta fase quando estiver ativa
| 6 |  **Área do Atleta:** |
| 6.1 | Autenticação completa da área restrita |
| 6.2 | Recuperação de Senha |
| 6.3 | Listagem de todos os certificados do próprio atleta |
| 6.4 | Exibição do Certificado de participação ou de vitória |
| 6.5 | Exportação em PDF do certificado |
|| **PAINEL ADMINISTRATIVO** |
| 7 |  **Módulo de Autenticação** |
| 7.1 | Autenticação completa do painel administrativo |
| 7.2 | Recuperação de senha |
| 7.3 | CRUD Usuários |
| 7.4 | Módulo de usuários com 2 diferentes níveis de acesso (ADMIN e User) |
| 8 |  **CRUD Campeonatos** |
| 8.1 | Cadastro, alteração, listagem e exclusão de campeonatos |
| 8.2 | Imagem do Campeonato: Inserir recurso de cortar imagem |
| 8.3 | Recurso de seleção dos Destaques de Campeonatos |
| 9 |  **Fase dos Campeonatos** |
| 9.1 | Seleção da fase atual de cada campeonato |
| 9.2 | Programação da fase de Inscrições Abertas |
| 9.3 | Programação da fase de Chaves de Lutas |
| 9.4 | Programação da fase de Resultados |
| 10 |  **Atletas** |
| 10.1 | Inscrições: Listagem das inscrições dos atletas com os filtros  |solicitados e paginação
| 10.2 | Extração dos dados em CSV e PDF |
| 10.3 | Opção para visualizar os certificados de cada atleta de acordo com os seu resultados nos diferentes campeonatos em que o atleta se inscreveu.




**Orientações**:

* Criar um projeto que contenha todos os recursos solicitados, seguindo as orientações mencionadas neste documento. Caso não consiga desenvolver todos os recursos solicitados, entregar o teste mesmo que incompleto. Quanto mais for desenvolvido corretamente, melhor será para avaliar.

* O projeto pode ser desenvolvido em PHP ou em .Net. Caso escolham PHP, recomendamos utilizar algum framework, de preferência o Laravel.

* O banco de dados pode ser desenvolvido tanto em MySQL ou em SQL Server.

* Ao finalizar o teste, dentro do prazo estipulado, subir todo o código-fonte na sua conta do GitHub e nos enviar o link de acesso. Avaliaremos o código-fonte do projeto que for desenvolvido.

* Não esquecer de nos fornecer algum login e senha de acesso ao sistema restrito.

* O projeto deverá ser realizado única e exclusivamente pelo próprio candidato, sendo proibido a ajuda de terceiros.

* Os responsáveis pelos melhores projetos desenvolvidos serão chamados para entrevistas online, para que possamos conhecê-los melhor, além de realizar algumas perguntas específicas sobre a forma em que realizaram o teste.

* Enviaremos um retorno para todos os candidatos que realizarem o teste, sendo aprovados ou não para a próxima etapa.

**Boa prova!**

