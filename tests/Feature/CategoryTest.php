<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testa se a API de CRIAR Categoria funciona.
     *
     * @return void
    */
    public function test_if_create_endpoint_returns_a_successful_response()
    {
        $response = $this->json('POST', '/api/v1/categories', [
            "titulo" => "Categoria de teste",
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            "titulo" => "Categoria de teste",
        ],);
    }

    /**
     * Testa se a API de EDITAR Post funciona.
     *
     * @return void
    */
    public function test_if_edit_endpoint_returns_a_successful_response()
    {
        $response = $this->json('POST', '/api/v1/categories', [
            "titulo" => "Categoria de teste",
        ]);
        
        $response = $this->json('PUT', '/api/v1/categories' . '/categoria-de-teste', [
            "slug" => "Categoria de teste atualizada",
            "titulo" => "Categoria de teste atualizada",
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            "slug" => "categoria-de-teste-atualizada",
            "titulo" => "Categoria de teste atualizada",
        ],);
    }

    /**
     * Testa se a API de APAGAR Post funciona.
     *
     * @return void
    */
    public function test_if_delete_endpoint_returns_a_successful_response()
    {
        $this->json('POST', '/api/v1/categories', [
            "titulo" => "Categoria de teste",
        ]);

        $this->json('DELETE', '/api/v1/categories' . '/categoria-de-teste');
        $this->assertDatabaseMissing('categories', [
            'titulo' => 'Categoria de teste',
        ]);
    }

    /**
     * Testa se a API de VISUALIZAR Post funciona.
     *
     * @return void
    */
    public function test_if_show_endpoint_returns_a_successful_response()
    {
        $this->json('POST', '/api/v1/categories', [
            "titulo" => "Categoria de teste",
        ]);

        $this->json('GET', '/api/v1/categories')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        [
                            'id',
                            'slug',
                            'titulo',
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
        $this->json('POST', '/api/v1/categories', [
            "titulo" => "Categoria de teste",
        ]);

        $this->json('GET', '/api/v1/categories')
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'slug',
                            'titulo',
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
        $this->json('GET', '/api/v1/categories')
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
