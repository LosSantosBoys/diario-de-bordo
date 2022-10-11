# diario-de-bordo-backend
Back-end do Diário de Bordo do projeto Mental-aid. Desenvolvido com PHP no primeiro (1°) ano da FIAP.

## Tecnologias
- [PHP](https://www.php.net/)
- [MySQL](https://www.mysql.com/)

## TODO
- [x]  Cadastro de posts
- [x]  Listagem de posts
- [x]  Exclusão de posts
- [x]  Edição de posts
- [ ]  Paginação de posts
- [x]  Exibição de posts
- [ ]  Likes? de posts
- [ ]  Comentários? de posts

## Recursos

## API

| Método    | Rota       | Descrição                            |
| --------- | ---------- | ------------------------------------ |
| HEAD, GET | /posts     | Lista todos os posts                 |
| POST      | /posts/new | Cria um novo post                    |
| HEAD, GET | /posts/:id | Lista dados de um post específico    |
| PUT       | /posts/:id | Atualiza dados de um post específico |
| DELETE    | /posts/:id | Apaga um post específico             |

## Como usar
O projeto está dividido em dois repositórios:

1. Front-end ([diario-de-bordo-frontend](https://github.com/LosSantosBoys/diario-de-bordo-frontend))
2. Back-end (este repositório)

O front-end precisa que o back-end esteja sendo executado para funcionar corretamente.

### Pré requisitos
- [Git](https://git-scm.com)

## Insomnia
Caso queira testar a API, pode agilizar o processo pelo [Insomnia](https://insomnia.rest/).

<p align="center">
  <img src="Insomnia_screenshot.png" alt="Insomnia screenshot">
  <a href="Insomnia_API.json" target="_blank"><img src="https://insomnia.rest/images/run.svg" alt="Run in Insomnia"></a>
</p>

## Licença
Esse projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.
