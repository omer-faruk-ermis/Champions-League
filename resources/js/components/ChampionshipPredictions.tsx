import { Card, CardContent, CardHeader, CardTitle } from './ui/card'
import {useEffect, useState} from "react";
import {getPredictions} from "../services/services";

export default function ChampionshipPredictions({leagueId}) {
    const [prediction, setPrediction] = useState<[]>([]);
    useEffect(() => {
        (async () => setPrediction(await getPredictions({league_id: leagueId})))();
    }, []);
    return (
        <Card>
                <CardHeader>
                    <CardTitle text={'Championship Predictions'}/>
                </CardHeader>
                <CardContent>
                    {prediction.map((prediction) => (
                        <div key={prediction.team.id} className="flex justify-between items-center mb-2">
                            <span>{prediction.team.name}</span>
                            <span className="font-medium">%{prediction.championship_probability.toFixed(2)}</span>
                        </div>
                    ))}
                </CardContent>
        </Card>
)
}
