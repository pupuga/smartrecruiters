export default class TableClearForm {

    constructor() {
    }

    clearSearch() {
        let filter = document.querySelector('.smartrecruiters__categories-filter');
        filter.value = filter.querySelector('option:nth-child(1)').value;
    }

    clearFilter() {
        document.querySelector('.smartrecruiters__search-input').value = '';
    }
}