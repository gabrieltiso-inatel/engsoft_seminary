## C214 Tic-Tac-Toe

Esse projeto contém todos os arquivos necessários para construir e executar
o projeto final da disciplina de C214 (Engenharia de Software).
O projeto consiste em um jogo de **Tic-Tac-Toe** (ou Jogo da Velha) para dois jogadores,
utilizando WebSockets para comunicação entre os jogadores durante o jogo. É uma aplicação
simples, mas que utiliza conceitos de Engenharia de Software de forma a tornar o projeto
mais robusto e escalável.

A aplicação foi desenvolvida em **PHP**, utilizando as seguintes ferramentas:
- **PHPUnit**: Realização de testes unitários e testes mock.
- **Jenkins**: Servidor de CI (Continuous Integration) responsável pelo
pipeline de construção e testes do projeto. 

### Estrutura do projeto

A estrutura do projeto é a seguinte:
```
.
├── local
├── public
├── scripts
├── src
└── tests
```

- `local/`: Pasta que contém os arquivos necessários para executar a aplicação localmente.
- `public/`: Contém os arquivos `.php` servidos pelo Nginx. Aqui ficam as páginas do jogo e também
do formulário de entrada nas salas.
- `scripts/`: Scripts utilitários para infraestrutura.
- `src/`: Contém os arquivos de código fonte do projeto. Aqui ficam as classes responsáveis
  pela lógica do jogo, comunicação entre jogadores e persistência de dados.
- `tests/`: Contém os arquivos de teste do projeto.

Alguns outros arquivos foram omitidos para não poluir a visualização da estrutura do projeto.

### Desenvolvendo localmente

Durante o desenvolvimento da aplicação, optamos por não instalar o PHP localmente,
(o que sinceramente você não deveria fazer também). Nesse sentido, existem duas formas
de desenvolver localmente:

#### Utilizando o Docker
Para utilizar essa opção, você deve ter o Docker e o Docker Compose instalados na sua máquina.
Para que todos os serviços sejam iniciados, basta executar o seguinte comando:

```bash
docker-compose up
```

Isso irá iniciar os três serviços necessários para o funcionamento do projeto:
- `php-web`: Serve páginas `.php` utilizando o FPM (FastCGI Process Manager). É utilizado junto com o Nginx.
- `ws-server`: Servidor web socket responsável pela comunicação entre jogadores durante os jogos.
- `nginx`: Responsável por, nesse momento, servir as páginas `.php`. Atua como um proxy reverso
  para o `php-web`.

Para começar a adicionar novas mudanças, use o editor de sua preferencia e faça as alterações.
Para verificar se os testes estão passando, utilize o seguinte comando:

```bash
docker-compose exec php-web vendor/bin/phpunit
```

#### Utilizando PHP, Composer e PHPUnit
Caso você tenha o PHP, o Composer e o PHPUnit instalados na sua máquina, você pode
executar os seguintes comandos para instalar as dependências do projeto e executar os testes:

```bash
composer install # Instala as dependências do projeto
vendor/bin/phpunit # Executa os testes
```

### Pipeline 

O pipeline de CI (Continuous Integration) foi desenvolvido utilizando o Jenkins. Estamos 
utilizando una imagem do Docker para o Jenkins, modificada para incluir o PHP, Composer e o PHPUnit.

Para executar o Jenkins, basta executar o script `scripts/setup_local_jenkins.sh`:

Acesse o Jenkins através do navegador, utilizando a URL `http://localhost:8888/`. Se quiser, 
pode alterar a porta `8888` para outra porta de sua preferência, mas lembre-se de alterar também
o comando acima.