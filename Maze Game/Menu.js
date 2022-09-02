//MENU//
//Selectors
const controls = document.querySelector(".controls");
const settings = document.querySelector(".settings");
const about = document.querySelector(".about-game");
//
const closetab1 = document.querySelector(".close");
const closetab2 = document.querySelector(".close2");
const closetab3 = document.querySelector(".close3");
//
const controlsMenu = document.querySelector(".controls-menu");
const settingsMenu = document.querySelector(".settings-menu");
const aboutMenu = document.querySelector(".about-menu");

//Event Listeners
controls.addEventListener("click",controlToggle);
settings.addEventListener("click",settingsToggle);
about.addEventListener("click",aboutToggle);
closetab1.addEventListener("click",closeRemove);
closetab2.addEventListener("click",closeRemove2);
closetab3.addEventListener("click",closeRemove3);

//Functions
function controlToggle(e){
    controlsMenu.classList.toggle("display-flex");
    if(settingsMenu.classList.contains("display-flex")){
        settingsMenu.classList.toggle("display-flex");
    }
    if(aboutMenu.classList.contains("display-flex")){
        aboutMenu.classList.toggle("display-flex");
    }
}
function settingsToggle(e){

    settingsMenu.classList.toggle("display-flex");
    controlsMenu.classList.toggle("display-flex");
    if(controlsMenu.classList.contains("display-flex")){
        controlsMenu.classList.toggle("display-flex");
    }
    if(aboutMenu.classList.contains("display-flex")){
        aboutMenu.classList.toggle("display-flex");
    }
}
function aboutToggle(e){
    aboutMenu.classList.toggle("display-flex");
    if(controlsMenu.classList.contains("display-flex")){
        controlsMenu.classList.toggle("display-flex");
    }
    if(settingsMenu.classList.contains("display-flex")){
        settingsMenu.classList.toggle("display-flex");
    }
}
function closeRemove(e){
    controlsMenu.classList.remove("display-flex");
}
function closeRemove2(e){
    settingsMenu.classList.remove("display-flex");
}
function closeRemove3(e){
    aboutMenu.classList.remove("display-flex");
}

//AUDIO//
//selectors
const buttonON = document.querySelector(".on");
const buttonOFF = document.querySelector(".off");
//Event listeners
buttonON.addEventListener("click",themesongOn);
buttonOFF.addEventListener("click",themesongOff);
window.addEventListener("load",themesongCreate);
window.addEventListener("load",themesongOff);

//Functions
function themesongCreate(e){
music = new Audio();
music.src = "audio/epyc_theme.mp3";
music.loop = true;
music.volume = 1;
}


function themesongOff(e){
    music.pause();
    buttonOFF.classList.add("music-off");
    if(buttonON.classList.contains("music-on")){
        buttonON.classList.remove("music-on");
    }
}
function themesongOn(e){
    music.play();
    buttonON.classList.add("music-on");
    if(buttonOFF.classList.contains("music-off")){
        buttonOFF.classList.remove("music-off");
    }

}
//BG COLORS
const wrapper = document.querySelector(".wrapper");
const bgRed = document.querySelector(".red-bg-div");
const bgBlue = document.querySelector(".blue-bg-div");
const bgBlack = document.querySelector(".black-bg-div");
//Event listeners
bgRed.addEventListener("click",BgToRed);
bgBlue.addEventListener("click",BgToBlue);
bgBlack.addEventListener("click",BgToBlack);
window.addEventListener("load",BgToBlack);

//Functions
function BgToRed(e){
wrapper.classList.add("red-set");
bgRed.classList.add("chosen-one");
if(wrapper.classList.contains("blue-set")){
    wrapper.classList.remove("blue-set");
    bgBlue.classList.remove("chosen-one");
}
if(wrapper.classList.contains("black-set")){
    wrapper.classList.remove("black-set");
    bgBlack.classList.remove("chosen-one");
}
}
function BgToBlue(e){
    wrapper.classList.add("blue-set"); 
    bgBlue.classList.add("chosen-one");  
    if(wrapper.classList.contains("red-set")){
        wrapper.classList.remove("red-set");
        bgRed.classList.remove("chosen-one");  
    }
    if(wrapper.classList.contains("black-set")){
        wrapper.classList.remove("black-set");
        bgBlack.classList.remove("chosen-one");  
    }
}
function BgToBlack(e){
    wrapper.classList.add("black-set"); 
    bgBlack.classList.add("chosen-one");  
    if(wrapper.classList.contains("red-set")){
        wrapper.classList.remove("red-set");
        bgRed.classList.remove("chosen-one");  
    }
    if(wrapper.classList.contains("blue-set")){
        wrapper.classList.remove("blue-set");
        bgBlue.classList.remove("chosen-one");  
    }
}
//BACKGROUND OPTION VALUE
const bgChoice1 = document.querySelector(".red-bg-div");
const bgChoice2 = document.querySelector(".blue-bg-div");
const bgChoice3 = document.querySelector(".black-bg-div");
bgChoice1.addEventListener("click",choosed5);
bgChoice2.addEventListener("click",choosed6);
bgChoice3.addEventListener("click",choosed7);
let bgOption = 3;
localStorage.setItem("bgOption",bgOption);
function choosed5(){
    bgOption = 1;
    localStorage.setItem("bgOption",bgOption);
}
function choosed6(){
    bgOption = 2;
    localStorage.setItem("bgOption",bgOption);
}
function choosed7(){
    bgOption = 3;
    localStorage.setItem("bgOption",bgOption);
}