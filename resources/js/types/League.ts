import {Team} from "./Team";

export type League = {
    id: number;
    name: string;
    teams: Array<Team>;
}
