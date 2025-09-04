let container = document.querySelector('.table-responsive-xl');
let left = document.querySelector('.bi-arrow-left-square-fill');
let right = document.querySelector('.bi-arrow-right-square-fill');

if (container && left && right) {
    left.addEventListener('click', () => {
        container.scrollBy({ left: -container.clientWidth, behavior: 'smooth' });
    });

    right.addEventListener('click', () => {
        container.scrollBy({ left: container.clientWidth, behavior: 'smooth' });
    });
}





/* JavaScript code for get All Event exist in Window JavaScript Object */
/* for (const key in window) {
    if (key.startsWith('on')) {
        
        container.addEventListener(key.slice(2), (e)=>{
            console.log(`Event Name: ${key}`, e)
        })
    }
} */