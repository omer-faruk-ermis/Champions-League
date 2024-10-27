import {Button} from "./ui/Button/button"
import {Card, CardContent, CardHeader, CardTitle} from "./ui/card"
import Standing from './Standing'
import Fixture from './Fixture'
import ChampionshipPredictions from './ChampionshipPredictions'
import LeagueTabs from "./LeagueTabs";

export default function SimulationPanel() {
    return (
        <Card>
            <CardHeader>
                <CardTitle className="text-2xl font-bold" text={'Simulation'}/>
            </CardHeader>
            <CardContent>
                <LeagueTabs/>
                <Standing/>
                <div className="grid md:grid-cols-2 gap-6">
                    <Fixture/>
                    <ChampionshipPredictions/>
                </div>
                <div className="flex justify-between mt-6">
                    <Button variant="secondary" text={'Sonraki Haftayı Oyna'}/>
                    <Button variant="danger" text={'Sezona Baştan Başla'}/>
                </div>
            </CardContent>
        </Card>
    )
}
