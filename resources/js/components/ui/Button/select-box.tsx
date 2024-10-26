import React from 'react';
import { buttonStyles } from './buttonStyles';

type SelectBoxProps = React.SelectHTMLAttributes<HTMLSelectElement> & {
    variant?: 'primary' | 'secondary' | 'danger' | 'outline';
    options: { value: number; label: string }[];
};
export const SelectBox: React.FC<SelectBoxProps> = ({ variant = 'primary', options, ...props }) => {
    const variantStyle = buttonStyles.variants[variant];

    return (
        <select className={`${buttonStyles.base} ${variantStyle}`} {...props}>
            {options.map((option) => (
                <option key={option.value} value={option.value}>
                    {option.label}
                </option>
            ))}
        </select>
    );
};
