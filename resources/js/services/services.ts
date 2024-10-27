import axios from 'axios';
import {Team} from '../types/Team';
import {API_URLS, getFullUrl} from "../config/apiConfig";
import {MESSAGES} from "../config/messages";
import {Standing} from "../types/Standing";
import {Fixture} from "../types/Fixture";
import {League} from "../types/League";

export const getTeams = async (params: any): Promise<Team[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.team), {params});
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

export const createFixtures = async (params: any): Promise<[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.createFixtures), {params});
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.createFixturesLoadError, error);
        throw error;
    }
};

export const playWeekly = async (params: any): Promise<[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.playWeekly), {params});
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.playWeeklyLoadError, error);
        throw error;
    }
};

export const getLeagues = async (): Promise<League[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.league));
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.leagueLoadError, error);
        throw error;
    }
};

