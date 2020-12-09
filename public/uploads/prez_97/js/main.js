var list = document.querySelectorAll("div[data-url]");
var delais = new Array(list.length).fill(0);
for (var i = 0; i < list.length; i++) {
  var url = list[i].getAttribute('data-url');
  list[i].style.backgroundImage="url('" + url + "')";
}

var position = 0;
var start = new Date().getTime();


function next(){
    var elm = document.querySelector("div.show[data-url]");
    elm.classList.toggle("show");
    if(elm.nextElementSibling !== null){
        elm.nextElementSibling.classList.toggle("show");
        if(elm.nextElementSibling.nextElementSibling === null){
            document.querySelector('.next').classList.add("hide");
        }
    }
    document.querySelector('.prev').classList.remove("hide");
    
    delais[position] += ( new Date().getTime() - start)/1000;
    position++;
    start = new Date().getTime();

}

function prev(){
    var elm = document.querySelector("div.show[data-url]");
    elm.classList.toggle("show");
    if(elm.previousElementSibling !== null){
        elm.previousElementSibling.classList.toggle("show");
        if(elm.previousElementSibling.previousElementSibling === null){
            document.querySelector('.prev').classList.add("hide");
        }

    }
    document.querySelector('.next').classList.remove("hide");
    delais[position] += (new Date().getTime() - start)/1000 ;
    start = new Date().getTime();
    position--;
}

document.querySelector('.next').onclick = next;
document.querySelector('.prev').onclick = prev;
window.save = function(){
    delais[position] += (new Date().getTime() - start)/1000 ;
    window.parent.service.delaipage(delais);
}