function spremiFormaShop() {
    //provjera da li je podržan local storage
    if (typeof(Storage) !== "undefined") {
        var indexTip = document.getElementById("selectTip").selectedIndex;
        var indexBrend = document.getElementById("selectBrend").selectedIndex;
        var dodatnoUnos = document.getElementById("inputDodatno").value;
        //sada trebamo ovo sve sačuvati u localstorage objekat
        localStorage.setItem("indexTip", indexTip.toString());
        localStorage.setItem("indexBrend", indexBrend.toString());
        localStorage.setItem("dodatnoUnos", dodatnoUnos);
    }
    else {
        window.alert("Spremanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}

//ucitavanje
function ucitajFormaShop() {
    if (typeof(Storage) !== "undefined") {
        var indexTip = parseInt(localStorage.getItem("indexTip"));
        var indexBrend = parseInt(localStorage.getItem("indexBrend"));
        var dodatnoUnos = localStorage.getItem("dodatnoUnos");
        //postavljanje ovih vrijednosti na formu:
        document.getElementById("selectTip").selectedIndex = indexTip;
        document.getElementById("selectBrend").selectedIndex = indexBrend;
        document.getElementById("inputDodatno").value = dodatnoUnos;
    }
    else {
        window.alert("Ucitavanje prethodno unesenih podataka u local storage nije podržano u ovoj verziji browsera.");
    }
}