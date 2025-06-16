<?php

namespace Domain\Info;

use Domain\BaseService;

class InfoService extends BaseService
{
    //  Criar tabela
    public function getGenres(): array
    {
        return getGenres();
    }
}
