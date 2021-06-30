import { orderRuchesTable } from './orderRuchesTable.js';

const ajouterRucheForm = $('#ajouter-ruche-form');
const ajouterRucheBtn = $('#ajouter-ruche-confirm');

const formSubmit = () => ajouterRucheForm.submit();

ajouterRucheBtn.click(formSubmit);

const orderData = $('.order-data');

const values = {
  id: $('.id-value'),
  nom: $('.nom-value'),
  latitude: $('.latitude-value'),
  longitude: $('.longitude-value'),
};

orderData[0].addEventListener('click', () => orderRuchesTable(values, 'nom'));
orderData[1].addEventListener('click', () =>
  orderRuchesTable(values, 'latitude')
);
orderData[2].addEventListener('click', () =>
  orderRuchesTable(values, 'longitude')
);
