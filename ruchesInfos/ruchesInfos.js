import { orderRuchesInfosTable } from './orderRuchesInfosTable.js';

const orderData = $('.order-data');

const values = {
  id: $('.id-value'),
  ruche: $('.ruche-value'),
  date: $('.date-value'),
  poids: $('.poids-value'),
  température: $('.temperature-value'),
  humidité: $('.humidite-value'),
};

orderData[0].addEventListener('click', () =>
  orderRuchesInfosTable(values, 'ruche')
);
orderData[1].addEventListener('click', () =>
  orderRuchesInfosTable(values, 'date')
);
orderData[2].addEventListener('click', () =>
  orderRuchesInfosTable(values, 'poids')
);
orderData[3].addEventListener('click', () =>
  orderRuchesInfosTable(values, 'température')
);
orderData[4].addEventListener('click', () =>
  orderRuchesInfosTable(values, 'humidité')
);
