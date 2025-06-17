<?php

if (!function_exists('setDate')) {
    function setDate($value)
    {
        if (trim($value) == '') {
            return null;
        }
        return \DateTime::createFromFormat('d/m/Y', trim($value))->format('Y-m-d');
    }
}

if (!function_exists('getSteamEndpoint')) {
    function getSteamEndpoint(string $key, array $params = []): string
    {
        //  Quando estiver finalizado alterar o uso de "getTestSteamId"
        $endpoints = [
            'players_online' => 'https://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1/?appid={appid}',
            'achievements' => 'https://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid={appid}',
            'game_details' => 'https://store.steampowered.com/api/appdetails?appids={appid}',
            'game_news' => 'https://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid={appid}&count=3&maxlength=300&format=json',
            'player_info' => 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . getSteamApiKey() . '&steamids=' . getTestSteamId(),
            'app_list' => 'https://api.steampowered.com/ISteamApps/GetAppList/v2/',
            'player_friendlist' => 'https://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=' . getSteamApiKey() . '&steamid=' . getTestSteamId() . '&relationship=friend',
            'player_achievements' => 'https://api.steampowered.com/ISteamUserStats/GetPlayerAchievements/v0001/?appid={appid}&key=' . getSteamApiKey() . '&steamid=' . getTestSteamId(), '',
        ];

        if (!isset($endpoints[$key])) {
            throw new InvalidArgumentException("Invalid Steam API key: {$key}");
        }

        $endpoint = $endpoints[$key];

        foreach ($params as $param => $value) {
            $endpoint = str_replace("{" . $param . "}", $value, $endpoint);
        }

        return $endpoint;
    }
}

if (!function_exists('getSteamApiKey')) {
    function getSteamApiKey(): string
    {
        return env('STEAM_API_KEY', '');
    }
}

if (!function_exists('getTestSteamId')) {
    function getTestSteamId(): string
    {
        return env('TEST_STEAM_ID', '');
    }
}

//  Criar uma migration com essas informações
if (!function_exists('getCategories')) {
    function getCategories(): array
    {
        return
            [
                [
                    'category' => 'action',
                ],
                [
                    'category' => 'arcade_rhythm'
                ],
                [
                    'category' => 'fighting_martial_arts'
                ],
                [
                    'category' => 'action_fps'
                ],
                [
                    'category' => 'hack_and_slash'
                ],
                [
                    'category' => 'action_run_jump'
                ],
                [
                    'category' => 'action_tps'
                ],
                [
                    'category' => 'shmup'
                ],
                [
                    'category' => 'adventure'
                ],
                [
                    'category' => 'adventure_rpg'
                ],
                [
                    'category' => 'casual'
                ],
                [
                    'category' => 'hidden_object'
                ],
                [
                    'category' => 'metroidvania'
                ],
                [
                    'category' => 'puzzle_matching'
                ],
                [
                    'category' => 'story_rich'
                ],
                [
                    'category' => 'visual_novel'
                ],
                [
                    'category' => 'rpg'
                ],
                [
                    'category' => 'rpg_action'
                ],
                [
                    'category' => 'adventure_rpg'
                ],
                [
                    'category' => 'rpg_jrpg'
                ],
                [
                    'category' => 'rpg_party_based'
                ],
                [
                    'category' => 'rogue_like_rogue_lite'
                ],
                [
                    'category' => 'rpg_strategy_tactics'
                ],
                [
                    'category' => 'rpg_turn_based'
                ],
                [
                    'category' => 'simulation'
                ],
                [
                    'category' => 'sim_building_automation'
                ],
                [
                    'category' => 'sim_dating'
                ],
                [
                    'category' => 'sim_farming_crafting'
                ],
                [
                    'category' => 'sim_hobby_sim'
                ],
                [
                    'category' => 'sim_life'
                ],
                [
                    'category' => 'sim_physics_sandbox'
                ],
                [
                    'category' => 'sim_space_flight'
                ],
                [
                    'category' => 'strategy'
                ],
                [
                    'category' => 'strategy_card_board'
                ],
                [
                    'category' => 'strategy_cities_settlements'
                ],
                [
                    'category' => 'strategy_grand_4x'
                ],
                [
                    'category' => 'strategy_military'
                ],
                [
                    'category' => 'strategy_real_time'
                ],
                [
                    'category' => 'tower_defense'
                ],
                [
                    'category' => 'strategy_turn_based'
                ],
                [
                    'category' => 'sports_and_racing'
                ],
                [
                    'category' => 'sports'
                ],
                [
                    'category' => 'sports_fishing_hunting'
                ],
                [
                    'category' => 'sports_individual'
                ],
                [
                    'category' => 'racing'
                ],
                [
                    'category' => 'racing_sim'
                ],
                [
                    'category' => 'sports_sim'
                ],
                [
                    'category' => 'sports_team'
                ],
            ];
    }
}

