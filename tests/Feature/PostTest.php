<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se a API de CRIAR Post funciona.
     *
     * @return void
    */
    public function test_if_create_endpoint_returns_a_successful_response()
    {
        $response = $this->json('POST', '/api/v1/posts', [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste",
            "data_de_publicacao" => '2022-10-13 21:37:35',
            "visivel" => 1
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('posts', [
            "slug" => "titulo-de-teste",
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste",
            "data_de_publicacao" => '2022-10-13 21:37:35',
            "visivel" => 1,
        ],);
    }

    /**
     * Testa se a API de EDITAR Post funciona.
     *
     * @return void
    */
    public function test_if_edit_endpoint_returns_a_successful_response()
    {
        $this->json('POST', '/api/v1/posts', [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste",
            "data_de_publicacao" => '2022-10-13 21:37:35',
            "visivel" => 1
        ]);
        
        $response = $this->json('PUT', '/api/v1/posts/titulo-de-teste', [
            "slug" => "titulo de teste atualizado",
            "titulo" => "Título de teste atualizado",
            "conteudo" => "conteudo de teste atualizado",
            "data_de_publicacao" => '2022-10-14 21:37:35',
            "visivel" => 0
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            "slug" => "titulo-de-teste-atualizado",
            "titulo" => "Título de teste atualizado",
            "conteudo" => "conteudo de teste atualizado",
            "data_de_publicacao" => '2022-10-14 21:37:35',
            "visivel" => 0
        ],);
    }

    /**
     * Testa se a API de APAGAR Post funciona.
     *
     * @return void
    */
    public function test_if_delete_endpoint_returns_a_successful_response()
    {
        $this->json('POST', '/api/v1/posts', [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ]);

        $this->json('DELETE', '/api/v1/posts/titulo-de-teste');
        $this->assertDatabaseMissing('posts', [
            'titulo' => 'Título de teste',
        ]);
    }

    /**
     * Testa se a API de VISUALIZAR Post funciona.
     *
     * @return void
    */
    public function test_if_show_endpoint_returns_a_successful_response()
    {
        $this->json('POST', '/api/v1/posts', [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste",
            "data_de_publicacao" => '2022-10-13 21:37:35',
            "visivel" => 1
        ]);

        $this->json('GET', '/api/v1/posts')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'id',
                            'slug',
                            'titulo',
                            'conteudo',
                            'visivel',
                            'data_de_publicacao',
                            'categoria_id'
                        ]
                    ],
                    'meta' => [
                        'count'
                    ]
                ]
            );
    }

    /**
     * Testa se a API de VISUALIZAR Post funciona.
     *
     * @return void
    */
    public function test_if_list_endpoint_returns_a_successful_response()
    {
        $this->json('POST', '/api/v1/posts', [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste",
            "data_de_publicacao" => '2022-10-13 21:37:35',
            "visivel" => 1
        ]);

        $this->json('GET', '/api/v1/posts')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'slug',
                            'titulo',
                            'conteudo',
                            'visivel',
			                'data_de_publicacao',
                            'categoria_id'
                        ]
                    ],
                    'meta' => [
                        'count'
                    ]
                ]
            );
    }

    /**
     * Testa se a API de lista retorna vazia.
     *
     * @return void
    */
    public function test_if_list_endpoint_returns_an_empty_list()
    {
        $this->json('GET', '/api/v1/posts')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [],
                    'meta' => [
                        'count'
                    ]
                ]
            );
    }
}
