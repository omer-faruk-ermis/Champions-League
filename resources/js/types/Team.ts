import {TeamPower} from "./TeamPower";
import {Standing} from "./Standing";
import {League} from "./League";

export type Team = {
    id: number;
    name: string;
    country: string;
    power: TeamPower;
    leagues: Array<League>;
    standing: Standing;
}
