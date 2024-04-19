export default class TableEvents {

    constructor() {
        let self = this;
        self.rows = document.querySelectorAll('.smartrecruiters__table-row');
        if (self.rows.length) {
            for (let row of self.rows) {
                self._click(row)
            }
        }
    }

    _click(row) {
        let self = this;
        row.addEventListener('click', function (){
            let a = this.querySelector('a');
            a.click();
            //window.open(a.href, a.getAttribute('target'));
        });
    }
}