//  Criar uma migration com essas informações
if (!(function_exists('getIDSMostPlayedGames'))) {
    function getIDSMostPlayedGames(): array
    {
        return [
            ['game' => '730'], // CS 2
            ['game' => '2357570'], // Overwatch 2
            ['game' => '2246340'], // Monster Hunter WIlds
            ['game' => '570'], // Dota 2
            ['game' => '578080'], // PUBG
            ['game' => '2767030'], // Marvel Rivals
            ['game' => '271590'], // Grand Theft Auto V Legacy
            ['game' => '3240220'], // Grand Theft Auto V Enhanced
            ['game' => '359550'], // Tom Clancy's Rainbow Six Siege
            ['game' => '440'], // Team Fortress 2
            ['game' => '1174180'], // Red Dead Redemption
            ['game' => '1245620'], // Elden Ring
            ['game' => '1086940'], // Baldur's Gate 3
            ['game' => '289070'], // Sid Meier's Civilization VI
            ['game' => '1623730'], // Palworld
            ['game' => '1222670'], // The Sims 4
            ['game' => '1091500'], // Cyberpunk 2077
            ['game' => '227300'], // Euro Truck Simulator 2
            ['game' => '489830'], // The Elder Scrolls V: Skyrim Special Edition
            ['game' => '2379780'], // Balatro
            ['game' => '550'], // Left 4 Dead 2
            ['game' => '292030'], // The Witcher 3: Wild Hunt
            ['game' => '252950'], // Rocket League
            ['game' => '814380'], // Sekiro: Shadows Die Twice
            ['game' => '648800'], // Raft
            ['game' => '1172620'], // Sea of Thieves
        ];
    }
}

//  Criar uma migration com essas informAções
if (!function_exists('getTags')) {
    function getTags(): array
    {
        return [
            ['tag' => 'driving'],
            ['tag' => 'fantasy'],
            ['tag' => 'funny'],
            ['tag' => 'survival'],
            ['tag' => 'drama'],
            ['tag' => 'memes'],
            ['tag' => 'space'],
            ['tag' => 'crime'],
            ['tag' => 'tactical'],
            ['tag' => 'zombies'],
            ['tag' => 'war'],
            ['tag' => 'indie'],
            ['tag' => 'sports'],
            ['tag' => 'simulation'],
            ['tag' => 'action'],
            ['tag' => 'rpg'],
            ['tag' => 'racing'],
            ['tag' => 'casual'],
            ['tag' => 'strategy'],
            ['tag' => 'software'],
            ['tag' => 'adventure'],
            ['tag' => 'action-adventure'],
            ['tag' => 'crafting'],
            ['tag' => 'conversation'],
            ['tag' => 'puzzle'],
            ['tag' => 'sandbox'],
            ['tag' => 'arcade'],
            ['tag' => 'shooter'],
            ['tag' => 'eSports'],
            ['tag' => 'card-game'],
            ['tag' => 'table-top'],
            ['tag' => 'moba'],
            ['tag' => 'trivia'],
            ['tag' => 'anime'],
            ['tag' => 'horrow'],
            ['tag' => 'singlePlayer'],
            ['tag' => 'multiplePlayer'],
            ['tag' => 'pvp'],
            ['tag' => 'pve'],
            ['tag' => 'co-op'],
            ['tag' => 'exploration'],
            ['tag' => 'stealth'],
            ['tag' => 'building'],
            ['tag' => 'sci-fi'],
        ];
    }
}

if (!function_exists('getGenres')) {
    function getGenres(): array
    {
        return
            [
                [
                    'genre' => 'Lorem',
                ],
            ];
    }
}
