import axios from 'axios';
import {Team} from '../types/Team';
import {API_URLS, getFullUrl} from "../config/apiConfig";
import {MESSAGES} from "../config/messages";
import {Standing} from "../types/Standing";
import {Fixture} from "../types/Fixture";
import {League} from "../types/League";
import {toast} from "react-toastify";

export const getTeams = async (params: any): Promise<Team[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.team), {params});
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.teamLoadError);
        throw error;
    }
};

export const getStandings = async (params: any): Promise<Standing[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.standing), {params});
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.standingLoadError);
        throw error;
    }
};

export const getFixtures = async (params: any): Promise<Fixture[]> => {
    console.log(params);
    try {
        const response = await axios.get(getFullUrl(API_URLS.fixture), {params});
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.fixtureLoadError);
        throw error;
    }
};

export const createFixtures = async (params: any): Promise<[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.createFixtures), {params});
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.createFixturesLoadError);
        throw error;
    }
};

export const playWeekly = async (params: any): Promise<[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.playWeekly), {params});
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.playWeeklyLoadError);
        throw error;
    }
};

export const getLeagues = async (): Promise<League[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.league));
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.leagueLoadError);
        throw error;
    }
};

export const resetLeague = async (params: any): Promise<[]> => {
    try {
        const response = await axios.delete(getFullUrl(API_URLS.resetLeague), {params});
        return response.data.data;
    } catch (error) {
        toast.error(MESSAGES.resetLeagueLoadError);
        throw error;
    }
};

