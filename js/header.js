let header = document.getElementsByTagName('header')[0];

document.addEventListener('scroll', () =>{
    if (window.scrollY != 0) {
        header.classList.add('not-top')
    } else {
        header.classList.remove('not-top')
    }
})