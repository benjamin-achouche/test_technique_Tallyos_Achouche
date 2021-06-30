const tabLength = $('#tab-length')[0].value;
const lineCount = $('#line-count')[0];

lineCount.innerHTML = `Ligne ${
  tabLength > 0 ? 1 : 0
} à ${tabLength} sur ${tabLength}`;

const pageNavDiv = $('.pages-navigation-div')[0];

const pagination = $('.pagination')[0];

const writePages = () => {
  let leftBtn =
    '<button class="btn btn-outline-secondary btn-pages-left"><</button>';
  let rightBtn =
    '<button class="btn btn-outline-secondary btn-pages-right">></button>';
  let pagesBtn = '<button class="btn btn-primary btn-pages-center">1</button>';
  let innerText = '';

  innerText += leftBtn + pagesBtn;
  for (let i = 1; i < Math.ceil(tabLength / pagination.value); i++) {
    innerText += `<button class="btn btn-outline-secondary btn-pages-center" style="border">${
      i + 1
    }</button>`;
  }
  innerText += rightBtn;

  pageNavDiv.innerHTML = innerText;
};

writePages();
pagination.addEventListener('click', writePages);
