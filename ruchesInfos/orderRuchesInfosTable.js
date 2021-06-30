const dataWrapper = document.getElementById('data-wrapper');

const renderOrderedTable = (id, ruche, date, poids, temp, humid, tableSize) => {
  let innerData = '';

  for (let i = 0; i < tableSize; i++) {
    innerData += `<div class='data'>
    <ul class='data__list ${i % 2 === 0 ? 'bg-grey' : ''}'>
    <li class='data__item ruche-value'>${ruche[i]}</li>
    <li class='data__item date-value'>${date[i]}</li>
    <li class='data__item poids-value'>${poids[i]}</li>
    <li class='data__item temperature-value'>${temp[i]}</li>
    <li class='data__item humidite-value'>${humid[i]}</li>
    </ul>
    </div>`;
  }

  dataWrapper.innerHTML = innerData;
};

const removeOtherFieldsArrows = (field) => {
  const ids = ['ruche', 'date', 'poids', 'température', 'humidité'];

  for (const id of ids) {
    if (id !== field) {
      const spans = $(
        `.data-header-${
          id === 'température'
            ? 'temperature'
            : id === 'humidité'
            ? 'humidite'
            : id
        }`
      )[0]
        .querySelector('.order-data')
        .querySelectorAll('span');
      spans[0].removeAttribute('id');
      spans[1].removeAttribute('id');
    }
  }
};

const setOrderingArrowsId = (field) => {
  const spans = $(
    `.data-header-${
      field === 'température'
        ? 'temperature'
        : field === 'humidité'
        ? 'humidite'
        : field
    }`
  )[0]
    .querySelector('.order-data')
    .querySelectorAll('span');

  if (!spans[0].id && !spans[1].id) {
    spans[0].id = 'ordered-data';
  } else if (spans[1].id === 'ordered-data') {
    spans[0].id = 'ordered-data';
    spans[1].removeAttribute('id');
  } else if (spans[0].id === 'ordered-data') {
    spans[1].id = 'ordered-data';
    spans[0].removeAttribute('id');
  }

  removeOtherFieldsArrows(field);
};

const sortArrays = (field, values, id, val1, val2, val3, val4, val5, order) => {
  const array = [];
  const sortedIdArray = [];
  const sortedRucheArray = [];
  const sortedDateArray = [];
  const sortedPoidsArray = [];
  const sortedTempArray = [];
  const sortedHumidArray = [];
  const toBeSorted = [
    sortedRucheArray,
    sortedDateArray,
    sortedPoidsArray,
    sortedTempArray,
    sortedHumidArray,
  ];
  const sortedArrays = [sortedIdArray];

  const spans = $(
    `.data-header-${
      field === 'température'
        ? 'temperature'
        : field === 'humidité'
        ? 'humidite'
        : field
    }`
  )[0]
    .querySelector('.order-data')
    .querySelectorAll('span');

  for (let i = 0; i < values[val1].length; i++) {
    array.push(
      values[val1][i].textContent +
        '_' +
        values[val2][i].textContent +
        '_' +
        values[val3][i].textContent +
        '_' +
        values[val4][i].textContent +
        '_' +
        values[val5][i].textContent +
        '_' +
        values[id][i].value
    );
  }

  if (!spans[0].id) {
    array.sort();
  } else {
    array.sort().reverse();
  }

  for (let i = 0; i < array.length; i++) {
    sortedRucheArray.push(array[i].split('_')[order[0]]);
    sortedDateArray.push(array[i].split('_')[order[1]]);
    sortedPoidsArray.push(array[i].split('_')[order[2]]);
    sortedTempArray.push(array[i].split('_')[order[3]]);
    sortedHumidArray.push(array[i].split('_')[order[4]]);
    sortedIdArray.push(array[i].split('_')[5]);
  }

  for (let j = 0; j < order.length; j++) {
    sortedArrays[j + 1] = toBeSorted[j];
  }

  return sortedArrays;
};

export const orderRuchesInfosTable = (values, field) => {
  const sortedArrays = [];

  if (field === 'ruche') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'ruche',
        'date',
        'poids',
        'température',
        'humidité',
        [0, 1, 2, 3, 4]
      )
    );
  } else if (field === 'date') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'date',
        'poids',
        'température',
        'humidité',
        'ruche',
        [4, 0, 1, 2, 3]
      )
    );
  } else if (field === 'poids') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'poids',
        'température',
        'humidité',
        'ruche',
        'date',
        [3, 4, 0, 1, 2]
      )
    );
  } else if (field === 'température') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'température',
        'humidité',
        'ruche',
        'date',
        'poids',
        [2, 3, 4, 0, 1]
      )
    );
  } else if (field === 'humidité') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'humidité',
        'ruche',
        'date',
        'poids',
        'température',
        [1, 2, 3, 4, 0]
      )
    );
  }

  renderOrderedTable(
    sortedArrays[0],
    sortedArrays[1],
    sortedArrays[2],
    sortedArrays[3],
    sortedArrays[4],
    sortedArrays[5],
    values[field].length
  );

  setOrderingArrowsId(field);
};
