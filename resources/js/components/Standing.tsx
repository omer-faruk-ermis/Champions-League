import {Table, TableBody, TableCell, TableHead, TableHeader, TableRow} from "./ui/table"
import {Card, CardContent, CardHeader, CardTitle} from "./ui/card"
import {useEffect, useState} from "react";
import {getStandings} from "../services/services";
import {Standing} from "../types/Standing";
import {StandingFields} from "../constants/StandingField";

export default function Standing() {
    const [standing, setStanding] = useState<Standing[]>([]);

    useEffect(() => {
        const fetchStandings = async () => {

            const data = await getStandings();
            setStanding(data);
        };

        fetchStandings();
    }, []);

    return (
        <Card>
            <CardHeader>
                <CardTitle>{standing[0]?.league.name}</CardTitle>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>{StandingFields.Team}</TableHead>
                            <TableHead>{StandingFields.Played}</TableHead>
                            <TableHead>{StandingFields.Won}</TableHead>
                            <TableHead>{StandingFields.Drawn}</TableHead>
                            <TableHead>{StandingFields.Lost}</TableHead>
                            <TableHead>{StandingFields.GoalsFor}</TableHead>
                            <TableHead>{StandingFields.GoalsAgainst}</TableHead>
                            <TableHead>{StandingFields.Points}</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {standing.map((standingItem) => (
                            <TableRow key={standingItem.id}>
                                <TableCell>{standingItem?.team?.name}</TableCell>
                                <TableCell>{standingItem.played}</TableCell>
                                <TableCell>{standingItem.won}</TableCell>
                                <TableCell>{standingItem.drawn}</TableCell>
                                <TableCell>{standingItem.lost}</TableCell>
                                <TableCell>{standingItem.goals_for}</TableCell>
                                <TableCell>{standingItem.goals_against}</TableCell>
                                <TableCell>{standingItem.points}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    )
}
