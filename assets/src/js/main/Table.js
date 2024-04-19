import Template from "./TableTemplate";
import TableEvents from "./TableEvents";
import SearchEvents from "./SearchEvents";
import FilterEvents from "./FilterEvents";

export default class Table {

    constructor(data) {
        let self = this;
        self.templates = new Template;
        if (self.templates.check()) {
            self.templates.setFilterTable(data);
            new TableEvents;
            new SearchEvents(data, self.templates);
            new FilterEvents(data, self.templates);
        }
    }
}