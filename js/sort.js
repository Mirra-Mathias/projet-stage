function $_GET(param) {
    var vars = {};
    window.location.href.replace( location.hash, '' ).replace(
        /[?&]+([^=&]+)=?([^&]*)?/gi,
        function( m, key, value ) {
            vars[key] = value !== undefined ? value : '';
        }
    );

    if ( param ) {
        return vars[param] ? vars[param] : null;
    }
    return vars;
}


function includeGET(get){
    var n = window.location.search.split('&');
    var n2,test,test2;
    var get2 = get.split('&');
    n[0] = n[0].substr(1);//enleve ?
//pour toutes les variables
        for (var y = 0; y < get2.length; y++) {//
            test = false;
            for (var i = 0; i < n.length; i++) { // pour toutes les variable du lien
                if (n[i].split('=')[0] == get2[y].split('=')[0]) { // si la variable est dans le lien
                    n[i] = get2[y]; //alors renplacer la variable
                    test = true; // test true
                }
            }
            if (!test) { //si il n'est pas dans le lien
                if (n.length > 0) { //si il y a déja une variable
                    n.push(get2[y]);
                } else {//sinon n = variable
                    n[0] = get2[y];
                }
            }

        }
    for (var i = 0; i < n.length; i++) { //pour tout les variable du lien
        test2 = false;
        if (n2 == null) {
            n2 = n[i];
            test2 = true;
        } else if (!test2) {
            n2 = n2 + "&" + n[i];
        }

    }

       window.location.search = n2;
}




function menu(nb) {

    switch (nb) {
        case 0:
            includeGET("menu=tout&page=1");
            break;
        case 1:
            includeGET("menu=abeille&page=1");
            break;
        case 2:
            includeGET("menu=delivrance&page=1");
            break;
        case 3:
            includeGET("menu=nouvelle_abeille&page=1");
            break;
    }

}

function gen_menu(tbutton,tbutton2,tbutton3,tbutton4) {
    let body = document.body;
    let button = document.createElement('button');
    button.textContent = 'Tout ';
    let span = document.createElement('span');
    span.textContent = tbutton;
    span.className = 'badge badge-secondary';
    button.appendChild(span);


    button.onclick = function() {menu(0)};
    let button2 = document.createElement('button');
    button2.textContent = 'L\'Abeille de Saint-Junien ';

    let span2 = document.createElement('span');
    span2.textContent = tbutton2;
    span2.className = 'badge badge-secondary';
    button2.appendChild(span2);
    button2.onclick = function() {menu(1)};
    let button3 = document.createElement('button');
    button3.textContent = 'La Délivrance';
    let span3 = document.createElement('span');
    span3.textContent = tbutton3;
    span3.className = 'badge badge-secondary';
    button3.appendChild(span3);
    button3.onclick = function() {menu(2)};
    let button4 = document.createElement('button');
    button4.textContent = 'La Nouvelle Abeille ';
    button4.onclick = function() {menu(3)};
    let span4 = document.createElement('span');
    span4.textContent = tbutton4;
    span4.className = 'badge badge-secondary';
    button4.appendChild(span4);

    button.className = 'btn btn-light btn-lg';
    button2.className = 'btn btn-light btn-lg';
    button3.className = 'btn btn-light btn-lg';
    button4.className = 'btn btn-light btn-lg';

    switch($_GET('menu')){

        case 'abeille':
            button2.className = 'btn btn-dark btn-lg';
            break;
        case 'delivrance':
            button3.className = 'btn btn-dark btn-lg';
            break;
        case 'nouvelle_abeille':
            button4.className = 'btn btn-dark btn-lg';
            break;
        default:
            button.className = 'btn btn-dark btn-lg';
    }
    body.append(button,button2,button3,button4);


}

function recherche_date(){

    includeGET("date_debut="+document.getElementById("date_debut").value+"&date_fin="+document.getElementById("date_fin").value+"&loading=on");
}

function get_Modallong(id) {
    var id2 = parseFloat(id);


    swal({
        text: document.getElementById(id).name,
        content: "input",
        button: {
            text: "Search!",
            closeModal: false,
        },
    })
        .then(name => {
            if (!name) throw null;

            return fetch(``);
        })
        .then(results => {
            return results.json();
        })
        .then(json => {
            const movie = json.results[0];

            if (!movie) {
                return swal("No movie was found!");
            }

            const name = movie.trackName;
            const imageURL = movie.artworkUrl100;

            swal({
                title: "Top result:",
                text: name,
                icon: imageURL,
            });
        })
        .catch(err => {

            if (err) {
                swal("Oh noes!", "The AJAX request failed!", "error");
            } else {
                swal.stopLoading();
                swal.close();
            }
        });

}

