import React from 'react';

export type ButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & {
    text: string;
    variant?: 'primary' | 'secondary' | 'danger' | 'outline';
    className?: string;
};
