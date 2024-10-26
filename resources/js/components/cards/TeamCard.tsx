interface TeamFeatures {
    name: string;
    country: string;
    leagues: object;
    attack: string;
    defense: string;
    fan_support: string;
    team_spirit: string;
}

export default function TeamCard({team}: { team: TeamFeatures }) {
    return (
        <div
            className="w-full max-w-sm mx-auto overflow-hidden transition-all duration-300 hover:shadow-lg bg-white rounded-lg shadow">
            <div className="text-center p-6">
                <div className="w-20 h-20 mx-auto mb-4 overflow-hidden rounded-full bg-gray-100">
                    <img src={team.logo} alt={`${team.name} logo`} className="object-cover w-full h-full"/>
                </div>
                <h2 className="text-2xl font-bold text-blue-600">{team.ad}</h2>
            </div>
            <div className="px-6 pt-2 pb-6">
                <div className="grid grid-cols-2 gap-4 text-center">
                    <div className="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" className="w-6 h-6 mb-2 text-blue-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                  d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                        </svg>
                        <span className="text-sm font-medium">Şampiyonluk</span>
                        <span className="text-2xl font-bold text-blue-600">{takim.sampiyonluk}</span>
                    </div>
                    <div className="flex flex-col items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" className="w-6 h-6 mb-2 text-blue-600" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2}
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <span className="text-sm font-medium">Oyuncu Sayısı</span>
                        <span className="text-2xl font-bold text-blue-600">{takim.oyuncuSayisi}</span>
                    </div>
                </div>
                <div className="mt-4 text-center">
          <span className="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">
            Süper Lig
          </span>
                </div>
            </div>
        </div>
    )
}
