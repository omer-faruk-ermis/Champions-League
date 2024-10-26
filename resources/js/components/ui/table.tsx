import React from 'react';

export const Table: React.FC = ({ children }) => (
    <div className="overflow-x-auto">
        <table className="min-w-full bg-white border border-gray-200">
            {children}
        </table>
    </div>
);

export const TableHeader: React.FC = ({ children }) => (
    <thead className="bg-gray-100">
    {children}
    </thead>
);

export const TableRow: React.FC = ({ children }) => (
    <tr className="border-b">{children}</tr>
);

export const TableHead: React.FC<{ children: React.ReactNode }> = ({ children }) => (
    <th className="py-2 px-4 text-left font-semibold text-gray-700">{children}</th>
);

export const TableBody: React.FC = ({ children }) => (
    <tbody className="text-gray-600">{children}</tbody>
);

export const TableCell: React.FC<{ children: React.ReactNode }> = ({ children }) => (
    <td className="py-2 px-4 border-b">{children}</td>
);
