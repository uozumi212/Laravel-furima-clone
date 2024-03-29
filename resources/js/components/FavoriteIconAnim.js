import React from 'react';
import { keyframes } from '@emotion/react';
import { chakra } from '@chakra-ui/react';

const createAnimationKeyframes = (
    translateX,
    translateY,
    scale,
) => keyframes({
    '0%': { opacity: 1 },
    '50%': { opacity: 0.8 },
    '80%': { opacity: 0.2 },
    '100%': {
        opacity: 0.1,
        transform: `translate(${translateX}px, ${translateY}px) scale(${scale})`,
    },
});

const FavoriteIconAnim = ({ isClicked }) => (
    <chakra.span
        pos="absolute"
        top="1px"
        left="-6px"
        background="#CC8EF5"
        borderRadius="100"
        w="4px"
        h="4px"
        opacity="0"
        animation={isClicked ? `${createAnimationKeyframes(-10, -10, 1.4)} 0.25s` : ''}
    />
);

export default FavoriteIconAnim;
