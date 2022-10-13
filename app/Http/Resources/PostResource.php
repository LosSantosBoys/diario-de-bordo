<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'titulo' => $this->titulo,
            'conteudo' => $this->conteudo,
            'visivel' => $this->visivel,
            'data_de_publicacao' => $this->data_de_publicacao,
            'categoria_id' => $this->categoria_id,
        ];
    }
}

?>