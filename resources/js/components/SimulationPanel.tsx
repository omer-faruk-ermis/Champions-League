import {Card, CardContent, CardHeader, CardTitle} from "./ui/card"
import LeagueTabs from "./LeagueTabs";

export default function SimulationPanel() {
    return (
        <Card>
            <CardHeader>
                <CardTitle className="text-3xl font-bold text-center" text={'League Simulation'}/>
            </CardHeader>
            <CardContent>
                <LeagueTabs/>
            </CardContent>
        </Card>
    )
}
