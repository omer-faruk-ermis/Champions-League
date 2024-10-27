const BASE_API_URL = '/api';

export const API_URLS = {
    team: '/team',
    standing: '/standing',
    prediction: '/prediction',
    league: '/league',
    resetLeague: '/league/reset_league',
    fixture: '/fixture',
    createFixtures: '/fixture/create_fixtures',
    playWeekly: '/fixture/play_week_matches',
};

export const getFullUrl = (endpoint: string) => `${BASE_API_URL}${endpoint}`;
