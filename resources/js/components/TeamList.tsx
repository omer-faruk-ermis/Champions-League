import React, {useEffect, useState} from 'react';
import {getTeams} from '../services/services';
import {Team} from '../types/Team';
import TeamCard from "./cards/Team/TeamCard";

interface TeamListProps {
    leagueId: number;
}

const TeamList: React.FC<TeamListProps> = ({leagueId}) => {
    const [teams, setTeams] = useState<Team[]>([]);

    useEffect(() => {
        (async () => setTeams(await getTeams({league_id: leagueId})))();
    }, [leagueId]);

    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-2xl font-bold mb-6 text-center">Football Teams</h1>
            <div className="grid grid-cols-4 gap-4">
                {teams.map((team) => (
                    <div key={team.id} className="flex justify-center">
                        <TeamCard team={team}/>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default TeamList;
