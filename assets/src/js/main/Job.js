class Job {

    constructor() {
        let self = this;
        self.buttons = document.querySelectorAll('.smartrecruiters__button');
        if (self.buttons.length) {
            for (let button of self.buttons) {
                self._click(button);
            }
        }
    }

    _click(button) {
        button.addEventListener('click', function (){
            if (this.dataset.alert) {
                alert(this.dataset.alert);
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    new Job();
});