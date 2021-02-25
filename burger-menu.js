var toggleButton = document.querySelector(".toggle-button");
var mobileNav = document.querySelector(".mobile-nav");
var backDrop = document.querySelector(".backdrop");
var menuBtn = document.querySelector(".mobile-nav__item");
var Btntext = document.querySelector(".a");

backDrop.addEventListener("click", function (){
    mobileNav.style.display = 'none';
    backDrop.style.display = 'none';
});

toggleButton.addEventListener("click", function (){
    mobileNav.style.display = 'block';
    backDrop.style.display = 'block';

});

menuBtn.addEventListener("mousedown", function(){
    Btntext.style.color = 'black';
})




