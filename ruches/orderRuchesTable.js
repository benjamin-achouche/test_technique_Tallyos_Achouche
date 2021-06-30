const dataWrapper = $('#data-wrapper')[0];

const renderOrderedTable = (id, nom, lat, long, tableSize) => {
  let innerData = '';

  for (let i = 0; i < tableSize; i++) {
    innerData += `<div class='data'>
    <ul class='data__list ${i % 2 === 0 ? 'bg-grey' : ''}'>
    <li class='data__item nom-value'>${nom[i]}</li>
    <li class='data__item latitude-value'>${lat[i]}</li>
    <li class='data__item longitude-value'>${long[i]}</li>
    <li class='data__item'>
    <div class='data-modifiers'>
        <button type='button' class='btn btn-link modifier-ruche' data-toggle='modal' data-target='#modifier-ruche-modal-${i}'>Modifier</button>
        <div class='modal fade' id='modifier-ruche-modal-${i}'>
          <div class='modal-dialog modal-dialog-centered'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5>Modifier une ruche</h5>
                <button class='close' data-dismiss='modal'>X</button>
              </div>
              <div class='modal-body'>
                <form id='modifier-ruche-form-${i}' class='modal-form' action='../extern/modify.ext.php' method='post'>
                  <input class='form-control mr-sm-2' type='text' placeholder='Nom' name='nom' value='${
                    nom[i]
                  }' />
                  <input class='form-control mr-sm-2' type='number' step='0.000001' placeholder='Latitude' name='latitude' value='${
                    lat[i]
                  }'/>
                  <input class='form-control mr-sm-2' type='number' step='0.000001' placeholder='Longitude' name='longitude' value='${
                    long[i]
                  }'/>
                  <div class='modal-confirm-div'>
                    <button id='modifier-ruche-confirm-${i}' type='submit' name='modify-submit' class='btn btn-outline-success' value='${
      id[i]
    }'>
                      Confirmer
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>/
        <form action='../extern/delete.ext.php' method='post'>
          <button type='submit' name='delete-submit' class='btn btn-link' value='${
            nom[i]
          }'>Supprimer</button>
        </form>
      </div>
    </li>
    </ul>
    </div>`;
  }

  dataWrapper.innerHTML = innerData;
};

const removeOtherFieldsArrows = (field) => {
  const ids = ['nom', 'latitude', 'longitude'];

  for (const id of ids) {
    if (id !== field) {
      const spans = $(`.data-header-${id}`)[0]
        .querySelector('.order-data')
        .querySelectorAll('span');
      spans[0].removeAttribute('id');
      spans[1].removeAttribute('id');
    }
  }
};

const setOrderingArrowsId = (field) => {
  const spans = $(`.data-header-${field}`)[0]
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

const sortArrays = (field, values, id, val1, val2, val3, order) => {
  const array = [];
  const sortedIdArray = [];
  const sortedNomArray = [];
  const sortedLatArray = [];
  const sortedLongArray = [];
  const toBeSorted = [sortedNomArray, sortedLatArray, sortedLongArray];
  const sortedArrays = [sortedIdArray];

  const spans = $(`.data-header-${field}`)[0]
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
        values[id][i].value
    );
  }

  if (!spans[0].id) {
    array.sort();
  } else {
    array.sort().reverse();
  }

  for (let i = 0; i < array.length; i++) {
    sortedNomArray.push(array[i].split('_')[order[0]]);
    sortedLatArray.push(array[i].split('_')[order[1]]);
    sortedLongArray.push(array[i].split('_')[order[2]]);
    sortedIdArray.push(array[i].split('_')[3]);
  }

  for (let j = 0; j < order.length; j++) {
    sortedArrays[j + 1] = toBeSorted[j];
  }

  return sortedArrays;
};

export const orderRuchesTable = (values, field) => {
  const sortedArrays = [];

  if (field === 'nom') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'nom',
        'latitude',
        'longitude',
        [0, 1, 2]
      )
    );
  } else if (field === 'latitude') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'latitude',
        'longitude',
        'nom',
        [2, 0, 1]
      )
    );
  } else if (field === 'longitude') {
    sortedArrays.push(
      ...sortArrays(
        field,
        values,
        'id',
        'longitude',
        'nom',
        'latitude',
        [1, 2, 0]
      )
    );
  }

  renderOrderedTable(
    sortedArrays[0],
    sortedArrays[1],
    sortedArrays[2],
    sortedArrays[3],
    values[field].length
  );

  setOrderingArrowsId(field);
};
