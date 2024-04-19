import Fetch from "./Fetch";
import Table from "./Table";
import Map from "./Map";

class Init {

    constructor() {
        let self = this;
        if (smartrecruitersConfig.fetch === true && smartrecruitersConfig.companies.length) {
            (new Fetch()).get().then(data => self._jobs(data));
        } else {
            self._jobs((new Fetch()).getData(smartrecruitersItems));
        }
    }

    _jobs(data) {
        if (Object.keys(data.items).length) {
            new Table(data);
            new Map(data);
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    new Init();
});