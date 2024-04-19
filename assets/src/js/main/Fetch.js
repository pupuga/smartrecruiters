export default class Fetch {

    constructor() {
    }

    get() {
        let self = this;
        let requests = [];
        for (let company of smartrecruitersConfig.companies) {
            requests.push(fetch(smartrecruitersConfig.restapi.replace(/\{company\}/gi, company)));
        }

        return self.fetch(requests);
    }

    async fetch(requests) {
        let self = this;
        return await Promise.all(requests)
            .then(responses => Promise.all(responses.map(response => response.json())))
            .then(data => self.getData(data))
    }

    getData(data) {
        let items = {};
        let categories = {};
        //console.log(data);
        //console.log(smartrecruitersConfig);
        if (data.length) {
            for (let company of data) {
                if(company.content !== undefined && company.content.length) {
                    for (let item of company.content) {
                        let type = item.typeOfEmployment.label.toLowerCase();
                        items[item.id] = {
                            'name': item.name,
                            'type': (smartrecruitersConfig[type] === undefined || !smartrecruitersConfig[type])
                                ? item.typeOfEmployment.label
                                : smartrecruitersConfig[type],
                            'category': item.customField[1].valueId,
                            'categoryLabel': item.customField[1].valueLabel,
                            'company': item.company.identifier,
                            'address': item.location.address,
                            'city': item.location.city,
                            'country': item.customField[0].valueLabel,
                            'postalCode': item.location.postalCode,
                            'link': smartrecruitersConfig.url + '?' +  item.company.identifier + '-' + item.id + '-' +
                                encodeURI(item.name.toLowerCase().replace(/ /gi, '-').replace(/-+/gi, '-')),
                        }
                        if(categories[items[item.id].category] === undefined) {
                            categories[items[item.id].category] = items[item.id].categoryLabel;
                        }
                    }
                }
            }
        }

        return {
            'items': items,
            'categories': categories
        };
    }

}