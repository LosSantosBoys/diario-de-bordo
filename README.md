# diario-de-bordo-backend

Back-end do Diário de Bordo do projeto Mental-aid. Desenvolvido com PHP no primeiro (1°) ano da FIAP.

## Tecnologias

-   [PHP](https://www.php.net/)
-   [Laravel](https://laravel.com/docs/9.x)
-   [MySQL](https://www.mysql.com/)
-   [Composer](https://getcomposer.org/)

## TODO

-   [x] Cadastro de posts
-   [x] Listagem de posts
-   [x] Exclusão de posts
-   [x] Edição de posts
-   [x] Exibição de posts
-   [x] Pesquisa de posts
-   [x] Filtro de posts
-   [ ] Paginação de posts
-   [ ] Likes? de posts
-   [ ] Comentários? de posts
-   [x] Cadastro de categorias
-   [x] Listagem de categorias
-   [x] Exclusão de categorias
-   [x] Edição de categorias
-   [x] Pesquisa de categorias
-   [x] Testes de banco de dados
-   [x] Testes de API de posts
-   [x] Testes de API de categorias
-   [ ] Cadastro de usuários
-   [ ] Listagem de usuários
-   [ ] Edição de usuários
-   [ ] Exclusão de usuários
-   [ ] Visualização de usuários
-   [ ] Pesquisa de usuários

## Recursos

-   CRUD de posts
-   Pesquisa de posts
-   Filtro de posts
-   CRUD de categorias
-   Pesquisa de categorias

## API

| Método | Rota                 | Descrição                                  |
| ------ | -------------------- | ------------------------------------------ |
| GET    | /posts               | Lista todos os posts                       |
| POST   | /posts               | Cria um novo post                          |
| GET    | /posts/:id           | Lista dados de um post específico          |
| PUT    | /posts/:id           | Atualiza dados de um post específico       |
| DELETE | /posts/:id           | Apaga um post específico                   |
| GET    | /posts/search/:query | Pesquisa por um post pelo título ou slug   |
|        |                      |                                            |
| GET    | /categories          | Lista todos as categorias                  |
| POST   | /categories          | Cria uma nova categoria                    |
| GET    | /categories/:id      | Lista dados de uma categoria específica    |
| PUT    | /categories/:id      | Atualiza dados de uma categoria específica |
| DELETE | /categories/:id      | Apaga uma categoria específica             |

## Como usar

O projeto está dividido em dois repositórios:

1. Front-end ([diario-de-bordo-frontend](https://github.com/LosSantosBoys/diario-de-bordo-frontend))
2. Back-end (este repositório)

O front-end precisa que o back-end esteja sendo executado para funcionar corretamente.

### Pré requisitos

-   [Git](https://git-scm.com)

## Rodando os testes

Para rodar os testes, rode o seguinte comando:

```bash
php artisan test
```

## Insomnia

Caso queira testar a API, pode agilizar o processo pelo [Insomnia](https://insomnia.rest/).

<p align="center">
  <img src="Insomnia_screenshot.png" alt="Insomnia screenshot">
  <a href="Insomnia_API.json" target="_blank"><img src="https://insomnia.rest/images/run.svg" alt="Run in Insomnia"></a>
</p>

## Licença

Esse projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
