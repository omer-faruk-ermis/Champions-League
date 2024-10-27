import React, {useEffect, useState} from "react";
import {getFixtures} from "../services/services";
import {Fixture} from "../types/Fixture";
import MatchCard from "./cards/Match/MatchCard";
import {Card, CardContent, CardHeader, CardTitle} from "./ui/card";
import {SelectBox} from "./ui/Button/select-box";

export default function Fixture() {
    const [fixtures, setFixtures] = useState<Fixture[]>([]);
    const [weekIndex, setWeekIndex] = useState(0);
    const [weekFixtures, setWeekFixtures] = useState<Fixture[]>([]);
    const totalWeeks = fixtures[0]?.league.total_matches || 0;

    useEffect(() => {
        (async () => {
            setFixtures(await getFixtures());
        })();
    }, []);

    useEffect(() => {
        const currentWeekFixtures = fixtures.filter(
            (fixture) => fixture.match_order === weekIndex + 1
        );
        setWeekFixtures(currentWeekFixtures);
    }, [weekIndex, fixtures]);

    const handleWeekChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
        setWeekIndex(Number(event.target.value));
    };

    const weekOptions = [...Array(totalWeeks)].map((_, index) => ({
        value: index,
        label: `Week ${index + 1}`,
    }));

    return (
        <Card>
            <CardHeader>
                <CardTitle text={`${weekIndex + 1}. Week`}/>
                <SelectBox
                    value={weekIndex}
                    onChange={handleWeekChange}
                    options={weekOptions}
                    variant="secondary"
                />
            </CardHeader>
            <CardContent>
                {weekFixtures.map((match: Fixture) => (
                    <div key={match.id}>
                        <MatchCard match={match} />
                    </div>
                ))}
            </CardContent>
        </Card>
    );
}
