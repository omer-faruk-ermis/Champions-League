import React, {useState} from 'react';
import {Button} from "./button";

interface GenerateFixturesButtonProps {
    onGenerateFixtures: () => Promise<void>;
}

const GenerateFixturesButton: React.FC<GenerateFixturesButtonProps> = ({
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
            className={`w-full mb-4 py-2 rounded bg-blue-500 text-white`}
            onClick={handleGenerate}
            text={loading ? "Generating..." : "Generate Fixtures"}
        />
    );
};

export default GenerateFixturesButton;
