import { Card, CardContent, CardHeader, CardTitle } from './ui/card'

const mockFixtures = [
    { homeTeam: 'Liverpool', awayTeam: 'Arsenal', result: '2 - 1' },
    { homeTeam: 'Manchester City', awayTeam: 'Chelsea', result: '0 - 0' },
]

export default function WeeklyMatches() {
    return (
        <Card>
            <CardHeader>
                <CardTitle>5. Hafta Maçları</CardTitle>
            </CardHeader>
            <CardContent>
                {mockFixtures.map((fixture, index) => (
                    <div key={index} className="flex justify-between items-center mb-4 text-sm">
                        <span className="font-medium">{fixture.homeTeam}</span>
                        <span className="bg-gray-100 px-3 py-1 rounded-full">{fixture.result}</span>
                        <span className="font-medium">{fixture.awayTeam}</span>
                    </div>
                ))}
            </CardContent>
        </Card>
    )
}
