import React from 'react';
import { TeamCardProps } from "./TeamCard.interface";
import { League } from "../../types/League";
import leagueLogo from '../../assets/icons/league-logo.png';

const TeamCard: React.FC<TeamCardProps> = ({ team }) => {
    return (
        <div className="w-full mx-auto bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <div className="p-3">
                <div className="w-12 h-12 mx-auto mb-2 overflow-hidden rounded-full bg-gray-100">
                    <img src={leagueLogo} alt={`${team.name} logo`} className="object-cover w-full h-full" />
                </div>
                <h2 className="text-base font-bold text-blue-600 truncate text-center">{team.name}</h2>
                <div className="grid grid-cols-2 gap-2 text-center mt-2">
                    <div className="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4 mb-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span className="text-xs font-medium">{team.country}</span>
                    </div>
                    <div className="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" className="w-4 h-4 mb-1 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span className="text-xs font-medium">{team.leagues.length}</span>
                    </div>
                </div>
            </div>
            <div className="px-3 pb-3">
                <div className="text-center">
                    <span className="text-xs text-gray-600">Leagues:</span>
                    <div className="mt-1 flex flex-wrap justify-center">
                        {team.leagues.slice(0, 3).map((league: League) => (
                            <span key={league.id} className="text-xs bg-gray-100 rounded px-1 py-0.5 m-0.5">
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
