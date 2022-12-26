const toggleBtn = document.getElementById('toggler');
const themeC = document.getElementById('themeController');

const filterBtn = document.getElementById('toggleBtn');
const toggleCont = document.getElementById('toggleCont');
const toggleBg = document.getElementById('toggleBg')


let dark = JSON.parse(localStorage.getItem('dark')) || false;

if(dark) {
    toggleBtn.checked = true;
    themeC.classList.add('dark');
}

toggleBtn?.addEventListener('click',()=>{
    dark = !dark;
    localStorage.setItem('dark', JSON.stringify(dark));
    themeC.classList.toggle('dark');
});

filterBtn?.addEventListener('click',()=>{
    toggleCont.classList.toggle('hidden');
    toggleCont.classList.toggle('flex');
    toggleBg.classList.toggle('hidden');
    toggleBg.classList.toggle('flex');
});
toggleBg?.addEventListener('click',()=>{
    toggleCont.classList.toggle('hidden');
    toggleCont.classList.toggle('flex');
    toggleBg.classList.toggle('hidden');
    toggleBg.classList.toggle('flex');
})