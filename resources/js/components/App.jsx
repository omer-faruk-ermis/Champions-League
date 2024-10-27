import React from 'react';
import TournamentDashboard from "./TournamentDashboard";
import {ToastContainer} from "react-toastify";
import 'react-toastify/dist/ReactToastify.css';

function App() {
    return (
        <div>
            <TournamentDashboard />
            <ToastContainer />
        </div>
    );
}

export default App;
