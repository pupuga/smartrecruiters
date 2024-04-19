import Clear from "./TableClearForm";

export default class FilterEvents {

    constructor(data, templates) {
        let self = this;
        self.data = data;
        self.templates = templates;
        self.element = document.querySelector('.smartrecruiters__categories-filter');
        let clear = (new Clear());
        self.element.addEventListener('change', function (e){
            clear.clearFilter();
            self.templates.setRows((e.target.value === 'all')
                ? self.data.items
                : self._getRows(e.target.value)
            );
        });
    }

    _getRows(value) {
        let self = this;
        let rows = {};
        for (let id in self.data.items) {
            if (self.data.items[id].category === value) {
                rows[id] = self.data.items[id];
            }
        }

        return rows;
    }
}