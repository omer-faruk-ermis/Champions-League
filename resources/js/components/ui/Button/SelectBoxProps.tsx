import React from "react";

export type SelectBoxProps = React.SelectHTMLAttributes<HTMLSelectElement> & {
    variant?: 'primary' | 'secondary' | 'danger' | 'outline';
    options: { value: number; label: string }[];
};
