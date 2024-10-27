import React, {useState} from 'react';
import {Button} from "./button";

interface PlayWeeklyButtonProps {
    disabled: boolean;
    onPlayWeekly: () => Promise<void>;
}

const PlayWeeklyButton: React.FC<PlayWeeklyButtonProps> = ({
                                                               disabled,
                                                               onPlayWeekly
                                                           }) => {
    const [loading, setLoading] = useState(false);

    const handlePlay = async () => {
        setLoading(true);
        await onPlayWeekly();
        setLoading(false);
    };

    return (
        <>
            <Button
                className={`w-full mb-4 py-2 rounded ${disabled ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-500 text-white'}`}
                disabled={loading || disabled}
                onClick={handlePlay}
                style={{cursor: disabled ? 'not-allowed' : 'pointer'}}
                text={loading ? "Playing..." : "Play All Matches"}
            />
        </>
    );
};

export default PlayWeeklyButton;
