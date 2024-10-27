import React, {useState} from 'react';
import {Button} from "./button";

interface PlayWeeklyButtonProps {
    onPlayAll: () => Promise<void>;
    text: string;
}

const PlayAllButton: React.FC<PlayWeeklyButtonProps> = ({
                                                            onPlayAll,
                                                            text
                                                        }) => {
    const [loading, setLoading] = useState(false);

    const handlePlay = async () => {
        setLoading(true);
        await onPlayAll();
        setLoading(false);
    };

    return (
        <Button
            className={`w-full mb-4 py-2 rounded bg-blue-500 text-white`}
            onClick={handlePlay}
            text={loading ? "Playing..." : text}
        />
    );
};

export default PlayAllButton;
