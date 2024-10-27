import React from 'react';
import {buttonStyles} from './buttonStyles';
import {ButtonProps} from "./buttonProps";

export const Button: React.FC<ButtonProps> = ({ text, variant = 'primary', className = '', ...props }) => {
    const variantStyle = buttonStyles.variants[variant];

    return (
        <button className={`${buttonStyles.base} ${variantStyle} ${className}`} {...props}>
            {text}
        </button>
    );
};
