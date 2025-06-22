<?php

namespace Domain\Models\Info;

class InfoService
{
    public function getIDSMostPlayedGames(): array
    {
        return getIDSMostPlayedGames();
    }
}
