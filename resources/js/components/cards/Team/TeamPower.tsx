import React from 'react';

function TeamPowerStat({ iconClass, value }) {
    return (
        <div className="flex flex-col items-center">
            <i className={`${iconClass} w-4 h-4 mb-1 text-gray-500`}></i>
            <span className="text-xs font-medium text-gray-1300">{value}</span>
        </div>
    );
}

export default TeamPowerStat;
