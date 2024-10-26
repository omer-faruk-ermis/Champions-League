import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from "./ui/table"
import { Card, CardContent, CardHeader, CardTitle } from "./ui/card"

const mockTeams = [
    { name: 'Liverpool', played: 5, won: 4, drawn: 1, lost: 0, gd: 10, points: 13 },
    { name: 'Manchester City', played: 5, won: 3, drawn: 2, lost: 0, gd: 8, points: 11 },
    { name: 'Chelsea', played: 5, won: 3, drawn: 1, lost: 1, gd: 5, points: 10 },
    { name: 'Arsenal', played: 5, won: 2, drawn: 2, lost: 1, gd: 2, points: 8 },
]

export default function LeagueTable() {
    return (
        <Card>
            <CardHeader>
                <CardTitle>Lig Tablosu</CardTitle>
            </CardHeader>
            <CardContent>
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Takım</TableHead>
                            <TableHead>O</TableHead>
                            <TableHead>G</TableHead>
                            <TableHead>B</TableHead>
                            <TableHead>M</TableHead>
                            <TableHead>AG</TableHead>
                            <TableHead>P</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        {mockTeams.map((team) => (
                            <TableRow key={team.name}>
                                <TableCell>{team.name}</TableCell>
                                <TableCell>{team.played}</TableCell>
                                <TableCell>{team.won}</TableCell>
                                <TableCell>{team.drawn}</TableCell>
                                <TableCell>{team.lost}</TableCell>
                                <TableCell>{team.gd}</TableCell>
                                <TableCell>{team.points}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </CardContent>
        </Card>
    )
}
