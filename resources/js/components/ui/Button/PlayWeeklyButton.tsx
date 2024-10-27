import React, {useState} from 'react';
import {Button} from "./button";

interface PlayWeeklyButtonProps {
    onPlayWeekly: () => Promise<void>;
    text: string;
}

const PlayWeeklyButton: React.FC<PlayWeeklyButtonProps> = ({
                                                               onPlayWeekly,
                                                               text
                                                           }) => {
    const [loading, setLoading] = useState(false);

    const handlePlay = async () => {
        setLoading(true);
        await onPlayWeekly();
        setLoading(false);
    };

    return (
        <Button
            className={`w-full mb-4 py-2 rounded bg-blue-500 text-white`}
            onClick={handlePlay}
            text={loading ? "Playing..." : text}
            variant={"outline"}
        />
    );
};

export default PlayWeeklyButton;
