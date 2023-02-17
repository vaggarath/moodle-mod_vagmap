import * as L from 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.8.0/leaflet.js';
import Swal from 'https://cdn.jsdelivr.net/npm/sweetalert2@11.7.1/dist/sweetalert2.all.min.js';

const showInformation = () => {
    Swal.fire({
        title: 'Titre de la carte'
        ,
        icon: '',
        html: 'Some info for later with param',
        confirmButtonText: 'Fermer',
        customClass:{
            confirmButton:"btn btn-success", //need to be a class called after the js script in order to rewrite
        }
      });
};

export const displayMap = () =>{
    let map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    document.getElementById('map').onclick = () => showInformation(); //this will be for poi later
};