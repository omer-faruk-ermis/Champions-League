import axios from 'axios';
import { Team } from '../types/Team';
import {API_URLS, getFullUrl} from "../config/apiConfig";
import {MESSAGES} from "../config/messages";

export const getTeams = async (): Promise<Team[]> => {
    try {
        const response = await axios.get(getFullUrl(API_URLS.team));
        return response.data.data;
    } catch (error) {
        console.error(MESSAGES.teamLoadError, error);
        throw error;
    }
};
