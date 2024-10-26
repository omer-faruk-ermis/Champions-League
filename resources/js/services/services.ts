import axios from 'axios';
import {Team} from '../types/Team';
import {API_URLS, getFullUrl} from "../config/apiConfig";
import {MESSAGES} from "../config/messages";
import {Standing} from "../types/Standing";
import {Fixture} from "../types/Fixture";

export const getTeams = async (): Promise<Team[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.team));
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.teamLoadError, error);
        throw error;
    }
};

export const getStandings = async (): Promise<Standing[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.standing));
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.standingLoadError, error);
        throw error;
    }
};

export const getFixtures = async (): Promise<Fixture[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.fixture));
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.fixtureLoadError, error);
        throw error;
    }
};

