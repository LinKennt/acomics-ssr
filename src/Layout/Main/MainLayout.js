// Инициализация страниц каталога
const initCatalogPage = () => {
    makeCatalogFilters();
    makeCatalogSearchForm();
};


// Инициализация общих элементов страницы
const init = () => {
	window.acomicsMain = {
		initCatalogPage,
	}

};

init();
