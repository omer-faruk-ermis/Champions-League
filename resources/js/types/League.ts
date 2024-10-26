import {Team} from "./Team";

export type League = {
    id: number;
    name: string;
    total_matches: number;
    teams: Array<Team>;
}
