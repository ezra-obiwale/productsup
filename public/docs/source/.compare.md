---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://sandbox.test/docs/collection.json)

<!-- END_INFO -->

#Data

Endpoints to interact with the `data` resource
<!-- START_024021c3c17f0cb3ad10ff7ab83b1aa0 -->
## Fetch a paginated list of data.

Support filtering with on all fields. For example, `/api/data?q[description]=sodium

> Example request:

```bash
curl -X GET -G "http://sandbox.test/api/data" 
```

```javascript
const url = new URL("http://sandbox.test/api/data");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "data": [
        {
            "id": "167acdea-4834-415c-9011-d34bb3b8971e",
            "title": "However.",
            "description": "Multiplication Table doesn't.",
            "short_description": "Gryphon in an.",
            "category": "new",
            "price": "6434937.38",
            "image_link": "https:\/\/lorempixel.com\/640\/480\/?38175",
            "deeplink": "http:\/\/sandbox.test\/api\/data\/167acdea-4834-415c-9011-d34bb3b8971e",
            "created_at": "2019-02-05 16:46:59",
            "updated_at": "2019-02-05 16:46:59"
        }
    ],
    "meta": {
        "current_page": 1,
        "first_page_url": "http:\/\/sandbox.test\/api\/data?page=1",
        "from": 1,
        "next_page_url": null,
        "path": "http:\/\/sandbox.test\/api\/data",
        "per_page": 10,
        "prev_page_url": null,
        "to": 1
    }
}
```

### HTTP Request
`GET api/data`


<!-- END_024021c3c17f0cb3ad10ff7ab83b1aa0 -->

<!-- START_74fcdea9c36a323313b81cc71ccfb446 -->
## Create a new data resource

> Example request:

```bash
curl -X POST "http://sandbox.test/api/data" \
    -H "Content-Type: application/json" \
    -d '{"title":"FSOUaIZsEK1uJfh6","description":"YcMnKY8hyLG5SwEA","short_description":"M1hsnzHYy4xgLMhh","category":"vl22W9GUWCxEj9yV","price":"100.20","image":"VEzqEA0htjwG6Wdb","image_link":"xHG0SicrAHgPxVVO"}'

```

```javascript
const url = new URL("http://sandbox.test/api/data");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "FSOUaIZsEK1uJfh6",
    "description": "YcMnKY8hyLG5SwEA",
    "short_description": "M1hsnzHYy4xgLMhh",
    "category": "vl22W9GUWCxEj9yV",
    "price": "100.20",
    "image": "VEzqEA0htjwG6Wdb",
    "image_link": "xHG0SicrAHgPxVVO"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "data": {
        "title": "However.",
        "description": "Multiplication Table doesn't.",
        "short_description": "Gryphon in an.",
        "category": "new",
        "price": 6434937.38,
        "image_link": "https:\/\/lorempixel.com\/640\/480\/?38175",
        "id": "167acdea-4834-415c-9011-d34bb3b8971e",
        "deeplink": "http:\/\/sandbox.test\/api\/data\/167acdea-4834-415c-9011-d34bb3b8971e",
        "updated_at": "2019-02-05 16:46:59",
        "created_at": "2019-02-05 16:46:59"
    }
}
```

### HTTP Request
`POST api/data`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | The title of the data
    description | string |  required  | The description of the data
    short_description | string |  required  | The short descripotion of the data
    category | string |  required  | The category of the data
    price | numeric |  required  | The price of the data.
    image | file |  optional  | The image file. Required if the image link is not provided.
    image_link | string |  optional  | The link to the image. Required if image file is not provided.

<!-- END_74fcdea9c36a323313b81cc71ccfb446 -->

<!-- START_beabb7c5ebbc6975cee7d9827448825b -->
## Fetch the detail of a data resource

> Example request:

```bash
curl -X GET -G "http://sandbox.test/api/data/{data}" 
```

```javascript
const url = new URL("http://sandbox.test/api/data/{data}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "data": {
        "id": "167acdea-4834-415c-9011-d34bb3b8971e",
        "title": "However.",
        "description": "Multiplication Table doesn't.",
        "short_description": "Gryphon in an.",
        "category": "new",
        "price": "6434937.38",
        "image_link": "https:\/\/lorempixel.com\/640\/480\/?38175",
        "deeplink": "http:\/\/sandbox.test\/api\/data\/167acdea-4834-415c-9011-d34bb3b8971e",
        "created_at": "2019-02-05 16:46:59",
        "updated_at": "2019-02-05 16:46:59"
    }
}
```

### HTTP Request
`GET api/data/{data}`

#### Url Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | The id of the data resource

<!-- END_beabb7c5ebbc6975cee7d9827448825b -->

<!-- START_f54244a5c37efefed0ddad0acd320436 -->
## Update an existing data resource

> Example request:

```bash
curl -X PUT "http://sandbox.test/api/data/{data}" \
    -H "Content-Type: application/json" \
    -d '{"title":"fXCGp21YUX6pGuRI","description":"lAdt8MLjROceRX3p","short_description":"OEPMb9ehak4P81Vt","category":"KPTekI7ykooWZvJM","price":"500","image":"Ku9kdy8bDA1sP8RW","image_link":"avGtzWK0WKx9fyYh"}'

