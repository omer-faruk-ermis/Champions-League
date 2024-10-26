import React, { useEffect, useState } from 'react';
import { getTeams } from '../services/services';
import { Team } from '../types/Team';
import TeamCard from "./cards/Team/TeamCard";

const TeamList: React.FC = () => {
    const [teams, setTeams] = useState<Team[]>([]);
    const [isLoading, setIsLoading] = useState(true);

    useEffect(() => {
        const fetchTeams = async () => {
            try {
                const data = await getTeams();
                setTeams(data);
            } catch (error) {
                console.error("Failed to fetch teams:", error);
            } finally {
                setIsLoading(false);
            }
        };

        fetchTeams();
    }, []);

    if (isLoading) {
        return <div className="text-center py-10">Loading teams...</div>;
    }

    return (
        <div className="container mx-auto px-4 py-8">
            <h1 className="text-2xl font-bold mb-6 text-center">Football Teams</h1>
            <div className="grid grid-cols-4 gap-4">
                {teams.map((team) => (
                    <div key={team.id} className="flex justify-center">
                        <TeamCard team={team} />
                    </div>
                ))}
            </div>
        </div>
    );
};

export default TeamList;
