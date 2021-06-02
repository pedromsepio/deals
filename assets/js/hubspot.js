

/* https://www.npmjs.com/package/@hubspot/api-client */
var request = require("request");

var options = {
    method: 'GET',
    url: 'https://api.hubapi.com/crm/v3/objects/deals/dealId',
    qs: {archived: 'false', hapikey: '2d1462a0-0239-4439-9502-d94d18093798'},
    headers: {accept: 'application/json'}
};

request(options, function (error, response, body) {
    if (error) throw new Error(error);

    console.log(body);
});