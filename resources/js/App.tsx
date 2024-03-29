import React from 'react';

const App: React.FC = () => {
    return (
        <div>
            <h1>Hello, React with TypeScript!</h1>
        </div>
    );
}

const createAnimationKeyframes = (
    translateX: number,
    translateY: number,
    scale: number,
): Keyframes =>
    keyframes({
        '0%': { opacity: 1 },
        '50%': { opacity: 0.8 },
        '80%': { opacity: 0.2 },
        '100%': {
            opacity: 0.1,
            transform: `translate(${translateX}px, ${translateY}px) scale(${scale})`,
        },
    })



// export default App;
import { useCallback, useState } from "react";
// import { FavoriteIconAnim } from "../../../components/FavoriteIconAnim";
 import { StarIcon } from "./components/StarIcon.vue";

export default function Favorite() {
    const [on, setOn] = useState(false);
    const handleClick = useCallback(() => {
        setOn((prev) => !prev);
    }, []);

    return (
        <article>
            <h1>Favorite Animation</h1>
            <button onClick={handleClick}>
                <StarIcon on={on} />
            </button>
        </article>
    );
}
