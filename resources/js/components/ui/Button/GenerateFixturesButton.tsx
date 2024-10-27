import React, {useState} from 'react';
import {Button} from "./button";

interface GenerateFixturesButtonProps {
    disabled: boolean;
    onGenerateFixtures: () => Promise<void>;
}

const GenerateFixturesButton: React.FC<GenerateFixturesButtonProps> = ({
                                                                           disabled,
                                                                           onGenerateFixtures
                                                                       }) => {
    const [loading, setLoading] = useState(false);

    const handleGenerate = async () => {
        setLoading(true);
        await onGenerateFixtures();
        setLoading(false);
    };

    return (
        <Button
            className={`w-full mb-4 py-2 rounded ${disabled ? 'bg-gray-300 text-gray-500 cursor-not-allowed' : 'bg-blue-500 text-white'}`}
            disabled={loading || disabled}
            onClick={handleGenerate}
            style={{cursor: disabled ? 'not-allowed' : 'pointer'}}
            text={loading ? "Generating..." : "Generate Fixtures"}
        />
    );
};

export default GenerateFixturesButton;
