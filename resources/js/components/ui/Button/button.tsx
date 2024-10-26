import React from 'react';
import { buttonStyles } from './buttonStyles';

type ButtonProps = React.ButtonHTMLAttributes<HTMLButtonElement> & {
    variant?: 'primary' | 'secondary' | 'danger' | 'outline';
};

export const Button: React.FC<ButtonProps> = ({ children, variant = 'primary', ...props }) => {
    const variantStyle = buttonStyles.variants[variant];

    return (
        <button className={`${buttonStyles.base} ${variantStyle}`} {...props}>
            {children}
        </button>
    );
};
