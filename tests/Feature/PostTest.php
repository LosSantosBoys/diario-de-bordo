<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

const API_PATH = '/api/v1/posts';

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
        $response = $this->json('POST', API_PATH, [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            "slug" => "titulo-de-teste",
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ],);
    }

    /**
     * Testa se a API de EDITAR Post funciona.
     *
     * @return void
    */
    public function test_if_edit_endpoint_returns_a_successful_response()
    {
        $this->json('POST', API_PATH, [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ]);
        
        $response = $this->json('PUT', API_PATH . '/titulo-de-teste', [
            "slug" => "titulo de teste atualizado",
            "titulo" => "Título de teste atualizado",
            "conteudo" => "conteudo de teste atualizado"
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', [
            "slug" => "titulo-de-teste-atualizado",
            "titulo" => "Título de teste atualizado",
            "conteudo" => "conteudo de teste atualizado"
        ],);
    }

    /**
     * Testa se a API de APAGAR Post funciona.
     *
     * @return void
    */
    public function test_if_delete_endpoint_returns_a_successful_response()
    {
        $this->json('POST', API_PATH, [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ]);

        $this->json('DELETE', API_PATH . '/titulo-de-teste');
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
        $this->json('POST', API_PATH, [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ]);

        $this->json('GET', API_PATH)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'id',
                            'slug',
                            'titulo',
                            'conteudo',
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
        $this->json('POST', API_PATH, [
            "titulo" => "Título de teste",
            "conteudo" => "conteudo de teste"
        ]);

        $this->json('GET', API_PATH)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'slug',
                            'titulo',
                            'conteudo',
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
        $this->json('GET', API_PATH)
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
