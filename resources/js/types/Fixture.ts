import {League} from "./League";
import {Team} from "./Team";

export type Fixture = {
    id: number;
    match_order: number;
    status: string;
    home_team_score: number;
    away_team_score: number;
    home_team: Array<Team>;
    away_team: Array<Team>;
    league: Array<League>;
}
