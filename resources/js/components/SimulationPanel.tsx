import {Button} from "./ui/Button/button"
import {Card, CardContent, CardHeader, CardTitle} from "./ui/card"
import LeagueTable from './LeagueTable'
import WeeklyMatches from './WeeklyMatches'
import ChampionshipPredictions from './ChampionshipPredictions'
import TeamList from "./TeamList";

export default function SimulationPanel() {
    return (
        <Card>
            <CardHeader>
                <CardTitle className="text-2xl font-bold">Simülasyon</CardTitle>
            </CardHeader>
            <CardContent>
                <TeamList/>
                <div className="grid md:grid-cols-3 gap-6">
                    <LeagueTable/>
                    <WeeklyMatches/>
                    <ChampionshipPredictions/>
                </div>
                <div className="flex justify-between mt-6">
                    <Button variant="primary">Tüm Haftaları Oyna</Button>
                    <Button variant="secondary">Sonraki Haftayı Oyna</Button>
                    <Button variant="danger">Verileri Sıfırla</Button>
                </div>
            </CardContent>
        </Card>
    )
}
