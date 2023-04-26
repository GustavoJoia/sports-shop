/*SHOW MENU */
const showMenu = (toggleId, navId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId)
    
    // Valida a existência de variáveis
    if(toggle && nav){
        toggle.addEventListener('click', ()=>{
            nav.classList.toggle('show-menu')
        })
    }
}
showMenu('nav-toggle','nav-menu')

/* REMOVE MENU MOBILE */
const navLink = document.querySelectorAll('.nav__link')

function linkAction(){
    const navMenu = document.getElementById('nav-menu')
    // Quando clicamos em cada nav__link, removemos a classe show-menu
    navMenu.classList.remove('show-menu')
}
navLink.forEach(n => n.addEventListener('click', linkAction))

/* SCROLL SEÇÕES ACTIVE LINK */
const sections = document.querySelectorAll('section[id]')

function scrollActive(){
    const scrollY = window.pageYOffset

    sections.forEach(current =>{
        const sectionHeight = current.offsetHeight
        const sectionTop = current.offsetTop - 50;
        sectionId = current.getAttribute('id')

        if(scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.add('active-link')
        }else{
            document.querySelector('.nav__menu a[href*=' + sectionId + ']').classList.remove('active-link')
        }
    })
}
window.addEventListener('scroll', scrollActive)

function scrollHeader(){
    const nav = document.getElementById('header')
    // Quando a rolagem é maior que 200 na altura da janela de visualização, adicione a classe scroll-header à tag de cabeçalho
    if(this.scrollY >= 200) nav.classList.add('scroll-header'); else nav.classList.remove('scroll-header')
}
window.addEventListener('scroll', scrollHeader)


function validar() {
    var email = document.getElementById ("E-mail");
    
    if (email.value == ""){
        alert('Preencha este dado!');
        email.focus();
    } else {
        alert('E-mail cadastrado com sucesso!');
    }
}

function cadastroTelaDp(){
    document.getElementById("dPessoais").style.display = "none";
    document.getElementById("endereco").style.display = "block";
}

function voltarTelaCadastroEnd(){
    document.getElementById("dPessoais").style.display = "block";
    document.getElementById("endereco").style.display = "none";
}
