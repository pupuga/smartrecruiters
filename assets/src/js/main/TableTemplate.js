export default class TableTemplate {

    constructor() {
        let self = this;
        self.place = document.querySelector('.smartrecruiters__filter-table');
        if(self.check()) {
            self.filterTemplate = self._setFilterTemplate();
            self.tableTemplate = self._setTableTemplate();
            self.rowTemplate = self._setRowTemplate();
            document.querySelector('.smartrecruiters__templates').remove();
        }
    }

    check() {
        let self = this;

        return self.place !== null;
    }

    setFilterTable(data) {
        let self = this;
        self.place.innerHTML = self.getFilter(data.categories) + self.getTable(data.items);
    }

    setRows(items = {}) {
        let self = this;
        document.querySelector('.smartrecruiters__table').remove();
        document.querySelector('.smartrecruiters__filter').insertAdjacentHTML('afterEnd', self.getTable(items));
    }

    getFilter(categories = '') {
        let self = this;
        let html = '';
        if (Object.keys(categories).length) {
            for(let id in categories) {
                html += `<option value="${id}">${categories[id]}</option>`
            }
        }
        return self.filterTemplate
            .replace(/\{\{categories\}\}/gi, html);
    }

    getTable(items) {
        let self = this;
        return self.tableTemplate
            .replace(/<\/tbody>/gi, self.getRows(items) + '</tbody>');
    }

    getRows(items) {
        let self = this;
        let html = '';
        for(let id in items) {
            html += self.rowTemplate
                .replace(/#link/gi, items[id].link)
                .replace(/\{\{name\}\}/gi, items[id].name)
                .replace(/\{\{type\}\}/gi, items[id].type)
                .replace(/\{\{category\}\}/gi, items[id].category)
                .replace(/\{\{categoryLabel\}\}/gi, items[id].categoryLabel);
        }

        return html;
    }

    _setFilterTemplate() {
        let element = document.querySelector('.smartrecruiters__template--filter');
        let template = element.innerHTML;
        element.remove();

        return template;
    }

    _setTableTemplate() {
        let element = document.querySelector('.smartrecruiters__template--table');
        let template = element.innerHTML;
        element.remove();

        return template;
    }

    _setRowTemplate() {
        let element = document.querySelector('.smartrecruiters__template--table-row tbody');
        let template = element.innerHTML;
        element.remove();

        return template;
    }
}