import React from 'react';
import { TeamCardProps } from "./TeamCard.interface";
import { League } from "../../../types/League";
import leagueLogo from '../../../assets/icons/league-logo.png';
import TeamPowerStat from "./TeamPower";
import '@fortawesome/fontawesome-free/css/all.min.css';

const TeamCard: React.FC<TeamCardProps> = ({ team }) => {
    return (
        <div className="w-full mx-auto bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div className="p-3">
                <div className="w-12 h-12 mx-auto mb-2 overflow-hidden rounded-full bg-gray-100">
                    <img src={leagueLogo} alt={`${team.name} logo`} className="object-cover w-full h-full" />
                </div>
                <h2 className="text-base font-bold text-blue-600 truncate text-center">{team.name}</h2>
                <div className="grid grid-cols-3 gap-2 text-center mt-2">
                    <TeamPowerStat iconClass="fas fa-globe" value={team.country} />
                    <TeamPowerStat iconClass="fas fa-fist-raised" value={team.power.attack} />
                    <TeamPowerStat iconClass="fas fa-shield-alt" value={team.power.defense} />
                </div>
            </div>
            <div className="px-3 pb-3">
                <div className="text-center">
                    <div className="mt-1 flex flex-wrap justify-center">
                        {team.leagues.slice(0, 3).map((league: League) => (
                            <span key={league.id} className="text-xs bg-blue-100 rounded px-1 py-0.5 m-0.5">
                                {league.name}
                            </span>
                        ))}
                        {team.leagues.length > 3 && (
                            <span className="text-xs text-gray-500">+{team.leagues.length - 3} more</span>
                        )}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default TeamCard;
