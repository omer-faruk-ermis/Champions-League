import {Button} from "./ui/Button/button"
import {Card, CardContent, CardHeader, CardTitle} from "./ui/card"
import Standing from './Standing'
import Fixture from './Fixture'
import ChampionshipPredictions from './ChampionshipPredictions'
import TeamList from "./TeamList";

export default function SimulationPanel() {
    return (
        <Card>
            <CardHeader>
                <CardTitle className="text-2xl font-bold">Simulation</CardTitle>
            </CardHeader>
            <CardContent>
                <TeamList/>
                <Standing/>
                <div className="grid md:grid-cols-2 gap-6">
                    <Fixture/>
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