```

```javascript
const url = new URL("http://sandbox.test/api/data/{data}");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "title": "fXCGp21YUX6pGuRI",
    "description": "lAdt8MLjROceRX3p",
    "short_description": "OEPMb9ehak4P81Vt",
    "category": "KPTekI7ykooWZvJM",
    "price": "500",
    "image": "Ku9kdy8bDA1sP8RW",
    "image_link": "avGtzWK0WKx9fyYh"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "data": {
        "id": "167acdea-4834-415c-9011-d34bb3b8971e",
        "title": "No.",
        "description": "SIT down,' the King said to.",
        "short_description": "Queen put on.",
        "category": "new",
        "price": 6371142.01,
        "image_link": "https:\/\/lorempixel.com\/640\/480\/?23612",
        "deeplink": "http:\/\/sandbox.test\/api\/data\/167acdea-4834-415c-9011-d34bb3b8971e",
        "created_at": "2019-02-05 16:46:59",
        "updated_at": "2019-02-05 16:47:00"
    }
}
```

### HTTP Request
`PUT api/data/{data}`

`PATCH api/data/{data}`

#### Url Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | The id of the data resource
#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    title | string |  required  | The title of the data
    description | string |  required  | The description of the data
    short_description | string |  required  | The short description of the data
    category | string |  required  | The category of the data
    price | numeric |  required  | The price of the data.
    image | file |  optional  | The image file. Required if the image link is not provided.
    image_link | string |  optional  | The link to the image. Required if image file is not provided.

<!-- END_f54244a5c37efefed0ddad0acd320436 -->

<!-- START_d4a360547ae5624cd6ba254490f187fa -->
## Deletes a data resource

> Example request:

```bash
curl -X DELETE "http://sandbox.test/api/data/{data}" 
```

```javascript
const url = new URL("http://sandbox.test/api/data/{data}");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "status": "success",
    "data": {
        "id": "167acdea-4834-415c-9011-d34bb3b8971e",
        "title": "No.",
        "description": "SIT down,' the King said to.",
        "short_description": "Queen put on.",
        "category": "new",
        "price": "6371142.01",
        "image_link": "https:\/\/lorempixel.com\/640\/480\/?23612",
        "deeplink": "http:\/\/sandbox.test\/api\/data\/167acdea-4834-415c-9011-d34bb3b8971e",
        "created_at": "2019-02-05 16:46:59",
        "updated_at": "2019-02-05 16:47:00"
    }
}
```

### HTTP Request
`DELETE api/data/{data}`

#### Url Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | The id of the data resource

<!-- END_d4a360547ae5624cd6ba254490f187fa -->


