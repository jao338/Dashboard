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
    public function getCategories(): array
    {
        return getCategories();
    }
    public function getTags(): array
    {
        return getTags();
    }
    public function getIDSMostPlayedGames(): array
    {
        return getIDSMostPlayedGames();
    }
}
