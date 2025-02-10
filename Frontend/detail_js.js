const imgs = document.querySelectorAll('.img-select a');
const imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);

document.addEventListener('DOMContentLoaded', (event) => { 
    const anggotaKelompok = document.querySelector('.anggota-kelompok');
    
    // Mengatur tampilan anggota kelompok
    if (anggotaKelompok) {
        anggotaKelompok.style.display = 'flex';
        anggotaKelompok.style.justifyContent = 'center';
        anggotaKelompok.style.alignItems = 'center';
        anggotaKelompok.style.flexWrap = 'wrap';
    }
    
    const listAnggota = document.querySelector('.list-anggota');
    
    // Mengatur tampilan list anggota
    if (listAnggota) {
        listAnggota.style.display = 'flex';
        listAnggota.style.justifyContent = 'center';
        listAnggota.style.alignItems = 'center';
        listAnggota.style.listStyleType = 'none';
        listAnggota.style.padding = '0';
        listAnggota.style.margin = '0';

        // Mengatur tampilan tiap item dalam list
        const listItems = listAnggota.querySelectorAll('li');
        listItems.forEach(item => {
            item.style.margin = '0 30px';  
            item.style.padding = '5px 10px';
            item.style.borderRadius = '5px';
        });
    }
});
