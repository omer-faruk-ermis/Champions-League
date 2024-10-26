import React from 'react';

export const Card: React.FC = ({ children }) => (
    <div className="border rounded-lg shadow-md p-4 bg-white">{children}</div>
);

export const CardHeader: React.FC = ({ children }) => (
    <div className="font-bold text-lg border-b mb-2">{children}</div>
);

export const CardContent: React.FC = ({ children }) => (
    <div className="text-gray-700">{children}</div>
);

export const CardTitle: React.FC = ({ children }) => (
    <h2 className="text-xl font-semibold">{children}</h2>
);
