import React from 'react';
import {MatchCardProps} from "./MatchCard.interface";
import {CardContent} from "../../ui/card";

const MatchCard: React.FC<MatchCardProps> = ({match}) => {
    return (
        <CardContent className="w-full">
            <div key={match.id} className="flex items-center mb-2 w-full">
                <span className="font-medium flex-1 text-left">{match.home_team.name}</span>
                <span className="bg-gray-100 px-3 py-1 rounded-full mx-auto text-center w-16">
          {match.home_team_score} - {match.away_team_score}
        </span>
                <span className="font-medium flex-1 text-right">{match.away_team.name}</span>
            </div>
        </CardContent>
    );
};

export default MatchCard;
