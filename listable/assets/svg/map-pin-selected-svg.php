<svg width="48px" height="59px" viewBox="0 0 48 59" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <defs>
        <filter x="-50%" y="-50%" width="200%" height="200%" filterUnits="objectBoundingBox" id="filter-1">
            <feOffset dx="0" dy="1" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
            <feGaussianBlur stdDeviation="1" in="shadowOffsetOuter1" result="shadowBlurOuter1"></feGaussianBlur>
            <feColorMatrix values="0 0 0 0 0   0 0 0 0 0   0 0 0 0 0  0 0 0 0.35 0" in="shadowBlurOuter1" type="matrix" result="shadowMatrixOuter1"></feColorMatrix>
            <feMerge>
                <feMergeNode in="shadowMatrixOuter1"></feMergeNode>
                <feMergeNode in="SourceGraphic"></feMergeNode>
            </feMerge>
        </filter>
        <path id="path-2" d="M6.47133474,6.469534 C0.275396197,12.691788 -1.44415263,21.6259064 1.19570658,29.3885257 C6.90326708,45.9636772 22.0560753,55.4531486 22.0560753,55.4531486 C22.0560753,55.4531486 37.0272756,46.0244703 42.7953721,29.6358057 C42.7953721,29.5750126 42.8559081,29.5142195 42.8559081,29.4501403 C45.5563033,21.6259064 43.8367544,12.691788 37.6408159,6.469534 C29.0512523,-2.15651133 15.0608983,-2.15651133 6.47133474,6.469534 Z"></path>
    </defs>
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g transform="translate(2.000000, 1.000000)">
            <g id="Pin" filter="url(#filter-1)">
                <use fill="#FFFFFF" xlink:href="#path-2"></use>
                <use id="selected" xlink:href="#path-2"></use>
            </g>
            <ellipse id="oval" fill="#FFFFFF" cx="22" cy="22.0243094" rx="18" ry="18.0198895"></ellipse>
        </g>
    </g>
</svg>
