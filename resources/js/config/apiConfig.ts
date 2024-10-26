const BASE_API_URL = '/api';

export const API_URLS = {
    team: '/team',
    standing: '/standing',
    fixture: '/fixture',
};

export const getFullUrl = (endpoint: string) => `${BASE_API_URL}${endpoint}`;
