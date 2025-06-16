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
            'players_online'      => 'https://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v1/?appid={appid}',
            'achievements'        => 'https://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid={appid}',
            'game_details'        => 'https://store.steampowered.com/api/appdetails?appids={appid}',
            'game_news'           => 'https://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?appid={appid}&count=3&maxlength=300&format=json',
            'player_info'         => 'https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=' . getSteamApiKey() . '&steamids=' . getTestSteamId(),
            'app_list'            => 'https://api.steampowered.com/ISteamApps/GetAppList/v2/',
            'player_friendlist'   => 'https://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=' . getSteamApiKey() . '&steamid=' . getTestSteamId() . '&relationship=friend',
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
                'action',
                'arcade_rhythm',
                'fighting_martial_arts',
                'action_fps',
                'hack_and_slash',
                'action_run_jump',
                'action_tps',
                'shmup',
                'adventure',
                'adventure_rpg',
                'casual',
                'hidden_object',
                'metroidvania',
                'puzzle_matching',
                'story_rich',
                'visual_novel',
                'rpg',
                'rpg_action',
                'adventure_rpg',
                'rpg_jrpg',
                'rpg_party_based',
                'rogue_like_rogue_lite',
                'rpg_strategy_tactics',
                'rpg_turn_based',
                'simulation',
                'sim_building_automation',
                'sim_dating',
                'sim_farming_crafting',
                'sim_hobby_sim',
                'sim_life',
                'sim_physics_sandbox',
                'sim_space_flight',
                'strategy',
                'strategy_card_board',
                'strategy_cities_settlements',
                'strategy_grand_4x',
                'strategy_military',
                'strategy_real_time',
                'tower_defense',
                'strategy_turn_based',
                'sports_and_racing',
                'sports',
                'sports_fishing_hunting',
                'sports_individual',
                'racing',
                'racing_sim',
                'sports_sim',
                'sports_team',
            ];
    }
}

//  Criar uma migration com essas informações
if (!(function_exists('getIDSMostPlayedGames'))) {
    function getIDSMostPlayedGames(): array
    {
        return
            [
                '730', // CS 2
                '2357570', // Overwatch 2
                '2246340', // Monster Hunter WIlds
                '570', // Dota 2
                '578080', // PUBG
                '2767030', // Marvel Rivals
                '271590', // Grand Theft Auto V Legacy
                '3240220', // Grand Theft Auto V Enhanced
                '359550', // Tom Clancy's Rainbow Six Siege
                '440', // Team Fortress 2
                '1174180', // Red Dead Redemption
                '1245620', // Elden Ring
                '1086940', // Baldur's Gate 3
                '289070', // Sid Meier's Civilization VI
                '1623730', // Palworld
                '1222670', // The Sims 4
                '1091500', // Cyberpunk 2077
                '227300', // Euro Truck Simulator 2
                '489830', // The Elder Scrolls V: Skyrim Special Edition
                '2379780', // Balatro
                '550', // Left 4 Dead 2
                '292030', // The Witcher 3: Wild Hunt
                '252950', // Rocket League
                '814380', // Sekiro: Shadows Die Twice
                '648800', // Raft
                '1172620', // Sea of Thieves
            ];
    }
}

//  Criar uma migration com essas informAções
if (!function_exists('getTags')) {
    function getTags(): array
    {
        return [
            'driving',
            'fantasy',
            'funny',
            'survival',
            'drama',
            'memes',
            'space',
            'crime',
            'tactical',
            'zombies',
            'war',
            'indie',
            'sports',
            'simulation',
            'action',
            'rpg',
            'racing',
            'casual',
            'strategy',
            'software',
            'adventure',
            'action-adventure',
            'crafting',
            'conversation',
            'puzzle',
            'sandbox',
            'arcade',
            'shooter',
            'eSports',
            'card-game',
            'table-top',
            'moba',
            'trivia',
            'anime',
            'horrow',
            'singlePlayer',
            'multiplePlayer',
            'pvp',
            'pve',
            'co-op',
            'exploration',
            'stealth',
            'building',
            'sci-fi',
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
