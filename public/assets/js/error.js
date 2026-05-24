/* jshint esversion: 6 */

let typeWriter = function(elementId, speed) {
    "use strict";

    const el = document.getElementById(elementId);

    if (el) {
        // Collect all text nodes in order
        const textNodes = [];
        (function collect(node) {
            for (let child of node.childNodes) {
                if (child.nodeType === Node.TEXT_NODE) {
                    textNodes.push({ node: child, text: child.textContent });
                    child.textContent = ''; // clear text
                } else {
                    collect(child); // recurse into nested elements
                }
            }
        })(el);

        let nodeIndex = 0;
        let charIndex = 0;

        const resetCharIndex = () => {
            charIndex = 0;
        };

        const step = function() {
            if (nodeIndex >= textNodes.length) {
                clearInterval(timer);
            } else {
                const current = textNodes[nodeIndex];
                current.node.textContent = current.text.slice(0, charIndex + 1);
                charIndex++;

                if (charIndex >= current.text.length) {
                    nodeIndex++;
                    resetCharIndex(); // Reset for next node
                }
            }
        };

        const timer = setInterval(step, speed);
    }
};

// Call it
(function initTypeWriter() {
    "use strict";
    typeWriter('errorMessage', '12');
})();
