const modal = document.querySelector('#modal');
const btn = document.getElementsByClassName('openModal');
const close = document.querySelector('.close');
var userLogin;

const divbtn = function (elem) {
    return function() 
    {
        userLogin = elem.id;
        userId = elem.name;
        document.location.href= "?page=" + userLogin + userId;
    }
};

/*close.onclick = function () {
  modal.style.display = 'none';
};

window.onclick = function (event) {
    if (event.target == modal)
        {
            modal.style.display = 'none';
        }
};*/

for(let elem of btn)
    {
        elem.addEventListener("click", divbtn(elem));
    }
