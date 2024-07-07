// animation.js

document.addEventListener('DOMContentLoaded', function() {
    const background = document.querySelector('.animated-background');
    
    function updateGradient() {
        const hue = (Date.now() / 50) % 360;
        background.style.background = `
            linear-gradient(
                45deg,
                hsl(${hue}, 100%, 50%),
                hsl(${(hue + 60) % 360}, 100%, 50%),
                hsl(${(hue + 120) % 360}, 100%, 50%)
            )
        `;
        background.style.backgroundSize = '400% 400%';
        requestAnimationFrame(updateGradient);
    }
    
    updateGradient();
});
