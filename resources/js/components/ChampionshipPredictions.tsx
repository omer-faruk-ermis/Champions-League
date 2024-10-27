import { Card, CardContent, CardHeader, CardTitle } from './ui/card'

const mockPredictions = [
    { team: 'Liverpool', percentage: 40 },
    { team: 'Manchester City', percentage: 35 },
    { team: 'Chelsea', percentage: 15 },
    { team: 'Arsenal', percentage: 10 },
]

export default function ChampionshipPredictions() {
    return (
        <Card>
                <CardHeader>
                    <CardTitle text={'Championship Predictions'}/>
                </CardHeader>
                <CardContent>
                    {mockPredictions.map((prediction) => (
                        <div key={prediction.team} className="flex justify-between items-center mb-2">
                            <span>{prediction.team}</span>
                            <span className="font-medium">%{prediction.percentage}</span>
                        </div>
                    ))}
                </CardContent>
        </Card>
)
}
