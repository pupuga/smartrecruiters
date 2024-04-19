import Clear from "./TableClearForm";

export default class SearchEvents {

    constructor(data, templates) {
        let self = this;
        self.data = data;
        self.templates = templates;
        self.element = document.querySelector('.smartrecruiters__search-input');
        let clear = (new Clear());
        self.element.addEventListener('keyup', function (e){
            clear.clearSearch();
            self.templates.setRows(self._getRows(this.value));
        });
    }

    _getRows(value) {
        let self = this;
        let rows = {};
        let fields = ['name', 'type', 'categoryLabel'];
        for (let id in self.data.items) {
            for (let field of fields) {
                if (self.data.items[id][field].toLowerCase().indexOf(value.toLowerCase()) + 1) {
                    rows[id] = self.data.items[id];
                    break;
                }
            }
        }

        return rows;
    }
}