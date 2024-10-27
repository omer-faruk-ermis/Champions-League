import React from 'react';
import {Button} from "./button";

interface ResetLeagueButtonProps {
    onResetLeague: () => Promise<void>;
    text: string;
}

const ResetLeagueButton: React.FC<ResetLeagueButtonProps> = ({onResetLeague, text}) => {
    const handleReset = async () => {
        await onResetLeague();
    };

    return (
        <Button
            className={'w-full'}
            onClick={handleReset}
            text={text}
            variant={'danger'}
        />
    );
};

export default ResetLeagueButton;
