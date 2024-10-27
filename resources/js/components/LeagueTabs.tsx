import React, {useEffect, useState} from 'react';
import TeamList from './TeamList';
import {createFixtures, getLeagues, playWeekly, resetLeague} from "../services/services";
import {League} from "../types/League";
import GenerateFixturesButton from "./ui/Button/GenerateFixturesButton";
import {MESSAGES} from "../config/messages";
import Fixture from "./Fixture";
import PlayWeeklyButton from "./ui/Button/PlayWeeklyButton";
import ChampionshipPredictions from "./ChampionshipPredictions";
import Standing from "./Standing";
import ResetLeagueButton from "./ui/Button/ResetLeagueButton";

const LeagueTabs: React.FC = () => {
    const [selectedLeagueId, setSelectedLeagueId] = useState<number | null>(null);
    const [leagues, setLeagues] = useState<League[]>([]);
    const [showFixture, setShowFixture] = useState<boolean>(false);

    useEffect(() => {
        (async () => {
            const fetchedLeagues = await getLeagues();
            setLeagues(fetchedLeagues);
            if (fetchedLeagues.length > 0) {
                setSelectedLeagueId(fetchedLeagues[0].id);
            }
        })();
    }, []);

    const handleLeagueChange = (leagueId: number) => {
        setSelectedLeagueId(leagueId);
        setShowFixture(false);
    };

    const handleShowFixture = () => {
        setShowFixture(true);
    };

    const selectedLeague = leagues.find(league => league.id === selectedLeagueId);

    const handleGenerateFixtures = async () => {
        if (selectedLeague) {
            try {
                await createFixtures({league_id: selectedLeague.id});
                handleShowFixture();
            } catch (error) {
                console.error(MESSAGES.createFixturesLoadError, error);
            }
        }
    };

    const handlePlayWeekly = async () => {
        if (selectedLeague) {
            try {
                await playWeekly({match_order: null, league_id: selectedLeague.id});
            } catch (error) {
                console.error(MESSAGES.playWeeklyLoadError, error);
            }
        }
    };

    const handleResetLeague = async () => {
        if (selectedLeague) {
            try {
                await resetLeague({league_id: selectedLeague.id});
            } catch (error) {
                console.error(MESSAGES.resetLeagueLoadError, error);
            }
        }
    };

    return (
        <div>
            <div className="flex space-x-4 mb-6">
                {leagues.map((league) => (
                    <button
                        key={league.id}
                        className={`py-2 px-4 rounded ${selectedLeagueId === league.id ? 'bg-blue-500 text-white' : 'bg-gray-200'}`}
                        onClick={() => handleLeagueChange(league.id)}
                    >
                        {league.name}
                    </button>
                ))}
            </div>
            {selectedLeagueId && <TeamList leagueId={selectedLeagueId}/>}
            {selectedLeague && (
                <GenerateFixturesButton
                    disabled={selectedLeague.league_status === 'active'}
                    onGenerateFixtures={handleGenerateFixtures}
                />

            )}
            {selectedLeague && (
                <PlayWeeklyButton
                    disabled={selectedLeague.league_status === 'active'}
                    onPlayWeekly={handlePlayWeekly}
                    text={'Play All Matches'}
                />

            )}
            {selectedLeague && (
                <ResetLeagueButton
                    onResetLeague={handleResetLeague}
                    text={'Reset League'}/>

            )}
            {showFixture &&
                <div className="grid md:grid-cols-2 gap-6">
                    <Fixture/>
                    <div className="gap-6">
                        <Standing/>
                        <ChampionshipPredictions/>
                    </div>
                </div>}
            {showFixture && selectedLeague && (
                <PlayWeeklyButton
                    disabled={selectedLeague.league_status !== 'active'}
                    onPlayWeekly={handlePlayWeekly}
                    text={'Play Next Week Matches'}
                />
            )}
        </div>
    );
};

export default LeagueTabs;
