const BASE_API_URL = '/api';

export const API_URLS = {
    team: '/team',
};

export const getFullUrl = (endpoint: string) => `${BASE_API_URL}${endpoint}`;
