import {Team} from "./Team";

export type League = {
    id: number;
    name: string;
    leagueStatus: string;
    totalMatches: number;
    teams: Array<Team>;
}
