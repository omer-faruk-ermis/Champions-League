import React from 'react';
import {buttonStyles} from "./Button/buttonStyles";

export const Card: React.FC = ({children}) => (
    <div className="border rounded-lg shadow-md p-8 bg-white">{children}</div>
);

export const CardHeader: React.FC = ({children}) => (
    <div className="container mx-auto px-4 py-2">
        <div
            className={`font-bold text-lg border-b mb-4 -mt-2 ${React.Children.count(children) > 1 ? 'flex justify-between' : ''}`}>
            {children}
        </div>
    </div>
);

export const CardContent: React.FC = ({children}) =>
    (
        <div className="text-gray-700">{children}</div>
    );

export const CardTitle: React.FC = ({text, className = ''}) => (
    <h2 className={`text-xl font-semibold text-center ${className}`}>{text}</h2>
);
