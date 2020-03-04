import $ from 'jquery';
import 'owl.carousel';
import 'leaflet';
import 'bootstrap';

$(document).ready(function() {

    /* News Carousel */
    $(".carousel-news").owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        navText: ['<i class="fa fa-angle-left fa-3x" aria-hidden="true"></i>', '<i class="fa fa-angle-right fa-3x" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });

    /* Spot Map */
    const themeURL = WPURLS.themeURL;

    const mapDiv = $('#spotMap');
    const latitude = mapDiv.data('latitude');
    const longitude = mapDiv.data('longitude');
    const title = mapDiv.data('title');
    const bsIcon = L.icon({
        iconUrl: themeURL + '/dist/images/marker.png',
        shadowUrl: themeURL + '/dist/images/marker-shadow.png',

        iconSize: [38, 95], // size of the icon
        shadowSize: [50, 60], // size of the shadow
        iconAnchor: [22, 90], // point of the icon which will correspond to marker's location
        shadowAnchor: [4, 62], // the same for the shadow
        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor
    });

    const map = L.map('spotMap').setView([latitude, longitude], 12);

    map.scrollWheelZoom.disable();

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([latitude, longitude], { icon: bsIcon }).addTo(map)
        .bindPopup('<h4>' + title + '</h4>')
        .openPopup();



});