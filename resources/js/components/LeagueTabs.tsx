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
import {toast} from "react-toastify";
import PlayAllButton from "./ui/Button/PlayAllButton";

const LeagueTabs: React.FC = () => {
    const [selectedLeagueId, setSelectedLeagueId] = useState<number | null>(1);
    const [leagues, setLeagues] = useState<League[]>([]);
    const [showComponents, setShowComponents] = useState(true);
    const [selectedLeague, setSelectedLeague] = useState<League | undefined>(undefined);
    const [componentKey, setComponentKey] = useState<number>(0);

    useEffect(() => {
        (async () => {
            const fetchedLeagues = await getLeagues();
            setLeagues(fetchedLeagues);
            if (fetchedLeagues.length > 0) {
                setSelectedLeagueId(fetchedLeagues[0].id);
            }
        })();
    }, []);

    useEffect(() => {
        const league = leagues.find(league => league.id === selectedLeagueId);
        setSelectedLeague(league);

        if (league) {
            setShowComponents(league.league_status === 'active');
        } else {
            setShowComponents(false);
        }

        // Change component key to trigger re-render
        setComponentKey(prevKey => prevKey + 1);
    }, [selectedLeagueId, leagues]);

    const handleGenerateFixture = async () => {
        if (selectedLeague) {
            try {
                await createFixtures({league_id: selectedLeague.id});
                setShowComponents(true);
            } catch (error) {
                toast.error(MESSAGES.createFixturesLoadError);
            }
        }
    };

    const handlePlayWeekly = async () => {
        if (selectedLeague) {
            try {
                await playWeekly({bulk: 0, league_id: selectedLeague.id});
                // Trigger re-render by changing the component key
                setComponentKey(prevKey => prevKey + 1);
            } catch (error) {
                toast.error(MESSAGES.playWeeklyLoadError);
            }
        }
    };

    const handlePlayAll = async () => {
        if (selectedLeague) {
            try {
                await playWeekly({bulk: 1, league_id: selectedLeague.id});
                // Trigger re-render by changing the component key
                setComponentKey(prevKey => prevKey + 1);
            } catch (error) {
                toast.error(MESSAGES.playAllLoadError);
            }
        }
    };

    const handleResetLeague = async () => {
        if (selectedLeague) {
            try {
                await resetLeague({league_id: selectedLeague.id});
                setShowComponents(false);
            } catch (error) {
                toast.error(MESSAGES.resetLeagueLoadError);
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
                        onClick={() => setSelectedLeagueId(league.id)}
                    >
                        {league.name}
                    </button>
                ))}
            </div>
            {selectedLeagueId && <TeamList leagueId={selectedLeagueId}/>}
            {selectedLeague && (
                <>
                    <GenerateFixturesButton
                        disabled={selectedLeague.league_status !== 'active'}
                        onGenerateFixtures={handleGenerateFixture}
                    />
                    <PlayAllButton
                        onPlayAll={handlePlayAll}
                        text={'Play All Matches'}/>
                    <ResetLeagueButton
                        onResetLeague={handleResetLeague}
                        text={'Reset League'}
                    />
                </>
            )}
            {selectedLeague && showComponents && (
                <>
                    <div className="grid md:grid-cols-2 gap-6">
                        <Fixture key={`fixture-${componentKey}`} leagueId={selectedLeagueId}/>
                        <div className="gap-6">
                            <Standing key={`standing-${componentKey}`} leagueId={selectedLeagueId}/>
                            <ChampionshipPredictions key={`predictions-${componentKey}`} leagueId={selectedLeagueId}/>
                        </div>
                    </div>
                    <PlayWeeklyButton
                        disabled={selectedLeague.league_status !== 'active'}
                        onPlayWeekly={handlePlayWeekly}
                        text={'Play Next Week Matches'}
                    />
                </>
            )}
        </div>
    );
};

export default LeagueTabs;
