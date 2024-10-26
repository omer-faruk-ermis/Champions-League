import {League} from "./League";

export type Standing = {
    id: number;
    played: number;
    won: number;
    drawn: number;
    lost: number;
    goals_for: number;
    goals_against: number;
    points: number;
    created_at: string;
    updated_at: string;
    team: Team;
    league: League;
}
